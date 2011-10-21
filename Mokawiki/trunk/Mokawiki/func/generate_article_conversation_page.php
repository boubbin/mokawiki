<?php
function generate_article_conversation_page($article) {
	$content = get_conversation_content($article);
	if ($content == "") {
            echo "
<div id=content>
    <article_header>Aloita keskustelu</article_header>
    <p>
        <form method=POST>
            <textarea name=new_conv_content cols=80 rows=8></textarea>
            <input type=submit name=submitted value=L&auml;het&auml;>
            <input type=submit name=delete_conv value=\"Poista keskustelu\">
        </form>
    </p>
</div>";
	} else {
            echo "
<div id=content>
    <article_header>Keskustelu</article_header><br>
    <p><div class=featurebox_conversation>$content</div></p><p>
    <form method=POST>
        <textarea name=new_conv_content cols=80 rows=8></textarea>
        <input type=submit name=submitted value=L&auml;het&auml;>
        <input type=submit name=delete_conv value=\"Poista keskustelu\">
    </form>
</p>
</div>";
    }
}
?>