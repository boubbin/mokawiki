<?php 

function generate_content_manager_page() {
	if ($_POST['repair'] == "on") { repair_mysql_tables(); }
	if ($_POST['optimize'] == "on") { optimize_mysql_tables(); }
	if ($_POST['flush'] == "on") { flush_mysql_tables(); }
	echo "
		<div id=\"content\"><p>
		<h3>Sisällönhallinta</h3>
		<div class=featurebox_center>
		<table>
		<form method=POST>
		<tr><td><input type=checkbox name=repair checked></td><td>Korjaa kaikki rikkinäiset taulut</td></tr>
		<tr><td><input type=checkbox name=optimize checked></td><td>Optimoi kaikki taulut</td></tr>
		<tr><td><input type=checkbox name=flush checked></td><td>Tyhjennä taulujen välimuisti</td></tr>
		</table>
		<input type=submit value=Suorita>
		</form>
		</table><p>
	";
	if ($_SESSION['performance']['wererepaired'] == 1) { echo "<h3green>Taulut korjattiin</h3green><br>"; }
	if ($_SESSION['performance']['wereoptimized'] == 1){ echo "<h3green>Taulut optimoitiin</h3green><br>"; }
	if ($_SESSION['performance']['wereflushed'] == 1){ echo "<h3green>Taulujen välimuistit on tyhjennetty</h3green><br>"; }
	echo "
		</p></div>
		</div></p>
	";
	$_SESSION['performance']['wererepaired'] = 0;
	$_SESSION['performance']['wereoptimized'] = 0;
	$_SESSION['performance']['wereflushed'] = 0;
}

?>