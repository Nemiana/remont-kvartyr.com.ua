<?php
    session_start();
    unset ($_SESSION['user']);
    unset ($_SESSION['rights']);
    session_destroy();
    header('Location: /admin/');
    exit();