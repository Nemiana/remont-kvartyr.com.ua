<?php 
    require_once ('/view/view_header.php');
    require_once ('/query/queries.php');
?>
<article class="review">
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $captcha = parse_ini_file ('/config/captcha.php');
        if ($_POST['captcha'] == $captcha [$_POST['image']]) {
            add_review ([
                'text_review' => $_POST['text_review'], 
                'name_user' => $_POST['name_user'],
                'date_publication_review' => date('Y-m-d'),
                'check_publication' => 0
                ]);
    ?>
        <p style="text-align: center; font-weight: bold">Ваш відгук відправлено на модерацію. Повернутися до <a href="/review">списку відгуків</a>?</p>
    <?php
        } else {
    ?>
            <p style="color: red; text-align: center;">Неправильно заповнена капча! Спробуйте ще раз.</p>
            <!-- Form for feedback -->
            <form class="feedback" method="POST" action="/feedback">
                <table>
                    <tr>
                        <th colspan="3">Залиште свій відгук</th>
                    </tr>
                    <tr>
                        <td><label for="name_user">Ім'я</label></td>
                        <td colspan="2"><input type="text" name="name_user" value="<?= $_POST['name_user'] ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="text_review">Текст</label></td>
                        <td colspan="2"><textarea name="text_review" cols="70" rows="10" required><?= $_POST['text_review'] ?></textarea></td>
                    </tr>
                    <tr>
                        <?php
                            $current_image = array_keys ($captcha) [rand (0, count($captcha) - 1)];
                        ?>
                        <td>
                            <img src="/captcha/<?= $current_image ?>.png" class="img_captcha">
                            <input type="hidden" name="image" class="name_captcha" value="<?= $current_image ?>">
                        </td>
                        <td style="width: 50px;">
                            <input type="text" name="captcha" size="3" required>
                        </td>
                        <td>
                            <input type="image" src="/images/upd_icon.png" class="update_captcha" alt="update" title="Оновити">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><button type="submit">Відправити</button></td>
                    </tr>
                </table>
            </form>
            <!---->
    <?php
        }
    }
    ?>
</article>
<script src="/js/update_captcha.js"></script>
<?php
    require_once ('/view/view_footer.php');