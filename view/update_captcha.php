<?php
    $captcha_images = parse_ini_file ('/config/captcha.php');
    echo array_keys ($captcha_images) [rand (0, count($captcha_images) - 1)];
