<?php session_start(); 
//If not login user with access rights 'admin', exit to start page
if (!isset($_SESSION['user']) || $_SESSION['rights'] != 'admin') {
    header('Location: /admin/');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ремонт квартир і будинків | Адмін-панель</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/admin/css/admin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/jquery.cookies.js"></script>
    <!-- Up button -->
    <script src="/js/go_top.js"></script>
    <!-- Script with fade in and fade out action windows -->
    <script src="/admin/js/pop_up_action.js"></script>
</head>
<body>
    <!-- ADMIN MENU -->
    <nav>
        <ul>
            <li><a href="/admin/admin_home_page.php">Головна</a></li>
            <li><a href="/admin/admin_price_list.php">Прайс</a></li>
			<li><a href="/admin/admin_gallery.php">Галерея</a></li>
			<li><a href="/admin/admin_article.php">Статті</a></li>
            <li><a href="/admin/admin_review.php">Відгуки</a></li>
            <li><a href="/admin/admin_contact.php">Контакти</a></li>
        </ul>
    </nav>
    <!-- /ADMIN MENU -->
    <!-- EXIT FROM ADMIN PANEL-->
    <form id="exit" method="POST" action="/admin/exit.php">
        <button type="submit">Вийти з адмін-панелі</button>
    </form>
    <!-- /EXIT -->
    <!-- Pop-up windows for success and fail action -->
    <div class="success_action">Дані збережено!</div>
    <div class="fail_action">Невдача!</div>
    <!-- / -->