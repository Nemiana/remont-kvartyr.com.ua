<?php
    session_start(); 
    //If not login user with access rights 'admin', exit to start page
    if (!isset($_SESSION['user']) || $_SESSION['rights'] != 'admin') {
        header('Location: /admin/');
        exit();
    }
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
    <title><?= $translate['admin_title'] ?></title>
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
    <!-- HEADER -->
	<header class="header">
        <!-- Language switch block for admin-panel (adds class style to active language (ukr by default)) -->
		<div class="admin_lang">
            <input type="image" class="ukr<?php if ($_COOKIE['admin_lang'] == 'ukr' || !isset($_COOKIE['admin_lang'])) echo ' lang_active'; ?>" src="/images/ukr_flag.png" title="Українська" alt="Українська">
            <input type="image" class="rus<?php if ($_COOKIE['admin_lang'] == 'rus') echo ' lang_active'; ?>" src="/images/rus_flag.png" title="Русский" alt="Русский">
            <input type="image" class="eng<?php if ($_COOKIE['admin_lang'] == 'eng') echo ' lang_active'; ?>" src="/images/eng_flag.png" title="English" alt="English">
		</div>
	</header>	
    <!-- /HEADER -->
    <!-- ADMIN MENU -->
    <nav>
        <ul>
            <li><a href="/admin/admin_home_page.php"><?= $translate['main_menu_home'] ?></a></li>
            <li><a href="/admin/admin_price_list.php"><?= $translate['main_menu_price'] ?></a></li>
			<li><a href="/admin/admin_gallery.php"><?= $translate['main_menu_gallery'] ?></a></li>
			<li><a href="/admin/admin_article.php"><?= $translate['main_menu_article'] ?></a></li>
            <li><a href="/admin/admin_review.php"><?= $translate['main_menu_review'] ?></a></li>
            <li><a href="/admin/admin_contact.php"><?= $translate['main_menu_contact'] ?></a></li>
        </ul>
    </nav>
    <!-- /ADMIN MENU -->
    <!-- EXIT FROM ADMIN PANEL-->
    <form id="exit" method="POST" action="/admin/exit.php">
        <button type="submit"><?= $translate['admin_logout'] ?></button>
    </form>
    <!-- /EXIT -->
    <!-- Pop-up windows for success and fail action -->
    <div class="success_action"><?= $translate['success_action'] ?></div>
    <div class="fail_action"><?= $translate['fail_action'] ?></div>
    <!-- / -->
    <!-- Script remember language in cookies and animate current choose -->
    <script src="/js/change_language.js"></script>