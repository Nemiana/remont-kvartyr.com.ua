<?php
    //Checks current language from cookies and upload appropriate file with translation
    if ($_COOKIE['admin_lang'] == 'rus') {
        $translate = parse_ini_file ('/config/rus.php');
    } else if ($_COOKIE['admin_lang'] == 'eng') {
        $translate = parse_ini_file ('/config/eng.php');
    } else {
        $translate = parse_ini_file ('/config/ukr.php');
    }
    session_start();
    //User already login
    if (isset ($_SESSION['user']) && $_SESSION['rights'] == 'admin') {
        header('Location: /admin/admin_home_page.php');
        exit();
    } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {  //if the button login was pressed
        //Include check authentication
        require_once ('/query/queries.php');
        //If username and password matches,
        if ($session_user = check_authentication ($_POST['login'], $_POST['pass'])) {
            //remember username and access rights in session
            $_SESSION['user'] = $session_user[0];
            $_SESSION['rights'] = $session_user[1];
            if ($_SESSION['rights'] == 'admin') {
                //Redirect to admin page
                header('Location: /admin/admin_home_page.php');
                exit();
            }
        } else {    //error if user data was incorrect
            echo "<p style='color: red; text-align: center'>{$translate['message_fail_login']}</p>";
            require_once ('/admin/admin_login.php');
        }
    } else { //else go in login page
        header('Location: /admin/admin_login.php');
    }