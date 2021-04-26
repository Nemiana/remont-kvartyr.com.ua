<?php
    require_once ('/admin/admin_header.php');
    require_once ('/query/queries.php');
    //Shows action message if it exists one time
    show_info_message ();
    //If any button was pressed
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //If first button was pressed
        if (isset($_POST['meta_tags'])) {
            //Set meta-tags for root (/) from form fields
            set_meta_tags_query ('/', $_POST['meta_title'], $_POST['meta_keywords'], $_POST['meta_description']);
            reload ();
        //If second button was pressed
        } else if (isset($_POST['title_text'])) {
            //Set title and article for home page from form fields
            set_main_article ($_POST['title_article'], $_POST['text_article']);
            reload ();
        };  
    };
    //Query meta-tags for root (/) from DB 
    $result_meta_tags = get_meta_tags_query ('/');
    //Query title and article from DB
    $result_article = get_main_article ();
?>
    <article class="admin_page">
        <h1>Головна</h1>
        <!-- Form for change meta-tags -->
        <?php require_once ('/admin/admin_meta_form.php');?>
        <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
            <table>
                <tr>
                    <td><label for="title_article">Заголовок: </label></td>
                    <td><input type="text" name="title_article" size="100" value="<?= $result_article[0]; ?>"></td>
                </tr>
                <tr>
                    <td><label for="text_article">Текст: </label></td>
                    <td><textarea name="text_article" cols="103" rows="10"><?= $result_article[1]; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="title_text">Зберегти</button></td>
                </tr>
            </table>
        </form>
    </article>
</body>
</html>