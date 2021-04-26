<?php
    require_once ('/admin/admin_header.php');
    require_once ('/query/queries.php');
    //Shows action message if it exists one time
    show_info_message ();
    //If any button was pressed
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //If first button was pressed
        if (isset($_POST['meta_tags'])) {
            //Set meta-tags for contact page (/contact) from form fields
            set_meta_tags_query ('/contact', $_POST['meta_title'], $_POST['meta_keywords'], $_POST['meta_description']);
            reload ();
        //If second button was pressed
        } else if (isset($_POST['contact'])) {
            //Set contact info for contact page from form fields
            set_contact_info ($_POST['contact_text']);
            reload ();
        }
    }
    //Query meta-tags for contact page (/contact) from DB 
    $result_meta_tags = get_meta_tags_query ('/contact');
    //Query contact info from DB
    $result_contact = get_contact_info ();
?>
    <article class="admin_page">
        <h1>Контакти</h1>
        <!-- Form for change meta-tags -->
        <?php require_once ('/admin/admin_meta_form.php');?>
        <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
            <table>
                <tr>
                    <td><label for="contact_text">Контакти: </label></td>
                    <td><textarea name="contact_text" cols="103" rows="10"><?= $result_contact[0]; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit" name="contact">Зберегти</button></td>
                </tr>
            </table>
        </form>
    </article>
</body>
</html>