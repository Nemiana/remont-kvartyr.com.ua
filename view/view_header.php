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
	<header>
		<div class="lang">
			<button class="ukr"><img src="/images/ukr_flag.png" alt="Українська" width="30px"></button>
			<button class="rus"><img src="/images/rus_flag.png" alt="Русский" width="30px"></button>
		</div>
		<a href="/"><img src="/images/logo.png" alt="Логотип" width="100px"></a>
		<h1 class="header_title">Ремонт квартир і будинків</h1>
		<div class="header_contact"><img src="/images/title_contact.png" alt="Контакти" width="170px"></div>
	</header>	
    <!-- /HEADER -->
    <!-- MENU -->
    <nav>
        <ul>
            <li><a href="/index">Головна</a></li>
            <li><a href="/price-list">Прайс</a></li>
			<li><a href="/gallery">Галерея</a></li>
			<li><a href="/article">Статті</a></li>
            <li><a href="/review">Відгуки</a></li>
            <li><a href="/contact">Контакти</a></li>
        </ul>
    </nav>
    <!-- /MENU -->
    <!-- MAIN PART -->
	<div class="main_page">
	<div class="left_side"><img src="/images/aside_long_img.png" alt="Логотип" width="90px"></div>
    <!-- Sets the block height to the size of the client area -->
    <script src="/js/left_block.js"></script>