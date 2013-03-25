<?php
function get_details($dir) {
	$config = file($dir."/config");
	$details = array("name" => "undefined", "port" => "undefined");
	foreach ($config as $line) {
		if ($details["name"] === "undefined" || $details["port"] === "undefined"){
			if (substr_compare($line, "Name=", 0,5) == 0){
				$details["name"] = utf8_encode(str_replace("\\xe9", "é", substr($line, 5)));
			}
			if (substr_compare($line, "Ports=", 0,6) == 0){
				$details["port"] = substr($line, 6);
			}
		}
		else {
			break;
		}
	}
	if (!$socket = @fsockopen("127.0.0.1", $details["port"], $errno, $errstr, 30)){
		$details["status"] = "<font color='red'><strong>Offline</strong></font>";
	}
	else {
		fclose($socket);
		$details["status"] = "<font color='green'><strong>Online</strong></font>";
	}
	return $details;
}
$ip = $_SERVER['SERVER_NAME'];
$all = array();
$i = 0;
if ($handle = opendir(getcwd())) {
	while (false !== ($entry = readdir($handle))) {
		if (is_dir($entry)){
			if (file_exists($entry."/config") && file_exists($entry."/server.exe")){
				$all[$i++] = get_details($entry);
			}
		}
	}
	closedir($handle);		
}
$table = "\t\t<table>\n"
. "\t\t\t<tr>\n"
. "\t\t\t\t<th>Name</th><th>Advanced Connection</th><th>Status</th>\n"
. "\t\t\t</tr>\n";
foreach ($all as $j){
	$table .= "\t\t\t<tr>\n"
	. "\t\t\t\t<td>{$j["name"]}</td><td><a href='http://po-devs.github.com/webclient/?server={$ip}%3A{$j["port"]}&autoconnect=true'>{$ip}:{$j["port"]}</a></td><td>{$j["status"]}</td>\n"
	. "\t\t\t</tr>\n";
}
$table .= "</table>\n";
$display = "<!DOCTYPE html>\n"
. "<html>\n"
. "\t<head>\n"
. "\t\t<title> PAPOS Server List </title>\n"
. "\t</head>\n"
. "\t<body>\n"
. $table
. "\t</body>\n"
. "</html>\n";
echo $display;
?>