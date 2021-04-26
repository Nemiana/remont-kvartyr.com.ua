<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Вхід в адмін-панель</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>
    <!-- LOGIN TO ADMIN PANEL -->
    <article>
        <form class="login" method="POST" action="/admin/index.php">
            <table>
                <tr>
                    <th colspan="2">Вхід в адмін-панель</th>
                </tr>
                <tr>
                    <td><label for="login">Ім'я<label></td>
                    <td><input type="text" name="login" required></td>
                </tr>
                <tr>
                    <td><label for="pass">Пароль<label></td>
                    <td><input type="password" name="pass" required></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Вхід</button><td>
                </tr>
            </table>
        <form>
    <article>

    <!-- Create tables and admin account (only one time!) -->
    <?php //require_once ('../query/create_tables.php'); ?>

    <!-- END LOGIN -->
</body>
</html>