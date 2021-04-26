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
            set_meta_tags_query ('/price-list', $_POST['meta_title'], $_POST['meta_keywords'], $_POST['meta_description']);
            reload ();
        //If import button was pressed, import file
        } elseif (isset($_POST['import'])) {
            import_file_price ('file_price');
            reload ();
        //If submit button was pressed in the modal window of addition
        } elseif (isset($_POST['add'])) {
            //Adds new record to DB
            add_service_price ($_POST['new_service'], $_POST['new_price']);
            reload ();
        }
    };
    //Query meta-tags for price page (/price-list) from DB 
    $result_meta_tags = get_meta_tags_query ('/price-list');
    //Query FULL! price-list
    $price_list = get_price_list (TRUE);
?>
    <article class="admin_page">
        <h1>Прайс-лист</h1>
        <!-- Form for change meta-tags -->
        <?php require_once ('/admin/admin_meta_form.php');?>
        <!-- Form for import .csv file with price-list -->
        <form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><label for="file_price">Імпорт прайс-листа (в форматі .csv): </label></td>
                    <td><input type="file" name="file_price"></td>
                    <td><button type="submit" name="import">Завантажити</button></td>
                </tr>
            </table>
        </form>
        <!-- Export price-list form DB  -->
        <table class="export">
            <tr>
                <td><label for="export">Експорт прайс-листа (в форматі .csv): </label></td>
                <td><button name="export"><a href="/admin/export_price.php">Завантажити</a></button></td>
            </tr>
        </table>
        <!-- Editable table of price-list -->
        <div class="price-list">
            <table>
                <tr>
                    <th>Послуга</th>
                    <th>Вартість (грн.)</th>
                    <th colspan="2">Дія</th>
                </tr>
                <?php
                //If price-list is not empty
                if ($price_list) {
                    //Outputs id (hidden), service and price in table in cycle
                    //and clickable images 'save' and 'delete' for every record
                    foreach($price_list as $value) {
                        echo "<tr>
                                <input type='hidden' class='id_price_list' value='{$value[0]}'>
                                <td><input type='text' class='service' value='{$value[1]}'></td>
                                <td><input type='text' class='price' value='{$value[2]}'></td>
                                <td><input type='image' src='/images/save_icon.png' data-action='save' alt='save' title='Зберегти'></td>
                                <td><input type='image' src='/images/del_icon.png' data-action='delete' alt='delete' title='Видалити'></td>
                            </tr>";
                    };
                }
                ?>
                <!-- In the last row of table outputs clickable images for actions 'add', 'save all', 'delete all' -->
                <tr>
                    <td class="multi-action" colspan="4">
                        <input type="image" src="/images/add_icon.png" data-action="add" alt="add" title="Додати">
                        <input type="image" src="/images/save_all_icon.png" data-action="save_all" alt="save all" title="Зберегти все">
                        <input type="image" src="/images/del_all_icon.png" data-action="delete_all" alt="delete all" title="Видалити все">
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
                            <th colspan="2">Додати нову послугу</th>
                        </tr>
                        <tr>
                            <td><label for="new_service">Послуга: </label></td>
                            <td><input type="text" name="new_service" required></td>
                        </tr>
                        <tr>
                            <td><label for="new_price">Вартість (грн.): </label></td>
                            <td><input type="text" name="new_price" required></td>
                        </tr>
                        <tr>
                            <td><button type="submit" name="add">Зберегти</button></td>
                            <td><button type="button" class="close">Відмінити</button></td>
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