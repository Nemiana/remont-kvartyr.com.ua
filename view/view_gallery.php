<!-- Views single gallery object -->
<?php
    require_once ('/view/view_header.php');
    require_once ('/query/queries.php');
    //
    $str_uri = $_SERVER['REQUEST_URI'];
    $id_gallery_object = substr($str_uri, strripos($str_uri, '-') + 1);
    $gallery_images = get_gallery_images ($id_gallery_object);
?>
<article class="gallery_article">
    <?php
        echo '<table class="gallery_table">';
        $i = 0;
        //Output all elements on page
        while ($i < count($gallery_images)) {
            echo '<tr>';
            //three in a row
            for ($j = 0; $j < 3; $j++, $i++) {
                if (isset($gallery_images[$i])) {
                    //Image + caption
                    echo "<td>
                            <div class='gallery'>
                                <img src='/gallery_images/{$gallery_images[$i]['object_image']}'>
                                <div class='gallery_caption'>{$gallery_images[$i]['image_description']}</div>
                            </div>
                        </td>";
                }
            }
            echo '</tr>';
        }
        echo '</table>';
    ?>
</article>
<?php
    require_once ('/view/view_footer.php');