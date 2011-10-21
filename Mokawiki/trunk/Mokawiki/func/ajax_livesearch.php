<?php
	require('require_functions.php');
	// get the q parameter from URL
	$searchterm = $_GET['q'];
	if (!validate_alphanumeric($searchterm)) { echo "SQL-injection much?"; return 0; }
	$result = get_matching_article_names($searchterm);
	if (mysql_num_rows($result)) {
		while ($row = mysql_fetch_assoc($result)) {
			echo "<a href=index.php?page=" . urlencode($row['articlename']) . "&action=read>".ucfirst(htmlentities($row['articlename']))."</a><br>";
		}
	} else  {
		echo "ei tuloksia";
	}
?>