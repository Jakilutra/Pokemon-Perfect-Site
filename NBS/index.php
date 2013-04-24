<?php
function get_status($ip, $port) {
	if (!$socket = @fsockopen($ip, $port, $errno, $errstr, 0.1)){
		return "<div class='offline'>Offline</div>";
	}
	else {
		fclose($socket);
		return "<div class='online'>Online</div>";
	}
}
$title = "Pok&eacute;mon NetBattle Supremacy (NBS)";
$content = "\t\t\t<p><a id='NetBattle_Supremacy_Site' class='external' href='http://nbsup.50webs.com/index.html'>Pok&eacute;mon NetBattle Supremacy</a> is a downloadable simulator that is the successor to Pok&eacute;mon NetBattle, debuting in February 2009, and adding support for the fourth generation &ndash; thus supporting the first four generations. The simulator was developed by Bayleef, with assistance from DJ Fury, Glaceon and Codabedago.</p>\n"
. "\t\t\t<p> We have the latest version (1.1.1) for you to <a id='NBS_Installer' href='NBSInstall.exe'>download</a>.</p>\n"
. "\t\t\t<table>"
. "\t\t\t\t<tr>\n"
. "\t\t\t\t\t<th>Name</th><th>Status</th>\n"
. "\t\t\t\t</tr>\n"
. "\t\t\t\t<tr>\n" 
. "\t\t\t\t\t<td>Server Registry</td><td>" . get_status('registry.nbsup.com', 30001) . "</td>\n"
. "\t\t\t\t</tr>\n"
. "\t\t\t</table>\n"
. "\t\t\t<table>\n"
. "\t\t\t\t<tr>\n"
. "\t\t\t\t\t<th>Name</th><th>Advanced Connection</th><th>Status</th>\n"
. "\t\t\t\t</tr>\n"
. "\t\t\t\t<tr>\n"
. "\t\t\t\t\t<td>Global Casino</td><td>atq.zapto.org</td><td>" . get_status('127.0.0.1', 30000) . "</td>\n"
. "\t\t\t\t</tr>\n"
. "\t\t\t\t<tr>\n"
. "\t\t\t\t\t<td>The Dove Shack</td><td>registry.nbsup.com</td><td>" . get_status('registry.nbsup.com', 30000) . "</td>\n"
. "\t\t\t\t</tr>\n"
. "\t\t\t</table>\n";
include "../template.php";
echo $display;
?>