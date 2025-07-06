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

Hashtable ext = new Hashtable();
ext.Add("html", "text/html");
ext.Add("css", "text/css");
ext.Add("js", "application/javascript");

ext.Add("png", "image/png");
ext.Add("jpg", "image/jpeg");
ext.Add("webp", "image/webp");
ext.Add("gif", "image/gif");

ext.Add("mp4", "video/mp4");
ext.Add("webm", "video/webm");
ext.Add("ico", "image/x-icon");


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
                byte[] result;
                if(!parse){
                	try {
                		result = File.ReadAllBytes("front/"+way);
                		//result = Encoding.ASCII.GetString(fileBytes, 0, 1024);
                		/*
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
			    	*/
			    	string exte = "text/plain";
				int toe = way.IndexOf(".") + 1;
				string est = way.Substring(toe, way.Length - toe);
				Console.Write("\n");
				Console.Write(est);
				Console.Write("\n");
				if(ext.ContainsKey(est)){
					//exte = ext.Read(est);
					exte = (string) ext[est];
				}
				byte[] rt = Encoding.ASCII.GetBytes($"HTTP/1.1 200 OK\r\nContent-Type: {exte}\r\nContent-Length: {result.Length}\r\nAccept-Ranges: bytes\r\n\r\n");
				byte[] tow = new byte[rt.Length + result.Length];
				for(int i = 0; i < rt.Length; ++i){
					tow[i] = rt[i];
				}
				for(int i = 0; i < result.Length; ++i){
					tow[rt.Length + i] = result[i];
				}
				
				st.Write(tow);
                	} catch (Exception e) {
                		st.Write(Encoding.ASCII.GetBytes($"HTTP/1.1 404 Not Found\r\n" + e.ToString()));
                		continue;
                	}
                	
                }
                
	}
}

