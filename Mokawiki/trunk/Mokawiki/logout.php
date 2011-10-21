<?
	ob_start();
	session_start();
	require_once('func/require_functions.php');
	if ($_SESSION['authed']==1) { del_user_active_status(md5($_SESSION['user'])); }
	session_destroy();
	header('Location: index.php');
	ob_flush();
?>
