<?php
function get_status($ip, $port) {
	if (!$socket = @fsockopen($ip, $port, $errno, $errstr, 30)){
		return "<div class='offline'>Offline</div>";
	}
	else {
		fclose($socket);
		return "<div class='online'>Online</div>";
	}
}
$sitepage = "nbs";
$title = "NBS Server List";
$header = "Pok&eacute;mon NetBattle Supremacy (NBS)";
$content = "\t\t\t<table>"
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
include "template.php";
echo $display;
?>