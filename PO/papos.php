<?php
function get_details($dir) {
	$config = file($dir."/config");
	$details = array("name" => "undefined", "port" => "undefined");
	foreach ($config as $line) {
		if ($details["name"] === "undefined" || $details["port"] === "undefined"){
			if (substr_compare($line, "Name=", 0,5) == 0){
				$details["name"] = str_replace("\\xe9", "&eacute;", str_replace("\r\n", "", substr($line, 5)));
			}
			if (substr_compare($line, "Ports=", 0,6) == 0){
				$details["port"] = str_replace("\r\n", "", substr($line, 6));
			}
		}
		else {
			break;
		}
	}
	if (!$socket = @fsockopen("127.0.0.1", $details["port"], $errno, $errstr, 30)){
		$details["status"] = "<div class='offline'>Offline</div>";
	}
	else {
		fclose($socket);
		$details["status"] = "<div class='online'>Online</div>";
	}
	return $details;
}
$ip = $_SERVER['SERVER_NAME'];
$all = array();
$i = 0;
$homedir = dirname(getcwd());
if ($handle = opendir($homedir)) {
	while (false !== ($entry = readdir($handle))) {
		if (is_dir($homedir."/".$entry)){
			if (file_exists($homedir."/".$entry."/config") && file_exists($homedir."/".$entry."/server.exe")){
				$all[$i++] = get_details($homedir."/".$entry);
			}
		}
	}
	closedir($handle);		
}
$table = "\t\t\t<table>\n"
. "\t\t\t\t<tr>\n"
. "\t\t\t\t\t<th>Name</th><th>Advanced Connection</th><th>Status</th>\n"
. "\t\t\t\t</tr>\n";
foreach ($all as $j){
	$table .= "\t\t\t\t<tr>\n"
	. "\t\t\t\t\t<td>{$j["name"]}</td><td><a class='external' id='". str_replace("'", "&#39;", str_replace(" ", "_", $j["name"])) . "' href='http://po-devs.github.com/webclient/?server={$ip}%3A{$j["port"]}&amp;autoconnect=true'>{$ip}:{$j["port"]}</a></td><td>{$j["status"]}</td>\n"
	. "\t\t\t\t</tr>\n";
}
$table .= "\t\t\t</table>\n";
$title = "Perfect Alliance of Pokemon Online Servers (PAPOS)";
$content = "\t\t\t<p> PAPOS is a group of servers hosted by pokemonperfect.com. PAPOS has a skype group with 2 participants from each server, for a total of 6 members. The skype group was set up to maintain one place for discussing problems experienced with the pokemonperfect.com servers. It also doubles as a place to chat about anything with its members.</p>\n"
. "\t\t\t<p> See below for details on PAPOS server names, their advance connections and online status. Clicking an advance connection link will connect you to the corresponding server via PO's in-development web client.</p>\n"
. $table;
include "../template.php";
echo $display;
?>