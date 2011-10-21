<?php

function generate_active_users_table() {
	delete_inactive_users();
	$users = get_active_users();
	echo "
		<h3>Kirjautuneena</h3>
		<p><div class=\"featurebox_side\">
	";
	while ($row = mysql_fetch_assoc($users)) {
		$username = $row['userid'];
		$duration = time() - get_user_lastlogin_time($username);
		$username = userid_to_username($username);
		$duration = trim(duration($duration));
		if ($duration == "") { $duration = "<1min"; }
		echo "<h6>$username ($duration)</h6>";
	}
	echo "</div></p>";
}

function generate_admin_options() {
	if ($_SESSION['userlevel'] > 1) {
		echo "
			<h3>Ylläpito</h3>	
			<p><div class=\"featurebox_side\">
			<h4><a href=index.php?admin_task=control_panel>Ohjauspaneeli</a></h4>
			<h4><a href=index.php?admin_task=user_control>Käyttäjätilit</a></h4>
			<h4><a href=index.php?admin_task=content_manager>Sisällönhallinta</a></h4>
			</div></p>
		";
	}


}

function generate_my_accout_info() {
		echo "
			<h3>Käyttäjätilini</h3>
			<p><div class=\"featurebox_side\">
				Tervetuloa!
				<h6>$_SESSION[user]</h6>
				<form action=logout.php>
				<input type=submit value=\"Kirjaudu Ulos\" action=logout.php>
				</form>
			</div></p>
		";
}

function generate_performance_info() {
	echo "
		<h3>Suorituskyky</h3>
		<p><div class=\"featurebox_side\">
			MYSQL:
			<h6>Kyselyt: ".$_SESSION['performance']['mysqlquerytotal']."</h6>
			<h6>Viime kysely: ".$_SESSION['performance']['lastmysqlquery']."</h6>
		</div></p>
	";
	$_SESSION['performance']['lastmysqlquery'] = 0;

}

function print_right_side() {
	echo "<div id=\"right_side\">";
	generate_my_accout_info();
	generate_active_users_table();
	generate_admin_options();
	generate_performance_info();
	echo "</div>";
}

?>
