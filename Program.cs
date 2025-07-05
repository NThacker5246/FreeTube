// See https://aka.ms/new-console-template for more information
using System.Net;
using System.Net.Sockets;
using System;
using System.Collections;
using System.Collections.Generic;

using System.Globalization;
using System.Text;

int port = 80;
TcpListener server = new TcpListener(IPAddress.Any, port);
server.Start();

while(true){
	using (TcpClient client = server.AcceptTcpClient()){
		Console.WriteLine("Client joined");
		NetworkStream st = client.GetStream();
		byte[] buffer = new byte[1024];
		int bytesRead = st.Read(buffer, 0, buffer.Length);
                
                string message = Encoding.ASCII.GetString(buffer, 0, bytesRead);
                Console.WriteLine("ACK: " + message);
                st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/html\r\nContent-Length: 20\r\nAccept-Ranges: bytes\r\n\r\n<h1>Hello World</h1>"));
	}
}
