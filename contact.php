<?php
    require_once ('/query/queries.php');
    //Query meta-tags and contact info from DB
    $result_meta_tags = get_meta_tags_query ('/contact');
    $result_contact = get_contact_info ();
    require_once ('/view/view_header.php');
?>
    <article class="contact">
        <!-- Contacts with switch language -->
        <?php 
            if ($_COOKIE['lang'] == 'rus') {
                echo $result_contact[2]; 
            } else if ($_COOKIE['lang'] == 'eng') {
                echo $result_contact[3]; 
            } else {
                echo $result_contact[1]; 
            }
        ?>
    </article>
<?php
    require_once ('/view/view_footer.php');