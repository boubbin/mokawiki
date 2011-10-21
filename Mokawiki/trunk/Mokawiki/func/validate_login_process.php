<?php

function compare_user_password($userid, $passwordhash) {
	open_mysql_connection();
	$query = "SELECT `userid`, `password` FROM `userbase`";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) {
			if ($row['userid'] == $userid && $row['password'] == $passwordhash) { 
				return 1;
			};
		}		
	} else {
		echo "MYSQL query ei onnistunut hakemaan userbasea salasanoilla<br>$query<br>";
		echo mysql_error();
	}
	return 0;
}

function username_exists($userid) {
	open_mysql_connection();
	$query = "SELECT `userid` FROM `userbase`";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) {
			if ($row['userid'] == $userid) { return 1; }
		}
	} else {
		echo "MYSQL query ei onnistunut hakemaan userbasea<br>$query<br>";
		echo mysql_error();
	}
	return 0;
}

function validate_login_process() {;
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$check_validness = 1;
	if (!validate_alphanumeric($username)) { $check_validness = 0; $_SESSION['login_process']['invalid_username'] = "1"; }
	if ($check_validness && !username_exists(md5($username))) { $check_validness = 0; $_SESSION['login_process']['no_such_username'] = "1"; }
	if ($check_validness && !compare_user_password(md5($username), md5($password))) { $check_validness = 0; $_SESSION['login_process']['wrong_password'] = "1"; }
	if ($check_validness == 1) {
		succesful_auth($username);
	} else {
		// header("Location: index.php");
	}
}

?>