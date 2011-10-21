<?php
function print_footer() {
	echo "
		<div id=\"footer\">
		<p>(c) Team Kolmasjalka 2011<br>
	";
	if ($_SESSION['authed'] == 1) {
		print_rendering_time();
	}
	echo "
		</p><br />
		</div>
		</div>
		</body>	
		</html>
	";
}

?>
