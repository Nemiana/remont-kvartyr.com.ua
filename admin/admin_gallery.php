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
            //Set meta-tags for gallery page (/gallery) from form fields
            set_meta_tags_query ('/gallery', $_POST);
            reload();
        }
    };
    //Query meta-tags for gallery page (/gallery) from DB 
    $result_meta_tags = get_meta_tags_query ('/gallery');   
?>
    <article class="admin_page">
        <h1><?= $translate['main_menu_gallery'] ?></h1>
        <!-- Form for change meta-tags -->
        <?php require_once ('/admin/admin_meta_form.php');?>
        <!-- Adding new gallery object (id = 0) -->
        <table class="add_record">
            <tr>
                <td><a href='/admin/edit_gallery.php?id=0'><?= $translate['add_new_object'] ?></a></td>
            </tr>
        </table>
        <!-- Selection amount gallery objects per page -->
        <table>
            <tr>
                <td><label for="amount_gallery_admin"><?= $translate['amount_objects_per_page'] ?></td>
                <td>
                    <select class="amount_gallery_admin" name="amount_gallery_admin">
                        <!-- Default value, allows you to select the first value 3 -->
                        <option selected hidden><?= $translate['choose'] ?></option>
                        <!-- Checks cookie with the same name as class select to set 'selected' to option -->
                        <option value="3" <?php if ($_COOKIE['amount_gallery_admin'] == '3') echo 'selected'; ?>>3</option>
                        <option value="5" <?php if ($_COOKIE['amount_gallery_admin'] == '5') echo 'selected'; ?>>5</option>
                        <option value="10" <?php if ($_COOKIE['amount_gallery_admin'] == '10') echo 'selected'; ?>>10</option>
                        <option value="15" <?php if ($_COOKIE['amount_gallery_admin'] == '15') echo 'selected'; ?>>15</option>
                        <option value="20" <?php if ($_COOKIE['amount_gallery_admin'] == '20') echo 'selected'; ?>>20</option>
                        <option value="50" <?php if ($_COOKIE['amount_gallery_admin'] == '50') echo 'selected'; ?>>50</option>
                    </select>
                </td>
            </tr>
        </table>
        <!-- Editable table of gallery objects -->
        <div class="gallery_objects">
            <table>
                <?php
                    //Check cookie for chosen amount or default value 3
                    if (isset ($_COOKIE['amount_gallery_admin'])) {
                        $elements_per_page = $_COOKIE['amount_gallery_admin'];
                    } else {
                        $elements_per_page = 3;
                    }
                    //Table for work from DB
                    $table_name = 'gallery_page';
                    //Set pagination parameters and return actual collection
                    $gallery = set_pagination_parameteres($table_name, $elements_per_page);
                    //Collection may be empty
                    if ($gallery) {
                        foreach ($gallery as $item) {
                            if (isset($item)) {
                ?>
                <tr>
                    <td>
                        <!-- Block of gallery object -->
                        <a href="/admin/edit_gallery.php?id=<?= $item['id'] ?>">
                            <div class='gallery'>
                                <img src='/gallery_images/<?= $item['object_start_image'] ?>'>
                                <div class="gallery_caption"><?= $item['object_name'] ?></div>
                            </div>
                        </a>
                    </td>
                    <td>
                        <!-- Edit icon -->
                        <a href="/admin/edit_gallery.php?id=<?= $item['id'] ?>">
                            <img src="/images/edit_icon.png" alt="edit" title="<?= $translate['edit'] ?>">
                        </a>
                    </td>
                    <td>
                        <!-- Delete icon -->
                        <input type="image" src="/images/del_icon.png" class="delete_gallery" 
                        data-id_gallery="<?= $item['id'] ?>" alt="delete" title="<?= $translate['delete'] ?>">
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
                pagination ('/admin/admin_gallery.php/page');
            ?>
        </div>
    </article>
    <script src="/js/amount_per_page.js"></script>
    <script>
        //Save to cookie chosen amount
        amount_per_page ('amount_gallery_admin', '/admin/admin_gallery.php');
    </script>
    <script src="/admin/js/delete_gallery.js"></script>
</body>
</html>