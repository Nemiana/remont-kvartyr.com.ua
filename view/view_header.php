<?php
    if ($_COOKIE['lang'] == 'rus') {
        $translate = parse_ini_file ('/config/rus.php');
    } else if ($_COOKIE['lang'] == 'eng') {
        $translate = parse_ini_file ('/config/eng.php');
    } else {
        $translate = parse_ini_file ('/config/ukr.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $result_meta_tags[0]; ?></title>
    <meta name="keywords" content="<?= $result_meta_tags[1]; ?>">
	<meta name="description" content="<?= $result_meta_tags[2]; ?>">
	<link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/jquery.cookies.js"></script>
    <!-- Up button -->
    <script src="/js/go_top.js"></script>
</head>
<body lang="uk">
    <!-- HEADER -->
	<header class="header">
		<div class="lang">
            <input type="image" class="ukr<?php if ($_COOKIE['lang'] == 'ukr' || !isset($_COOKIE['lang'])) echo ' lang_active'; ?>" src="/images/ukr_flag.png" title="Українська" alt="Українська">
            <input type="image" class="rus<?php if ($_COOKIE['lang'] == 'rus') echo ' lang_active'; ?>" src="/images/rus_flag.png" title="Русский" alt="Русский">
            <input type="image" class="eng<?php if ($_COOKIE['lang'] == 'eng') echo ' lang_active'; ?>" src="/images/eng_flag.png" title="English" alt="English">
        </div>
		<a href="/"><img src="/images/logo.png" alt="Логотип" width="100px"></a>
		<h1 class="header_title">Ремонт квартир і будинків</h1>
		<div class="header_contact"><img src="/images/title_contact.png" alt="Контакти" width="170px"></div>
	</header>	
    <!-- /HEADER -->
    <!-- MENU -->
    <nav>
        <ul>
            <li><a href="/index"><?= $translate['main_menu_home'] ?></a></li>
            <li><a href="/price-list"><?= $translate['main_menu_price'] ?></a></li>
			<li><a href="/gallery"><?= $translate['main_menu_gallery'] ?></a></li>
			<li><a href="/article"><?= $translate['main_menu_article'] ?></a></li>
            <li><a href="/review"><?= $translate['main_menu_review'] ?></a></li>
            <li><a href="/contact"><?= $translate['main_menu_contact'] ?></a></li>
        </ul>
    </nav>
    <!-- /MENU -->
    <!-- MAIN PART -->
	<div class="main_page">
	<div class="left_side"><img src="/images/aside_long_img.png" alt="Логотип" width="90px"></div>
    <!-- Sets the block height to the size of the client area -->
    <script src="/js/left_block.js"></script>
    <!-- -->
    <script src="/js/change_language.js"></script>