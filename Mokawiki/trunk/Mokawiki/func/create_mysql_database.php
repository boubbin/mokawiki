<?php
require_once('require_functions.php');
function create_mysql_database() {

	if (0) { echo "Edit create_mysql_database.php if you are really sure about this"; return 0; }

	// This file creates the mysql database schema
	// use this only one time in a new enviroment!!!!
	
	mysql_connect($mysql_host, $mysql_user, $mysql_pass);
	mysql_selectdb($mysql_table);
	echo "Muuttujat asetettu, sql-yhteys avattu<br>";

	$create_article_db = "CREATE TABLE `kolmasjalka`.`article` (`articleid` VARCHAR(32) NOT NULL, `articlename` VARCHAR(255) NOT NULL, `classes` VARCHAR(255) NOT NULL, `content` MEDIUMTEXT) ENGINE = MyISAM;";
	$create_history_db = "CREATE TABLE `kolmasjalka`.`history` (`articleid` VARCHAR(255) NOT NULL, `created` BIGINT(255) NOT NULL, `userid` VARCHAR(32) NOT NULL, `content` MEDIUMTEXT, `description` VARCHAR(255) NOT NULL) ENGINE = MyISAM;";
	$create_conversation_db = "CREATE TABLE `kolmasjalka`.`conversation` (`articleid` VARCHAR(32) NOT NULL, `created` BIGINT(255) NOT NULL, `content` MEDIUMTEXT) ENGINE = MyISAM;";
	$create_userbase_db = "CREATE TABLE `kolmasjalka`.`userbase` (`userid` VARCHAR(32) NOT NULL, `username` VARCHAR(255) NOT NULL, `password` VARCHAR(255) NOT NULL, `firstname` VARCHAR(20) NOT NULL, `lastname` VARCHAR(20) NOT NULL, `title` VARCHAR(255) NOT NULL, `sex` INT(1) NOT NULL, `email` VARCHAR(255) NOT NULL, `userlevel` INT(1) NOT NULL, `created` BIGINT(255) NOT NULL, `lastlogin` BIGINT(255) NOT NULL) ENGINE = MyISAM;";
	$create_news_db = "CREATE TABLE `kolmasjalka`.`news` (`created` BIGINT(255) NOT NULL, `userid` VARCHAR(32) NOT NULL, `content` MEDIUMTEXT) ENGINE = MyISAM;";
	$create_activeusers_db = "CREATE TABLE `kolmasjalka`.`activeusers` (`userid` VARCHAR(32) NOT NULL, `logon` BIGINT(255) NOT NULL, PRIMARY KEY (`userid`)) ENGINE = MyISAM;";

	echo "DB-queryt muodostettu...<br>";
	
	$result = mysql_query($create_article_db);
	$result = mysql_query($create_history_db);
	$result = mysql_query($create_conversation_db);
	$result = mysql_query($create_userbase_db);
	$result = mysql_query($create_news_db);
	$result = mysql_query($create_activeusers_db);
	
	echo "Databaset luotu..<br>";
	
	$set_articleid_as_primarykey_in_article = "ALTER TABLE `article` ADD PRIMARY KEY(`articleid`)";
	$set_articleid_unique_in_article = "ALTER TABLE `article` ADD UNIQUE(`articleid`)";	
	$set_article_id_as_primarykey_in_conversation = "ALTER TABLE `conversation` ADD PRIMARY KEY(`articleid`)";
	$set_artcile_id_as_unique_in_conversation = "ALTER TABLE `conversation` ADD UNIQUE(`articleid`)";
	$set_userid_as_primarykey_in_userbase = "ALTER TABLE `userbase` ADD PRIMARY KEY(`userid`)";
	$set_userid_as_unique_in_userbase = "ALTER TABLE `userbase` ADD UNIQUE(`userid`)";
	$set_created_as_unique_in_history = "ALTER TABLE `history` ADD UNIQUE(`created`)";
	$set_userid_as_primarykey_in_activeusers = "ALTER TABLE `activeusers` ADD UNIQUE(`userid`)";

	echo "Key ja unique queryt muodostettu..<br>";
	
	$result = mysql_query($set_articleid_as_primarykey_in_article);
	$result = mysql_query($set_articleid_unique_in_article);
	$result = mysql_query($set_article_id_as_primarykey_in_conversation);
	$result = mysql_query($set_artcile_id_as_unique_in_conversation);
	$result = mysql_query($set_userid_as_primarykey_in_userbase);
	$result = mysql_query($set_userid_as_unique_in_userbase);
	$result = mysql_query($set_created_as_unique_in_history);
	$result = mysql_query($set_userid_as_primarykey_in_activeusers);

	echo "Uniquet ja keyt asetettu..<br>";
	
	mysql_close();
	
	echo "SQL-ytheys suljettu<br>";

}
create_mysql_database();
?>
