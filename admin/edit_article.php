<?php
    //View single article for edit or addition
    require_once ('/admin/admin_header.php');
    require_once ('/query/queries.php'); 
    //Shows action message if it exists one time
    show_info_message ();
    //Get id article from GET-parameter
    $id_article = $_GET['id'];
    //Get article form DB by id
    $article = get_article ($id_article);
    //If id = 0 - addition article, else edit and save article (title page and name submit button)
    $title_page = $id_article > 0 ? $translate['edit_article'] : $translate['add_article'];
    $submit_name = $id_article > 0 ? 'save_article' : 'add_article';
    //Current path to reload page
    $path = '/admin/admin_article.php';
    //If any button was pressed
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //If save button was pressed
        if (isset ($_POST['save_article'])) {
            save_article ($_POST);
            reload ($path);
        //If addition button was pressed
        } elseif (isset ($_POST['add_article'])) {
            add_article ($_POST);
            reload ($path);
        }
    };
?>
    <article class="admin_page">
        <h1><?= $title_page ?></h1>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <!-- Editable table for article -->
            <table class="edit_article">
                <tr>
                    <!-- id article -->
                    <td><input type="hidden" name="id_article" value="<?= $article['id']; ?>"></td>
                </tr>
                <!-- Meta-tags -->
                <tr>
                    <td><label for="meta_title"><?= $translate['meta_title'] ?>: </label></td>
                    <td colspan="2"><input type="text" name="meta_title" size="100" value="<?= $article['meta_title']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="meta_keywords"><?= $translate['meta_keywords'] ?>: </label></td>
                    <td colspan="2"><input type="text" name="meta_keywords" size="100" value="<?= $article['meta_keywords']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="meta_description"><?= $translate['meta_description'] ?>: </label></td>
                    <td colspan="2"><input type="text" name="meta_description" size="100" value="<?= $article['meta_description']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="title_article"><?= $translate['heading'] ?>: </label></td>
                    <td colspan="2"><input type="text" name="title_article" class="title_article" size="100" value="<?= $article['title_article']; ?>" required></td>
                </tr>
                <tr>
                    <!-- SEF URL for article -->
                    <td><label for="url_article">URL: </label></td>
                    <td><input type="text" name="url_article" class="url_article" size="70" value="<?= $article['url']; ?>"></td>
                    <!-- Button for generating url from title by transliteration -->
                    <td><input type="button" class="generate_url" value="<?= $translate['generate'] ?>"></td>
                </tr>
                <tr>
                    <td><label for="text_article"><?= $translate['text'] ?>: </label></td>
                    <td colspan="2"><textarea name="text_article" cols="103" rows="10" required><?= $article['text_article']; ?></textarea></td>
                </tr>
                <tr>
                    <!-- Date creation without time -->
                    <td><label for="date_creation_article"><?= $translate['date_creation'] ?>: </label></td>
                    <td><input type="date" name="date_creation_article" value="<?= date_format(date_create($article['date_publication_article']), 'Y-m-d'); ?>"></td>
                </tr>
                <tr>
                    <td><label for="image_article"><?= $translate['image'] ?>: </label></td>
                    <!-- Input for chosen image file -->
                    <td><input type="file" name="image_article"></td>
                    <td><img src="/articles_images/<?= $article['image_article']; ?>" class="image_article"></td>
                    <!-- Delete icon for image -->
                    <td><input type="image" src="/images/del_all_icon.png" data-id_article="<?= $article['id']; ?>"
                        class="delete_image" alt="delete" title="<?= $translate['delete'] ?>"></td>
                </tr>
                <tr>
                    <td><button type="submit" name="<?= $submit_name; ?>"><?= $translate['save'] ?></button></td>
                </tr>
            </table>
        </form>
    </article>
    <!-- Scripts for generate url and delete image -->
    <script src="/admin/js/generate_url.js"></script>
    <script src="/admin/js/delete_image.js"></script>