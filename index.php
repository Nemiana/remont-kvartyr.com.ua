<?php
    //Redirect index.php to root (/)
    if ($_SERVER['REQUEST_URI'] == '/index') {
        header ('Location: /', TRUE, 301);
        exit();
    }
    require_once ('/query/queries.php');
    //Query meta-tags and main article from DB
    $result_meta_tags = get_meta_tags_query ('/');
    $result_article = get_main_article ();
    require_once ('/view/view_header.php');
?>
<article>
    <!-- Title and text with switch language -->
    <?php 
        if ($_COOKIE['lang'] == 'rus') {
            echo "<h1>$result_article[3]</h1><p>$result_article[4]</p>"; 
        } else if ($_COOKIE['lang'] == 'eng') {
            echo "<h1>$result_article[5]</h1><p>$result_article[6]</p>"; 
        } else {
            echo "<h1>$result_article[1]</h1><p>$result_article[2]</p>"; 
        }
    ?>
</article>
<?php
    require_once ('/view/view_footer.php');