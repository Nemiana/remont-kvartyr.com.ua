 <!-- Form for change meta-tags in three languages -->
<form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
    <table>
        <tr>
            <td colspan="2" class="contact_lang">Ukr</td>
        </tr>
        <tr>
            <td><label for="meta_title_ukr"><?= $translate['meta_title'] ?>: </label></td>
            <td><input type="text" name="meta_title_ukr" size="100" value="<?= $result_meta_tags[2]; ?>"></td>
        </tr>
        <tr>
            <td><label for="meta_keywords_ukr"><?= $translate['meta_keywords'] ?>: </label></td>
            <td><input type="text" name="meta_keywords_ukr" size="100" value="<?= $result_meta_tags[3]; ?>"></td>
        </tr>
        <tr>
            <td><label for="meta_description_ukr"><?= $translate['meta_description'] ?>: </label></td>
            <td><input type="text" name="meta_description_ukr" size="100" value="<?= $result_meta_tags[4]; ?>"></td>
        </tr>
        <tr>
            <td colspan="2" class="contact_lang">Rus</td>
        </tr>
        <tr>
            <td><label for="meta_title_rus"><?= $translate['meta_title'] ?>: </label></td>
            <td><input type="text" name="meta_title_rus" size="100" value="<?= $result_meta_tags[5]; ?>"></td>
        </tr>
        <tr>
            <td><label for="meta_keywords_rus"><?= $translate['meta_keywords'] ?>: </label></td>
            <td><input type="text" name="meta_keywords_rus" size="100" value="<?= $result_meta_tags[6]; ?>"></td>
        </tr>
        <tr>
            <td><label for="meta_description_rus"><?= $translate['meta_description'] ?>: </label></td>
            <td><input type="text" name="meta_description_rus" size="100" value="<?= $result_meta_tags[7]; ?>"></td>
        </tr>
        <tr>
            <td colspan="2" class="contact_lang">Eng</td>
        </tr>
        <tr>
            <td><label for="meta_title_eng"><?= $translate['meta_title'] ?>: </label></td>
            <td><input type="text" name="meta_title_eng" size="100" value="<?= $result_meta_tags[8]; ?>"></td>
        </tr>
        <tr>
            <td><label for="meta_keywords_eng"><?= $translate['meta_keywords'] ?>: </label></td>
            <td><input type="text" name="meta_keywords_eng" size="100" value="<?= $result_meta_tags[9]; ?>"></td>
        </tr>
        <tr>
            <td><label for="meta_description_eng"><?= $translate['meta_description'] ?>: </label></td>
            <td><input type="text" name="meta_description_eng" size="100" value="<?= $result_meta_tags[10]; ?>"></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit" name="meta_tags"><?= $translate['save'] ?></button></td>
        </tr>
    </table>    
</form>