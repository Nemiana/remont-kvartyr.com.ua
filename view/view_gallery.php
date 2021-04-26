<!-- Views single gallery object -->
<?php
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
    //Search the index of query title and setting meta-tags
    foreach ($all_gallery_objects as $key => $value) {
        if ($_GET['title'] == $value[0]) {
            $index = $key;
            $title = $description = $keywords = $value[0];
            break;
        }
    }
    require_once ('/view/view_header.php');
?>
<article>
    <?php
        echo '<table>';
        $i = 1;
        //Output all elements on page
        while ($i < count($all_gallery_objects[$index]) - 1) {
            echo '<tr>';
            //three in a row
            for ($j = 0; $j < 3; $j++, $i++) {
                if (isset($all_gallery_objects[$index][$i])) {
                    //Image + caption
                    echo "<td>
                            <figure class='gallery'>
                                <img src='{$all_gallery_objects[$index][$i]}'>
                                <figcaption>{$all_gallery_objects[$index][0]}</figcaption>
                            </figure>
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