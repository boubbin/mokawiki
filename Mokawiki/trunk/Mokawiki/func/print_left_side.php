<?php
function print_ajax_search() {
	echo '
<html>
<head>
<script type="text/javascript">

function submitenter(searchterm,e) {
	var keycode;
	if (window.event) keycode = window.event.keyCode;
	else if (e) keycode = e.which;
	else return true;
	var re = /^[a-zA-Z0-9|äö,\.\!\?]$/;
	if (keycode == 13) {
		if (re.test(searchterm) == true) {	
			return 0;
		} else {
			this.location.href = "print_search_page.php?searchterm="+searchterm;
		}
	}
}

function showResult(str) {
	if (str.length==0) { 
		document.getElementById("livesearch_results").innerHTML="";
		document.getElementById("livesearch_results").style.border="0px";
		return;
	}
	xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange=function() {	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			document.getElementById("livesearch_results").innerHTML=xmlhttp.responseText;
			document.getElementById("livesearch_results").style.border="1px solid #A5ACB2";
		}
	}
	xmlhttp.open("GET","func/ajax_livesearch.php?q="+str,true);
	xmlhttp.send();
}
</script>
</head>
<body>


<input type="text" size="20" onkeyup="showResult(this.value)" autocomplete=off onKeyPress="submitenter(this.value, event)" />
<div id="livesearch_results" style="margin : 0px 10px; width : 137px; font-size : 12px; font-family: verdana, arial, sans-serif;"></div>


</body>
</html>

	';

}

function print_left_side() {
	if ($_POST['search']!="") { echo $_POST['search']; }
	global $mainpage_name;
        echo '
	      <div id="left_side">
		    <h3>Toiminnot</h3>
		    
		    <h4>Hae wikistä</h4>
	';
print_ajax_search();
	echo "
		    
		    <p><h4><a href=index.php?page=random_article>Satunnainen</a></h4></p>
		    <p><h4><a href=index.php>Tiedostot</a></h4></p>
		    <p><h4><a href=index.php?page=recent_changes>Muutokset</a></h4></p>
		    <p><h4><a href=index.php?page=top_contributors>Top wikittäjät</a></h4></p>
		    <p><h4><a href=index.php?page=organization>Organisaatio</a></h4></p>
		    <p>
	      </div>
        ";
}

?>
