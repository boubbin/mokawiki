<?php

function print_create_article_page($article) {
	echo "
		<div id=\"content\">
			<p>
			<article_header>$article</article_header><br>
			<div class=featurebox_center><center>
			<h3>Aivan kuten seksiel‰m‰‰si, t‰t‰ artikkelia ei ole olemassa</h3><br>
			<a href=index.php?page=$article&action=edit><h3green>Klikkaa minua auttaaksesi MokaWiki‰ ja luo artikkeli t‰st‰ aiheesta!</h3green></a>
			</div>
			<p>
		</div>";
}
?>