<?php
function print_recent_changes_page() {
	print_html_head_and_meta_data_tags();
	print_header_of_the_page_no_header_links();
	print_left_side();
	print_right_side();
	generate_recent_changes_page();
	print_footer();
}

?>