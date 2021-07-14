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
            //Set meta-tags for review page (/review) from form fields
            set_meta_tags_query ('/review', $_POST);
            reload();
        }
    };
    //Query meta-tags for review page (/review) from DB 
    $result_meta_tags = get_meta_tags_query ('/review');    
?>
    <article class="admin_page">
        <h1><?= $translate['main_menu_review'] ?></h1>
        <!-- Form for change meta-tags -->
        <?php require_once ('/admin/admin_meta_form.php');?>
        <!-- Adding new review (id = 0) -->
        <table class="add_record">
            <tr>
                <td><a href='/admin/edit_review.php?id=0'><?= $translate['add_new_review'] ?></a></td>
            </tr>
        </table>
        <!-- Selection amount reviews per page -->
        <table>
            <tr>
                <td><label for="amount_reviews_admin"><?= $translate['amount_reviews_per_page'] ?></td>
                <td>
                    <select class="amount_reviews_admin" name="amount_reviews_admin">
                        <!-- Default value, allows you to select the first value 3 -->
                        <option selected hidden><?= $translate['choose'] ?></option>
                        <!-- Checks cookie with the same name as class select to set 'selected' to option -->
                        <option value="3" <?php if ($_COOKIE['amount_reviews_admin'] == '3') echo 'selected'; ?>>3</option>
                        <option value="5" <?php if ($_COOKIE['amount_reviews_admin'] == '5') echo 'selected'; ?>>5</option>
                        <option value="10" <?php if ($_COOKIE['amount_reviews_admin'] == '10') echo 'selected'; ?>>10</option>
                        <option value="15" <?php if ($_COOKIE['amount_reviews_admin'] == '15') echo 'selected'; ?>>15</option>
                        <option value="20" <?php if ($_COOKIE['amount_reviews_admin'] == '20') echo 'selected'; ?>>20</option>
                        <option value="50" <?php if ($_COOKIE['amount_reviews_admin'] == '50') echo 'selected'; ?>>50</option>
                    </select>
                </td>
            </tr>
        </table>
        <!-- Editable table of reviews -->
        <div class="review">
            <table>
                <!-- Table header -->
                <tr>
                    <th><?= $translate['text_review'] ?></th>
                    <th><?= $translate['name_user'] ?></th>
                    <th><?= $translate['date_creation_review'] ?></th>
                    <th><?= $translate['show'] ?></th>
                    <th><?= $translate['edit'] ?></th>
                    <th><?= $translate['delete'] ?></th>
                </tr>
                <?php
                    //Check cookie for chosen amount or default value 3
                    if (isset ($_COOKIE['amount_reviews_admin'])) {
                        $elements_per_page = $_COOKIE['amount_reviews_admin'];
                    } else {
                        $elements_per_page = 3;
                    }
                    //Table for work from DB
                    $table_name = 'review_page';
                    //Set pagination parameters and return actual collection
                    $reviews = set_pagination_parameteres($table_name, $elements_per_page, 1);
                    //Collection may be empty
                    if ($reviews) {
                        //For JS reveal and collapse long text
                        $index = 0;
                        //Output short reviews
                        foreach ($reviews as $item) {
                            if (isset($item)) { 
                                //Formatting date without time
                                $date = date_format(date_create($item['date_publication_review']), 'd.m.Y');
                ?>
                <!-- Block review -->
                <tr>
                    <!-- data-index - for JS -->
                    <td class='review_text' data-index=<?= $index ?>><?= $item['text_review'] ?></td>
                    <td><?= $item['name_user'] ?></td>
                    <td class='review_date'><?= $date ?></td>
                    <td><?= ($item['check_publication']) ? "{$translate['answer_yes']}" : "{$translate['answer_no']}" ?></td>
                    <td>
                        <!-- Edit icon -->
                        <a href="/admin/edit_review.php?id=<?= $item['id'] ?>">
                            <img src="/images/edit_icon.png" alt="edit" title="<?= $translate['edit'] ?>">
                        </a>
                    </td>
                    <td>
                        <!-- Delete icon -->
                        <input type="image" src="/images/del_icon.png" class="delete_review" 
                        data-id_review="<?= $item['id'] ?>" alt="delete" title="<?= $translate['delete'] ?>">
                    </td>
                </tr>
                <?php
                                $index++;
                            }
                        }
                    }
                ?>
            </table>
            <?php
                //Output markup pagination (parameter - base path)
                pagination ('/admin/admin_review.php/page');
            ?>
        </div>
    </article>
    <!-- Choses amount records per page for pagination -->
    <script src="/js/amount_per_page.js"></script>
    <script>
        //Save to cookie chosen amount
        amount_per_page ('amount_reviews_admin', '/admin/admin_review.php');
    </script>
    <!-- Buttons for deploy and roll up of long reviews -->
    <script src="/js/reveal_collapse_text.js"></script>
    <script>
        //Length of short review
        let lengthReview = 350;
        //Collection of all reviews
        let reviewText = document.querySelectorAll('.review_text');
        //function from JS
        reveal_collapse_text(lengthReview, reviewText);
    </script>
    <!-- Deleting record by click -->
    <script src="/admin/js/delete_review.js"></script>
</body>
</html>