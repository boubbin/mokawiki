<?php

function succesful_auth($username) {
	$_SESSION['authed'] = 1;
	$_SESSION['user'] = $username;
	$_SESSION['userlevel'] = get_userlevel_of_userid(md5($username));
	$_SESSION['currentpage'] = $mainpage_name;
	header("Location: index.php?page=".urlencode($mainpage_name)."&action=read");
	set_last_login_for_userid(md5($username), time());
	set_user_active_time(md5($username), time());
}

?>
