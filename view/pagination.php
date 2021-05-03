<?php
    require_once ('/query/queries.php');
    $current_page;
    $max_page;
    //Setting parameters pagination (table name and elements per page)
    function set_pagination_parameteres ($table_name, $elements_per_page = 3, $visible = 0) {
        global $current_page, $max_page;
        //Amount of all elements
        $amount_elements = count_records ($table_name, $visible);
        //Last page
        $max_page = ceil((int)$amount_elements / $elements_per_page);
        //If GET-parameter transferred
        if (isset($_GET['page'])) {
            //Minimum page 1
            if ($_GET['page'] < 1) {
                $current_page = 1;
            //Maximum page - the last
            } elseif ($_GET['page'] > $max_page) {
                $current_page = $max_page;
            } else {
                $current_page = $_GET['page'];
            }
        //If GET-parameter not transferred (*.php) current page 1
        } else {
            $current_page = 1;
        }
        //First element in table
        $start = ($current_page - 1) * $elements_per_page;
        //Amount received elements
        $amount = $elements_per_page;
        //Collection elements for current page
        if ($table_name == 'article_page') {
            $collection = get_article_records ($table_name, $start, $amount);
        } else if ($table_name == 'review_page') {
            $collection = get_review_records ($table_name, $start, $amount, $visible);
        }
        return $collection;
    }
    //Output markup pagination with base path
    function pagination ($base_path) { 
        global $current_page, $max_page; 
        ?>
        <div class="pagination">        
            <!-- Movement to the start. Blocked when current page 1 -->
            <?php if ($current_page == 1) : ?>
            &lt;&lt;
            <?php else : ?>
            <a href="<?= $base_path ?>1">&lt;&lt;</a>
            <?php endif;
            // Movement 1 page back. Blocked when current page 1
            if ($current_page == 1) : ?>
            &lt;
            <?php else : ?>
            <a href="<?= $base_path . ($current_page - 1) ?>">&lt;</a>
            <?php endif;
            //If current page 2, show only one page before current - 1
            if ($current_page == 2) : ?>
            <a href="<?= $base_path ?>1">1</a>
            <!-- Else show two previous pages -->
            <?php elseif ($current_page > 2) : ?>
            <a href="<?= $base_path . ($current_page - 2) ?>"><?= $current_page - 2 ?></a>
            <a href="<?= $base_path . ($current_page - 1) ?>"><?= $current_page - 1 ?></a>
            <?php endif; ?>
            <!-- Current page without link -->
            <a><b><?= $current_page ?></b></a>
            <!-- If current page penult, show only one page to move forward -->
            <?php if ($current_page == $max_page - 1) : ?>
            <a href="<?= $base_path . $max_page ?>"><?= $max_page ?></a>
            <!-- Else show two next pages -->
            <?php elseif ($current_page < $max_page - 1) : ?>
            <a href="<?= $base_path . ($current_page + 1) ?>"><?= $current_page + 1 ?></a>
            <a href="<?= $base_path . ($current_page + 2) ?>"><?= $current_page + 2 ?></a>
            <?php endif;
            //If current page the last, block movement forward
            if ($current_page == $max_page) : ?>
            &gt;
            <!-- Else movement one page forward -->
            <?php else : ?>
            <a href="<?= $base_path . ($current_page + 1) ?>">&gt;</a>
            <?php endif;
            //If current page the last, block movement to the end
            if ($current_page == $max_page) : ?>
            &gt;&gt;
            <!-- Else movement to the end -->
            <?php else : ?>
            <a href="<?= $base_path . $max_page ?>">&gt;&gt;</a>
            <?php endif; ?>
        </div>
<?php }