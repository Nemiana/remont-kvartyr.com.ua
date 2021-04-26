<?php
    //Parse options DB from config file
    $options = parse_ini_file ('/config/config.php');
    //Connect to DB
    $link = mysqli_connect($options['db_server'], $options['db_user'], $options['db_password'], $options['db_name']);
    //If connection to BD failed
    if ($link == false) {
        echo 'Cannot connect to DataBase!' . mysqli_connect_error();
        return false;
    } else {
        return $link;
    }