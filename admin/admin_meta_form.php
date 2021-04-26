 <!-- Form for change meta-tags -->
<form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>">
    <table>
        <tr>
            <td><label for="meta_title">Meta title: </label></td>
            <td><input type="text" name="meta_title" size="100" value="<?= $result_meta_tags[0]; ?>"></td>
        </tr>
        <tr>
            <td><label for="meta_keywords">Meta keywords: </label></td>
            <td><input type="text" name="meta_keywords" size="100" value="<?= $result_meta_tags[1]; ?>"></td>
        </tr>
        <tr>
            <td><label for="meta_description">Meta description: </label></td>
            <td><input type="text" name="meta_description" size="100" value="<?= $result_meta_tags[2]; ?>"></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit" name="meta_tags">Зберегти</button></td>
        </tr>
    </table>    
</form>