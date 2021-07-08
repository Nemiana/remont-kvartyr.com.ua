<?php
    require_once ('/query/queries.php');
    //Query meta-tags and price list from DB
    $result_meta_tags = get_meta_tags_query ('/price-list');
    $price_list = get_price_list ();
    require_once ('/view/view_header.php');
?>
<article class="price-list">
    <h1><?= $translate['price_list'] ?></h1>
    <!-- Services and its costs in table -->
    <table>
        <tr>
            <th><?= $translate['service'] ?></th>
            <th><?= $translate['cost_grn'] ?></th>
        </tr>
        <?php
            if ($price_list) {
                foreach($price_list as $value) {
                    //Service collection with switch language
                    if ($_COOKIE['lang'] == 'rus') {
                        echo "<tr><td>{$value[2]}</td><td>{$value[4]}</td></tr>"; 
                    } else if ($_COOKIE['lang'] == 'eng') {
                        echo "<tr><td>{$value[3]}</td><td>{$value[4]}</td></tr>";
                    } else {
                        echo "<tr><td>{$value[1]}</td><td>{$value[4]}</td></tr>";
                    }
                };
            }
        ?>
    </table>
</article>
<?php
    require_once ('/view/view_footer.php');