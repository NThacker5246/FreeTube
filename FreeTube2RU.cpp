// FreeTube2RU.cpp : Этот файл содержит функцию "main". Здесь начинается и заканчивается выполнение программы.
//
#include <fstream>
#include <iostream>
#include <sstream>
#include <string>
#include <map>
#include <algorithm>

#define _WIN32_WINNT 0x501
#include <WinSock2.h>
#include <WS2tcpip.h>
#pragma comment(lib, "Ws2_32.lib")

using std::cerr;
using std::string;

string getExtension(const string& path) {
    size_t dot_pos = path.find_last_of('.');
    if (dot_pos == string::npos) return "";
    return path.substr(dot_pos + 1);
}

std::map<string, string> mime_types = {
    {"html", "text/html"},
    {"css", "text/css"},
    {"js", "application/javascript"},
    {"png", "image/png"},
    {"jpg", "image/jpeg"},
    {"jpeg", "image/jpeg"},
    {"gif", "image/gif"},
    {"mp4", "video/mp4"},
    {"webm", "video/webm"},
    {"ico", "image/x-icon"}
};

// Парсинг заголовка Range (например, "bytes=0-999")
bool parseRange(const string& range_header, size_t file_size, size_t& start, size_t& end) {
    if (range_header.empty() || range_header.find("bytes=") == string::npos) {
        return false;
    }

    size_t eq_pos = range_header.find('=');
    size_t dash_pos = range_header.find('-', eq_pos + 1);

    if (dash_pos == string::npos) {
        return false;
    }

    string start_str = range_header.substr(eq_pos + 1, dash_pos - eq_pos - 1);
    string end_str = range_header.substr(dash_pos + 1);

    start = stoull(start_str);
    end = end_str.empty() ? file_size - 1 : stoull(end_str);

    if (end >= file_size) {
        end = file_size - 1;
    }

    return true;
}

int main() {
    WSADATA wsaData;
    int result = WSAStartup(MAKEWORD(2, 2), &wsaData);

    if (result != 0) {
        cerr << "WSAStartup failed: " << result << "\n";
        return result;
    }

    struct addrinfo* addr = NULL;
    struct addrinfo hints;
    ZeroMemory(&hints, sizeof(hints));
    hints.ai_family = AF_INET;
    hints.ai_socktype = SOCK_STREAM;
    hints.ai_protocol = IPPROTO_TCP;
    hints.ai_flags = AI_PASSIVE;

    result = getaddrinfo("127.0.0.1", "8000", &hints, &addr);

    if (result != 0) {
        cerr << "getaddrinfo failed: " << result << "\n";
        WSACleanup();
        return 1;
    }

    int listen_socket = socket(addr->ai_family, addr->ai_socktype, addr->ai_protocol);
    if (listen_socket == INVALID_SOCKET) {
        cerr << "Error at socket: " << WSAGetLastError() << "\n";
        freeaddrinfo(addr);
        WSACleanup();
        return 1;
    }

    result = bind(listen_socket, addr->ai_addr, (int)addr->ai_addrlen);
    if (result == SOCKET_ERROR) {
        cerr << "bind failed with error: " << WSAGetLastError() << "\n";
        freeaddrinfo(addr);
        closesocket(listen_socket);
        WSACleanup();
        return 1;
    }

    if (listen(listen_socket, SOMAXCONN) == SOCKET_ERROR) {
        cerr << "listen failed with error: " << WSAGetLastError() << "\n";
        closesocket(listen_socket);
        WSACleanup();
        return 1;
    }

    const int max_client_buffer_size = 1024;
    char buf[max_client_buffer_size];
    int client_socket = INVALID_SOCKET;

    for (;;) {
        client_socket = accept(listen_socket, NULL, NULL);
        if (client_socket == INVALID_SOCKET) {
            cerr << "accept failed: " << WSAGetLastError() << "\n";
            closesocket(listen_socket);
            WSACleanup();
            return 1;
        }

        result = recv(client_socket, buf, max_client_buffer_size, 0);

        if (result == SOCKET_ERROR) {
            cerr << "recv failed: " << result << "\n";
            closesocket(client_socket);
        }
        else if (result == 0) {
            cerr << "connection closed...\n";
        }
        else if (result > 0) {
            buf[result] = '\0';
            string request(buf);

            // Парсим путь запроса
            size_t start_pos = request.find(' ') + 1;
            size_t end_pos = request.find(' ', start_pos);
            string path = request.substr(start_pos, end_pos - start_pos);

            if (path == "/") path = "/index.html";
            string file_path = path.substr(1);

            // Проверяем, есть ли заголовок Range
            bool is_range_request = (request.find("Range: bytes=") != string::npos);
            string range_header;

            if (is_range_request) {
                size_t range_start = request.find("Range: bytes=");
                size_t range_end = request.find("\r\n", range_start);
                range_header = request.substr(range_start + 13, range_end - range_start - 13);
            }

            // Открываем файл
            std::ifstream file(file_path, std::ios::binary | std::ios::ate);
            if (!file) {
                string response_body = "404 Not Found";
                string response = "HTTP/1.1 404 Not Found\r\n"
                    "Content-Type: text/plain\r\n"
                    "Content-Length: " + std::to_string(response_body.size()) + "\r\n"
                    "\r\n" + response_body;
                send(client_socket, response.c_str(), response.size(), 0);
                closesocket(client_socket);
                continue;
            }

            size_t file_size = file.tellg();
            file.seekg(0, std::ios::beg);

            size_t range_start = 0, range_end = file_size - 1;
            bool has_range = parseRange(range_header, file_size, range_start, range_end);

            string response;
            if (has_range) {
                // Отправляем часть файла (206 Partial Content)
                size_t chunk_size = range_end - range_start + 1;
                file.seekg(range_start);

                char* chunk_data = new char[chunk_size];
                file.read(chunk_data, chunk_size);

                response = "HTTP/1.1 206 Partial Content\r\n"
                    "Content-Type: " + mime_types[getExtension(file_path)] + "\r\n"
                    "Content-Length: " + std::to_string(chunk_size) + "\r\n"
                    "Content-Range: bytes " + std::to_string(range_start) + "-" +
                    std::to_string(range_end) + "/" + std::to_string(file_size) + "\r\n"
                    "\r\n";

                send(client_socket, response.c_str(), response.size(), 0);
                send(client_socket, chunk_data, chunk_size, 0);
                delete[] chunk_data;
            }
            else {
                // Отправляем весь файл (200 OK)
                char* file_data = new char[file_size];
                file.read(file_data, file_size);

                response = "HTTP/1.1 200 OK\r\n"
                    "Content-Type: " + mime_types[getExtension(file_path)] + "\r\n"
                    "Content-Length: " + std::to_string(file_size) + "\r\n"
                    "Accept-Ranges: bytes\r\n"  // Говорим клиенту, что поддерживаем Range
                    "\r\n";

                send(client_socket, response.c_str(), response.size(), 0);
                send(client_socket, file_data, file_size, 0);
                delete[] file_data;
            }

            file.close();
            closesocket(client_socket);
        }
    }

    closesocket(listen_socket);
    freeaddrinfo(addr);
    WSACleanup();
    return 0;
}

// Запуск программы: CTRL+F5 или меню "Отладка" > "Запуск без отладки"
// Отладка программы: F5 или меню "Отладка" > "Запустить отладку"

// Советы по началу работы 
//   1. В окне обозревателя решений можно добавлять файлы и управлять ими.
//   2. В окне Team Explorer можно подключиться к системе управления версиями.
//   3. В окне "Выходные данные" можно просматривать выходные данные сборки и другие сообщения.
//   4. В окне "Список ошибок" можно просматривать ошибки.
//   5. Последовательно выберите пункты меню "Проект" > "Добавить новый элемент", чтобы создать файлы кода, или "Проект" > "Добавить существующий элемент", чтобы добавить в проект существующие файлы кода.
//   6. Чтобы снова открыть этот проект позже, выберите пункты меню "Файл" > "Открыть" > "Проект" и выберите SLN-файл.

