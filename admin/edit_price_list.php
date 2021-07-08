<?php
    //Page for processing all actions, sends by ajax
    require_once ('/query/queries.php');
    //
    if (session_status () == PHP_SESSION_NONE) {
        session_start();
    }
    //If not login user with access rights 'admin', exit to start page
    if (!isset($_SESSION['user']) || $_SESSION['rights'] != 'admin') {
        header('Location: /admin/');
        exit();
    };
    //If via POST was sent action 'save'
    if ($_POST['action'] == 'save') {
        //Calls function for update record and sets info message into session
        if (save_price_list ($_POST)) {
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Дані збережено';
        } else {
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося зберегти дані';
        };
    //If via POST was sent action 'delete'
    } elseif ($_POST['action'] == 'delete') {
        //Calls function for delete record and sets info message into session
        if (delete_price_list ($_POST['id'])) {
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Дані видалено';
        } else {
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося видалити дані';
        };
    //If via POST was sent action 'save all'
    } elseif ($_POST['action'] == 'save_all') {
        //Saves collections with id, service, price
        $id_collection = $_POST['id_array'];
        $service_ukr_collection = $_POST['service_ukr_array'];
        $service_rus_collection = $_POST['service_rus_array'];
        $service_eng_collection = $_POST['service_eng_array'];
        $price_collection = $_POST['price_array'];
        $flag_result = true;
        //Calls update function for every record in cycle
        for ($i = 0; $i < count ($id_collection); $i++) {
            $array_data = [ 'id' => $id_collection[$i], 'service_ukr' => $service_ukr_collection[$i], 
                'service_rus' => $service_rus_collection[$i], 'service_eng' => $service_eng_collection[$i],
                'price' => $price_collection[$i] ];
            //If was fail update, changes success flag
            if (!save_price_list ($array_data)) {
                $flag_result = false;
                break;
            }
        };
        //Sets info message into session
        if ($flag_result) {
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Дані збережено';
        } else {
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося зберегти дані';
        };
    //If via POST was sent action 'delete all'
    } elseif ($_POST['action'] == 'delete_all') {
        //Saves id collection
        $id_collection = $_POST['id_array'];
        $flag_result = true;
        //Calls delete function for every record in cycle
        for ($i = 0; $i < count ($id_collection); $i++) {
            //If was fail delete, changes success flag
            if (!delete_price_list ($id_collection[$i])) {
                $flag_result = false;
                break;
            }
        }
        //Sets info message into session
        if ($flag_result) {
            $_SESSION['type_message'] = 'success';
            $_SESSION['text_message'] = 'Дані видалено';
        } else {
            $_SESSION['type_message'] = 'fail';
            $_SESSION['text_message'] = 'Не вдалося видалити дані';
        };
    };