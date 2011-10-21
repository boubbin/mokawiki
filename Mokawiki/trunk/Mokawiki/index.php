<?php
	ob_start();
	// error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start();
	$_SESSION['performance']['rendering_start_time'] = microtime(true);
	require_once('func/require_functions.php');
	ini_set('session.gc_maxlifetime', 30*60);

	if ($_POST['pass'] != "" && $_POST['user'] != "") {
		validate_login_process();
	}

	$requested_page = $_GET['page'];
	$requested_action = $_GET['action'];

	// if (validate_alphanumeric($requested_page)) { go_to_mainpage(); }

	if ($_SESSION[authed] == 1) {
		update_user_active_time(md5($_SESSION['user']), time());
		if ($requested_page != "") {
			$_SESSION[currentpage] = $requested_page;
			if ($requested_page == "random_article") {
				$random_page = get_random_wiki_page_name();
				header("Location: index.php?page=".urlencode($random_page)."&action=read");
			} else if ($requested_page == "files") {
				// implement files page
			} else if ($requested_page == "recent_changes") {
				print_recent_changes_page();
			} else if ($requested_page == "organisation") {
				// implement organiatio
			} else if ($requested_page == "top_contributors") {
				print_top_editors_page($requested_page);
			} else if ($requested_action == "read" || $requested_action == "") {
				print_wiki_page($requested_page);
			} else if ($requested_action == "edit") {
				edit_wiki_page($requested_page);
			} else if ($requested_action == "conversation") {
				print_conversation_page($requested_page);
			} else if ($requested_action == "history") {
				print_history_page($requested_page);
			} else {
				// There was page, but no action, default action read?
				header("Location: index.php?page=".urlencode($requested_page)."&action=read");
			}
		} else {
			// There was no page (nor action)
			// so there might be admin actions!
			$admin_task = $_GET['admin_task'];
			if ($admin_task == "control_panel") {
				print_control_panel();
			} else if ($admin_task == "user_control") {
				print_user_control();
			} else if ($admin_task == "content_manager") {
				print_content_manager();
			} else {
				header("Location: index.php?page=".urlencode($mainpage_name)."&action=read");
			}
		}
	} else {
		if ($requested_action == "login") {
			print_visitor_page();
		} else if ($requested_action == "create_account") {
			if (!isset($_SESSION[create])) {
				$_SESSION[create] = 1;
				print_registration_page();
			} else {
				$result = validate_account_creation_process();
				if ($result == 0) {
					print_registration_page();
				} else {
					header("Location: index.php?page=paasivu&action=read");
				}
			}
		} else if ($requested_action == "about") {
			print_about_service_page();
		} else {
			print_visitor_page();
		}
	}
	ob_flush();
?>
