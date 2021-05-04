<?php
    //Parses names and values from config-file
    $captcha_images = parse_ini_file ('/config/captcha.php');
    //Return random image name - key of assoc. array
    echo array_keys ($captcha_images) [rand (0, count($captcha_images) - 1)];
