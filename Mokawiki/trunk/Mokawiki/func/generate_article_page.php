<?php


function replace_inner_links($content) {
	$array = explode(" ", $content);
	$i = 0;
	foreach ($array as $word) {
		if ($word == "") { continue; }
		if (article_exists($word)) { $word = '<a href=index.php?page='.$word.'&action=read>'.$word.'</a>'; }
		$array[$i] = "$word"; $i++;
	}
	return implode(" ", $array);
}

function generate_article_page($article) {
	$article_name = get_article_name($article);
	$article_content = get_article_content($article);
	$last_editor_id = get_article_last_modification_username($article);
	$last_editor_name = userid_to_username($last_editor_id);
	$last_edited = get_article_last_modification_time($article);
	$last_edited = unixtime_to_date($last_edited);
	if ($article_name == "") {
		print_create_article_page($article);
	} else {
		echo "
			<div id=\"content\">
				<p>
				<article_header>$article_name</article_header>
					<div class=\"featurebox_center\">
					".replace_inner_links($article_content)."
				</div>
				</p>
				<p>
				<article_info>
				Tätä artikkelia on muutettu viimeksi: $last_edited (muokannut: $last_editor_name)
				</article_info>
				<p>
			</div>";
	}
}
?>
