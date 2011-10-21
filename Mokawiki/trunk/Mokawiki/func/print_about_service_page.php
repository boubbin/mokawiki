<?php

function number_of_php_files() {
	$files = exec('find . -name "*.php" -exec echo {} \; | wc -l');
	return $files;
}

function number_of_php_functions() {
	$functions = exec('find . -name "*.php" -exec cat {} \; | grep ^function | wc -l');
	return $functions;
}

function number_of_php_codelines_and_chars() {
	$lines = exec('find . -name "*.php" -exec cat {} \; | wc -l');
	$chars = exec('find . -name "*.php" -exec cat {} \; | wc -c');
	return "$lines ($chars merkkiä)";
}

function number_of_css_codelines_and_chars() {
	$lines = exec('find . -name "*.css" -exec cat {} \; | wc -l');
	$chars = exec('find . -name "*.css" -exec cat {} \; | wc -c');
	return "$lines ($chars merkkiä)";
}

function mysql_version() {
	require_once('mysql_functions.php');
	open_mysql_connection();
	$mysql_version = mysql_get_server_info();
	mysql_close();
	return $mysql_version;
}

function apacheversion() {
	$ver = split("[/ ]",$_SERVER['SERVER_SOFTWARE']);
	$apver = "$ver[1] $ver[2]";
	return $apver;
}

function print_about_service_page() {
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
		<li><a href="index.php?action=create_account">Luo tunnus</a></li>
		<li id="active"><a href="index.php?action=about" id="current">Tietoja palvelusta</a></li>
		</ul>
		</div>
		</div>
		<p>
		<div id="content">
			<p>
				<h3>Ympäristö</h3>
				<div class="featurebox_center">
					<table>
						
						<tr><td><h2>PHP</td><td><h2>'.phpversion().'</td></tr>
						<tr><td><h2>MYSQL</td><td><h2>'.mysql_version().'</td><tr>
						<tr><td><h2>Apache</td><td><h2>'.apacheversion().'</td><tr>
						<tr><td><h2>OS</td><td><h2>'.PHP_OS.'</td><tr>
					</table>
				</div>
			</p>
			<p>
				<h3>MYSQL</h3>
				<div class="featurebox_center">
					<table>
						<tr><td><h2>Taulujen lukumäärä</td><td><h2>'.number_of_tables().'</td></tr>
						';
						$results = get_database_stats();
						while ($row = mysql_fetch_assoc($results)) {
							echo "<tr><td><h2>$row[table_name]</td><td><h2>$row[table_rows] riviä</td><td><h2>$row[data_length] merkkiä</td><td><h2>$row[size] kt</td></tr>";
						}
	echo '
					</table>
				</div>
			</p>
			<p>
				<h3>PHP+HTML+CSS+JavaScript</h3>
				<div class="featurebox_center">
					<table>
						
						<tr><td><h2>PHP-tiedostoja</td><td><h2>'.number_of_php_files().'</td></tr>
						<tr><td><h2>PHP-funktioita</td><td><h2>'.number_of_php_functions().'</td></tr>
						<tr><td><h2>PHP-koodirivejä</td><td><h2>'.number_of_php_codelines_and_chars().'</td></tr>
						<tr><td><h2>CSS-koodirivejä</td><td><h2>'.number_of_css_codelines_and_chars().'</td></tr>

					</table>
				</div>
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