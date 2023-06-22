<?php

	// Bind a socket to localhost:8080
	$socketServer = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_bind($socketServer, "webminer.moneroocean.stream", "443");
	socket_listen($socketServer);

	// Begin the server loop
	while (1){

		// Wait for a connection
		$connection = socket_accept($socketServer);

		// Gather all data in socket buffer intil \r\n\r\n is hit
		$reading = true;
		$buffer = "";
		while ($reading){
			$buffer .= socket_read($connection, 1);

			if (strpos($buffer, "\r\n\r\n") !== false){
				// This is the HTTP end of header data
				print("Buffer end\n");
				$reading = false; // Stop the reading loop
			}
		}

		// Split HTTP into individual lines
		$lines = explode("\r\n", $buffer);

		// Parse headers
		// Ignore first index - it's the HTTP type
		$headers = [];
		foreach ($lines as $index=>$header){
			if ($index > 0){

				// Trim the header of whitespace - is it blank?
				if (trim($header) !== ""){

					// Extract the header name and value
					preg_match("/([^\:]+): \s*(.+)/", $header, $matches);
					$headers[$matches[1]] = $matches[2];
				}
			}
		}

		// Debug print
		print_r($headers);

		// Assume Connection is "upgrade"
		$key = $headers['Sec-WebSocket-Key']; // Get the key
		//$uuid = "258EAFA5-E914-47DA-95CA-C5AB0DC85B11"; // This is a constant
		$result = sha1($key . $uuid, true); // true to output raw
		$result = base64_encode($result);

http_response_code(101);
		// Respond to the request with handshake headers
		//$response = "HTTP/1.1 101 Switching Protocols\r\n";
		//$response .= "Upgrade: websocket\r\n";
		//$response .= "Connection: upgrade\r\n";
		//$response .= "Sec-WebSocket-Accept: $result\r\n";

		// This header is only necessary if the client has it in the request headers
		// $response .= "Sec-WebSocket-Protocol: chat\r\n";
		
		$response .= "\r\n"; // End all HTTP headers with a set of \r\n (blank line)

		// Debug print
		print($response);

		// Send the respons e headers to the websocket
		socket_write($connection, $response, mb_strlen($response));

		// At this point the WebSocket is connected
		// and we should infinitely listen to messages from $connection

	}
