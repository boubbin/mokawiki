<?php
function print_registration_page() {
	session_start();
	print_html_head_and_meta_data_tags();
	echo '	
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
		<li><a href="index.php?action=login">Kirjautuminen</a></li>
		<li id="active"><a href="index.php?action=create_account" id="current">Luo tunnus</a></li>
		<li><a href="index.php?action=about">Tietoja palvelusta</a></li>
		</ul>
		</div>
		</div>
		<p>
		<div id="content">
			<p>
			<h3>Luo itsellesi MokaWiki-tunnus!</h3>
			<div class="featurebox_center">
				<form method="POST"><br><b>Ole hyvä ja täytä alla oleva lomake tunnuksen saamiseksi!</b><br>
				<table cellpadding="2\ cellspacing="0" border="0">

				<tr>
				<td align=right>Etunimi<errmsg>*</errmsg></td>
				<td><input type="text" name="firstname" size="20">
	';
				if ($_SESSION['create_account']['firstname'] == 1) { $_SESSION['create_account']['firstname'] = 0; echo "<errmsg>Saa sisältää pieniä tai suuria kirjaimia a-z, maksimipituus 20</errmsg>"; }
	echo '
				</td>
				</tr>

				<tr>
				<td align=right>Sukunimi<errmsg>*</errmsg></td>
				<td><input type="text" name="lastname" size="20">
	';
				if ($_SESSION['create_account']['lastname'] == 1) { $_SESSION['create_account']['lastname'] = 0; echo "<errmsg>Saa sisältää pieniä tai suuria kirjaimia a-z, maksimipituus 20</errmsg>"; }
	echo '
				</td>
				</tr>

				<tr>
				<td align=right>Titteli/Ammattinimike</td>
				<td><input type="text" name="title" size="20">
	';
				if ($_SESSION['create_account']['title'] == 1) { $_SESSION['create_account']['title'] = 0; echo "<errmsg>Seriously how did you manage, there was no check against this?! Congratz!</errmsg>"; }
	echo '
				</td>
				</tr>

				<tr>
				<td align=right>Sukupuoli<errmsg>*</errmsg></td>
				<td>
				<select name=sex>
				<option value=man>Mies</option>
				<option value=women>Nainen</option>
				</select>
	';
				if ($_SESSION['create_account']['sex'] == 1) { $_SESSION['create_account']['sex'] = 0; echo "<errmsg>Tulee olla mies, nainen tai ei mitään</errmsg>"; }
	echo '
				</td>
				</tr>

				<tr>
				<td align=right>Sähköposti<errmsg>**</errmsg></td>
				<td><input type="text" name="email" size="20">
	';
				if ($_SESSION['create_account']['email'] == 1) { $_SESSION['create_account']['email'] = 0; echo "<errmsg>Muotoa käyttäjänimi@metropolia.fi</errmsg>"; }
	echo '
				</td>
				</tr>

				<tr>
				<td align=right>Käyttäjätunnus<errmsg>*</errmsg></td>
				<td><input type="text" name="username" size="20">
	';
				if ($_SESSION['create_account']['username'] == 1) { $_SESSION['create_account']['username'] = 0; echo "<errmsg>Saa sisältää pieniä ja suuria kirjaimia a-z ja numeroita 0-9</errmsg>"; }
				if ($_SESSION['create_account']['inuse'] == 1) { $_SESSION['create_account']['inuse'] = 0; echo "<errmsg>Tunnus on jo käytössä, valitse toinen</errmsg>"; }
	echo '
				</td>
				</tr>

				<tr>
				<td align=right>Salasana<errmsg>*</errmsg></td>
				<td><input type="password" name="password1" size=20">
	';
				if ($_SESSION['create_account']['password1'] == 1) { $_SESSION['create_account']['password1'] = 0; echo "<errmsg>Salasana liian lyhyt</errmsg>"; }
	echo '
				</td>
				</tr>

				<tr>
				<td align=right>Salasana uudestaan<errmsg>*</errmsg></td>
				<td><input type="password" name="password2" size=20">
	';
				if ($_SESSION['create_account']['password2'] == 1) { $_SESSION['create_account']['password2'] = 0; echo "<errmsg>Salasanat eivät täsmää</errmsg>"; }
	echo '
				</td>
				</tr>
				</table>
				Olen hyväksynyt <a href=sopimusehdot.php>sopimusehdot</a><input type="checkbox" name=terms></a>
	';
				if ($_SESSION['create_account']['terms'] == 1) { $_SESSION['create_account']['terms'] = 0; echo "<errmsg>Et hyväksynyt ehtoja</errmsg>"; }
	echo '<br>
				<td><input type="submit" name="submitted" value="Luo Tunnus!"></form><br>
			<errmsg>*) Kentät ovat pakollosia<br>
			**) Vain @metropolia.fi sähköpostit tällä hetkellä (ei vaadi sähköpostivarmennusta)!</errmsg>
			</div>
			</p>
			<p>
			</p>
			</div>
			</p>
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