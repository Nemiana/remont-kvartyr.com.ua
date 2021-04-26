//Script for processing actions with price-list
'use strict';
//Table with price-list
let tablePrice = document.querySelector('.price-list');
//Event for click over all table
tablePrice.addEventListener('click', function (event) {
    //Stores action from data-* attribute
    let action = event.target.dataset.action;
    //Values for current record
    let id_price_list, service_price_list, price_price_list;
    //Arrays for stores all values all records (group actions)
    let id_collection = [], service_collection = [], price_collection = [];
    //For single actions reads values from current row of the table
    if (action == 'save' || action == 'delete') {
        id_price_list = event.target.parentNode.parentNode.children[0].value;
        service_price_list = event.target.parentNode.parentNode.children[1].firstChild.value;
        price_price_list = event.target.parentNode.parentNode.children[2].firstChild.value; 
    //For group actions saves all values in arrays
    } else if (action == 'save_all' || action == 'delete_all') {
        for (let i = 0; i < document.querySelectorAll ('.id_price_list').length; i++) {
            id_collection[i] = document.querySelectorAll ('.id_price_list')[i].value;
            service_collection[i] = document.querySelectorAll ('.service')[i].value;
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
                    service: service_price_list,
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
            //Confirmation from user
            if (confirm ('Дані будуть видалені. Підтвердити?')) {
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
                    service_array: service_collection,
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
            //Confirmation from user
            if (confirm ('Всі дані будуть видалені. Підтвердити?')) {
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