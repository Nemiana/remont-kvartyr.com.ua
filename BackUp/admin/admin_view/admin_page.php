<?php session_start(); 
if ($_SESSION['user'] != 'admin') {
    header('Location: ../admin.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ремонт квартир і будинків | Адмін-панель</title>
    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/admin/admin_css/admin.css">
</head>
<body>
    <p>Wellcome to admin panel!</p>
    <!-- EXIT FROM ADMIN PANEL-->
    <form method="POST" action="exit.php">
        <button type="submit">Exit</button>
    </form>
    <!-- END EXIT -->
</body>
</html>