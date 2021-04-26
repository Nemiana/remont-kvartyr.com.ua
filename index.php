<?php
    //Redirect index.php to root
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
    <!-- Title -->
    <h1><?= $result_article[0]; ?></h1>
    <!-- Text -->
    <?= $result_article[1]; ?>
</article>
<?php
    require_once ('/view/view_footer.php');