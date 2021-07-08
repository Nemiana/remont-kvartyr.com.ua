<?php
    require_once ('/query/queries.php');
    //Query meta-tags for page
    $result_meta_tags = get_meta_tags_query ('/gallery');
    require_once ('/view/view_header.php');
    require_once ('/view/pagination.php');
    //Setting parameters pagination (table name and elements per page) and return collection for current page
    $elements_per_page = 6;
    $table_name = 'gallery_page';
    $gallery_objects = set_pagination_parameteres($table_name, $elements_per_page);
?>
<article class="gallery_article">
    <?php
        echo '<table class="gallery_table">';
        //Index for iterating all elements from collection
        $i = 0;
        while ($i < $elements_per_page) {
            echo '<tr>';
            //Output three in a row
            for ($j = 0; $j < 3; $j++, $i++) {
                //If record exists
                if (isset($gallery_objects[$i])) {
                    //Block with start image and objects name (is a link to individual page with object name and id)
                    echo "<td>
                            <a href='/gallery/{$gallery_objects[$i]['object_name']}-{$gallery_objects[$i]['id']}'>
                                <div class='gallery'>
                                    <img src='/gallery_images/{$gallery_objects[$i]['object_start_image']}'>
                                    <div class='gallery_caption'>{$gallery_objects[$i]['object_name']}</div>
                                </div>
                            </a>
                        </td>";
                }
            }
            echo '</tr>';
        }
        echo '</table>';
        //Output markup pagination (parameter - base path)
        pagination ('/gallery/page');
    ?>
</article>
<?php
    require_once ('/view/view_footer.php');