<?php

// MYSQL RELATED SHIT MOSTLY

function open_mysql_connection() {
	session_start();
	$_SESSION['performance']['mysqlquerytotal']++;
	$_SESSION['performance']['lastmysqlquery']++;
	$mysql_host = "localhost";
	$mysql_user = "kolmasjalka";
	$mysql_pass = "jalka123";
	$mysql_table = "kolmasjalka";
	mysql_connect($mysql_host, $mysql_user, $mysql_pass);
	mysql_selectdb($mysql_table);
}

function load_existing_articles_to_session() {
	open_mysql_connection();
	$query = "SELECT `articlename` FROM `article`";
	$result = mysql_query($query);
	mysql_close();
	$i = 0;
	$_SESSION['articles'] = array();
	while ($row = mysql_fetch_assoc($result)) {
		$i++;
		$articlename = $row['articlename'];
		$_SESSION['articles'][$i] = "$articlename";
	}
	return 1;
}

function article_exists($articlename) {
	if (!isset($_SESSION['articles'])) { load_existing_articles_to_session(); }
	foreach ($_SESSION[articles] as $article) {
		if ($article==$articlename) { return 1; }
	}
	return 0;
}

function get_article_name($article) {
	open_mysql_connection();
	$articleid = md5($article);
	$query = "SELECT `articlename` FROM `article` WHERE `articleid` = '$articleid'";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) { $article_name = $row['articlename']; };	
	} else {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
	}
	return $article_name;
}

function get_article_name_matching_part($part) {
	open_mysql_connection();
	$query = "SELECT `articlename` FROM `article` WHERE `articlename` LIKE '%$part%' ORDER BY `articlename`";
	$result = mysql_query($query);
	mysql_close();
	if ($result == FALSE) {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
		return 0;
	}
	while ($row = mysql_fetch_assoc($result)) { return $row['articlename']; };
}

function is_part_of_article_name($part) {
	open_mysql_connection();
	$query = "SELECT `articlename` FROM `article` WHERE `articlename` LIKE '%$part%' ORDER BY `articlename`";
	$result = mysql_query($query);
	mysql_close();
	if ($result == FALSE) {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
		return 0;
	}
	$rows = mysql_num_rows($result);
	if ($rows == 0) { return 0; }
	if ($rows == 1) { return 1; }
	return 2;
}

function is_part_of_article_body($part) {
	open_mysql_connection();
	$query = "SELECT `articlename`, `content` FROM `article` WHERE `content` LIKE '%$part%' ORDER BY `articlename`";
	$result = mysql_query($query);
	mysql_close();
	if ($result == FALSE) {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
		return 0;
	}
	$rows = mysql_num_rows($result);
	if ($rows > 0) { return 1; }
	return 0;
}

function get_matching_article_names($searchterm) {
	open_mysql_connection();
	$searchterm = mysql_real_escape_string($searchterm);
	$query = "SELECT `articlename` FROM `article` WHERE `articlename` LIKE '%$searchterm%' ORDER BY  `articlename` ASC LIMIT 0, 5";
	$result = mysql_query($query);
	mysql_close();
	if ($result == FALSE) {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
	}
	return $result;
}


function get_matching_article_names_which_has_part($part) {
	open_mysql_connection();
	$query = "SELECT `articlename`, `content` FROM `article` WHERE `content` LIKE '%$part%' ORDER BY  `articlename` ASC";
	$result = mysql_query($query);
	mysql_close();
	if ($result == FALSE) {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
	}
	return $result;
}

function get_article_content($article) {
	open_mysql_connection();
	$articleid = md5($article);
	$query = "SELECT `content` FROM `article` WHERE `articleid` = '$articleid'";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) { $content = $row['content']; };	
	} else {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
	}
	return $content;
}

function get_article_last_modification_time($article) {
	open_mysql_connection();
	$articleid = md5($article);
	$query = "SELECT `created` FROM `history` WHERE `articleid` = '$articleid' ORDER BY  `created` DESC LIMIT 0, 1 ";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) { $unixtime = $row['created']; };	
	} else {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
	}
	return $unixtime;
}

function get_article_last_modification_username($article) {
	open_mysql_connection();
	$articleid = md5($article);
	$query = "SELECT `userid` FROM `history` WHERE `articleid` = '$articleid' ORDER BY  `created` DESC LIMIT 0, 1 ";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) { $editorid = $row['userid']; };	
	} else {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis�lt��<br>$query<br>";
		echo mysql_error();
	}
	return $editorid;
}

function articleid_to_articlename($articleid) {
	open_mysql_connection();
	$query = "SELECT `articlename` FROM `article` WHERE `articleid` = '$articleid'";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) {
			$articlename = $row['articlename'];
		}
	} else {
		echo "MYSQL query ei onnistunut hakemaan userbasea<br>$query<br>";
		echo mysql_error();
	}
	return $articlename;
}

function userid_to_username($userid) {
	open_mysql_connection();
	$query = "SELECT `username` FROM `userbase` WHERE `userid` = '$userid'";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) {
			if ($username = $row['username']) { break; }
		}
	} else {
		echo "MYSQL query ei onnistunut hakemaan userbasea<br>$query<br>";
		echo mysql_error();
	}
	return $username;
}


function add_new_conversation($article, $content) {
	open_mysql_connection();
	$articleid = md5($article);
	$userid = md5($_SESSION['user']);
        $unixtime = time();
        $creation_time = unixtime_to_date($unixtime);
        $content = "<b>" . $_SESSION['user'] . " - " . $creation_time . "</b><br/>" . $content;
	$query = "INSERT INTO `conversation` (`articleid`, `created`, `content`) VALUES ('$articleid', '$unixtime', '$content');";
	$result = mysql_query($query);
	mysql_close();
}

function delete_conversation($article) {
	open_mysql_connection();
	$articleid = md5($article);
	$query = "DELETE FROM `conversation` WHERE `articleid` = '$articleid';";
	$result = mysql_query($query);
	mysql_close();
}

function update_conversation($articleid, $old_content, $new_content) {
        $full_content = $old_content . "<br/><b>" . $_SESSION['user'] . " - " . unixtime_to_date(time()) . "</b><br/>" . $new_content;
	open_mysql_connection();
	$query = "UPDATE `conversation` SET `content` = '$full_content' WHERE `articleid` = '$articleid';";
	$result = mysql_query($query);
	mysql_close();
}

//function write_conversation($articleid, $content, $description) {
//	open_mysql_connection();
//	$time = time();
//	$userid = md5($_SESSION[user]);
//	$query = "INSERT INTO `history` (`articleid`, `created`, `userid`, `content`, `description`) VALUES ('$articleid', '$time', '$userid', '$content', '$description');";
//	$result = mysql_query($query);
//	mysql_close();
//}

function get_conversation_content($article) {
	open_mysql_connection();
	$articleid = md5($article);
	$query = "SELECT `content` FROM `conversation` WHERE `articleid` = '$articleid'";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) { $content = $row['content']; };
	} else {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sis��<br>$query<br>";
		echo mysql_error();
	}
	return $content;
}

function get_conversation_last_modification_time($article) {
	open_mysql_connection();
	$articleid = md5($article);
	$query = "SELECT `created` FROM `conversation` WHERE `articleid` = '$articleid' ORDER BY `created` DESC LIMIT 0, 1 ";
	$result = mysql_query($query);
	mysql_close();
	if ($result == TRUE) {
		while ($row = mysql_fetch_assoc($result)) { $unixtime = $row['created']; };
	} else {
		echo "MYSQL query ei onnistunut hakemaan artikkelin sisältöä<br>$query<br>";
		echo mysql_error();
	}
	return $unixtime;
}

function get_next_x_changes($start, $howmany, $empty) {
          if ($empty) {
	          $query = "SELECT * FROM `history` ORDER BY `history`.`created` DESC LIMIT $start, $howmany ";
          } else {
	          $query = "SELECT * FROM `history` ORDER BY `history`.`created` DESC LIMIT $start, $howmany ";
          }
	open_mysql_connection();
	$result = mysql_query($query);
	mysql_close();
	if ($result == FALSE) {
		echo "MYSQL query ei onnistunut hakemaan viimeisi� muutksia<br>$query<br>";
		echo mysql_error();
	}
	return $result;
}

function get_random_wiki_page_name() {
	open_mysql_connection();
	$query = "SELECT `articlename` from `article` ORDER BY rand() LIMIT 1";
	$result = mysql_query($query);
	mysql_close();
	$row = mysql_fetch_assoc($result);
	return $row['articlename'];
}	

function number_of_tables() {
	open_mysql_connection();
	$query = "SELECT count(*) as tables from information_schema.tables WHERE table_schema = 'kolmasjalka'";
	$result = mysql_query($query);
	mysql_close();
	$result = mysql_fetch_assoc($result);
	return $result['tables'];
}

function number_of_rows_in_table($table) {
	open_mysql_connection();
	$query = "SELECT * FROM $table";
	$result = mysql_query($query);
	mysql_close();
	$result = mysql_num_rows($result);
	return $result;
}

function get_database_stats() {
	open_mysql_connection();
	$query = "SELECT table_name, table_rows, data_length, index_length, \n"
    . "round(((data_length + index_length) / 1024),2) \"size\"\n"
    . "FROM information_schema.TABLES WHERE table_schema = \"kolmasjalka\"";
	$result = mysql_query($query);
	return $result;
}

function set_last_login_for_userid($userid, $unixtime) {
	open_mysql_connection();
	$query = "UPDATE `kolmasjalka`.`userbase` SET `lastlogin` = '$unixtime' WHERE `userbase`.`userid` = '$userid';";
	$result = mysql_query($query);
	mysql_close();
}

function update_user_active_time($userid, $unixtime) {
	open_mysql_connection();
	$query = "UPDATE `kolmasjalka`.`activeusers` SET `logon` = '$unixtime' WHERE `activeusers`.`userid` = '$userid';";
	$result = mysql_query($query);
	mysql_close();
}

function set_user_active_time($userid, $unixtime) {
	open_mysql_connection();
	$query = "INSERT INTO `kolmasjalka`.`activeusers` (`userid`, `logon`) VALUES ('$userid', '$unixtime');";
	$result = mysql_query($query);
	mysql_close();
}

function del_user_active_status($userid) {
	open_mysql_connection();
	$query = "DELETE FROM `kolmasjalka`.`activeusers` WHERE `activeusers`.`userid` = '$userid'";
	$result = mysql_query($query);
	echo $result;
	mysql_close();
}

function get_active_users() {
	open_mysql_connection();
	$query = "SELECT * from `activeusers`";
	$result = mysql_query($query);
	mysql_close();
	return $result;
}

function delete_inactive_users() {
	open_mysql_connection();
	$time = time() - (60*30);
	$query = "DELETE FROM `kolmasjalka`.`activeusers` WHERE `activeusers`.`logon` < '$time'";
	$result = mysql_query($query);
	mysql_close();
}


function get_top_editors() {
	open_mysql_connection();
	$query = "SELECT userid, COUNT(articleid) as count FROM `history` GROUP BY `userid` ORDER BY count DESC LIMIT 0, 30 ";
	$result = mysql_query($query);
	mysql_close();
	return $result;
}

function get_top_creators() {
	open_mysql_connection();
	$query = "SELECT userid, description, COUNT(articleid) as count FROM `history` WHERE `description` LIKE \"%Uusi%\" GROUP BY `userid` ORDER BY count DESC";
	$result = mysql_query($query);
	mysql_close();
	return $result;

}

function get_most_inactive() {
	open_mysql_connection();
	$query = "SELECT userid, COUNT(articleid) as count FROM `history` GROUP BY `userid` ORDER BY count ASC LIMIT 0, 30 ";
	$result = mysql_query($query);
	mysql_close();
	return $result;

}

function number_of_created_articles() {
	open_mysql_connection();
	$query = "SELECT description FROM `history` WHERE `description` LIKE \"%Uusi%\"";
	$result = mysql_query($query);
	$result = mysql_num_rows($result);
	mysql_close();
	return $result;
}

function get_user_lastlogin_time($userid) {
	open_mysql_connection();
	$query = "SELECT * FROM `userbase` WHERE `userid` LIKE '$userid' LIMIT 0, 30";
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) { $lastlogin = $row['lastlogin']; };
	mysql_close();
	return $lastlogin;
}

function get_userlevel_of_userid($userid) {
	open_mysql_connection();
	$query = "SELECT userlevel FROM `userbase` WHERE `userid` LIKE '$userid' LIMIT 0, 30";
	$result = mysql_query($query);
	while ($row = mysql_fetch_assoc($result)) { $userlevel = $row['userlevel']; };
	mysql_close();
	return $userlevel;
}

function get_all_users_all_info() {
	open_mysql_connection();
	$query = "SELECT * FROM `userbase` ORDER BY `userlevel` DESC";
	$result = mysql_query($query);;
	mysql_close();
	return $result;
}

function repair_mysql_tables() {
	open_mysql_connection();
	$query = "SELECT table_name FROM information_schema.TABLES WHERE table_schema = 'kolmasjalka'";
	$result = mysql_query($query);
	mysql_close();
	while ($row = mysql_fetch_assoc($result)) {
		$query = "REPAIR TABLE $row[table_name]";
		open_mysql_connection();
		mysql_query($query);
		mysql_close();
		if ($result == TRUE) { $_SESSION[performance][wererepaired] = 1; }
	}
}

function optimize_mysql_tables() {
	open_mysql_connection();
	$query = "SELECT table_name FROM information_schema.TABLES WHERE table_schema = 'kolmasjalka'";
	$result1 = mysql_query($query);
	mysql_close();
	while ($row = mysql_fetch_assoc($result1)) {
		$query = "OPTIMIZE TABLE $row[table_name]";
		open_mysql_connection();
		mysql_query($query);
		mysql_close();
		if ($result == TRUE) { $_SESSION[performance][wereoptimized] = 1; }
		
	}
}

function flush_mysql_tables() {
	open_mysql_connection();
	$query = "SELECT table_name FROM information_schema.TABLES WHERE table_schema = 'kolmasjalka'";
	$result = mysql_query($query);
	mysql_close();
	while ($row = mysql_fetch_assoc($result)) {
		$query = "FLUSH TABLE $row[table_name]";
		open_mysql_connection();
		mysql_query($query);
		mysql_close();
		if ($result == TRUE) { $_SESSION[performance][wereflushed] = 1; }
	}
}

function update_user_level($userid, $userlevel) {
	open_mysql_connection();
	$query = "UPDATE `userbase` SET `userlevel` = '$userlevel' WHERE `userid` = '$userid';";
	$result = mysql_query($query);
	mysql_close();
	return 0;
}

?>
