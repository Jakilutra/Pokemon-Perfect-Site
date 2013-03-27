<?php
	$nav = "\t\t<div class='nav'><a href='index.php'>Home</a> | <a href='papos.php'>PAPOS</a> | <a class='external' href='forums/forum.php'>Forums</a></div>\n";
	switch ($sitepage){
		case "papos": $nav = str_replace("<a href='papos.php'>PAPOS</a>", "<b>PAPOS</b>", $nav);
		break;
		case "index": $nav = str_replace("<a href='index.php'>Home</a>", "<b>Home</b>", $nav);
		break;
	}
	$display = "<!DOCTYPE html>\n"
	. "<html>\n"
	. "\t<head>\n"
	. "\t\t<meta charset='UTF-8'>\n"
	. "\t\t<link href='style.css' rel='stylesheet' type='text/css'>\n"
	. "\t\t<title>{$title}</title>\n"
	. "\t</head>\n"
	. "\t<body>\n"
	. "\t\t<img class='banner' src ='PPBanner.png' alt='Pokemon Perfect Banner' />\n"
	. $nav
	. "\t\t<div class='content'>\n"
	. "\t\t\t<h1>{$header}</h1>\n"
	. "\t\t\t<hr />\n"
	. $content
	. "\t\t\t<hr />\n"
	. "\t\t\t<div>\n"
	. "\t\t\t\tAll content is &copy; 2013 pokemonperfect.com. Pok&eacute;mon is &copy; 1995-2013 Nintendo\n"
	. "\t\t\t</div>\n"
	. "\t\t</div>\n"
	. "\t</body>\n"
	. "</html>\n";
?>