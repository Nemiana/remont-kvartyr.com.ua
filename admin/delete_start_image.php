<?php
    require_once ('/query/queries.php');
    //If session not started, started it
    if (session_status () == PHP_SESSION_NONE) {
        session_start();
    }
    //If not login user with access rights 'admin', exit to start page
    if (!isset($_SESSION['user']) || $_SESSION['rights'] != 'admin') {
        header('Location: /admin/');
        exit();
    };
    //Call function to delete start image of gallery object from DB
    delete_gallery_start_image ($_POST['id']);