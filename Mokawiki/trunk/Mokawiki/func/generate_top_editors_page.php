<?php 

function format_procent($string) {
	return round($string*100,0);
}

function print_top_editors() {
	echo "<table>";
	echo "<tr><td><h3>Nimi</td><td><h3>Kpl</td></tr>";
	$result = get_top_editors();
	$total_edits = number_of_rows_in_table(history);
	while ($row = mysql_fetch_assoc($result)) {
		$username = userid_to_username($row['userid']);
		$count =  $row['count'];
		echo "<tr><td><h3green>$username</h3green></td><td><h2>$count (".format_procent($count/$total_edits)."%)</h2></td></tr>";
	}
	echo "</table>";
}

function print_top_creators() {
	echo "<table>";
	echo "<tr><td><h3>Nimi</td><td><h3>kpl</td></tr>";
	$result = get_top_creators();
	$total_created = number_of_created_articles();
	while ($row = mysql_fetch_assoc($result)) {
		$username = userid_to_username($row['userid']);
		$count =  $row['count'];
		echo "<tr><td><h3green>$username</h3green></td><td><h2>$count (".format_procent($count/$total_created)."%)</h2></td></tr>";

	}
	echo "</table>";
}

function print_most_inactive() {
	echo "<table>";
	echo "<tr><td><h3>Nimi</td><td><h3>kpl</td></tr>";
	$result = get_most_inactive();
	$total_edits = number_of_rows_in_table(history);
	while ($row = mysql_fetch_assoc($result)) {
		$username = userid_to_username($row['userid']);
		$count =  $row['count'];
		echo "<tr><td><h3green>$username</h3green></td><td><h2>$count (".format_procent($count/$total_edits)."%)</h2></td></tr>";
	}
	echo "</table>";
}


function generate_top_editors_page() {
	echo '
		<p>
		<div id="content">
			<p>
				<h3>Kovimmat muokkaajat</h3>
				<div class="featurebox_center">
	';			print_top_editors();
	echo '
				</div>
			</p>
			<p>
				<h3>Eniten luotuja artikkeleita</h3>
				<div class="featurebox_center">
	';			print_top_creators();
	echo '
				</div>
			</p>
			<p>
				<h3>Epäaktiivisimmat</h3>
				<div class="featurebox_center">
	';			print_most_inactive();
	echo '
				</div>
			</p>
		</div>
		</p>
';

}

?>