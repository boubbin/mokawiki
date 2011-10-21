<?php

function validate_alphanumeric($string) {
	$string = str_replace("ä", a, $string);
	$string = str_replace("ö", a, $string);
	$string = str_replace(" ", a, $string);
	$string = str_replace("?", a, $string);
	$string = str_replace("!", a, $string);
	$string = str_replace(",", a, $string);
	if ((preg_match('/^[a-zA-Z0-9]+$/',$string)==0) || strlen($string) > 20) { return 0; }
	return 1;

}
function validate_email($email) {
	if (preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@metropolia.fi/", $email)==0) { return 0; }
	return 1;
}

function validate_sex($sex) {
	if ($sex == "man" || $sex == "women") { return 1;}
	return 1;
}

function validate_password_equal($password1, $password2) {
	if ($password1 != $password2) { return 0; }
	return 1;
}

function validate_password_len($password1) {
	if (strlen($password1) < 4) { return 0; }
	return 1;
}

function validate_terms($terms) {
	if (!$terms) { return 0; }
	return 1;
}

function username_in_use($username) {
	open_mysql_connection();
	$userid = md5($username);
	$query = "SELECT * FROM `userbase` WHERE `userid` = '$userid'";
	$result = mysql_num_rows(mysql_query($query));
	mysql_close();
	if ($result == 1) { return 0; }
	return 1;
}

function validate_account_creation_process() {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$title = strip_tags($_POST['title']);
	$sex = $_POST['sex'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$terms = $_POST['terms'];
	if ($firstname == "" && $lastname == "" && $username == "") { return 0; }

	$check_validness = 1;

	if (!validate_alphanumeric($firstname)) { $check_validness = 0; $_SESSION['create_account']['firstname'] = "1"; }
	if (!validate_alphanumeric($lastname)) { $check_validness = 0; $_SESSION['create_account']['lastname'] = "1"; }
	if (!validate_alphanumeric($username)) { $check_validness = 0; $_SESSION['create_account']['username'] = "1"; }
	if (!validate_email($email)) { $check_validness = 0; $_SESSION['create_account']['email'] = "1"; }
	if (!validate_password_len($password1)) { $check_validness = 0; $_SESSION['create_account']['password1'] = "1"; }
	if (!validate_password_equal($password1, $password2)) { $check_validness = 0; $_SESSION['create_account']['password2'] = "1"; }
	if (!validate_sex($sex)) { $check_validness = 0; $_SESSION['create_account']['sex'] = "1"; }
	if (!validate_terms($terms)) { $check_validness = 0; $_SESSION['create_account']['terms'] = "1"; }

	if (!username_in_use($username)) { $check_validness = 0; $_SESSION['create_account']['inuse'] = "1"; }

	if ($check_validness == 1) {
		if ($sex == "man") { $sex = 1; } else { $sex = 0; }
		create_new_user_account(md5($username), $username, md5($password1), $firstname, $lastname, $title, $sex, $email, 1, time(), 0);
		return 1;
	} else {
		return 0;
	}
	
}

?>