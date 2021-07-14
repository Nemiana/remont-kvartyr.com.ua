<?php
    //View single review for edit or addition
    require_once ('/admin/admin_header.php');
    require_once ('/query/queries.php'); 
    //Shows action message if it exists one time
    show_info_message ();
    //Get id review from GET-parameter
    $id_review = $_GET['id'];
    //Get review form DB by id
    $review = get_review ($id_review);
    //If id = 0 - addition review, else edit and save review (title page and name submit button)
    $title_page = $id_review > 0 ? $translate['edit_review'] : $translate['add_review'];
    $submit_name = $id_review > 0 ? 'save_review' : 'add_review';
    //Current path to reload page
    $path = '/admin/admin_review.php';
    //If any button was pressed
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //If save button was pressed
        if (isset ($_POST['save_review'])) {
            save_review ($_POST);
            reload ($path);
        //If addition button was pressed
        } elseif (isset ($_POST['add_review'])) {
            add_review ($_POST);
            reload ($path);
        }
    };
?>
    <article class="admin_page">
        <h1><?= $title_page ?></h1>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <!-- Editable table for review -->
            <table>
                <tr>
                    <!-- id review -->
                    <td><input type="hidden" name="id_review" value="<?= $review['id']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="name_user"><?= $translate['name_user'] ?>: </label></td>
                    <td colspan="2"><input type="text" name="name_user" size="100" value="<?= $review['name_user']; ?>" required></td>
                </tr>
                <tr>
                    <td><label for="text_review"><?= $translate['text_review'] ?>: </label></td>
                    <td colspan="2"><textarea name="text_review" cols="103" rows="10" required><?= $review['text_review']; ?></textarea></td>
                </tr>
                <tr>
                    <!-- Date creation without time -->
                    <td><label for="date_publication_review"><?= $translate['date_creation_review'] ?>: </label></td>
                    <td><input type="date" name="date_publication_review" value="<?= date_format(date_create($review['date_publication_review']), 'Y-m-d'); ?>"></td>
                </tr>
                <tr>
                    <!-- Checkbox for visible/unvisible review -->
                    <td><label for="check_publication"><?= $translate['show'] ?>: </label></td>
                    <td><input type="checkbox" name="check_publication" value="1" <?= ($review['check_publication']) ? 'checked' : '' ?>></td>
                </tr>
                <tr>
                    <td><button type="submit" name="<?= $submit_name; ?>"><?= $translate['save'] ?></button></td>
                </tr>
            </table>
        </form>
    </article>