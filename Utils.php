<?php
function request_by_socket($remote_server,$remote_path,$post_string,$port = 80,$timeout = 30){
$socket = fsockopen($remote_server,$port,$errno,$errstr,$timeout);
if (!$socket) die("$errstr($errno)");

//echo "Start to post the request\r\n\r\n";
fwrite($socket,"POST $remote_path HTTP/1.0\r\n");
//fwrite($socket,"User-Agent: Socket Example\r\n");
fwrite($socket,"HOST: $remote_server\r\n");
fwrite($socket,"Content-type: application/soap+xml; charset=utf-8\r\n");
fwrite($socket,"Content-length: ".(strlen($post_string)+1)."\r\n");
fwrite($socket,"Accept:*/*\r\n");
fwrite($socket,"\r\n");
fwrite($socket,"$post_string\r\n");
fwrite($socket,"\r\n");

$header = "";
while ($str = trim(fgets($socket,4096))) {
$header.=$str;
}

//echo "Header is: \r\n".$header;

$data = "";
while (!feof($socket)) {
$data .= fgets($socket,4096);
}

return $data;
}
?>