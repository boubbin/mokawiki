<?php

function add_new_article($article, $content) {
	open_mysql_connection();
	$articleid = md5($article);
	$userid = md5($_SESSION['user']);
	$content = mysql_real_escape_string($content);
	$query = "INSERT INTO `article` (`articleid`, `articlename`, `classes`, `content`) VALUES ('$articleid', '$article', '', '$content');";
	$result = mysql_query($query);
	mysql_close();
}

function delete_article($article) {
	open_mysql_connection();
	$articleid = md5($article);
	$query = "DELETE FROM `article` WHERE `articleid` = '$articleid';";
	$result = mysql_query($query);
	mysql_close();
}

function update_article($articleid, $newcontent) {
	open_mysql_connection();
	$newcontent = mysql_real_escape_string($newcontent);
	$query = "UPDATE `article` SET `content` = '$newcontent' WHERE `articleid` = '$articleid';";
	$result = mysql_query($query);
	mysql_close();
}

function write_history($articleid, $content, $description) {
	open_mysql_connection();
	$time = time();
	$userid = md5($_SESSION['user']);
	$content = mysql_real_escape_string($content);
	$query = "INSERT INTO `history` (`articleid`, `created`, `userid`, `content`, `description`) VALUES ('$articleid', '$time', '$userid', '$content', '$description');";
	$result = mysql_query($query);
	mysql_close();
}

function edit_wiki_page($article) {
	if ($_POST['newcontent'] != "") {
		if (get_article_content($article) == "") {
			// its actually new article...
			$content = $_POST['newcontent'];
			$description = $_POST['description'];
			// check if the user wants to replace the html tags automaticly?
			if ($_POST['replace_html'] == "replace") {
				$content = replace_html_tags($content);
			}
			add_new_article($article, $content);
			write_history(md5($article), $content, $description);
			header("Location: index.php?page=$article&action=read");
		} else if ($_POST['delete_article'] == "delete" && $_SESSION['userlevel']>1) {
			delete_article($article);
			header("Location: index.php?page=$article&action=read");
		} else {
			// check if the changes are equal to the exisiting article
			$newcontent = $_POST['newcontent'];
			$oldcontent = get_article_content($article);
			$description = $_POST['description'];
			// check if the user wants to replace the html tags automaticly?
			if ($_POST['replace_html'] == "replace") {
				$newcontent = replace_html_tags($newcontent);
			}
			if (md5($oldcontent) != md5($newcontent)) {
				// there was changes
				update_article(md5($article), $newcontent);
				write_history(md5($article), $newcontent, $description);
			}
			header("Location: index.php?page=$article&action=read");
		}
	} else {
		print_html_head_and_meta_data_tags();
		print_header_of_the_page();
		print_left_side();
		print_right_side();
		generate_article_edit_page($article);
		print_footer();
	}
}
?>
