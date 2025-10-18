<?
$dt = date('m/d/Y h:i:s a', time());
$page = $_SERVER['REQUEST_URI'];
$ref = $_SERVER['HTTP_REFERER'];
$path = "$dt | $page | $ref \r\n";
$logFile = "log/log.txt";
$myfile = fopen($logFile, "a");
fwrite($myfile, $path);
fclose($myfile);
?>
