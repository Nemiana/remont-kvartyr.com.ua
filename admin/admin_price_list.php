<?php
    require_once ('/admin/admin_header.php');
    require_once ('/query/queries.php');
    //Shows action message if it exists one time
    show_info_message ();
    //If any button was pressed
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //If first button was pressed
        if (isset($_POST['meta_tags'])) {
            //Set meta-tags for price page (/price-list) from form fields
            set_meta_tags_query ('/price-list', $_POST);
            reload ();
        //If import button was pressed, import file
        } elseif (isset($_POST['import'])) {
            import_file_price ('file_price');
            reload ();
        //If submit button was pressed in the modal window of addition
        } elseif (isset($_POST['add'])) {
            //Adds new record to DB
            add_service_price ($_POST);
            reload ();
        }
    };
    //Query meta-tags for price page (/price-list) from DB 
    $result_meta_tags = get_meta_tags_query ('/price-list');
    //Query price-list
    $price_list = get_price_list ();
?>
    <article class="admin_page">
        <h1><?= $translate['main_menu_price'] ?></h1>
        <!-- Form for change meta-tags -->
        <?php require_once ('/admin/admin_meta_form.php');?>
        <!-- Form for import .csv file with price-list -->
        <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="file_price"><?= $translate['import_price_list'] ?></label></td>
                    <td><input type="file" name="file_price"></td>
                    <td><button type="submit" name="import"><?= $translate['upload'] ?></button></td>
                </tr>
            </table>
        </form>
        <!-- Export price-list form DB  -->
        <table class="export">
            <tr>
                <td><label for="export"><?= $translate['export_price_list'] ?></label></td>
                <td><button name="export"><a href="/admin/export_price.php"><?= $translate['upload'] ?></a></button></td>
            </tr>
        </table>
        <!-- Editable table of price-list -->
        <div class="price-list">
            <table>
                <tr>
                    <th><?= $translate['service_ukr'] ?></th>
                    <th><?= $translate['service_rus'] ?></th>
                    <th><?= $translate['service_eng'] ?></th>
                    <th><?= $translate['cost_grn'] ?></th>
                    <th colspan="2"><?= $translate['action'] ?></th>
                </tr>
                <?php
                //If price-list is not empty
                if ($price_list) {
                    //Outputs id (hidden), service and price in table in cycle
                    //and clickable images 'save' and 'delete' for every record
                    foreach($price_list as $value) {
                        echo "<tr>
                                <input type='hidden' class='id_price_list' value='{$value[0]}'>
                                <td><input type='text' class='service_ukr' value='{$value[1]}'></td>
                                <td><input type='text' class='service_rus' value='{$value[2]}'></td>
                                <td><input type='text' class='service_eng' value='{$value[3]}'></td>
                                <td><input type='text' class='price' value='{$value[4]}'></td>
                                <td><input type='image' src='/images/save_icon.png' data-action='save' alt='save' title='{$translate['save']}'></td>
                                <td><input type='image' src='/images/del_icon.png' data-action='delete' alt='delete' title='{$translate['delete']}'></td>
                            </tr>";
                    };
                }
                ?>
                <!-- In the last row of table outputs clickable images for actions 'add', 'save all', 'delete all' -->
                <tr>
                    <td class="multi-action" colspan="4">
                        <input type="image" src="/images/add_icon.png" data-action="add" alt="add" title="<?= $translate['add'] ?>">
                        <input type="image" src="/images/save_all_icon.png" data-action="save_all" alt="save all" title="<?= $translate['save_all'] ?>">
                        <input type="image" src="/images/del_all_icon.png" data-action="delete_all" alt="delete all" title="<?= $translate['delete_all'] ?>">
                    </td>
                </tr>
            </table>
        </div>
        <!-- The overlay for modal window -->
        <div class="overlay">
            <!-- Modal window with form for addition new record -->
            <div class="window_add">
                <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
                    <table>
                        <tr>
                            <th colspan="2"><?= $translate['add_new_service'] ?></th>
                        </tr>
                        <tr>
                            <td><label for="new_service_ukr"><?= $translate['service_ukr'] ?>: </label></td>
                            <td><input type="text" name="new_service_ukr" required></td>
                        </tr>
                        <tr>
                            <td><label for="new_service_rus"><?= $translate['service_rus'] ?>: </label></td>
                            <td><input type="text" name="new_service_rus" required></td>
                        </tr>
                        <tr>
                            <td><label for="new_service_eng"><?= $translate['service_eng'] ?>: </label></td>
                            <td><input type="text" name="new_service_eng" required></td>
                        </tr>
                        <tr>
                            <td><label for="new_price"><?= $translate['cost_grn'] ?>: </label></td>
                            <td><input type="text" name="new_price" required></td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="add"><?= $translate['save'] ?></button></td>
                            <td><button type="button" class="close"><?= $translate['cancel'] ?></button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        
    </article>
    <!-- Script for processing actions in table -->
    <script src="/admin/js/edit_price_list.js"></script>
</body>
</html>