<?php

function print_edit_page_options() {
	if ($_SESSION['userlevel'] > 0) { 
		if ($_SESSION['userlevel'] > 1) { echo "<h4><input type=checkbox value=delete name=delete_article>Poista artikkeli?</h4>"; }
		echo "<h4><input type=checkbox value=replace name=replace_html checked>Korvaa html-mutoilut automaattisesti?</h4></p>";
		echo "<input type=submit name=submitted value=\"Tallenna muutokset\"></form>";
	}


}

function print_create_new_article_options() {
	if ($_SESSION['userlevel'] > 0) { 
		echo "
			<h4><input type=checkbox value=replace name=replace_html checked>Korvaa html-muotoilut automaattisesti?</h4></p>
			<input type=submit name=submitted value=\"Tallenna muutokset\"></form></p>
		";
	}


}

function generate_article_edit_page($article) {
	$content = get_article_content($article);
	$last_editor_id = get_article_last_modification_username($article);
	$last_editor_name = userid_to_username($last_editor_id);
	$last_edited = get_article_last_modification_time($article);
	$last_edited = unixtime_to_date($last_edited);
	if ($content == "") {
		echo "
<div id=content>
<p>
<article_header>Luo uusi artikkeli</article_header>
<form method=POST>
<textarea name=newcontent cols=80 rows=25>
</textarea>
<h3>Lyhyt kuvaus</h3>
<textarea name=description cols=80 rows=1 style=\"overflow:hidden;\">
Uusi artikkeli luotu
</textarea><p>
";
print_create_new_article_options();
echo "

</div>";
	} else {
		echo "
<div id=content>
<p>
<article_header>Muokkaa artikkelia</article_header>
<form method=POST>
<textarea name=newcontent cols=80 rows=25>
".replace_newline_tags($content)."
</textarea>
<h3>Lyhyt kuvaus muutokselle</h3>
<textarea name=description cols=80 rows=1 style=\"overflow:hidden;\">

</textarea><p>
";
print_edit_page_options();
echo "
<p>
<article_info>
Tätä artikkelia on muutettu viimeksi: $last_edited (muokannut: $last_editor_name)
</article_info>
</div>
</p>";
	}
}
?>
