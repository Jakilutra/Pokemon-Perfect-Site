<?php
	$pages = array ("/" => "Home", "/ps/" => "PS", "/po/" => "PO", "/nbs/" => "NBS", "/sprites/" => "Sprites");
	$currentpage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$nav = "\t\t<div class='nav'>";
	foreach ($pages as $page => $name){
		if ($page === $currentpage){
			$nav .= "<b>{$name}</b> | ";
		}
		else {
			$nav .= "<a href='{$page}'>{$name}</a> | ";
		}
	}
	$nav .= "<a class='external' href='/forums/'>Forum</a></div>\n";
	$dirnames = array("po" => "Pokemon Online (PO)", "nbs" => "Pok&eacutemon NetBattle Supremacy (NBS)", "ps" => "Pokemon Showdown (PS)", "sprites" => "Sprites", "stadium" => "Stadium");
	$dirs = explode("/", $currentpage);
	if ($dirs[1] === ""){
		$subnavpath = "<b>Pokemon Perfect</b>";
	}
	else {
		$subnavpath = "<a href='/'>Pokemon Perfect</a>";
	}
	if (count($dirs) > 2){
		if ($dirs[2] !== ""){
			$subnavpath .= " -> " . "<a href='/" . $dirs[1] . "/'>" . $dirnames[strtolower($dirs[1])] . "</a>";
		}
		else {
			$subnavpath .= " -> " . "<b>" . $dirnames[strtolower($dirs[1])] . "</b>";
		}
		if (count($dirs) > 3){
			if ($dirs[3] !== ""){
				$subnavpath .= " -> " . "<a href='/" . $dirs[1] . "/" . $dirs[2] . "/'>" . $dirnames[strtolower($dirs[2])] . "</a>";
			}
			else {
				$subnavpath .= " -> " . "<b>" . $dirnames[strtolower($dirs[2])] . "</b>";
			}
			if (count($dirs) > 4){
				if ($dirs[4] !== ""){
					$subnavpath .= " -> " . "<a href='/" . $dirs[1] . "/" . $dirs[2] . "/" . $dirs[3] . "/'>" . $dirnames[strtolower($dirs[3])] . "</a>";
				}
				else {
					$subnavpath .= " -> " . "<b>" . $dirnames[strtolower($dirs[3])] . "</b>";
				}
				if (count($dirs) > 5){
					if ($dirs[5] !== ""){
						$subnavpath .= " -> " . "<a href='/" . $dirs[1] . "/" . $dirs[2] . "/" . $dirs[3] . "/" . $dirs[4] . "/'>" . $dirnames[strtolower($dirs[4])] . "</a>";
					}
					else {
						$subnavpath .= " -> " . "<b>" . $dirnames[strtolower($dirs[4])] . "</b>";
					}
				}
			}
		}
	}
	if ($dirs[count($dirs)-1] !== ""){
		$subnavpath .=  " -> <b>{$title}</b>";
	}
	$subnav = "\t\t<div class='subnav'>{$subnavpath}</div>\n";
	$doc = new DOMDocument();
	$doc->loadHTML($content);
	$links = $doc->getElementsByTagName('a');
	$exlinks = array();
	$inlinks = array();
	foreach ($links as $link){
		if ($link->getAttribute('class') === "external"){
			array_push($exlinks, "<a class='external' href='" . str_replace("&", "&amp;", $link->getAttribute('href')) . "'>" . str_replace("_", " ", $link->getAttribute('id'))  . "</a>");
		}
		else {
			array_push($inlinks, "<a href='" . str_replace("&", "&amp;", $link->getAttribute('href')) . "'>" . str_replace("_", " ", $link->getAttribute('id'))  . "</a>");
		}	
	}
	$exlinks = implode(" | ", $exlinks);
	$inlinks = implode(" | ", $inlinks);
	$linksummary = "";
	if ($inlinks !== "" || $exlinks !== ""){
		$linksummary .= "\t\t<div class='linksummary'>\n";
		if ($inlinks !== ""){
			$linksummary .= "\t\t\tInternal Links: {$inlinks}<br />\n";
		}
		if ($exlinks !==""){
			$linksummary .= "\t\t\tExternal Links: {$exlinks}\n";
		}
		$linksummary .= "\t\t</div>\n";
	}
	$display = "<!DOCTYPE html>\n"
	. "<html>\n"
	. "\t<head>\n"
	. "\t\t<meta charset='UTF-8'>\n"
	. "\t\t<link href='/style.css' rel='stylesheet' type='text/css'>\n"
	. "\t\t<title>{$title}</title>\n"
	. "\t</head>\n"
	. "\t<body>\n"
	. "\t<div id='fb-root'></div>"
	. "<script>(function(d, s, id) {"
	. "var js, fjs = d.getElementsByTagName(s)[0];"
	. "if (d.getElementById(id)) return;"
	. "js = d.createElement(s); js.id = id;"
	. "js.src = '//connect.facebook.net/en_US/all.js#xfbml=1';"
	. "fjs.parentNode.insertBefore(js, fjs);"
	. "}(document, 'script', 'facebook-jssdk'));</script>\n"
	. "\t\t<img class='banner' src ='/PPBanner.png' alt='Pokemon Perfect Banner' />\n"
	. $nav
	. $subnav
	. "\t\t<div class='content'>\n"
	. "\t\t\t<h1>{$title}</h1>\n"
	. "\t\t\t<hr />\n"
	. $content
	. "\t\t</div>\n"
	. $linksummary
	. "\t\t<div class='copyright'>\n"
	. "\t\t\tAll content is &copy; 2013 pokemonperfect.com. Pok&eacute;mon is &copy; 1995-2013 Nintendo\n"
	. "\t\t</div>\n"
	. "\t\t<div class='footer'>\n"
	. "\t\t\t<a href='http://php.net'><img src='http://pokemonperfect.com/php-power-white.png' alt='powered by php'></a>"
	. "\t\t\t<a href='http://jigsaw.w3.org/css-validator/check/referer'><img src='http://pokemonperfect.com/vcss-blue.gif' alt='valid CSS'></a>\n"
	. "\t\t\t<a href='http://www.w3.org/html/logo/'><img src='http://pokemonperfect.com/html5-badge-h-solo.png' height='32' width='32' alt='HTML5 powered'></a>\n"
	. "\t\t\t<iframe src='http://ghbtns.com/github-btn.html?user=Jakilutra&amp;repo=Pokemon-Perfect-Site&amp;type=watch' width='62' height='20'></iframe>\n"
	. "\t\t\t<a href='https://twitter.com/PokemonPerfect' class='twitter-follow-button' data-show-count='false'>Follow @PokemonPerfect</a>\n"
	. "\t\t\t<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='//platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','twitter-wjs');</script>\n"
	. "\t\t\t<a href='http://www.youtube.com/user/PokemonPerfectStream?feature=creators_cornier-%2F%2Fs.ytimg.com%2Fyt%2Fimg%2Fcreators_corner%2FI_heart_YouTube%2F90x15_i_love_red.png'><img src='//s.ytimg.com/yt/img/creators_corner/I_heart_YouTube/90x15_i_love_red.png' alt='Subscribe to us on YouTube'/></a>\n"
	. "\t\t\t<div class='fb-like' data-href='https://www.facebook.com/pages/Pokemonperfect/510730222321922' data-send='false' data-layout='button_count' data-width='450' data-show-faces='true'></div>\n"
	. "\t\t</div>\n"
	. "\t</body>\n"
	. "</html>\n";
?>