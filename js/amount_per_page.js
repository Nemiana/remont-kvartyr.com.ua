'use strict';
//Function gets class current select and path to save cookie
function amount_per_page (class_select, path_cookie) {
    //Receives current select
    let select = document.querySelector('.' + class_select);
    //Forms cookies name
    let name_cookie = class_select;
    //On change select
    select.addEventListener('change', function () {
        //Remember selected index
        let n = select.options.selectedIndex;
        //Save cookie with value of selected option for 7 days and for received path
        $.cookie(name_cookie, select.options[n].value, { expires: 7, path: path_cookie });  
        location.reload();
    });
}