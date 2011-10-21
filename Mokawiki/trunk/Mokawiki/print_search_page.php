<?php

function echo_page_doesnt_exist($article) {
	echo "
		<p>
		<div class=featurebox_center><center>
		<h3>Aivan kuten seksielämääsi, tätä artikkelia ei ole olemassa</h3><br>
		<a href=index.php?page=".urlencode($article)."&action=edit><h3green>Klikkaa minua auttaaksesi MokaWikiä ja luo artikkeli tästä aiheesta!</h3green></a>
		</div>
		</p>
		</center><p>";

}
function echo_search_result_header($articlename) {
	if ($articlename == "") { $articlename = "Hakutulokset"; }
	echo "
		<p>
		<article_header>$articlename</article_header><br><br>
		</p>";
}

	// do not create new functions in this file
	// ...or if you do remember to call them in the end
	// this file is called form javascript event!
	// javascript cant call php functions
	require('func/require_functions.php');
	$search_term = $_GET[searchterm];
	if (!isset($_GET[searchterm])) { header('Location: index.php'); }
	if (!validate_alphanumeric($_GET[searchterm])) { header('Location: index.php'); }
	if (article_exists($_GET[searchterm])) { header("Location: index.php?page=$search_term&action=read"); }

	// there wont be redirections anymore, we need to form the results page, no matter what shit...
	print_html_head_and_meta_data_tags();
	print_header_of_the_page_no_header_links();
	print_left_side();
	print_right_side();
	echo "<div id=\"content\">";
	if (is_part_of_article_name($_GET[searchterm])==1) { 
		// we only got one, show results, but sugggest to create the article
		$article = get_article_name_matching_part($search_term);
		echo_search_result_header($search_term);
		echo_page_doesnt_exist($search_term);
		echo "<p><div class=\"featurebox_center\">";
		echo "<h3>Seuraava hakutulos löytyi haulla (<h3green>$search_term</h3green>) kun etsittiin artikkelien nimistä</h3>";
		echo "<li><a href=index.php?page=".urlencode($article)."&action=read>$article</a></li></p>";
	} else if (is_part_of_article_name($search_term)==2) {
		// we got plenty, well.. over 1..
		$articles = get_matching_article_names($search_term);
		echo_search_result_header($search_term);
		echo_page_doesnt_exist($search_term);
		echo "<p><div class=\"featurebox_center\">";
		echo "<h3>Seuraavat hakutulokset löytyivät haulla (<h3green>$search_term</h3green>) kun etsittiin artikkelien nimistä</h3>";
		echo "<ol>";
		while ($row = mysql_fetch_assoc($articles)) {
			echo "<li><a href=index.php?page=".urlencode($row[articlename])."&action=read>$row[articlename]</a></li>";
		}
	} else if (is_part_of_article_body($search_term)) {
		$articles = get_matching_article_names_which_has_part($search_term);
		echo_search_result_header($search_term);
		echo_page_doesnt_exist($search_term);
		echo "<p><div class=\"featurebox_center\">";
		echo "</center><h3>Seuraavat hakutulokset löytyivät haulla (<h3green>$search_term</h3green>) kun etsittiin artikkelien sisällöstä</h3>";
		echo "</center><ol>";
		while ($row = mysql_fetch_assoc($articles)) {
			$content = $row[content];
			$position = strpos(strtolower($content), strtolower($search_term));
			$preview = str_replace(strtolower($search_term),"<b>".$search_term."</b>",strip_tags(substr(strtolower($content), $position - 40, 80)));
			echo "<li><a href=index.php?page=".urlencode($row[articlename])."&action=read>$row[articlename]</a> (..<i>$preview</i>..)</li>";
		}
	} else if (!is_part_of_article_body($search_term)) {
		echo_search_result_header($search_term);
		echo_page_doesnt_exist($search_term);
		echo "<p><div class=\"featurebox_center\">";
		echo "<h3>Hakutuloksia ei löytynyt haulla (<h3green>$search_term</h3green>) kun etsittiin artikkelien nimistä ja niiden sisällöstä</h3>";
	}
	echo "</div></p></div></p></p><br>";
	print_footer();
?>
