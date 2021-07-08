<?php
    //View single gallery object for edit or addition
    require_once ('/admin/admin_header.php');
    require_once ('/query/queries.php'); 
    //Shows action message if it exists one time
    show_info_message ();
    //Get id gallery object from GET-parameter
    $id_gallery = $_GET['id'];
    //Get gallery object form DB by id
    $gallery_object = get_gallery ($id_gallery);
    //Get all images of object gallery
    $gallery_images = get_gallery_images ($id_gallery);
    //If id = 0 - addition gallery object, else edit and save gallery object (title page and name submit button)
    $title_page = $id_gallery > 0 ? 'Редагування об\'єкта галереї' : 'Додавання об\'єкта галереї';
    $submit_name = $id_gallery > 0 ? 'save_gallery' : 'add_gallery';
    //Current path to reload page
    $path = '/admin/admin_gallery.php';
    //If any button was pressed
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //If save button was pressed
        if (isset ($_POST['save_gallery'])) {
            save_gallery ($_POST);
            reload ($path);
        //If addition button was pressed
        } elseif (isset ($_POST['add_gallery'])) {
            add_gallery ($_POST);
            reload ($path);
        }
    };
?>
    <article class="admin_page">
        <h1><?= $title_page ?></h1>
        <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <!-- Editable table for gallery object and images -->
            <table class="edit_gallery">
                <tr>
                    <!-- id gallery object -->
                    <td><input type="hidden" name="id_gallery_object" value="<?= $gallery_object['id']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="object_start_image">Стартове зображення: </label></td>
                    <!-- Input for chosen image file -->
                    <td><input type="file" name="object_start_image"></td>
                    <td><img src="/gallery_images/<?= $gallery_object['object_start_image']; ?>" class="object_start_image"></td>
                    <!-- Delete icon for image -->
                    <td><input type="image" src="/images/del_all_icon.png" data-id_gallery="<?= $gallery_object['id']; ?>"
                        class="delete_start_image" alt="delete" title="Видалити"></td>
                </tr>
                <tr>
                    <td><label for="object_name">Назва об'єкта: </label></td>
                    <td colspan="3"><input type="text" name="object_name" size="80" value="<?= $gallery_object['object_name']; ?>"></td>
                </tr>
            </table>
                <?php
                    //Collection of images in separate tables for comfort deleting
                    if ($gallery_images) {
                        foreach ($gallery_images as $item) {
                            if (isset($item)) {
                ?>
            <table class="edit_gallery">
                <tr>
                    <!-- id gallery image -->
                    <td><input type="hidden" name="id_gallery_image[]" value="<?= $item['id']; ?>"></td>
                </tr>
                <tr>
                    <td><label for="object_image"><?= $translate['photo_image'] ?>: </label></td>
                    <!-- Input for chosen image file -->
                    <td><input type="file" name="object_image[]"></td>
                    <td><img src="/gallery_images/<?= $item['object_image']; ?>" class="object_image"></td>
                    <!-- Delete icon for image -->
                    <td rowspan="2"><input type="image" src="/images/del_all_icon.png" data-id_image="<?= $item['id']; ?>"
                        class="delete_image" alt="delete" title="Видалити"></td>
                </tr>
                <tr>
                    <td><label for="image_description"><?= $translate['description'] ?>: </label></td>
                    <td colspan="2"><input type="text" name="image_description[]" size="95" value="<?= $item['image_description']; ?>"></td>
                </tr>
            </table>
                <?php
                        }
                    }
                }
                ?>
            <!-- Block with buttons for adding new image and save all changes -->
            <table class="edit_gallery">
                <tr>
                    <td><button type="button" class="add_image">Додати фото</button></td>
                    <td><button type="submit" name="<?= $submit_name; ?>">Зберегти</button></td>
                </tr>
            </table>
        </form>
    </article>
    <!-- Script for deleting only start image -->
    <script src="/admin/js/delete_start_image.js"></script>
    <!-- Script for deleting whole image (not start) with caption -->
    <script src="/admin/js/delete_object_image.js"></script>
    <!-- Script for adding block of code for uploading new image and caption -->
    <script src="/admin/js/add_gallery_image.js"></script>