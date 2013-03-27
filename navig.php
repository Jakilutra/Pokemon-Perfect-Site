<?php
	$nav = "<div class='nav'><a class='external' href='index.html'>Home</a> | <a href='papos.php'>PAPOS</a> | <a class='external' href='forums/forum.php'>Forums</a></div>";
	switch ($sitepage){
		case "papos": $nav = str_replace("<a href='papos.php'>PAPOS</a>", "<b>PAPOS</b>", $nav);
	}
?>