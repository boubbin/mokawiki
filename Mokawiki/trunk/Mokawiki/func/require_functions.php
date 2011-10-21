<?php 
	// Turn "off" the error_reporting
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	// Add new functions to the bottom please!
	// .. until we get the loop in here
	
	// require('create_mysql_database.php');
	require('variables.php');
	require('mysql_functions.php');
	require('set_wrong_user_variable.php');
	require('set_wrong_password_variable.php');
	require('succesful_auth.php');
	require('print_wiki_mainpage_after_login.php');
	require('bad_password_echo.php');
	require('bad_username_echo.php');
	require('print_footer.php');
	require('get_news.php');
	require('print_right_side.php');
	require('print_left_side.php');
	require('print_header_of_the_page.php');
	require('print_html_head_and_meta_data_tags.php');
	require('print_visitor_page.php');
	require('generate_article_page.php');
	require('generate_article_edit_page.php');
	require('generate_article_history_page.php');
	require('generate_article_conversation_page.php');
	require('print_wiki_page.php');
	require('edit_wiki_page.php');
	require('print_conversation_page.php');
	require('print_history_page.php');
	require('print_registration_page.php');
	require('validate_account_creation_process.php');
	require('create_new_user_account.php');
	require('validate_login_process.php');
	require('print_create_article_page.php');
	require('print_recent_changes_page.php');
	require('generate_recent_changes_page.php');
	require('print_header_of_the_page_no_header_links.php');
	require('generate_search_results_page.php');
	require('print_about_service_page.php');
	require('print_top_editors_page.php');
	require('generate_top_editors_page.php');
	require('admin_tools.php');
	require('generate_control_panel_page.php');
	require('generate_user_control_page.php');
	require('generate_content_manager_page.php');
?>