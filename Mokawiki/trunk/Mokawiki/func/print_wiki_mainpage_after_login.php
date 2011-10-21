<?php
function print_wiki_mainpage_after_login() {
	if (!isset($_SESSION['firstpageload'])) {
		$_SESSION['firstpageload'] = 1;
		return 1;		
	}
	return 0;
}

?>
