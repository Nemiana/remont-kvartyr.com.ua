<?php
session_start();
//User already login
if (isset ($_SESSION['user']) && $_SESSION['user'] == 'admin') {
    header('Location: /admin/admin_view/admin_page.php');
    exit();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {  //if the button login was pressed
    if ($_POST['login'] == 'admin' && $_POST['pass'] == '123') {    //check user data
        $_SESSION['user'] = 'admin';
        header('Location: /admin/admin_view/admin_page.php');
        exit();
    } else {    //error if user data was incorrect
        echo '<p style="color: red; text-align: center">Incorrect registration data!</p>';
        require_once '/admin_view/admin_login.php';
    }
} else { //else go in login page
    header('Location: /admin/admin_view/admin_login.php');
}