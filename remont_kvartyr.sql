-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 05 2021 г., 14:22
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `remont_kvartyr`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article_page`
--

CREATE TABLE `article_page` (
  `id` int(11) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `title_article` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `text_article` text,
  `date_publication_article` datetime DEFAULT NULL,
  `image_article` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `article_page`
--

INSERT INTO `article_page` (`id`, `meta_title`, `meta_keywords`, `meta_description`, `title_article`, `url`, `text_article`, `date_publication_article`, `image_article`) VALUES
(12, 'Ремонт передпокою', 'Ремонт передпокою', 'Ремонт передпокою', 'Ремонт передпокою', 'remont-peredpokoi', '<p>Ремонт передпокою є не менш важливим, ніж одяг для людини. Саме цю кімнату помічають гості в першу чергу, коли заходять в квартиру, а відповідно по ній складається все подальше враження. Також передпокій виступає не тільки візитною карткою квартири, але і вважається найбільш уразливим приміщенням, так як сюди заходять в брудному взутті, знімають верхній одяг, відкривають парасолі для подальшої просушки, а також заносяться санки, коляски і багато іншого. Відповідно важливо не тільки ретельно продумати дизайн, але і вибрати якісні стійкі матеріали для обробки.</p>\r\n<h3>Що слід враховувати при плануванні ремонту?</h3>\r\n<p>Під час планування дуже важливо приділити увагу таким основним моментам, як:</p>\r\n<ul style=\"list-style-type: circle;\">\r\n<li>Освітлення приміщення;</li>\r\n<li>Оздоблення стін, підлоги і стелі;</li>\r\n<li>Ретельна і продумана організація наявного простору;</li>\r\n<li>А також меблювання.</li>\r\n</ul>\r\n<p>Якщо підходити до організації простору з особливою увагою, то приміщення можна перетворити з тісного і не комфортабельного в досить світлу і функціональну зону.</p>\r\n<h3 style=\"text-align: center;\">Основні приклади розширення наявного простору</h3>\r\n<ul style=\"list-style-type: circle;\">\r\n<li>Щоб виконаний ремонт порадував одержуваними результатами, слід звернути увагу на кілька дієвих прийомів:Слід віддавати перевагу гарному освітленню, навіть якщо немає можливості встановити кілька світильників, важливо встановити один, але яскравий в максимально зручному місці.</li>\r\n<li>Чи не вибирати для стін темні шпалери або обшивку.</li>\r\n<li>Розміщення дзеркала на зовнішній поверхні шафи-купе. Таке рішення допомагає не тільки зручно і компактно складати речі, але і не шукати окреме місце для дзеркала.</li>\r\n<li>Вибір стелі з глянцевим ефектом або в світлих тонах. Вони вдало відбивають світло і роблять приміщення візуально більше.</li>\r\n</ul>\r\n<h3>На що слід звернути увагу?</h3>\r\n<p>Якщо висота стелі в прихожей дозволяє, то вигідно буде розглянути варіант підвісних стель. В такому випадку дуже зручно розміщувати освітлення кількох рівнів. Також гарний ремонт просто не може обходитися без шпалер. Особливо привабливо і оригінально виглядають комбінації декількох вдало підібраних видів шпалер. Однотонними або максимально наближеними за кольором повинні бути дверні полотна, плінтуса, а також підлоги.</p>\r\n<h3>Які матеріали краще вибирати?</h3>\r\n<p>Для підлог найкраще підбирати безпечні і досить міцні матеріали, щоб не турбуватися про переробку найближчим часом. Для цього добре підходить ламінат. Однак слід віддавати перевагу не самим тонким варіантів, особливо якщо хтось в родині ходить на каблуках. Також добре підходить для обробки підлоги в передпокою плитка, що володіє злегка шорсткою поверхнею.</p>\r\n<p/>Що стосується стін, то для них краще вибирати миються матеріали, серед яких: вінілові шпалери, структурний вініл, ПВХ покриття, декоративна штукатурка, рідкі шпалери, ламінований ДСП і інші.</p>\r\n<p>Для стель практично ідеальним варіантом вважаються натяжні стелі, так як вони добре відбивають світло і дуже легко миються. Також можна звернути увагу на гіпсокартонні варіації і пластикові панелі.</p>', '2021-05-15 00:00:00', 'peredpokiy.jpg'),
(13, 'Ремонт в кімнаті підлітка', 'Ремонт в кімнаті підлітка', 'Ремонт в кімнаті підлітка', 'Ремонт в кімнаті підлітка', 'remont-v-kimnati-pidlitka', '<h3 style=\"text-align: center;\">Головні моменти оформлення</h3>\r\n<p>Підлітки, на відміну від маленьких діток, в основному не сприймають пастельних і спокійних відтінків. Енергія, яка активно прокидається в цьому віці, потребує яскравих фарбах і різноманітних крайнощах в дизайні. Однак тут вкрай важливо не переборщити з елементами інтер\'єру, щоб не звести всю роботу в несмак. При цьому напрямок стилю залежить від статі власника кімнати. Якщо це хлопчик, то краще для оформлення вибирати відтінки коричневого, синього, зеленого, сірого і навіть жовтого. Для дівчаток відмінно підходить вибір більш м\'яких і жіночних відтінків пурпурного, рожевого, оранжевого та інших. Змішування різноманітних кольорів може зробити кімнату не тільки більш контрастною, але і модною, а також універсальної, якщо в ній будуть жити кілька дітей.</p>\r\n<h3>Який дизайн кімнати для підлітка дівчинки краще?</h3>\r\n<p>Перш за все, ремонт і дизайн кімнати для підлітка дівчинки повинен враховувати всю специфіку характеру і відображати цілісність молодий натури. У такому віці особиста кімната зазвичай виступає найголовнішим місцем, в якому знаходяться особисті секрети і переживання. Тому в інтер\'єрі повинні гармонійно поєднуватися: спальня, особистий кабінет, будуар, а також вітальню, в яку можуть приходити друзі.</p>\r\n<p>Більшість сучасних дизайнерських рішень дає можливість не обмежуватися в розробці інтер\'єру тільки рюшами, рожевими відтінками кольору і бантами. Виробники намагаються враховувати все розмаїття захоплень і різнобічність підлітків.</p>\r\n<p>Також для кожної дівчинки важлива наявність місця для зберігання речей і вдалим рішенням для кожної кімнати буде:</p>\r\n<ul>\r\n	<li>Комод для дрібної одягу;</li>\r\n	<li>Шафка для суконь;</li>\r\n	<li>Шухлядки для білизни в нижній частині ліжка або біля неї.</li>\r\n</ul>\r\n<h3>Вибір дизайну кімнати для хлопчиків-підлітків</h3>\r\n<p>Інтер\'єр кімнати, яка призначена для проживання в ній хлопчика-підлітка, повинен відповідати цілому ряду вимог. Перш за все, кімната повинна бути світлою і досить просторою. Також важливо подбати про якісне висвітлення, так як в цьому віці хлопці величезна кількість часу проводять за зошитами та ПК.</p>\r\n<p>Не менш важливою частиною в кімнаті підлітків-хлопчиків є наявність місця для зберігання всіляких речей. Слід грунтовно продумати, які меблі буде не тільки підходити до інтер\'єру, але і зручною у використанні для зберігання непотрібного «мотлоху». Доброю ідеєю буде внесення в дизайн комфортного містечка, в якому можна буде займатися своїми улюбленими справами і захопленнями.</p>', '2021-06-16 00:00:00', 'kimnata-dlya-pidlitka.jpg'),
(14, '10 корисних Лайфхаків для маленької кухні', '10 корисних Лайфхаків для маленької кухні', '10 корисних Лайфхаків для маленької кухні', '10 корисних Лайфхаків для маленької кухні', '10-korysnykh-laifkhakiv-dlia-malenkoi-kukhni', '<p>Планування типових і малогабаритних квартир не відрізняється великою різноманітністю варіантів, і тим більше, не радує власників своїми габаритами. Обмежені площі приміщень змушують дизайнерів і виробників меблів шукати варіанти, які допоможуть раціонально і зручно облаштувати навіть саму малогабаритну кімнату. Однією з найбільш проблемних зон в цьому випадку є кухня. Велика функціональне навантаження на це приміщення і високі вимоги до організації простору стимулюють ідеї, які допомагають облаштувати приміщення з максимальною віддачею і ергономічністю. Різні Лайфхакі для маленької кухні, які з\'являються із завидною періодичністю, дозволяють зробити приміщення функціональним і використовувати його потенціал на повну потужність.</p>\r\n<h3>Малогабаритні кухні: як зберегти простір</h3>\r\n<p><strong>1) Висувні ящики.</strong> \r\nНа кухні компактних розмірів найбільш зручним і практичним рішенням стануть висувні ящики. Вони дозволяють вміщати велику кількість побутових предметів і кухонного приладдя, значно економлять простір в порівнянні з орними ящиками і допомагають організувати впорядковану систему зберігання.<br /><br />\r\n<strong>2) Відмова від столу. </strong>Якщо приміщення не дозволяє розмістити повноцінний стіл - розумно буде відмовитися від класичного варіанта і замінити його барною стійкою або складним / відкидним міні-столиком.</p>\r\n<p><strong>3) Використання бічних стінок шаф.</strong> Маленька кухня має на увазі максимальну економію площі, тому розмістив на бічних поверхнях шаф гачки і рейлінги, можна знайти місце для кухонного текстилю та дрібної кухонного начиння.</p>\r\n<p><strong>4) Магнітні полиці.</strong> Чудовим місцем для розміщення додаткових відкритих полиць стане поверхню холодильника, на яку вони надійно кріпляться за допомогою магнітів.</p>\r\n<p><strong>5) Мініатюрна техніка та побутові прилади.</strong> Багато виробників враховують потреби своїх клієнтів і створюють техніку, адаптовану для маленької кухні. Зараз без зусиль можна знайти посудомийну машину шириною всього 45 см або двухкомфорочная індукційну варильну поверхню.</p>\r\n<p><strong>6) Меблі-трансформер.</strong> Значно заощадити простір допоможуть трансформуються стільці і табурети, які, у міру необхідності можна складати і прибирати.</p>\r\n<p><strong>7) Відмова від дверей.</strong> Оптимізувати простір в малогабаритній квартирі і в кухні зокрема, допоможе відмова від дверей в це приміщення. Орне полотно не буде займати місце при відкриванні, а дверний проріз можна оформити у вигляді арки або задекорувати текстилем.</p>\r\n<p><strong>8) Г-або П-образне розміщення меблів.</strong> У компактних кухнях кращим планувальним рішенням буде саме така розстановка меблів. Вона допоможе максимально використовувати наявний простір.</p>\r\n<p><strong>9) Стінові панелі.</strong> Цікавим і практичним Лайфхаком є застосування спеціальних стінових панелей з металу з перфорацією. Розміщуючи таку панель в якості фартуха над робочою поверхнею, її використовують для зберігання кухонного приладдя. Крім цього, такі стінові панелі відмінно захищають стіни від забруднень.</p>\r\n<p><strong>10) Використання всіляких органайзеров.</strong> Різні органайзери допомагають не тільки надійно зберігати необхідні предмети і речовини, але і допомагають підтримувати чистоту на кухні.<br />Такі корисні Лайфхак для маленької кухні зроблять її не тільки зручним і практичним, але і допоможуть створити затишок і комфорт для всіх членів родини!</p>', '2021-07-14 00:00:00', 'malenka-kuxnya.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `authentication`
--

CREATE TABLE `authentication` (
  `id` int(11) NOT NULL,
  `name_user` varchar(255) DEFAULT NULL,
  `password_user` varchar(255) DEFAULT NULL,
  `access_rights` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authentication`
--

INSERT INTO `authentication` (`id`, `name_user`, `password_user`, `access_rights`) VALUES
(1, 'user', '$2y$10$ZxSwRft/JTOhSRMm2fuuQO/cA4zZND/UGIMqsuN/v4eYSxEpQZ4XC', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `contact_page`
--

CREATE TABLE `contact_page` (
  `id` int(11) NOT NULL,
  `info_contact_ukr` text,
  `info_contact_rus` text,
  `info_contact_eng` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contact_page`
--

INSERT INTO `contact_page` (`id`, `info_contact_ukr`, `info_contact_rus`, `info_contact_eng`) VALUES
(2, '<h1>Наші контакти:</h1>\r\n<p><img src=\"/images/phone_contact.png\" alt=\"Контактний телефон\" width=\"40px\">063-561-82-99</p>\r\n<p><img src=\"/images/phone_contact.png\" alt=\"Контактний телефон\" width=\"40px\">068-392-40-65</p>\r\n<p><img src=\"/images/e-mail_contact.png\" alt=\"Електронна адреса\" width=\"40px\">111567@ukr.net</p>', '<h1>Наши контакты:</h1>\r\n<p><img src=\"/images/phone_contact.png\" alt=\"Контактный телефон\" width=\"40px\">063-561-82-99</p>\r\n<p><img src=\"/images/phone_contact.png\" alt=\"Контактный телефон\" width=\"40px\">068-392-40-65</p>\r\n<p><img src=\"/images/e-mail_contact.png\" alt=\"Электронный адрес\" width=\"40px\">111567@ukr.net</p>', '<h1>Our contacts:</h1>\r\n<p><img src=\"/images/phone_contact.png\" alt=\"Contact phone\" width=\"40px\">063-561-82-99</p>\r\n<p><img src=\"/images/phone_contact.png\" alt=\"Contact phone\" width=\"40px\">068-392-40-65</p>\r\n<p><img src=\"/images/e-mail_contact.png\" alt=\"Email address\" width=\"40px\">111567@ukr.net</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_objects`
--

CREATE TABLE `gallery_objects` (
  `id` int(11) NOT NULL,
  `object_id` int(11) DEFAULT NULL,
  `object_image` varchar(255) DEFAULT NULL,
  `image_description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery_objects`
--

INSERT INTO `gallery_objects` (`id`, `object_id`, `object_image`, `image_description`) VALUES
(57, 21, '121.jpg', 'Було'),
(58, 21, '124.jpg', 'Було'),
(59, 21, '130.jpg', 'Було'),
(60, 21, '133.jpg', 'Обшивка стін'),
(61, 21, '134.jpg', 'Обшивка стін'),
(62, 21, '139.jpg', 'Обшивка стін'),
(63, 21, '144.jpg', 'Дерев\'яні полиці'),
(64, 21, '150.jpg', 'Дерев\'яні полиці'),
(65, 21, '154.jpg', 'Дерев\'яні полиці'),
(66, 21, '155.jpg', 'Шпаклювання стін'),
(67, 21, '157.jpg', 'Шпаклювання стін'),
(68, 21, '158.jpg', 'Шпаклювання стін'),
(69, 21, '159.jpg', 'Вікно'),
(70, 21, '170.jpg', 'Підлога на балконі'),
(71, 21, '174.jpg', ''),
(73, 22, '214.jpg', 'Було'),
(74, 22, '215.jpg', 'Було'),
(75, 22, '219.jpg', 'Було'),
(76, 22, '222.jpg', 'Було'),
(77, 22, '227.jpg', 'Шпаклювання стін'),
(78, 22, '229.jpg', 'Шпаклювання стін'),
(79, 22, '230.jpg', 'Шпаклювання стін'),
(80, 22, '235.jpg', 'Шпаклювання стін'),
(81, 22, '236.jpg', 'Шпаклювання стін'),
(82, 22, '240.jpg', 'Шпаклювання стін'),
(83, 22, '241.jpg', 'Шпаклювання стелі'),
(84, 22, '246.jpg', 'Шпаклювання стін'),
(85, 22, '250.jpg', 'Шпаклювання стін'),
(86, 22, '251.jpg', 'Шпаклювання стін'),
(87, 22, '258.jpg', 'Фарбування стін'),
(88, 22, '260.jpg', 'Фарбування стін'),
(89, 22, '261.jpg', 'Фарбування стін'),
(90, 22, '262.jpg', 'Шпалери'),
(91, 22, '263.jpg', 'Шпалери'),
(92, 22, '264.jpg', 'Шпалери'),
(93, 22, '266.jpg', 'Шпалери'),
(94, 23, '270.jpg', 'Було'),
(95, 23, '271.jpg', 'Було'),
(96, 23, '272.jpg', 'Було'),
(97, 23, '276.jpg', 'Вирівнювання стін'),
(98, 23, '277.jpg', 'Підшивання стелі'),
(99, 23, '278.jpg', 'Балконні двері'),
(100, 23, '279.jpg', 'Стеля на балконі'),
(101, 23, '280.jpg', 'Стеля на балконі'),
(102, 23, '284.jpg', 'Шпаклювання стін'),
(103, 23, '285.jpg', 'Шпаклювання стін'),
(104, 23, '286.jpg', 'Шпаклювання стін'),
(105, 23, '292.jpg', 'Шпаклювання стелі'),
(106, 23, '293.jpg', 'Укладка ламінату'),
(107, 23, '294.jpg', 'Укладка ламінату'),
(108, 23, '296.jpg', 'Укладка ламінату'),
(109, 23, '298.jpg', 'Укладка ламінату');

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_page`
--

CREATE TABLE `gallery_page` (
  `id` int(11) NOT NULL,
  `object_name` varchar(255) DEFAULT NULL,
  `object_start_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gallery_page`
--

INSERT INTO `gallery_page` (`id`, `object_name`, `object_start_image`) VALUES
(21, 'Квартира, ремонт кімнати і балкону', '158.jpg'),
(22, 'Ремонт кімнати під ключ', '260.jpg'),
(23, 'Ремонт великої кімнати і балкону', '286.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `home_page`
--

CREATE TABLE `home_page` (
  `id` int(11) NOT NULL,
  `title_ukr` varchar(255) DEFAULT NULL,
  `article_ukr` text,
  `title_rus` varchar(255) DEFAULT NULL,
  `article_rus` text,
  `title_eng` varchar(255) DEFAULT NULL,
  `article_eng` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `home_page`
--

INSERT INTO `home_page` (`id`, `title_ukr`, `article_ukr`, `title_rus`, `article_rus`, `title_eng`, `article_eng`) VALUES
(1, 'Ремонт квартир і будинків дешево і швидко', '<p>Наша основна ціль - це якісна робота по доступній ціні. Завдяки тому, що ми працюємо без посередників, Вам не доведеться переплачувати комісію будівельній компанії. Ви завжди можете звернутись до нас для консультації при виборі матеріалів, якщо необхідно провести оцінку роботи, підрахувати витратні матеріали, тощо.</p>\r\n    <p>Ми займаємось ремонтами вже більше 15 років, завдяки чому гарантуємо Вам якісне виконання робіт в зазначений термін. Крім звичних оздоблювальних робіт, таких як шпаклювання стін і стелі, поклейка шпалерів, багетів, вкладання ламінату, плитки тощо, ми займаємось також електрикою і сантехнікою. Вам не доведеться оплачувати багато різних майстрів, щоб зробити ремонт \"під ключ.\"</p>\r\n    <p>З нашими останніми роботами Ви можете ознайомитись у розділі <a href=\"gallery\">Галерея</a>.</p>', 'Ремонт квартир и домов дешево и быстро', '<p>Наша основная цель - это качественная работа по доступной цене. Благодаря тому, что мы работаем без посредников, Вам не придется переплачивать комиссию строительной компании. Вы всегда можете обратиться к нам для консультации при выборе материалов, если необходимо провести оценку работы, подсчитать расходные материалы и тому подобное.</p>\r\n<p>Мы занимаемся ремонтами уже более 15 лет, благодаря чему гарантируем Вам качественное выполнение работ в срок. Кроме привычных отделочных работ, таких как шпаклевка стен и потолка, поклейка обоев, багетов, укладывание ламината, плитки и т.д., мы занимаемся также электричеством и сантехникой. Вам не придется оплачивать много разных мастеров, чтобы сделать ремонт \"под ключ\".</p>\r\n<p>С нашими последними работами Вы можете ознакомиться в разделе <a href=\"gallery\">Галерея</a>.</p>', 'Repair of apartments and houses is cheap and fast', '<p>Our main goal is quality work at an affordable price. Due to the fact that we work without intermediaries, you do not have to overpay the commission of the construction company. You can always contact us for advice on the choice of materials, if you need to evaluate the work, calculate consumables, etc.</p>\r\n<p>We have been engaged in repairs for more than 15 years, thanks to which we guarantee you quality work within the specified period. In addition to the usual finishing work, such as plastering walls and ceilings, gluing wallpaper, baguettes, laying laminate, tiles, etc., we also deal with electricity and plumbing. You don\'t have to pay many different technicians to make turnkey repairs.</p>\r\n<p>You can see our latest work in the <a href=\"gallery\">Gallery</a>.</p>');

-- --------------------------------------------------------

--
-- Структура таблицы `meta`
--

CREATE TABLE `meta` (
  `id` int(11) NOT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `meta_title_ukr` varchar(255) DEFAULT NULL,
  `meta_keywords_ukr` varchar(255) DEFAULT NULL,
  `meta_description_ukr` varchar(255) DEFAULT NULL,
  `meta_title_rus` varchar(255) DEFAULT NULL,
  `meta_keywords_rus` varchar(255) DEFAULT NULL,
  `meta_description_rus` varchar(255) DEFAULT NULL,
  `meta_title_eng` varchar(255) DEFAULT NULL,
  `meta_keywords_eng` varchar(255) DEFAULT NULL,
  `meta_description_eng` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `meta`
--

INSERT INTO `meta` (`id`, `page_url`, `meta_title_ukr`, `meta_keywords_ukr`, `meta_description_ukr`, `meta_title_rus`, `meta_keywords_rus`, `meta_description_rus`, `meta_title_eng`, `meta_keywords_eng`, `meta_description_eng`) VALUES
(1, '/', 'Ремонт квартир і будинків', 'Ремонт квартир і будинків під ключ дешево і швидко', 'Ремонт квартир, ремонт будинків', 'Ремонт квартир и домов', 'Ремонт квартир и домов под ключ дешево и быстро', 'Ремонт квартир, ремонт домов', 'Repair of apartments and houses', 'Repair of apartments and houses is cheap and fast', 'Repair of apartments, repair of houses'),
(2, '/price-list', 'Ремонт квартир і будинків | Прайс', 'Прайс-лист ремонт квартир і будинків під ключ дешево і швидко', 'Прайс ремонт квартир, прайс ремонт будинків', 'Ремонт квартир и домов | Прайс', 'Прайс-лист ремонт квартир и домов под ключ дешево и быстро', 'Прайс ремонт квартир, прайс ремонт домов', 'Repair of apartments and houses | Price', 'Price-list repair of apartments and houses  is cheap and fast', 'Price repair of apartments, price repair of houses'),
(3, '/gallery', 'Ремонт квартир і будинків | Галерея', 'Галерея ремонту квартир і будинків під ключ дешево і швидко', 'Галерея ремонт квартир, галерея ремонт будинків', 'Ремонт квартир и домов | Галерея', 'Галерея ремонта квартир и домов под ключ дешево и быстро', 'Галерея ремонт квартир, галерея ремонт домов', 'Repair of apartments and houses | Gallery', 'Gallery repair of apartments and houses is cheap and fast', 'Gallery repair of apartments, gallery repair of houses'),
(4, '/article', 'Ремонт квартир і будинків | Статті', 'Статті ремонт квартир, статті ремонт будинків', 'Статті про ремонт квартир і будинків під ключ дешево і швидко', 'Ремонт квартир и домов | Статьи', 'Статьи ремонт квартир и домов под ключ дешево и быстро', 'Статьи ремонт квартир, статьи ремонт домов', 'Repair of apartments and houses | Articles', 'Articles repair of apartments and houses is cheap and fast', 'Articles repair of apartments, articles repair of houses'),
(5, '/review', 'Ремонт квартир і будинків | Відгуки', 'Відгуки про ремонт квартир і будинків під ключ дешево і швидко', 'Відгуки ремонт квартир, відгуки ремонт будинків', 'Ремонт квартир и домов | Отзывы', 'Отзывы ремонт квартир и домов под ключ дешево и быстро', 'Отзывы ремонт квартир, отзывы ремонт домов', 'Repair of apartments and houses | Feedback', 'Feedback repair of apartments and houses is cheap and fast', 'Feedback repair of apartments, feedback repair of houses'),
(6, '/contact', 'Ремонт квартир і будинків | Контакти', 'Контакти ремонт квартир і будинків під ключ дешево і швидко', 'Контакти ремонт квартир, контакти ремонт будинків', 'Ремонт квартир и домов | Контакты', 'Контакты ремонта квартир и домов под ключ дешево и быстро', 'Контакты ремонт квартир, контакты ремонт домов', 'Repair of apartments and houses | Contacts', 'Contacts repair of apartments and houses is cheap and fast', 'Contacts repair of apartments, contacts repair of houses');

-- --------------------------------------------------------

--
-- Структура таблицы `price_page`
--

CREATE TABLE `price_page` (
  `id` int(11) NOT NULL,
  `service_ukr` text,
  `service_rus` text,
  `service_eng` text,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `price_page`
--

INSERT INTO `price_page` (`id`, `service_ukr`, `service_rus`, `service_eng`, `price`) VALUES
(14, 'Поклейка шпалер (за м.кв.)', 'Поклейка обоев (за м.кв.)', 'Wallpapering (per sq.m.)', 50),
(15, 'Шпаклювання стін (за м.кв.)', 'Шпаклевка стен (за м.кв.)', 'Plastering of walls (per sq.m.)', 70),
(16, 'Укладка ламінату (за м.кв.)', 'Укладка ламината (за м.кв.)', 'Laying of a laminate (on sq.m.)', 100),
(17, 'Фарбування стін (за м.кв.)', 'Покраска стен (за м.кв.)', 'Painting the walls (per sq.m.)', 50),
(18, 'Фарбування стелі (за м.кв.)', 'Покраска потолка (за м.кв.)', 'Painting the ceiling (per sq.m.)', 60);

-- --------------------------------------------------------

--
-- Структура таблицы `review_page`
--

CREATE TABLE `review_page` (
  `id` int(11) NOT NULL,
  `text_review` text,
  `name_user` varchar(255) DEFAULT NULL,
  `date_publication_review` datetime DEFAULT NULL,
  `check_publication` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review_page`
--

INSERT INTO `review_page` (`id`, `text_review`, `name_user`, `date_publication_review`, `check_publication`) VALUES
(17, 'Хлопці працюють гарно і швидко. Ремонтом задоволений, але хотілося б трохи дешевше.', 'Василь', '2021-03-17 00:00:00', 1),
(18, 'Быстро и качественно. Приятно, что консультацию провели бесплатно и можно заключить договор для подстраховки.', 'Мирослава', '2021-05-03 00:00:00', 1),
(19, 'Good quality for less price. Work was done quickly, I am satisfied.', 'John', '2021-06-20 00:00:00', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article_page`
--
ALTER TABLE `article_page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `authentication`
--
ALTER TABLE `authentication`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contact_page`
--
ALTER TABLE `contact_page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `gallery_objects`
--
ALTER TABLE `gallery_objects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `object_id` (`object_id`);

--
-- Индексы таблицы `gallery_page`
--
ALTER TABLE `gallery_page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `home_page`
--
ALTER TABLE `home_page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `price_page`
--
ALTER TABLE `price_page`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review_page`
--
ALTER TABLE `review_page`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article_page`
--
ALTER TABLE `article_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT для таблицы `authentication`
--
ALTER TABLE `authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `contact_page`
--
ALTER TABLE `contact_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `gallery_objects`
--
ALTER TABLE `gallery_objects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT для таблицы `gallery_page`
--
ALTER TABLE `gallery_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT для таблицы `home_page`
--
ALTER TABLE `home_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `meta`
--
ALTER TABLE `meta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `price_page`
--
ALTER TABLE `price_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `review_page`
--
ALTER TABLE `review_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `gallery_objects`
--
ALTER TABLE `gallery_objects`
  ADD CONSTRAINT `gallery_objects_ibfk_1` FOREIGN KEY (`object_id`) REFERENCES `gallery_page` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
