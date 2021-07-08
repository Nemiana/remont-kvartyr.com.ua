<?php
//Shows action message if it exists one time
function show_info_message () {
    if (isset ($_SESSION['type_message'])) {
        ?><script> pop_up_window ('<?= $_SESSION['type_message'] ?>', '<?= $_SESSION['text_message'] ?>');</script><?php
        unset ($_SESSION['type_message'], $_SESSION['text_message']);
    }
}
//Check login, password and return access rights
function check_authentication ($name, $pass) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Query username, password and access rights by entered name
        $sql = "SELECT name_user, password_user, access_rights FROM `authentication` WHERE name_user = ?";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, 's', $name);
        mysqli_stmt_execute ($stmt);
        mysqli_stmt_bind_result($stmt, $result_name, $result_pass, $result_rights);
        if (mysqli_stmt_fetch($stmt)) {
            //Compares password from user and DB
            if (password_verify ($pass, $result_pass)) {
                //Remember name and access rights
                $result_check = [$result_name, $result_rights];
                mysqli_stmt_close($stmt);
            }
        } else {
            $result_check = false;
        }
        mysqli_close($link);
        //Return name and access rights or false
        return $result_check;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    } 
}
//Get meta-tags for web-page
function get_meta_tags_query ($url) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Execute the request of meta-tags from DB
        if ($result = mysqli_query($link, "SELECT * FROM meta WHERE page_url = '$url'")) {
            //Remember meta-tags
            $result_meta_tags = mysqli_fetch_row ($result);
            mysqli_free_result ($result);
        } else {
            //Default
            $result_meta_tags = [];
        }
        mysqli_close ($link);
        //Return meta-tags
        return $result_meta_tags;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Set meta-tags for web-page
function set_meta_tags_query ($url, $array_data) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //The query checks if a URL exists in the database
        $result = mysqli_query ($link, "SELECT * FROM meta WHERE page_url = '$url'");
        //If exists, then update record, else insert new record
        if ($row = mysqli_fetch_row ($result)) {
            $sql = "UPDATE meta SET meta_title_ukr = ?, meta_keywords_ukr = ?, meta_description_ukr = ?,
                meta_title_rus = ?, meta_keywords_rus = ?, meta_description_rus = ?,
                meta_title_eng = ?, meta_keywords_eng = ?, meta_description_eng = ? WHERE id = '$row[0]'";
        } else {
            $sql = "INSERT INTO meta (page_url, meta_title_ukr, meta_keywords_ukr, meta_description_ukr,
                meta_title_rus, meta_keywords_rus, meta_description_rus,
                meta_title_eng, meta_keywords_eng, meta_description_eng) VALUES ('$url', ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        }
        mysqli_free_result ($result);
        //Prepare a statement and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'sssssssss', 
            $array_data['meta_title_ukr'], $array_data['meta_keywords_ukr'], $array_data['meta_description_ukr'],
            $array_data['meta_title_rus'], $array_data['meta_keywords_rus'], $array_data['meta_description_rus'],
            $array_data['meta_title_eng'], $array_data['meta_keywords_eng'], $array_data['meta_description_eng']);
        //If execute statement success
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_meta_tags'];
        } else { 
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_meta_tags'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Gets title and article in three languages for home page
function get_main_article () {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Execute the request of title and article from DB
        if ($result = mysqli_query ($link, "SELECT * FROM home_page")) {
            //Save data
            $result_article = mysqli_fetch_row ($result);
            mysqli_free_result ($result);
        } else {
            //Default
            $result_article = [];
        }
        mysqli_close ($link);
        return $result_article;    
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Sets title and article in three languages for home page
function set_main_article ($array_data) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //The query checks if the at least one record exists in the database
        $result = mysqli_query ($link, "SELECT * FROM home_page");
        //If exists, then update record, else insert new record
        if ($row = mysqli_fetch_row ($result)) {
            $sql = "UPDATE home_page SET title_ukr = ?, article_ukr = ?, title_rus = ?, article_rus = ?, 
                    title_eng = ?, article_eng = ? WHERE id = '$row[0]'";
        } else {
            $sql = "INSERT INTO home_page (title_ukr, article_ukr, title_rus, article_rus, 
                    title_eng, article_eng) VALUES (?, ?, ?, ?, ?, ?)";
        }
        mysqli_free_result ($result);
        //Prepare a statement and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'ssssss', $array_data['title_article_ukr'], $array_data['text_article_ukr'], 
            $array_data['title_article_rus'], $array_data['text_article_rus'],
            $array_data['title_article_eng'], $array_data['text_article_eng']);
        //If execute statement success
        if (mysqli_stmt_execute ($stmt)) { 
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_main_article'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_main_article'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Gets contact info in three languages for contact page
function get_contact_info () {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Execute the request of contact info from DB
        if ($result = mysqli_query ($link, "SELECT * FROM contact_page")) {
            //Save data
            $result_contact = mysqli_fetch_row ($result);
            mysqli_free_result ($result);
        } else {
            //Default
            $result_contact = '';
        }
        mysqli_close ($link);
        return $result_contact;    
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Sets contact info in three languages for contact page
function set_contact_info ($array_data) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //The query checks if the at least one record exists in the database
        $result = mysqli_query ($link, "SELECT * FROM contact_page");
        //If exists, then update record, else insert new record
        if ($row = mysqli_fetch_row ($result)) {
            $sql = "UPDATE contact_page SET info_contact_ukr = ?, info_contact_rus = ?, info_contact_eng = ? WHERE id = '$row[0]'";
        } else {
            $sql = "INSERT INTO contact_page (info_contact_ukr, info_contact_rus, info_contact_eng) VALUES (?, ?, ?)";
        }
        mysqli_free_result ($result);
        //Prepare a statement and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'sss', $array_data['contact_text_ukr'], $array_data['contact_text_rus'], $array_data['contact_text_eng']);
        //If execute statement success
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_contact'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_contact'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Convert every string in array from Windows-1251 to UTF-8 encoding
function convert_1251_UTF ($array) {
    foreach ($array as $value) {
        $result[] = iconv ('Windows-1251', 'UTF-8', $value);
    }
    return $result;
}
//Convert every string in array from UTF-8 to Windows-1251 encoding
function convert_UTF_1251 ($array) {
    foreach ($array as $value) {
        $result[] = iconv ('UTF-8', 'Windows-1251', $value);
    }
    return $result;
}
//Reload or redirect page
function reload ($path = '') {
    //If no path is passed, reloads current page
    if (!$path) $path = $_SERVER['PHP_SELF'];
    //else redirect to new page
    $location = 'http://'.$_SERVER['HTTP_HOST'].$path;
    echo '<meta http-equiv="Refresh" Content="0; URL='.$location.'">';
}
//Import prices and services from .csv file into DB table
function import_file_price ($price) {
    global $translate;
    //If file selected and can be opened for reading
    if ($_FILES[$price]['name'] && $handle = fopen ($_FILES[$price]['tmp_name'], 'rt')) {
        //Connect to DB
        if ($link = require ('/query/connect.php')) {
            //Read file line by line in cycle
            while (($input_string = fgetcsv ($handle, 2000, ';')) !== FALSE) {
                //If encoding success
                if ($convert_string = convert_1251_UTF ($input_string)) {
                    //Request for existence record with the same service
                    $sql = "SELECT 1 FROM price_page WHERE service_ukr = ?";
                    $stmt = mysqli_prepare ($link, $sql);
                    //Bind parameter from the first element of array
                    mysqli_stmt_bind_param ($stmt, 's', $convert_string[0]);
                    mysqli_stmt_execute ($stmt);
                    //Bind result into flag
                    mysqli_stmt_bind_result ($stmt, $flag_result);
                    mysqli_stmt_fetch($stmt);
                    //Delete statement and sql variables for next using
                    unset ($stmt, $sql);
                    //If record exists, update record by serice field
                    if ($flag_result) {
                        $sql = "UPDATE price_page SET service_rus = ?, service_eng = ?, price = ? WHERE service_ukr = ?";
                    //else insert new record
                    } else {
                        $sql = "INSERT INTO price_page (service_rus, service_eng, price, service_ukr) VALUES (?, ?, ?, ?)";
                    }
                    $stmt = mysqli_prepare ($link, $sql);
                    //Bind parameters for both variants
                    mysqli_stmt_bind_param ($stmt, 'ssds', $convert_string[1], $convert_string[2], $convert_string[3], $convert_string[0]);
                    //If execute statement success, flag = true, continue
                    if (mysqli_stmt_execute ($stmt)) { 
                        $flag_result = true;
                    //else flag = false, break cycle
                    } else { 
                        $flag_result = false;
                        break;
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    //Sets info message into session
                    $_SESSION['type_message'] = 'fail';
                    $_SESSION['text_message'] = $translate['message_fail_convert'];
                }
            }
            if ($flag_result) {
                //Sets info message into session
                $_SESSION['type_message'] = 'success';
                $_SESSION['text_message'] = $translate['message_success_price_list'];
            } else {
                //Sets info message into session
                $_SESSION['type_message'] = 'fail';
                $_SESSION['text_message'] = $translate['message_fail_price_list'];
            }
            mysqli_close($link);
            fclose ($handle);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_db'];
        }
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_upload'];
    }
}
//Returns array of records with id, service and price from table DB or empty array
//Argument - flag for full (with ID) or short records
function get_price_list () {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Request to DB to extract all records with services and prices
        $result = mysqli_query ($link, "SELECT * FROM price_page");
        //Extracts rows in cycle
        while ($result_line = mysqli_fetch_row ($result)) {
            //Remember all string in array
            $price_list[] = $result_line;
        }
        mysqli_free_result ($result);
        return $price_list;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
        return [];
    }
}
//Function for update record in DB, returns true if success and false if fail
function save_price_list ($array_data) {
    //If service and price not empty srtings
    if ($array_data['service_ukr'] != '' && $array_data['price'] != '') {
        //Connect to DB
        if ($link = require ('/query/connect.php')) {
            //Query for update service and price by the specified id
            $sql = "UPDATE price_page SET service_ukr = ?, service_rus = ?, service_eng = ?, price = ? WHERE id = ?";
            //Prepare and bind parameters
            $stmt = mysqli_prepare ($link, $sql);
            mysqli_stmt_bind_param ($stmt, 'sssdd', $array_data['service_ukr'], $array_data['service_rus'], 
            $array_data['service_eng'], $array_data['price'], $array_data['id']);
            //Returns result of executing
            if (mysqli_stmt_execute ($stmt)) {
                return true;
            } else {
                return false;
            }
            mysqli_stmt_close($stmt);
            mysqli_close ($link);
        } else {
            return false;
        }
   } else {
        return false;
    }
}
//Function for delete record from DB, returns true if success and false if fail
function delete_price_list ($id) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Query for delete record by the specified id
        $sql = "DELETE FROM price_page WHERE id = ?";
        //Prepare and bind parameter
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'd', $id);
        //Returns result of executing
        if (mysqli_stmt_execute ($stmt)) {
            return true;
        } else {
            return false;
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        return false;
    }
}
//Function for adding new record to DB or update if servise already exists
function add_service_price ($array_data) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Query for searching record with the same service
        $sql = "SELECT 1 FROM price_page WHERE service_ukr = ?";
        //Prepare and bind parameter
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 's', $array_data['new_service_ukr']);
        //Execute, bind and fetch result in flag
        mysqli_stmt_execute ($stmt);
        mysqli_stmt_bind_result ($stmt, $flag_result);
        mysqli_stmt_fetch($stmt);
        //Delete statement and sql variables for next using
        unset ($stmt, $sql);
        //If record exists, updates it
        if ($flag_result) {
            $sql = "UPDATE price_page SET service_rus = ?, service_eng = ?, price = ? WHERE service_ukr = ?";
        //else inserts new record
        } else {
            $sql = "INSERT INTO price_page (service_rus, service_eng, price, service_ukr) VALUES (?, ?, ?, ?)";
        }
        //Prepare and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'ssds', $array_data['new_service_rus'], $array_data['new_service_eng'],
        $array_data['new_price'], $array_data['new_service_ukr']);
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_price_service'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_price_service'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }  
}
//Converting strings to SEF URL
function transliteration ($string_url) {
    //Replaces all spaces to minuses
    $string_url = str_replace (' ', '-', $string_url);
    //Converts to lower case latin and cyrillic
    $string_url = mb_strtolower ($string_url, 'UTF-8');
    //Arrays of cyrillic and latin letters
    $cyrillic_array = ['а', 'б', 'в', 'г', 'ґ', 'д', 'е', 'є', 'ж', 'з', 'и', 'і', 'ї', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ю', 'я', 'ё', 'ъ', 'ы', 'э'];
    $latin_array = ['a', 'b', 'v', 'h', 'g', 'd', 'e', 'ie', 'zh', 'z', 'y', 'i', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'ts', 'ch', 'sh', 'shch', '', 'iu', 'ia', 'yo', '', 'y', 'eh'];
    //Letters transliteration
    $string_url = str_replace ($cyrillic_array, $latin_array, $string_url);
    //Replace all not-letters and not-digits except '-' to empty string
    $string_url = preg_replace ("/[^\w-]/", "", $string_url);
    return $string_url;
}
//Get article by id from DB
function get_article ($id_article) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Fields names from table for associative array
        $array_keys = ['id', 'meta_title', 'meta_keywords', 'meta_description', 'title_article', 'url',  
            'text_article', 'date_publication_article', 'image_article'];
        //Check record with received id
        $result = mysqli_query($link, "SELECT 1 FROM article_page WHERE id  = '$id_article'");
        //If record exists
        if (mysqli_fetch_row ($result)){
            //Free memory
            mysqli_free_result ($result);
            //Get all record from DB
            $result = mysqli_query($link, "SELECT * FROM article_page WHERE id  = '$id_article'");
            $result_article = mysqli_fetch_row ($result);
            //Combine array of keys and array of values (to get an associative array)
            $article = array_combine ($array_keys, $result_article);
            //Free memory again
            mysqli_free_result ($result);
        } else {
            //If record not exists, return empty associative array with keys
            $article = array_fill_keys ($array_keys, '');
            mysqli_free_result ($result);
        };
        mysqli_close ($link);
        return $article;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Get article by URL from DB
function get_article_by_url ($url) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Fields names from table for associative array
        $array_keys = ['id', 'meta_title', 'meta_keywords', 'meta_description', 'title_article', 'url',  
            'text_article', 'date_publication_article', 'image_article'];
        //Get record with received URL
        $result = mysqli_query ($link, "SELECT * FROM article_page WHERE `url` = '$url'");
        if ($result_line = mysqli_fetch_row ($result)) {
            //If record exists, combine array of keys and array of values (to get an associative array)
            $article = array_combine ($array_keys, $result_line);
        } else {
            //Else return empty associative array with keys
            $article = array_fill_keys ($array_keys, '');
        }
        //Free memory and close connection
        mysqli_free_result ($result);
        mysqli_close ($link);
        return $article;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Addition new article to table of DB
function add_article ($array_data) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //If date not filled, use current date
        $date_publish = $array_data['date_creation_article'] ? $array_data['date_creation_article'] : date('Y-m-d');
        //Not allow to enter a date greater than the current one
        $date_publish = strtotime ($date_publish) > strtotime (date('Y-m-d')) ? date('Y-m-d') : $date_publish;
        //If URL not filled, transliterated title, else transliterated URL
        $url_article = $array_data['url_article'] ? transliteration ($array_data['url_article']) : transliteration ($array_data['title_article']);
        //Search article by title (avoid duplication)
        $sql = "SELECT 1 FROM article_page WHERE title_article = ?";
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 's', $array_data['title_article']);
        //Execute, bind and fetch result in flag
        mysqli_stmt_execute ($stmt);
        mysqli_stmt_bind_result ($stmt, $flag_result);
        mysqli_stmt_fetch($stmt);
        //Delete statement and sql variables for next using
        unset ($stmt, $sql);
        //If record exists, updates it
        if ($flag_result) {
            $sql = "UPDATE article_page SET meta_title = ?, meta_keywords = ?, meta_description = ?, `url` = ?, 
                text_article = ?, date_publication_article = ?, image_article = ? WHERE title_article = ?";
        //else inserts new record
        } else {
            $sql = "INSERT INTO article_page (meta_title, meta_keywords, meta_description, `url`, 
                text_article, date_publication_article, image_article, title_article) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        }
        //Prepare and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'ssssssss', $array_data['meta_title'], $array_data['meta_keywords'], 
            $array_data['meta_description'], $url_article, $array_data['text_article'], $date_publish, 
            $array_data['image_article'], $array_data['title_article']);
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_add_article'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_add_article'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Save modified article to DB
function save_article ($array_data) {
    global $translate;
    $id_article = $array_data['id_article'];
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //If date not filled, use current date
        $date_publish = $array_data['date_creation_article'] ? $array_data['date_creation_article'] : date('Y-m-d');
        //Not allow to enter a date greater than the current one
        $date_publish = strtotime ($date_publish) > strtotime (date('Y-m-d')) ? date('Y-m-d') : $date_publish;
        //If URL not filled, transliterated title, else transliterated URL
        $url_article = $array_data['url_article'] ? transliteration ($array_data['url_article']) : transliteration ($array_data['title_article']);
        //If image selection made, upgrade record in DB (else not touch image!)
        if ($array_data['image_article']) {
            $sql = "UPDATE article_page SET image_article = ? WHERE id = '$id_article'";
            $stmt = mysqli_prepare ($link, $sql);
            mysqli_stmt_bind_param ($stmt, 's', $array_data['image_article']);
            mysqli_stmt_execute ($stmt);
            unset ($stmt, $sql);
        }
        //Upgrade all other fields in table with prepared statements
        $sql = "UPDATE article_page SET meta_title = ?, meta_keywords = ?, meta_description = ?, 
                title_article = ?, `url` = ?, text_article = ?, date_publication_article = ? 
                WHERE id = '$id_article'";
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'sssssss', $array_data['meta_title'], $array_data['meta_keywords'], 
        $array_data['meta_description'], $array_data['title_article'], $url_article, $array_data['text_article'], 
        $date_publish);
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_save_article'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_save_article'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);    
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }   
}
//Delete artice by id
function delete_article ($id_article) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Delete article from DB by id
        if ($result = mysqli_query ($link, "DELETE FROM article_page WHERE id = '$id_article'")) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_delete_article'];
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_delete_article'];
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Delete image from article by id article
function delete_image_article ($id_article) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Clear field with image in record
        if ($result = mysqli_query ($link, "UPDATE article_page SET image_article = '' WHERE id = '$id_article'")) {
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_delete_image'];
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_delete_image'];
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Counts records in table by its name (for pagination)
function count_records ($table_name, $visible) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //For page review show only available records
        if ($table_name == 'review_page' && $visible == 0) {
            $sql = "SELECT COUNT(*) FROM review_page WHERE check_publication = 1";
        //For others - show all
        } else {
            $sql = "SELECT COUNT(*) FROM `$table_name`";
        }
        //Count all records
        if ($result = mysqli_query ($link, $sql)) {
            //Result is array with one element with index 0
            $count = mysqli_fetch_row ($result)[0];
            mysqli_free_result ($result);
        } else {
            $count = -1;
        }
        mysqli_close ($link);
    } else {
        $count = -1;
    }
    return $count;
}
//Get range of article records (for pagination)
function get_article_records ($table_name, $start, $amount) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Select some fields of records with limit in reverse order
        $sql = "SELECT id, title_article, url, text_article, date_publication_article, image_article 
            FROM `$table_name` ORDER BY id DESC LIMIT ?, ?";
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'dd', $start, $amount);
        mysqli_stmt_execute ($stmt);
        mysqli_stmt_bind_result($stmt, $id, $title_article, $url, $text_article, $date_publication_article, $image_article);
        //Extract records in loop and adds to collection
        while (mysqli_stmt_fetch($stmt)) {
            $collection[] = [
                            'id' => $id, 
                            'title_article' => $title_article,
                            'url' => $url,
                            'text_article' => $text_article,
                            'date_publication_article' => $date_publication_article,
                            'image_article' => $image_article
                            ];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        $collection = [];
    }
    return $collection;
}
//Get range of review records (for pagination)
function get_review_records ($table_name, $start, $amount, $visible) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Select some fields of records with limit in reverse order
        //For admin page review
        if ($visible) {
            $sql = "SELECT id, text_review, name_user, date_publication_review, check_publication  
            FROM `$table_name` ORDER BY id DESC LIMIT ?, ?";
        //For page review (only available records)
        } else {
            $sql = "SELECT id, text_review, name_user, date_publication_review, check_publication  
            FROM `$table_name` WHERE check_publication = 1 ORDER BY id DESC LIMIT ?, ?";
        }
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'dd', $start, $amount);
        mysqli_stmt_execute ($stmt);
        mysqli_stmt_bind_result($stmt, $id, $text_review, $name_user, $date_publication_review, $check_publication);
        //Extract records in loop and adds to collection
        while (mysqli_stmt_fetch($stmt)) {
            $collection[] = [
                            'id' => $id, 
                            'text_review' => $text_review,
                            'name_user' => $name_user,
                            'date_publication_review' => $date_publication_review,
                            'check_publication' => $check_publication
                            ];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        $collection = [];
    }
    return $collection;
}
//Get review by id from DB
function get_review ($id_review) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Fields names from table for associative array
        $array_keys = ['id', 'text_review', 'name_user', 'date_publication_review', 'check_publication'];
        //Check record with received id
        $result = mysqli_query($link, "SELECT 1 FROM review_page WHERE id  = '$id_review'");
        //If record exists
        if (mysqli_fetch_row ($result)){
            //Free memory
            mysqli_free_result ($result);
            //Get full record from DB
            $result = mysqli_query($link, "SELECT * FROM review_page WHERE id  = '$id_review'");
            $result_review = mysqli_fetch_row ($result);
            //Combine array of keys and array of values (to get an associative array)
            $review = array_combine ($array_keys, $result_review);
            //Free memory again
            mysqli_free_result ($result);
        } else {
            //If record not exists, return empty associative array with keys
            $review = array_fill_keys ($array_keys, '');
            mysqli_free_result ($result);
        };
        mysqli_close ($link);
        return $review;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Addition new review to table of DB
function add_review ($array_data) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //If date not filled, use current date
        $date_publish = $array_data['date_publication_review'] ? $array_data['date_publication_review'] : date('Y-m-d');
        //Not allow to enter a date greater than the current one
        $date_publish = strtotime ($date_publish) > strtotime (date('Y-m-d')) ? date('Y-m-d') : $date_publish;
        $sql = "INSERT INTO review_page (text_review, name_user, date_publication_review, check_publication) 
            VALUES (?, ?, ?, ?)";
        //Prepare and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'ssss', $array_data['text_review'], $array_data['name_user'], $date_publish, $array_data['check_publication']);
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_add_review'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_add_review'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Save modified review to DB
function save_review ($array_data) {
    global $translate;
    $id_review = $array_data['id_review'];
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //If date not filled, use current date
        $date_publish = $array_data['date_publication_review'] ? $array_data['date_publication_review'] : date('Y-m-d');
        //Not allow to enter a date greater than the current one
        $date_publish = strtotime ($date_publish) > strtotime (date('Y-m-d')) ? date('Y-m-d') : $date_publish;
        //Upgrade all other fields in table with prepared statements
        $sql = "UPDATE review_page SET text_review = ?, name_user = ?, date_publication_review = ?, check_publication = ?
                WHERE id = '$id_review'";
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'ssss', $array_data['text_review'], $array_data['name_user'], $date_publish, $array_data['check_publication']);
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_save_review'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_save_review'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);    
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }   
}
//Delete review by id
function delete_review ($id_review) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Delete review from DB by id
        if ($result = mysqli_query ($link, "DELETE FROM review_page WHERE id = '$id_review'")) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_delete_review'];
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_delete_review'];
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Get range of gallery records (for pagination)
function get_gallery_records ($table_name, $start, $amount) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Select some fields of records with limit in reverse order
        $sql = "SELECT id, object_name, object_start_image 
            FROM `$table_name` ORDER BY id DESC LIMIT ?, ?";
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'dd', $start, $amount);
        mysqli_stmt_execute ($stmt);
        mysqli_stmt_bind_result($stmt, $id, $object_name, $object_start_image);
        //Extract records in loop and adds to collection
        while (mysqli_stmt_fetch($stmt)) {
            $collection[] = [
                            'id' => $id, 
                            'object_name' => $object_name,
                            'object_start_image' => $object_start_image
                            ];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        $collection = [];
    }
    return $collection;
}
//Delete gallery object by id
function delete_gallery ($id_gallery) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Delete gallery object from DB by id
        if ($result = mysqli_query ($link, "DELETE FROM gallery_page WHERE id = '$id_gallery'")) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_delete_gallery'];
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_delete_gallery'];
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Get gallery object by id from DB
function get_gallery ($id_gallery) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Fields names from table for associative array
        $array_keys = ['id', 'object_name', 'object_start_image'];
        //Check record with received id
        $result = mysqli_query($link, "SELECT 1 FROM gallery_page WHERE id  = '$id_gallery'");
        //If record exists
        if (mysqli_fetch_row ($result)){
            //Free memory
            mysqli_free_result ($result);
            //Get all record from DB
            $result = mysqli_query($link, "SELECT * FROM gallery_page WHERE id  = '$id_gallery'");
            $result_gallery = mysqli_fetch_row ($result);
            //Combine array of keys and array of values (to get an associative array)
            $gallery = array_combine ($array_keys, $result_gallery);
            //Free memory again
            mysqli_free_result ($result);
        } else {
            //If record not exists, return empty associative array with keys
            $gallery = array_fill_keys ($array_keys, '');
            mysqli_free_result ($result);
        };
        mysqli_close ($link);
        return $gallery;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Get images array of gallery object by object id
function get_gallery_images ($id_gallery) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Fields names from table for associative array
        $array_keys = ['id', 'object_id', 'object_image', 'image_description'];
        //Check record with received id
        $result = mysqli_query($link, "SELECT 1 FROM gallery_objects WHERE object_id  = '$id_gallery'");
        //If at least one record exists
        if (mysqli_fetch_row ($result)){
            //Free memory
            mysqli_free_result ($result);
            //Get all records from DB
            $result = mysqli_query($link, "SELECT * FROM gallery_objects WHERE object_id  = '$id_gallery'");
            while ($result_gallery = mysqli_fetch_row ($result)) {
                $gallery[] = array_combine ($array_keys, $result_gallery);
            }
            //Free memory again
            mysqli_free_result ($result);
        } else {
            //If record not exists, return empty string
            $gallery = '';
            mysqli_free_result ($result);
        };
        mysqli_close ($link);
        return $gallery;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Addition new gallery object to table of DB
function add_gallery ($array_data) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Insert new gallery object
        $sql = "INSERT INTO gallery_page (object_name, object_start_image) VALUES (?, ?)";
        //Prepare and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'ss', $array_data['object_name'], $array_data['object_start_image']);
        if (mysqli_stmt_execute ($stmt)) {
            //Delete statement and sql variables for next using
            unset ($stmt, $sql);
            //Receive id just added object
            $sql = "SELECT id FROM gallery_page WHERE object_name = ? AND object_start_image = ?";
            $stmt = mysqli_prepare ($link, $sql);
            mysqli_stmt_bind_param ($stmt, 'ss', $array_data['object_name'], $array_data['object_start_image']);
            if (mysqli_stmt_execute ($stmt)) {
                //Remember object id and unset variables
                mysqli_stmt_bind_result($stmt, $id_gallery);
                mysqli_stmt_fetch($stmt);
                unset ($stmt, $sql);
            } else {
                $id_gallery = 0;
            }
            //Inserting images of gallery object in second table by object id (foreign key)
            $sql = "INSERT INTO gallery_objects (object_id, object_image, image_description) VALUES (?, ?, ?)";
            //Prepare and bind parameters
            $stmt = mysqli_prepare ($link, $sql);
            //Image may be without description
            if ($array_data['object_image']) {
                //Inserting records to table in cycle
                for ($i = 0; $i < count ($array_data['object_image']); $i++) {
                    mysqli_stmt_bind_param ($stmt, 'sss', $id_gallery, $array_data['object_image'][$i], $array_data['image_description'][$i]);
                    mysqli_stmt_execute ($stmt);
                }
            }   
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_add_gallery'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_add_gallery'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_db'];
        }
}
//Save modified gallery object to DB
function save_gallery ($array_data) {
    global $translate;
    $id_gallery = $array_data['id_gallery_object'];
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //If image selection made, upgrade record in DB (else not touch image!)
        if ($array_data['object_start_image']) {
            $sql = "UPDATE gallery_page SET object_start_image = ? WHERE id = '$id_gallery'";
            $stmt = mysqli_prepare ($link, $sql);
            mysqli_stmt_bind_param ($stmt, 's', $array_data['object_start_image']);
            mysqli_stmt_execute ($stmt);
            unset ($stmt, $sql);
        }
        //Change name of gallery object
        $sql = "UPDATE gallery_page SET object_name = ? WHERE id = '$id_gallery'";
        //Prepare and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 's', $array_data['object_name']);
        if (mysqli_stmt_execute ($stmt)) {
            //If object has at least one image, iterate them in cycle
            if ($array_data['object_image']) {
                for ($i = 0; $i < count ($array_data['object_image']); $i++) {
                    //If current image exists (not new!)
                    if ($array_data['id_gallery_image'][$i] > 0) {
                        $id_image = $array_data['id_gallery_image'][$i];
                        //If image selection made, upgrade record in DB (else not touch image!)
                        if ($array_data['object_image'][$i]) {
                            $sql = "UPDATE gallery_objects SET object_image = ? WHERE id = '$id_image'";
                            $stmt = mysqli_prepare ($link, $sql);
                            mysqli_stmt_bind_param ($stmt, 's', $array_data['object_image'][$i]);
                            mysqli_stmt_execute ($stmt);
                            unset ($stmt, $sql);
                        }
                        //Update other fields (except image)
                        $sql = "UPDATE gallery_objects SET object_id = ?, image_description = ? WHERE id = '$id_image'";
                        //Prepare and bind parameters
                        $stmt = mysqli_prepare ($link, $sql);
                        mysqli_stmt_bind_param ($stmt, 'ss', $id_gallery, $array_data['image_description'][$i]);
                        mysqli_stmt_execute ($stmt);
                        unset ($stmt, $sql);
                    } else {
                        //Adding new image
                        $sql = "INSERT INTO gallery_objects (object_id, object_image, image_description) VALUES (?, ?, ?)";
                        //Prepare and bind parameters
                        $stmt = mysqli_prepare ($link, $sql);
                        mysqli_stmt_bind_param ($stmt, 'sss', $id_gallery, $array_data['object_image'][$i], $array_data['image_description'][$i]);
                        mysqli_stmt_execute ($stmt);
                        unset ($stmt, $sql);
                    }
                    
                }
            }
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_save_gallery'];
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_save_gallery'];
        }
        //mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Delete start image from gallery object by id
function delete_gallery_start_image ($id_gallery) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Clear field with image in record
        if ($result = mysqli_query ($link, "UPDATE gallery_page SET object_start_image = '' WHERE id = '$id_gallery'")) {
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_delete_image'];
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_delete_image'];
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}
//Delete image from gallery object by image id
function delete_gallery_image ($id_image) {
    global $translate;
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Delete image record by image id
        if ($result = mysqli_query ($link, "DELETE FROM gallery_objects WHERE id = '$id_image'")) {
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = $translate['message_success_delete_image'];
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = $translate['message_fail_delete_image'];
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = $translate['message_fail_db'];
    }
}