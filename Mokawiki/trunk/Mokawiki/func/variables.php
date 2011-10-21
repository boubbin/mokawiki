<?php
	// This file holds some variables  and functions we need

	// Whas it the name of our mainpage?
	$mainpage_name = "Pääsivu";

	/*function check_if_user_is_authed() {
		if ($_SESSION[authed] == 1) {
			return 1;
		} else {
			return 0;
		}
	}*/

	function go_to_mainpage() {
		global $mainpage_name;
		header("Location: index.php?page=".urlencode($mainpage_name)."&action=read");
	}

	function replace_html_tags($content) {
		$replaced_content = trim($content);
		$replaced_content = str_replace("\r\n", "<br>", $replaced_content);
		$replaced_content = str_replace("*", "<li>", $replaced_content);
		return $replaced_content;
	}

	function replace_newline_tags($content) {
		$replaced_content = trim($content);
		$replaced_content = str_replace("<br>", "\r\n",  $replaced_content);
		$replaced_content = str_replace("<li>", "*",  $replaced_content);
		return $replaced_content;
	}

	function unixtime_to_date($unixtime) {
		$date = date('d/m/Y H:i:s', $unixtime);
		return $date;
	}

	function unixtime_to_duration($unixtime) {
		$seconds = time() - $unixtime;
		return duration($seconds);
	}

	function duration($timestamp){
	$years=floor($timestamp/(60*60*24*365));$timestamp%=60*60*24*365;
	$weeks=floor($timestamp/(60*60*24*7));$timestamp%=60*60*24*7;
	$days=floor($timestamp/(60*60*24));$timestamp%=60*60*24;
	$hrs=floor($timestamp/(60*60));$timestamp%=60*60;
	$mins=floor($timestamp/60);$secs=$timestamp%60;
	if ($years >= 1) { $str.= $years.'y '; }
	if ($weeks >= 1) { $str.= $weeks.'w '; }
	if ($days >= 1) { $str.=$days.'d '; }
	if ($hrs >= 1) { $str.=$hrs.' h '; }
	if ($mins >= 1) { $str.=$mins.'m '; }
	return $str;
	
	}
	
	function print_rendering_time() {
		//$_SESSION[performance][renderingtime];
		$seconds = microtime(true)- $_SESSION['performance']['rendering_start_time'];
		$seconds = round($seconds, 3);
		echo "Sivun muodostukseen kului ".$seconds." sekuntia";
	
	}
	
?>