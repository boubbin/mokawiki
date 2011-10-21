<?php
function print_history_page($article) {
	print_html_head_and_meta_data_tags();
	print_header_of_the_page();
	print_left_side();
	print_right_side();
	generate_article_history_page($article);
	print_footer();
}

?>