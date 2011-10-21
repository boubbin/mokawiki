<?php
function print_header_of_the_page() {
        echo '
	      <body>
	      <div id="page_wrapper">
	      <div id="header_wrapper"> 
	      <div id="header">
	      <table><tr><td><a href=index.php><img src=img/lokoo.png></a></td><td>
	      <h1>Moka<font color="#FFDF8C">Wiki</font></h1>
	      <h2>Mokamiespalveluiden sisäinen wiki</h2>
	      </td></tr></table>
	      </div>
	      <div id="navcontainer">
	      <ul id="navlist">
	';
	$current_page = $_SESSION[currentpage];
	$l1 = "<li><a href=\"index.php?page=$current_page&action=read\">Artikkeli</a></li>";
	$l2 = "<li><a href=\"index.php?page=$current_page&action=edit\">Muokkaa</a></li>";
	$l3 = "<li><a href=\"index.php?page=$current_page&action=conversation\">Keskustelu</a></li>";
	$l4 = "<li><a href=\"index.php?page=$current_page&action=history\">Historia</a></li>";
	if ($_GET[action] == "read") {
		$l1 = "<li id=\"active\"><a href=\"index.php?page=$current_page&action=read\" id=\"current\">Artikkeli</a></li>";
	} elseif ($_GET[action] == "edit") {
		$l2 = "<li id=\"active\"><a href=\"index.php?page=$current_page&action=edit\" id=\"current\">Muokkaa</a></li>";
	} elseif ($_GET[action] == "conversation") {
		$l3 = "<li id=\"active\"><a href=\"index.php?page=$current_page&action=conversation\" id=\"current\">Keskustelu</a></li>";
	} elseif ($_GET[action] == "history") {
		$l4 = "<li id=\"active\"><a href=\"index.php?page=$current_page&action=history\" id=\"current\">Historia</a></li>";
	}
	echo "
	      $l1
	      $l2
	      $l3
	      $l4
	";
	echo '
	      </ul>
	      </div>
	      </div>
	';
}

?>
