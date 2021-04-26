<?php
    $title = 'Ремонт квартир і будинків | Галерея';
    $description = 'Галерея ремонту квартир і будинків під ключ дешево і швидко';
    $keywords = 'Галерея ремонт квартир, галерея ремонт будинків';
    require_once ('/view/view_header.php');
    require_once ('/view/pagination.php');
    /////////////For test
    $all_gallery_objects = [
        ['object1', '/gallery_images/object1.jpg', '/gallery_images/object1.jpg', '/gallery_images/object1.jpg', '/gallery_images/object1.jpg', '/gallery_images/object1.jpg'],
        ['object2', '/gallery_images/object2.jpg', '/gallery_images/object2.jpg', '/gallery_images/object2.jpg', '/gallery_images/object2.jpg', '/gallery_images/object2.jpg'],
        ['object3', '/gallery_images/object3.jpg', '/gallery_images/object3.jpg', '/gallery_images/object3.jpg', '/gallery_images/object3.jpg', '/gallery_images/object3.jpg'],
        ['object4', '/gallery_images/object4.jpg', '/gallery_images/object4.jpg', '/gallery_images/object4.jpg', '/gallery_images/object4.jpg', '/gallery_images/object4.jpg'],
        ['object5', '/gallery_images/object5.jpg', '/gallery_images/object5.jpg', '/gallery_images/object5.jpg', '/gallery_images/object5.jpg', '/gallery_images/object5.jpg'],
        ['object6', '/gallery_images/object6.jpg', '/gallery_images/object6.jpg', '/gallery_images/object6.jpg', '/gallery_images/object6.jpg', '/gallery_images/object6.jpg'],
        ['object7', '/gallery_images/object7.jpg', '/gallery_images/object7.jpg', '/gallery_images/object7.jpg', '/gallery_images/object7.jpg', '/gallery_images/object7.jpg'],
        ['object8', '/gallery_images/object8.jpg', '/gallery_images/object8.jpg', '/gallery_images/object8.jpg', '/gallery_images/object8.jpg', '/gallery_images/object8.jpg'],
        ['object9', '/gallery_images/object9.jpg', '/gallery_images/object9.jpg', '/gallery_images/object9.jpg', '/gallery_images/object9.jpg', '/gallery_images/object9.jpg'],
        ['object10', '/gallery_images/object10.jpg', '/gallery_images/object10.jpg', '/gallery_images/object10.jpg', '/gallery_images/object10.jpg', '/gallery_images/object10.jpg'],
        ['object11', '/gallery_images/object11.jpg', '/gallery_images/object11.jpg', '/gallery_images/object11.jpg', '/gallery_images/object11.jpg', '/gallery_images/object11.jpg'],
        ['object12', '/gallery_images/object12.jpg', '/gallery_images/object12.jpg', '/gallery_images/object12.jpg', '/gallery_images/object12.jpg', '/gallery_images/object12.jpg'],
        ['object13', '/gallery_images/object13.jpg', '/gallery_images/object13.jpg', '/gallery_images/object13.jpg', '/gallery_images/object13.jpg', '/gallery_images/object13.jpg'],
        ['object14', '/gallery_images/object14.jpg', '/gallery_images/object14.jpg', '/gallery_images/object14.jpg', '/gallery_images/object14.jpg', '/gallery_images/object14.jpg'],
        ['object15', '/gallery_images/object15.jpg', '/gallery_images/object15.jpg', '/gallery_images/object15.jpg', '/gallery_images/object15.jpg', '/gallery_images/object15.jpg'],
    ];
    /////////////
    //Setting parameters pagination (all collection and elements per page (multiple 3)) and return collection for current page
    $elements_per_page = 6;
    $gallery_objects = set_pagination_parameteres($all_gallery_objects, $elements_per_page);
?>
<article>
    <?php
        echo '<table>';
        $i = 0;
        //Output all elements on page
        while ($i < $elements_per_page) {
            echo '<tr>';
            //three in a row
            for ($j = 0; $j < 3; $j++, $i++) {
                if (isset($gallery_objects[$i])) {
                    //Image + caption is a link to single page
                    echo "<td>
                            <a href='/gallery/{$gallery_objects[$i][0]}'>
                                <figure class='gallery'>
                                    <img src='{$gallery_objects[$i][1]}'>
                                    <figcaption>{$gallery_objects[$i][0]}</figcaption>
                                </figure>
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