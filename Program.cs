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
                int end = 0;
                bool parse = false;
                for(int i = 5; end == 0; ++i){
                	if(message[i] == '?') parse = true;
                	else if(message[i] == ' ') end = i - 5;
                } 
                string way = message.Substring(5, end);
                Console.WriteLine($"Way: {way}, parse: {parse}\r\n");
                if(way == ""){
                	way = "index.html";
                }
                //Console.WriteLine("ACK: " + message);
                string result = "";
                if(!parse){
                	try {
		        	using (StreamReader sr = new StreamReader("front/"+way)) {
					string line;
					// Read and display lines from the file until the end of
					// the file is reached.
					line = sr.ReadLine();
					while (line != null)
					{
						Console.Write(line);
				
						result += line;
						line = sr.ReadLine();
					}
			    	}
                	} catch (Exception e) {
                		st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 404 Not Found\r\n"));
                		continue;
                	}
                	
                }
                st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: text/html\r\nContent-Length: {result.Length}\r\nAccept-Ranges: bytes\r\n\r\n{result}"));
	}
}

