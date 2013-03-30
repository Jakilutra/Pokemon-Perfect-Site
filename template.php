<?php
	$pages = array ("index.php" => "Home", "papos.php" => "PAPOS", "nbs.php" => "NBS");
	$currentpage = basename($_SERVER['PHP_SELF']);
	$nav = "\t\t<div class='nav'>";
	foreach ($pages as $page => $name){
		if ($page === $currentpage){
			$nav .= "<b>{$name}</b> | ";
		}
		else {
			$nav .= "<a href={$page}>{$name}</a> | ";
		}
	}
	$nav .= "<a class='external' href='forums/forum.php'>Forums</a></div>\n";
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
	. "\t\t\t<h1>{$title}</h1>\n"
	. "\t\t\t<hr />\n"
	. $content
	. "\t\t\t<hr />\n"
	. "\t\t\t<div>\n"
	. "\t\t\t\tAll content is &copy; 2013 pokemonperfect.com. Pok&eacute;mon is &copy; 1995-2013 Nintendo\n"
	. "\t\t\t</div>\n"
	. "\t\t</div>\n"
	. "\t\t<div class='footer'>\n"
	. "\t\t\t<a href='http://php.net'><img src='php-power-white.png' alt='powered by php'></a>"
	. "\t\t\t<a href='http://jigsaw.w3.org/css-validator/check/referer'><img src='vcss-blue.gif' alt='valid CSS'></a>\n"
	. "\t\t\t<a href='http://www.w3.org/html/logo/'><img src='html5-badge-h-solo.png' height='32' width='32' alt='HTML5 powered'></a>\n"
	. "\t\t\t<iframe src='http://ghbtns.com/github-btn.html?user=Jakilutra&amp;repo=Pokemon-Perfect-Site&amp;type=watch' width='62' height='20'></iframe>\n"
	. "\t\t\t<a href='https://twitter.com/PokemonPerfect' class='twitter-follow-button' data-show-count='false'>Follow @PokemonPerfect</a>\n"
	. "\t\t\t<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>\n"
	. "\t\t</div>\n"
	. "\t</body>\n"
	. "</html>\n";
?>