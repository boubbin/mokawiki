<?php
function print_visitor_page() {
	session_start();
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	echo '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="description" content="MokaWiki" />
		<meta name="keywords" content="mokawiki, ei-wikipedia" />
		<title>MokaWiki | Mokamiespalveluiden sisäinen wiki</title>
		<link href="css/style.css" type="text/css" rel="stylesheet" />
		</head>
		<body>
		<div id="page_wrapper">
		<div id="header_wrapper">
		<div id="header">
		<table><tr><td><img src=img/lokoo.png></td>
		<td><h1>Moka<font color="#FFDF8C">Wiki</font></h1>
		<h2>Mokamiespalveluiden sisäinen wiki</h2>
		</td></tr></table>
		</div>
		<div id="navcontainer">
		<ul id="navlist">
		<li id="active"><a href="index.php?action=login" id="current">Kirjautuminen</a></li>
		<li><a href="index.php?action=create_account">Luo tunnus</a></li>
		<li><a href="index.php?action=about">Tietoja palvelusta</a></li>
		</ul>
		</div>
		</div>
		<p>
		<div id="content">
			<p>
			<h3>Sisäänkirjautuminen</h3>
			<div class="featurebox_center">
				<form method="POST"><br><b>Ole hyvä ja kirjaudu käyttääksesi wikiä</b><br>
				<table cellpadding="2\ cellspacing="0" border="0">
				<tr>
				<td>Käyttäjänimi</td>
				<td><input type="text" name="user" size="19">
	';
				if ($_SESSION[login_process]['invalid_username']==1) { $_SESSION['login_process']['invalid_username'] = 0; echo  "<errmsg>Saa sisältää pieniä ja suuria kirjaimia a-z ja numeroita 0-9</errmsg>"; }
				if ($_SESSION[login_process]['no_such_username']==1) { $_SESSION['login_process']['no_such_username'] = 0; echo  "<errmsg>Käyttäjänimeä ei ole, rekisteröidy ensin?</errmsg>"; }

	echo '
				</td>
				</tr>
				<tr>
				<td>Salasana
				<td><input type="password" name="pass" size=19">
	';
				if ($_SESSION['login_process']['wrong_password']==1) { $_SESSION['login_process']['wrong_password'] = 0; echo  "<errmsg>Väärä salasana</errmsg>"; }

	echo '
				</td>
				</tr>
				<td></td>
				<td><input type="submit" name="submitted" value="Kirjaudu!"></form></td>
				</tr>
				</table><br>
			</div>
			</p>
			<p>
	';
	echo '
			</p>
			</div>
			</p>
	';
	echo '
		<div id="footer">
		<p>(c) Team Kolmasjalka 2011</p>
		<br />
		</div>
		</div>
		</body>	
		</html>
	';
}
?>
