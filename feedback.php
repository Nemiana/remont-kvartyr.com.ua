<?php
    require_once ('/view/view_header.php');
    require_once ('/query/queries.php');
?>
<article class="review">
    <?php
        //If was request POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Parse captcha config file
        $captcha = parse_ini_file ('/config/captcha.php');
        //If sended value equal captcha value from file
        if ($_POST['captcha'] == $captcha [$_POST['image']]) {
            //Adds invisible new review to DB for post-moderation
            add_review ([
                'text_review' => $_POST['text_review'], 
                'name_user' => $_POST['name_user'],
                'date_publication_review' => date('Y-m-d'),
                'check_publication' => 0
                ]);
    ?>
        <!-- Success message -->
        <p style="text-align: center; font-weight: bold"><?= $translate['message_success_feedback'] ?></p>
    <?php
        } else {
    ?>
            <!-- If captcha was incorrect, shows warning message and form for adding review -->
            <p style="color: red; text-align: center;"><?= $translate['message_fail_feedback'] ?></p>
            <!-- Form for feedback with remembering fields -->
            <form class="feedback" method="POST" action="/feedback">
                <table>
                    <tr>
                        <th colspan="3"><?= $translate['leave_feedback'] ?></th>
                    </tr>
                    <tr>
                        <td><label for="name_user"><?= $translate['name_user'] ?></label></td>
                        <td colspan="2"><input type="text" name="name_user" value="<?= $_POST['name_user'] ?>" required></td>
                    </tr>
                    <tr>
                        <td><label for="text_review"><?= $translate['text'] ?></label></td>
                        <td colspan="2"><textarea name="text_review" cols="70" rows="10" required><?= $_POST['text_review'] ?></textarea></td>
                    </tr>
                    <tr>
                        <?php
                            //Show new random captcha
                            $current_image = array_keys ($captcha) [rand (0, count($captcha) - 1)];
                        ?>
                        <td>
                            <img src="/captcha/<?= $current_image ?>.png" class="img_captcha">
                            <input type="hidden" name="image" class="name_captcha" value="<?= $current_image ?>">
                        </td>
                        <td style="width: 50px;">
                            <!-- Field for input captcha -->
                            <input type="text" name="captcha" size="3" required>
                        </td>
                        <td>
                            <!-- Update captcha button -->
                            <input type="image" src="/images/upd_icon.png" class="update_captcha" alt="update" title="Оновити">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><button type="submit"><?= $translate['submit'] ?></button></td>
                    </tr>
                </table>
            </form>
            <!---->
    <?php
        }
    }
    ?>
</article>
<!-- Update captcha by click -->
<script src="/js/update_captcha.js"></script>
<?php
    require_once ('/view/view_footer.php');