//Script for processing actions with price-list
'use strict';
//Table with price-list
let tablePrice = document.querySelector('.price-list');
//Event for click over all table
tablePrice.addEventListener('click', function (event) {
    //Stores action from data-* attribute
    let action = event.target.dataset.action;
    //Values for current record
    let id_price_list, service_ukr_price_list, service_rus_price_list, service_eng_price_list, price_price_list;
    //Arrays for stores all values all records (group actions)
    let id_collection = [], service_ukr_collection = [], service_rus_collection = [];
    let service_eng_collection = [], price_collection = [];
    //For single actions reads values from current row of the table
    if (action == 'save' || action == 'delete') {
        id_price_list = event.target.parentNode.parentNode.children[0].value;
        service_ukr_price_list = event.target.parentNode.parentNode.children[1].firstChild.value;
        service_rus_price_list = event.target.parentNode.parentNode.children[2].firstChild.value;
        service_eng_price_list = event.target.parentNode.parentNode.children[3].firstChild.value;
        price_price_list = event.target.parentNode.parentNode.children[4].firstChild.value; 
    //For group actions saves all values in arrays
    } else if (action == 'save_all' || action == 'delete_all') {
        for (let i = 0; i < document.querySelectorAll ('.id_price_list').length; i++) {
            id_collection[i] = document.querySelectorAll ('.id_price_list')[i].value;
            service_ukr_collection[i] = document.querySelectorAll ('.service_ukr')[i].value;
            service_rus_collection[i] = document.querySelectorAll ('.service_rus')[i].value;
            service_eng_collection[i] = document.querySelectorAll ('.service_eng')[i].value;
            price_collection[i] = document.querySelectorAll ('.price')[i].value;
        }
    }
    //Handling all actions from data attribute
    switch (action) {
        case 'save' : {
            //Sends ajax-query with current action, id, service and price for record that edited
            $.ajax ({
                url: '/admin/edit_price_list.php',
                method: 'post',
                dataType: 'html',
                data: {
                    action: 'save',
                    id: id_price_list,
                    service_ukr: service_ukr_price_list,
                    service_rus: service_rus_price_list,
                    service_eng: service_eng_price_list,
                    price: price_price_list
                },
                //If the request was successfully sent, reloads page
                success: function (data) {
                    location.reload ();    
                }
            });
            break;
        }
        case 'delete' : {
            //The message corresponding to the current language
            let message = $.cookie('admin_lang') == 'rus' ? 
                'Данные будут удалены. Подтвердить?' : $.cookie('admin_lang') == 'eng' ? 
                'The data will be deleted. Confirm?' : 'Дані будуть видалені. Підтвердити?';
            //Confirmation from user
            if (confirm (message)) {
                //Sends ajax-query with current action and id for record that deleted
                $.ajax ({
                    url: '/admin/edit_price_list.php',
                    method: 'post',
                    dataType: 'html',
                    data: {
                        action: 'delete',
                        id: id_price_list
                    },
                    //If the request was successfully sent, reloads page
                    success: function (data) {
                        location.reload ();    
                    }
                });
            }
            break;
        }
        case 'add' : {
            //Slowly appearance modal window with overlay for adding new record
            $('.overlay').fadeIn(500);
            break;
        }
        case 'save_all' : {
            //Sends ajax-query with current action and id, service, price collections to save all records
            $.ajax ({
                url: '/admin/edit_price_list.php',
                method: 'post',
                dataType: 'html',
                data: {
                    action: 'save_all',
                    id_array: id_collection,
                    service_ukr_array: service_ukr_collection,
                    service_rus_array: service_rus_collection,
                    service_eng_array: service_eng_collection,
                    price_array: price_collection
                },
                //If the request was successfully sent, reloads page
                success: function (data) {
                    location.reload ();    
                }
            })
            break;
        }
        case 'delete_all' : {
            //The message corresponding to the current language
            let message = $.cookie('admin_lang') == 'rus' ? 
                'Все данные будут удалены. Подтвердить?' : $.cookie('admin_lang') == 'eng' ? 
                'All data will be deleted. Confirm?' : 'Всі дані будуть видалені. Підтвердити?';
            //Confirmation from user
            if (confirm (message)) {
                //Sends ajax-query with current action and id collection to delete all records
                $.ajax ({
                    url: '/admin/edit_price_list.php',
                    method: 'post',
                    dataType: 'html',
                    data: {
                        action: 'delete_all',
                        id_array: id_collection
                    },
                    //If the request was successfully sent, reloads page
                    success: function (data) {
                        location.reload ();    
                    }
                });
            }
            break;
        }
        default: return;
    }
});
//Click function on cancel button in modal window slowly closes it with overlay
$('.close').click (function () {
    $('.overlay').fadeOut(500);
});