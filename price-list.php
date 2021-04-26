<?php
    require_once ('/query/queries.php');
    //Query meta-tags and SHORT! price list from DB
    $result_meta_tags = get_meta_tags_query ('/price-list');
    $price_list = get_price_list (FALSE);
    require_once ('/view/view_header.php');
?>
<article class="price-list">
    <h1>Прайс-лист</h1>
    <table>
        <tr>
            <th>Послуга</th>
            <th>Вартість (грн.)</th>
        </tr>
        <?php
            if ($price_list) {
                foreach($price_list as $value) {
                    echo "<tr><td>{$value[0]}</td><td>{$value[1]}</td></tr>";
                };
            }
        ?>
    </table>
</article>
<?php
    require_once ('/view/view_footer.php');