<?php
function generate_recent_changes_page() {
          // "how many results per page"
	$indexing = 30;
	$show_removed = 1;
	$number_of_results = 0;
	if (!isset($_GET['style'])) { $show_removed = 0; }
	if (!isset($_GET['page_index'])) {
		$page_start_index = 0;
	} else {
		$page_start_index = $_GET['page_index'];
	}
	echo "
		<div id=\"content\">
			<p>
			<article_header>Muutokset </article_header>
				<div class=\"featurebox_center\">
				<ol start=" . ($page_start_index + 1) . ">
	";
          if (isset($show_removed)) { $empty = 1; } else { $empty = 0; }
	$result = get_next_x_changes($page_start_index, $indexing, $empty);
	while ($row = mysql_fetch_assoc($result)) {
		$articleid = $row['articleid'];
		$articlename = articleid_to_articlename($row['articleid']);
		$duration = trim(unixtime_to_duration($row['created']));
		$editor = userid_to_username($row['userid']);
		$description = htmlspecialchars(trim($row['description']));
		if ($description == "") { $description = "ei kuvausta"; }
		if ($duration == "") { $duration = "<1m sitten"; }
		$number_of_results++;
		echo "<li><a href=index.php?page=".urlencode($articlename)."&action=read>". ucfirst($articlename) . " ($duration)</a>, edited by: <easy>$editor</easy> (<i>$description</i>)</li>\n";
	}
	echo "
			</div>
			</p>
			<p><script type=\"text/javascript\">
				function active_remove_also(state)
				{
					if (state.value == \"on\") {
						this.location.href = \"index.php?page=recent_changes&style=showall\";
					} else {
						this.location.href = \"index.php?page=recent_changes\";
					}
				}
			</script>
			<h4><form><input type=checkbox ";if ($show_removed) { echo "checked"; } echo " onclick=active_remove_also(this);>Näytä myös poistettujen artikkelien muutokset</form></h4>
			<table width=100% border=0>
				<tr>
					<td align=left width=50%>
	";
					if ($page_start_index > 0) {
						$newindex = $page_start_index - $indexing;
						if ($show_removed) {
							echo "<a href=index.php?page=recent_changes&page_index=$newindex&style=showall><h3>Edelliset $indexing hakutulosta</h3></a>";

						} else {
							echo "<a href=index.php?page=recent_changes&page_index=$newindex><h3>Edelliset $indexing hakutulosta</h3></a>";
						}
					}
	echo "
					</td>
					<td align=right width=50%>
          ";
				        if ($number_of_results == $indexing) {
						$newindex = $page_start_index + $indexing;
						if ($show_removed) {
							echo "<a href=index.php?page=recent_changes&page_index=$newindex&style=showall><h3>Seuraavat $indexing hakutulosta</h3></a>";

						} else {
							echo "<a href=index.php?page=recent_changes&page_index=$newindex><h3>Seuraavat $indexing hakutulosta</h3></a>";
						}
				        }
          echo "
					</td>
				</tr>
			</table>
			</p>
		</div>
	";
}
?>