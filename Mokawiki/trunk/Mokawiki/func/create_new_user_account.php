<?php
function create_new_user_account($userid, $username, $password, $firstname, $lastname, $title, $sex, $email, $userlevel, $creationtime, $lastlogin) {
	// ww already know they are valid so just push em to mysql...
	open_mysql_connection();
	$sql = "INSERT INTO `kolmasjalka`.`userbase` (`userid`, `username`, `password`, `firstname`, `lastname`, `title`, `sex`, `email`, `userlevel`, `created`, `lastlogin`) VALUES ('$userid', '$username', '$password', '$firstname', '$lastname', '$title', '$sex', '$email', '$userlevel', '$creationtime', '$lastlogin');";
	$result = mysql_query($sql);
	if ($result == TRUE) {
		// we made it, we got new user!!
	} else {
		echo "MYSQL query ei onnistunut luomaan käyttäjää<br>Kaikki data oli validoitu aikaisemmin.<br>$userid, $username, $password, $firstname, $lastname, $title, $sex, $email, $userlevel, $creationtime, $lastlogin<br>";
		echo mysql_error();
	}
	mysql_close();

}

?>
