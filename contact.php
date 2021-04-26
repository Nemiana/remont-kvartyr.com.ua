<?php
    require_once ('/query/queries.php');
    //Query meta-tags and contact info from DB
    $result_meta_tags = get_meta_tags_query ('/contact');
    $result_contact = get_contact_info ();
    require_once ('/view/view_header.php');
?>
    <article class="contact">
        <?= $result_contact[0]; ?>
    </article>
<?php
    require_once ('/view/view_footer.php');