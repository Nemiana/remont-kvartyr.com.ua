<?php
    session_start();
    //Checks current language from cookies and upload appropriate file with translation
    if ($_COOKIE['admin_lang'] == 'rus') {
        $translate = parse_ini_file ('/config/rus.php');
    } else if ($_COOKIE['admin_lang'] == 'eng') {
        $translate = parse_ini_file ('/config/eng.php');
    } else {
        $translate = parse_ini_file ('/config/ukr.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $translate['login_admin_panel'] ?></title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>
    <!-- LOGIN TO ADMIN PANEL -->
    <article>
        <form class="login" method="POST" action="/admin/index.php">
            <table>
                <tr>
                    <th colspan="2"><?= $translate['login_admin_panel'] ?></th>
                </tr>
                <tr>
                    <td><label for="login"><?= $translate['name_user'] ?><label></td>
                    <td><input type="text" name="login" required></td>
                </tr>
                <tr>
                    <td><label for="pass"><?= $translate['password'] ?><label></td>
                    <td><input type="password" name="pass" required></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit"><?= $translate['login'] ?></button><td>
                </tr>
            </table>
        <form>
    <article>

    <!-- Create tables and admin account (only one time!) -->
    <?php //require_once ('../query/create_tables.php'); ?>

    <!-- END LOGIN -->
</body>
</html>