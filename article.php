<?php
    require_once ('/view/view_header.php');
    require_once ('/view/pagination.php');
?>
<article class="article">
    <!-- Selection amount articles per page -->
    <table>
        <tr>
            <td><label for="amount_articles">Кількість статей на сторінці: </td>
            <td>
                <select class="amount_articles" name="amount_articles">
                    <!-- Default value, allows you to select the first value 3 -->
                    <option selected hidden>Вибрати</option>
                    <!-- Checks cookie with the same name as class select to set 'selected' to option -->
                    <option value="3" <?php if ($_COOKIE['amount_articles'] == '3') echo 'selected'; ?>>3</option>
                    <option value="5" <?php if ($_COOKIE['amount_articles'] == '5') echo 'selected'; ?>>5</option>
                    <option value="10" <?php if ($_COOKIE['amount_articles'] == '10') echo 'selected'; ?>>10</option>
                    <option value="15" <?php if ($_COOKIE['amount_articles'] == '15') echo 'selected'; ?>>15</option>
                    <option value="20" <?php if ($_COOKIE['amount_articles'] == '20') echo 'selected'; ?>>20</option>
                    <option value="50" <?php if ($_COOKIE['amount_articles'] == '50') echo 'selected'; ?>>50</option>
                </select>
            </td>
        </tr>
    </table>
    <?php 
        //Check cookie for chosen amount or default value 3
        if (isset ($_COOKIE['amount_articles'])) {
            $elements_per_page = $_COOKIE['amount_articles'];
        } else {
            $elements_per_page = 3;
        }
        //Table for work from DB
        $table_name = 'article_page';
        //Set pagination parameters and return actual collection
        $articles = set_pagination_parameteres($table_name, $elements_per_page);
        //Collection may be empty
        if ($articles) {
            //Output short articles
            foreach ($articles as $item) {
                if (isset($item)) {
                    //Short content with ...
                    $short_content = mb_substr($item['text_article'], 0, 800, 'UTF-8') . '...';
                    //Formatting date without time
                    $date = date_format(date_create($item['date_publication_article']), 'd.m.Y');
                    //Block article
                    echo "<div class='block_article'>";
                    echo "<a href='/article/{$item['url']}'><h1>{$item['title_article']}</h1></a>";
                    echo "<p>{$date}</p>";
                    echo "<img src='/articles_images/{$item['image_article']}' alt='{$item['title_article']}'>";
                    echo "<p class='content'>{$short_content}";
                    echo "<a href='/article/{$item['url']}'>Читати далі...</a></p>";
                    echo "</div>";
                }
            }
        }
        //Output markup pagination (parameter - base path)
        pagination ('/article/page');
    ?>
</article>
<script src="/js/amount_per_page.js"></script>
<script>
    //Save to cookie chosen amount
    amount_per_page ('amount_articles', '/article');
</script>
<?php
    require_once ('/view/view_footer.php');