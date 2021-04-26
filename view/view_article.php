<!-- Views full single article -->
<?php
    require_once ('/view/view_header.php');
    require_once ('/query/queries.php');
    //Get article by url from GET-parameter
    $article = get_article_by_url ($_GET['title']);
    //Formatting date without time
    $date = date_format(date_create($article['date_publication_article']), 'd.m.Y');
?>
<article class="article">
    <!-- Full article -->
    <div class="block_article">
        <h1><?= $article['title_article'] ?></h1>
        <p><?= $date ?></p>
        <img src='/articles_images/<?= $article['image_article'] ?>' alt='<?= $article['title_article'] ?>'>
        <p class='content'><?= $article['text_article'] ?></p>
    </div>
</article>
<?php
    require_once ('/view/view_footer.php');