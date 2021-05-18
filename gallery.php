<?php
    require_once ('/view/view_header.php');
    require_once ('/view/pagination.php');
    //Setting parameters pagination (all collection and elements per page (multiple 3)) and return collection for current page
    $elements_per_page = 6;
    $table_name = 'gallery_page';
    $gallery_objects = set_pagination_parameteres($table_name, $elements_per_page);
?>
<article class="gallery_article">
    <?php
        echo '<table class="gallery_table">';
        $i = 0;
        //Output all elements on page
        while ($i < $elements_per_page) {
            echo '<tr>';
            //three in a row
            for ($j = 0; $j < 3; $j++, $i++) {
                if (isset($gallery_objects[$i])) {
                    //Image + caption is a link to single page
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