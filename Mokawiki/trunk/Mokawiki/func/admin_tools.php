<?php

function print_control_panel() {
	print_html_head_and_meta_data_tags();
	print_header_of_the_page_no_header_links();
	print_left_side();
	print_right_side();
	generate_control_panel_page();
	print_footer();	
	
}

function print_user_control() {
	print_html_head_and_meta_data_tags();
	print_header_of_the_page_no_header_links();
	print_left_side();
	print_right_side();
	generate_user_control_page();
	print_footer();	
	
}

function print_content_manager() {
	print_html_head_and_meta_data_tags();
	print_header_of_the_page_no_header_links();
	print_left_side();
	print_right_side();
	generate_content_manager_page();
	print_footer();	
	
}


?>