<?php

function print_header_of_the_page_no_header_links() {
       echo '
        <body>
        <div id="page_wrapper">
        <div id="header_wrapper"> 
        <div id="header">
        <table><tr><td><a href=index.php><img src=img/lokoo.png></a></td><td>
        <h1>Moka<font color="#FFDF8C">Wiki</font></h1>
        <h2>Mokamiespalveluiden sisäinen wiki</h2>
        </td></tr></table>
        </div>
        <div id="navcontainer">
        <ul id="navlist">
	<li id="active"><a href="index.php" id="current">' . MokaWiki . '</a></li>
        </ul>
        </div>
        </div>
';
}

?>