// Created for The Alogical (GiMaker) by Aksel Std.

#include <boost/asio.hpp>
#include <boost/beast.hpp>
#include <iostream>
#include <string>
#include <vector>
#include <fstream>

namespace http = boost::beast::http;
namespace asio = boost::asio;
using tcp = asio::ip::tcp;

class StreamingServer {
private:
    asio::io_context& io_context_;
    tcp::acceptor acceptor_;
    std::string video_path_;

    void handle_request(tcp::socket& socket, const http::request<http::string_body>& req) {
        std::ifstream video_file(video_path_, std::ios::binary);
        if (!video_file) {
            send_error(socket, http::status::not_found);
            return;
        }

        video_file.seekg(0, std::ios::end);
        size_t file_size = video_file.tellg();
        video_file.seekg(0, std::ios::beg);

        size_t start_pos = 0;
        size_t end_pos = file_size - 1;
        bool is_range_request = false;

        auto range_header = req[http::field::range];
        if (!range_header.empty()) {
            is_range_request = true;
            std::string range_str(range_header);
            sscanf(range_str.c_str(), "bytes=%zu-%zu", &start_pos, &end_pos);
        }

        http::response<http::vector_body<char>> res;
        res.version(req.version());
        res.result(is_range_request ? http::status::partial_content : http::status::ok);
        res.set(http::field::content_type, "video/webm");
        res.set(http::field::accept_ranges, "bytes");

        if (is_range_request) {
            char content_range[100];
            sprintf(content_range, "bytes %zu-%zu/%zu", start_pos, end_pos, file_size);
            res.set(http::field::content_range, content_range);
        }

        size_t chunk_size = 8192; 
        std::vector<char> buffer(chunk_size);
        video_file.seekg(start_pos);

        size_t remaining = end_pos - start_pos + 1;
        while (remaining > 0 && video_file) {
            size_t to_read = std::min(chunk_size, remaining);
            video_file.read(buffer.data(), to_read);
            size_t bytes_read = video_file.gcount();

            if (bytes_read == 0) break;

            res.body().insert(res.body().end(), buffer.begin(), buffer.begin() + bytes_read);
            remaining -= bytes_read;
        }

        res.prepare_payload();
        http::write(socket, res);
    }

    void send_error(tcp::socket& socket, http::status status) {
        http::response<http::string_body> res{status, 11};
        res.set(http::field::content_type, "text/plain");
        res.body() = http::to_string(status);
        res.prepare_payload();
        http::write(socket, res);
    }

public:
    StreamingServer(asio::io_context& io_context, unsigned short port, const std::string& video_path)
        : io_context_(io_context),
          acceptor_(io_context, tcp::endpoint(tcp::v4(), port)),
          video_path_(video_path) {
        accept_connections();
    }

private:
    void accept_connections() {
        acceptor_.async_accept(
            [this](boost::system::error_code ec, tcp::socket socket) {
                if (!ec) {
                    // Handle the connection in a new thread
                    std::thread([this, s = std::move(socket)]() mutable {
                        try {
                            http::request<http::string_body> req;
                            http::read(s, req);
                            handle_request(s, req);
                        }
                        catch (const std::exception& e) {
                            std::cerr << "Error: " << e.what() << std::endl;
                        }
                    }).detach();
                }
                accept_connections();
            });
    }
};