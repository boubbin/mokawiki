<?php 

function print_selection_javascript() {
	echo '
		<script language="javascript">
		function choose(username, newlevel) { 
			alert(username+newlevel);
			this.location.href = "index.php?admin_task=user_control&username="+username+"&user_level="+newlevel;
		}
		</script>
	';
}

function print_user_setting_rows() {
	if (isset($_GET[username]) && isset($_GET[user_level])) {
			update_user_level(md5($_GET[username]), $_GET[user_level]);
	}
	print_selection_javascript();
	$result = get_all_users_all_info();
	while ($row = mysql_fetch_assoc($result)) {
		$userlevel = $row['userlevel'];
		$username = $row['username'];
		$email = $row['email'];
		echo "
			<tr>
				<td><h2>$username</h2></td>
				<td><h2>$email</h2></td>
				<td><select name=$username onchange=\"choose(this.name, this.value)\">
		";
				$i = 0;
				while ($i < 4) {
					if ($i == $userlevel) {
						echo "<option value=$i selected>$i</option>";
					} else {
						echo "<option value=$i>$i</option>";
					}
					$i++;

				}
		echo "
				</select>
				</td>
				<td><input type=submit name=delete_$username value=\"Poista käyttäjä\"></td>
			</tr>
		";
	}
}

function generate_user_control_page() {
	echo "
		<div id=\"content\"><p>
		<h3>Käyttäjätilien hallinta</h3>
		<div class=featurebox_center>
		<table>
			<tr>
				<td><h3>Nimi</h3></td>
				<td><h3>Sähköposti</h3></td>
				<td><h3>Taso</h3></td>
				<td></td>
			</tr>
	";
	print_user_setting_rows();
	echo "
		</table>
		<p><h5>Userlevel asetus toimii, mutta poistaminen ei</h5>	</p>
		</div>
		</div></p>
	";


}

?>