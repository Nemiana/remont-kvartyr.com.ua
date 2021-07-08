<?php
    require_once ('/admin/admin_header.php');
    require_once ('/query/queries.php');
    require_once ('/view/pagination.php');
    //Shows action message if it exists one time
    show_info_message ();
    //If any button was pressed
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //If first button was pressed
        if (isset($_POST['meta_tags'])) {
            //Set meta-tags for article page (/article) from form fields
            set_meta_tags_query ('/article', $_POST);
            reload();
        }
    };
    //Query meta-tags for article page (/article) from DB 
    $result_meta_tags = get_meta_tags_query ('/article');
?>
    <article class="admin_page">
        <h1><?= $translate['main_menu_article'] ?></h1>
        <!-- Form for change meta-tags -->
        <?php require_once ('/admin/admin_meta_form.php');?>
        <!-- Adding new article (id = 0) -->
        <table class="add_record">
            <tr>
                <td><a href='/admin/edit_article.php?id=0'><?= $translate['add_new_article'] ?></a></td>
            </tr>
        </table>
        <!-- Selection amount articles per page -->
        <table>
            <tr>
                <td><label for="amount_articles_admin"><?= $translate['amount_articles_per_page'] ?></td>
                <td>
                    <select class="amount_articles_admin" name="amount_articles_admin">
                        <!-- Default value, allows you to select the first value 3 -->
                        <option selected hidden><?= $translate['choose'] ?></option>
                        <!-- Checks cookie with the same name as class select to set 'selected' to option -->
                        <option value="3" <?php if ($_COOKIE['amount_articles_admin'] == '3') echo 'selected'; ?>>3</option>
                        <option value="5" <?php if ($_COOKIE['amount_articles_admin'] == '5') echo 'selected'; ?>>5</option>
                        <option value="10" <?php if ($_COOKIE['amount_articles_admin'] == '10') echo 'selected'; ?>>10</option>
                        <option value="15" <?php if ($_COOKIE['amount_articles_admin'] == '15') echo 'selected'; ?>>15</option>
                        <option value="20" <?php if ($_COOKIE['amount_articles_admin'] == '20') echo 'selected'; ?>>20</option>
                        <option value="50" <?php if ($_COOKIE['amount_articles_admin'] == '50') echo 'selected'; ?>>50</option>
                    </select>
                </td>
            </tr>
        </table>
        <!-- Editable table of articles -->
        <div>
            <table class="articles_table">
                <?php
                    //Check cookie for chosen amount or default value 3
                    if (isset ($_COOKIE['amount_articles_admin'])) {
                        $elements_per_page = $_COOKIE['amount_articles_admin'];
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
                ?>
                <tr>
                    <td>
                        <!-- Block article -->
                        <div class="block_article">
                            <a href="/admin/edit_article.php?id=<?= $item['id'] ?>"><h1><?= $item['title_article'] ?></h1></a>
                            <p><?= $date ?></p>
                            <img src="/articles_images/<?= $item['image_article'] ?>" alt="<?= $item['title_article'] ?>">
                            <p class="content"><?= $short_content ?>
                            <a href="/admin/edit_article.php?id=<?= $item['id'] ?>"><?= $translate['edit'] ?></a></p>
                        </div>
                    <td>
                    <td>
                        <!-- Edit icon -->
                        <a href="/admin/edit_article.php?id=<?= $item['id'] ?>">
                            <img src="/images/edit_icon.png" alt="edit" title="<?= $translate['edit'] ?>">
                        </a>
                    </td>
                    <td>
                        <!-- Delete icon -->
                        <input type="image" src="/images/del_icon.png" class="delete_article" 
                        data-id_article="<?= $item['id'] ?>" alt="delete" title="<?= $translate['delete'] ?>">
                    </td>
                </tr>
                <?php
                            }
                        }
                    }
                ?>
            </table>
            <?php
                //Output markup pagination (parameter - base path)
                pagination ('/admin/admin_article.php/page');
            ?>
        </div>
    </article>
    <script src="/js/amount_per_page.js"></script>
    <script>
        //Save to cookie chosen amount
        amount_per_page ('amount_articles_admin', '/admin/admin_article.php');
    </script>
    <script src="/admin/js/delete_article.js"></script>
</body>
</html>