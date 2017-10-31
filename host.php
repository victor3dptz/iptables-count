<?php
#ID сервера в базе
$host='Mail';

# Запуск host.php <имя файла>
$link=mysqli_connect("IP", "USER", "PASSWORD", "DATABASE");
if (!$link) {
	file_put_contents("error.log", date("Y-m-d H:i:s")."\n", FILE_APPEND);
	file_put_contents("error.log", mysqli_connect_error()."\n", FILE_APPEND);
	if (isset($argv[1])) {
	$file_handle = fopen("$argv[1]", "r");
	while (!feof($file_handle)) {
	$line = fgets($file_handle);
	file_put_contents("error.log", $line, FILE_APPEND);
	}
	}
	file_put_contents("error.log", "-------------------------------------------\n", FILE_APPEND);
	close($file_handle);
	exit;
}
mysqli_query($link, 'set names utf8');

if (!isset($argv[1])){
echo "Usage: host.php <filename>\n";
exit;
}

$file_handle = fopen("$argv[1]", "r");
while (!feof($file_handle)) {
	$line = fgets($file_handle);
	$a=strpos($line,";");
	$pkts=substr($line,0,$a);
	$b=strpos($line,",");
	$bytes=substr($line,$a+1,$b-$a-1);
	$c=strpos($line,"-");
	$port=substr($line,$b+1,$c-$b-1);
	$protocol=trim(substr($line,$c+1));
	mysqli_query($link,"INSERT INTO data (datetime, server, protocol, port, pkts, bytes) VALUES (NOW(), '$host', '$protocol', $port, $pkts, $bytes)");
}
fclose($file_handle);

mysqli_close($link);
?>
