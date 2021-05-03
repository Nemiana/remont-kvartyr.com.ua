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
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    } 
}
//Get meta-tags for web-page
function get_meta_tags_query ($url) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Execute the request of meta-tags from DB
        if ($result = mysqli_query($link, "SELECT meta_title, meta_keywords, meta_description FROM meta WHERE page_url = '$url'")) {
            //Remember meta-tags
            $result_meta_tags = mysqli_fetch_row ($result);
            mysqli_free_result ($result);
        } else {
            //Default
            $result_meta_tags = ['', '', ''];
        }
        mysqli_close ($link);
        //Return meta-tags
        return $result_meta_tags;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
//Set meta-tags for web-page
function set_meta_tags_query ($url, $title, $keywords, $description) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //The query checks if a URL exists in the database
        $result = mysqli_query ($link, "SELECT 1 FROM meta WHERE page_url = '$url'");
        //If exists, then update record, else insert new record
        if (mysqli_fetch_row ($result)) {
            $sql = "UPDATE meta SET meta_title = ?, meta_keywords = ?, meta_description = ? WHERE page_url = '$url'";
        } else {
            $sql = "INSERT INTO meta (page_url, meta_title, meta_keywords, meta_description) VALUES ('$url', ?, ?, ?)";
        }
        mysqli_free_result ($result);
        //Prepare a statement and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'sss', $title, $keywords, $description);
        //If execute statement success
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Мета-теги збережено';
        } else { 
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося зберегти мета-теги';
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
function get_main_article () {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Execute the request of title and article from DB
        if ($result = mysqli_query ($link, "SELECT title, article FROM home_page")) {
            //Save data
            $result_article = mysqli_fetch_row ($result);
            mysqli_free_result ($result);
        } else {
            //Default
            $result_article = ['', ''];
        }
        mysqli_close ($link);
        return $result_article;    
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
function set_main_article ($title, $text) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //The query checks if the first record exists in the database
        $result = mysqli_query ($link, "SELECT 1 FROM home_page WHERE id = 1");
        //If exists, then update record, else insert new record
        if (mysqli_fetch_row ($result)) {
            $sql = "UPDATE home_page SET title = ?, article = ? WHERE id = 1";
        } else {
            $sql = "INSERT INTO home_page VALUES (1, ?, ?)";
        }
        mysqli_free_result ($result);
        //Prepare a statement and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'ss', $title, $text);
        //If execute statement success
        if (mysqli_stmt_execute ($stmt)) { 
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Заголовок і стаття збережені';
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося зберегти заголовок і статтю';
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
function get_contact_info () {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Execute the request of contact info from DB
        if ($result = mysqli_query ($link, "SELECT info_contact FROM contact_page")) {
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
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
function set_contact_info ($text) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //The query checks if the first record exists in the database
        $result = mysqli_query ($link, "SELECT 1 FROM contact_page WHERE id = 1");
        //If exists, then update record, else insert new record
        if (mysqli_fetch_row ($result)) {
            $sql = "UPDATE contact_page SET info_contact = ? WHERE id = 1";
        } else {
            $sql = "INSERT INTO contact_page VALUES (1, ?)";
        }
        mysqli_free_result ($result);
        //Prepare a statement and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 's', $text);
        //If execute statement success
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Контакти збережені';
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося зберегти контакти';
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
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
    //If file selected and can be opened for reading
    if ($_FILES[$price]['name'] && $handle = fopen ($_FILES[$price]['tmp_name'], 'rt')) {
        //Connect to DB
        if ($link = require ('/query/connect.php')) {
            //Read file line by line in cycle
            while (($input_string = fgetcsv ($handle, 2000, ';')) !== FALSE) {
                //If encoding success
                if ($convert_string = convert_1251_UTF ($input_string)) {
                    //Request for existence record with the same service
                    $sql = "SELECT 1 FROM price_page WHERE `service` = ?";
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
                        $sql = "UPDATE price_page SET price = ? WHERE `service` = ?";
                    //else insert new record
                    } else {
                        $sql = "INSERT INTO price_page (price, `service`) VALUES (?, ?)";
                    }
                    $stmt = mysqli_prepare ($link, $sql);
                    //Bind parameters for both variants
                    mysqli_stmt_bind_param ($stmt, 'ds', $convert_string[1], $convert_string[0]);
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
                    $_SESSION['text_message'] = 'Не вдалося конвертувати рядок файлу';
                }
            }
            if ($flag_result) {
                //Sets info message into session
                $_SESSION['type_message'] = 'success';
                $_SESSION['text_message'] = 'Прайс-лист оновлено';
            } else {
                //Sets info message into session
                $_SESSION['type_message'] = 'fail';
                $_SESSION['text_message'] = 'Не вдалося оновити прайс-лист';
            }
            mysqli_close($link);
            fclose ($handle);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
        }
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося завантажити файл';
    }
}
//Returns array of records with id, service and price from table DB or empty array
//Argument - flag for full (with ID) or short records
function get_price_list ($full) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Request to DB to extract all records with services and prices
        $result = mysqli_query ($link, "SELECT * FROM price_page");
        //Extracts rows in cycle
        while ($result_line = mysqli_fetch_row ($result)) {
            //Remember all string in array
            if ($full) {
                $price_list[] = $result_line;
            //Or only service and price
            } else {
                $price_list[] = [$result_line[1], $result_line[2]];
            }
        }
        mysqli_free_result ($result);
        return $price_list;
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
        return [];
    }
}
//Function for update record in DB, returns true if success and false if fail
function save_price_list ($id, $service, $price) {
    //If service and price not empty srtings
    if ($service != '' && $price != '') {
        //Connect to DB
        if ($link = require ('/query/connect.php')) {
            //Query for update service and price by the specified id
            $sql = "UPDATE price_page SET `service` = ?, price = ? WHERE id = ?";
            //Prepare and bind parameters
            $stmt = mysqli_prepare ($link, $sql);
            mysqli_stmt_bind_param ($stmt, 'sdd', $service, $price, $id);
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
function add_service_price ($new_service, $new_price) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Query for searching record with the same service
        $sql = "SELECT 1 FROM price_page WHERE `service` = ?";
        //Prepare and bind parameter
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 's', $new_service);
        //Execute, bind and fetch result in flag
        mysqli_stmt_execute ($stmt);
        mysqli_stmt_bind_result ($stmt, $flag_result);
        mysqli_stmt_fetch($stmt);
        //Delete statement and sql variables for next using
        unset ($stmt, $sql);
        //If record exists, updates it
        if ($flag_result) {
            $sql = "UPDATE price_page SET price = ? WHERE `service` = ?";
        //else inserts new record
        } else {
            $sql = "INSERT INTO price_page (price, `service`) VALUES (?, ?)";
        }
        //Prepare and bind parameters
        $stmt = mysqli_prepare ($link, $sql);
        mysqli_stmt_bind_param ($stmt, 'ds', $new_price, $new_service);
        if (mysqli_stmt_execute ($stmt)) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Послугу додано';
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося додати послугу';
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
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
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
//Get article by URL from DB
function get_article_by_url ($url) {
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
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
//Addition new article to table of DB
function add_article ($array_data) {
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
            $_SESSION['text_message'] = 'Статтю додано';
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося додати статтю';
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
//Save modified article to DB
function save_article ($array_data) {
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
            $_SESSION['text_message'] = 'Статтю збережено';
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося зберегти статтю';
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);    
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }   
}
//Delete artice by id
function delete_article ($id_article) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Delete article from DB by id
        if ($result = mysqli_query ($link, "DELETE FROM article_page WHERE id = '$id_article'")) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Статтю видалено';
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося видалити статтю';
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
//Delete image from article by id article
function delete_image_article ($id_article) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Clear field with image in record
        if ($result = mysqli_query ($link, "UPDATE article_page SET image_article = '' WHERE id = '$id_article'")) {
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Зображення видалено';
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося видалити зображення';
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
//Counts records in table by its name (for pagination)
function count_records ($table_name, $visible) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        if ($table_name == 'review_page' && $visible == 0) {
            $sql = "SELECT COUNT(*) FROM review_page WHERE check_publication = 1";
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
        //Select some fields of records with limit
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
        //Select some fields of records with limit
        if ($visible) {
            $sql = "SELECT id, text_review, name_user, date_publication_review, check_publication  
            FROM `$table_name` ORDER BY id DESC LIMIT ?, ?";
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
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
//Addition new review to table of DB
function add_review ($array_data) {
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
            $_SESSION['text_message'] = 'Відгук додано';
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося додати відгук';
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}
//Save modified review to DB
function save_review ($array_data) {
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
            $_SESSION['text_message'] = 'Відгук збережено';
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося зберегти відгук';
        }
        mysqli_stmt_close($stmt);
        mysqli_close ($link);    
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }   
}
//Delete review by id
function delete_review ($id_review) {
    //Connect to DB
    if ($link = require ('/query/connect.php')) {
        //Delete review from DB by id
        if ($result = mysqli_query ($link, "DELETE FROM review_page WHERE id = '$id_review'")) {
            //Sets info message into session
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Відгук видалено';
            mysqli_free_result ($result);
        } else {
            //Sets info message into session
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося видалити відгук';
        }
        mysqli_close ($link);
    } else {
        //Sets info message into session
        $_SESSION['type_message'] = 'fail';
        $_SESSION['text_message'] = 'Не вдалося підключитися до бази даних';
    }
}