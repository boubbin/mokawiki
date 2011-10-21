<?php
function print_conversation_page($article) {

    if ($_POST['delete_conv'] == "Poista") {
        delete_conversation($article);
        header("Location: index.php?page=$article&action=conversation");
    }

    else if ($_POST[new_conv_content] != "") {
            if (get_conversation_content($article) == "") {
                    // its actually new article...
                    $content = $_POST['new_conv_content'];
//                    $description = $_POST[description];
                    // check if the user wants to replace the html tags automaticly?
//                    if ($_POST[replace_html] == "replace") {
                    $content = replace_html_tags($content);
//                    }
                    add_new_conversation($article, $content);
//                    $edit_time = get_conversation_last_modification_time($article);
//                    $edit_time = unixtime_to_date($edit_time);
//                    write_history(md5($article), $content, $description);
                    header("Location: index.php?page=$article&action=conversation");
            }
//            else if ($_POST[delete_conv] == "Poista") {
//                    delete_conversation($article);
//                    header("Location: index.php?page=$article&action=conversation");
//            }
            else {
                    // check if the changes are equal to the exisiting article
                    $new_conv_content = $_POST['new_conv_content'];
                    $oldcontent = get_conversation_content($article);
//                    $description = $_POST[description];
                    // check if the user wants to replace the html tags automaticly?
//                    if ($_POST[replace_html] == "replace") {
                    $new_conv_content = replace_html_tags($new_conv_content);
//                    }
                    if (md5($oldcontent) != md5($new_conv_content)) {
                            // there was changes
                            update_conversation(md5($article), $oldcontent, $new_conv_content);
//                            write_history(md5($article), $new_conv_content, $description);
                    }
                    header("Location: index.php?page=$article&action=conversation");
            }
    }

    else {
        print_html_head_and_meta_data_tags();
        print_header_of_the_page();
        print_left_side();
        print_right_side();
        generate_article_conversation_page($article);
        print_footer();
    }
} 
?>