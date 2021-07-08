<?php
    require_once ('/query/queries.php');
    //If session is not exists, creates it
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    //If not login user with access rights 'admin', exit to start page
    if (!isset($_SESSION['user']) || $_SESSION['rights'] != 'admin') {
        header('Location: /admin/');
        exit();
    };
    //Opens a write stream for a temporary file
    $file_price = fopen ('php://memory', 'w');
    //Delimiter for records in the file
    $delimiter = ';';
    //Name of the output file
    $file_name = 'export_price.csv';
    //Extract price-list
    $result = get_price_list ();
    //If price list not empty, encoding string from UTF-8 to Windows-1251 and write into .csv file in cycle
    if ($result) {
        foreach ($result as $value) {
            //Delete first element of array - field id
            array_shift ($value);
            fputcsv ($file_price, convert_UTF_1251 ($value), $delimiter);
        }
    };
    //Sets a file pointer in the beginning of the file
    fseek ($file_price, 0);
    //Sending headers with type and name file
    header ('Content-Type: application/csv');
    header ('Content-Disposition: attachment; filename = "'.$file_name.'";');
    //Outputs all data from the file pointer into output stream
    fpassthru($file_price);