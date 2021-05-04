<?php
    require_once ('/view/view_header.php');
    require_once ('/view/pagination.php');
?>
<article class="review">
    <!-- Selection amount reviews per page -->
    <div class="block_select">
        <table>
                <tr>
                    <td><label for="amount_reviews">Кількість відгуків на сторінці: </td>
                    <td>
                        <select class="amount_reviews" name="amount_reviews">
                            <!-- Default value, allows you to select the first value 3 -->
                            <option selected hidden>Вибрати</option>
                            <!-- Checks cookie with the same name as class select to set 'selected' to option -->
                            <option value="3" <?php if ($_COOKIE['amount_reviews'] == '3') echo 'selected'; ?>>3</option>
                            <option value="5" <?php if ($_COOKIE['amount_reviews'] == '5') echo 'selected'; ?>>5</option>
                            <option value="10" <?php if ($_COOKIE['amount_reviews'] == '10') echo 'selected'; ?>>10</option>
                            <option value="15" <?php if ($_COOKIE['amount_reviews'] == '15') echo 'selected'; ?>>15</option>
                            <option value="20" <?php if ($_COOKIE['amount_reviews'] == '20') echo 'selected'; ?>>20</option>
                            <option value="50" <?php if ($_COOKIE['amount_reviews'] == '50') echo 'selected'; ?>>50</option>
                        </select>
                    </td>
                </tr>
        </table>
    </div><hr>
    <?php
        //Check cookie for chosen amount or default value 3
        if (isset ($_COOKIE['amount_reviews'])) {
            $elements_per_page = $_COOKIE['amount_reviews'];
        } else {
            $elements_per_page = 3;
        }
        //Table for work from DB
        $table_name = 'review_page';
        //Set pagination parameters and return actual collection
        $reviews = set_pagination_parameteres($table_name, $elements_per_page, 0);
        //Collection may be empty
        if ($reviews) {
            //For JS reveal and collapse long text
            $index = 0;
            //Output short reviews
            foreach ($reviews as $item) {
                if (isset($item) && ($item['check_publication'])) {
                    //Formatting date without time
                    $date = date_format(date_create($item['date_publication_review']), 'd.m.Y');
                    //Block review
                    echo "<table>";
                    //data-index - for JS
                    echo "<tr><td colspan='2' class='review_text' data-index=$index>{$item['text_review']}</td></tr>";
                    echo "<tr><td>{$item['name_user']}</td><td class='review_date'>$date</td></tr>";
                    echo "</table><hr>";
                    $index++;
                }
            }
        }
        //Output markup pagination (parameter - base path)
        pagination ('/review/page');
    ?>
    <!-- Form for feedback -->
    <form class="feedback" method="POST" action="/feedback">
        <table>
            <tr>
                <th colspan="3">Залиште свій відгук</th>
            </tr>
            <tr>
                <td><label for="name_user">Ім'я</label></td>
                <td colspan="2"><input type="text" name="name_user" required></td>
            </tr>
            <tr>
                <td><label for="text_review">Текст</label></td>
                <td colspan="2"><textarea name="text_review" cols="70" rows="10" required></textarea></td>
            </tr>
            <tr>
                <?php
                    //Parse image names from config file
                    $captcha_images = parse_ini_file ('/config/captcha.php');
                    //Return random name
                    $current_image = array_keys ($captcha_images) [rand (0, count($captcha_images) - 1)];
                ?>
                <td>
                    <!-- Path to captcha image -->
                    <img src="/captcha/<?= $current_image ?>.png" class="img_captcha">
                    <!-- Image name to check result -->
                    <input type="hidden" name="image" class="name_captcha" value="<?= $current_image ?>">
                </td>
                <td style="width: 50px;">
                    <!-- Field for input captcha -->
                    <input type="text" name="captcha" class="captcha" size="3" required>
                </td>
                <td>
                    <!-- Updates captcha input -->
                    <input type="image" src="/images/upd_icon.png" class="update_captcha" alt="update" title="Оновити">
                </td>
            </tr>
            <tr>
                <td colspan="3"><button type="submit">Відправити</button></td>
            </tr>
        </table>
    </form>
    <!---->
</article>
<!-- Choses amount records per page for pagination -->
<script src="/js/amount_per_page.js"></script>
<script>
    //Save to cookie chosen amount
    amount_per_page ('amount_reviews', '/review');
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
<!-- Update captcha by click -->
<script src="/js/update_captcha.js"></script>
<?php
    require_once ('/view/view_footer.php');