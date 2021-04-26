'use strict';
//Function with fade in and fade out windows for success and fail action
function pop_up_window (action, message) {
    if (action == 'success') {
        //Fade in and fade out div with success message
        $('.success_action').text(message);
        $('.success_action').fadeIn(1000);
        $('.success_action').fadeOut(3000);
    } else if (action == 'fail') {
        //Fade in and fade out div with fail message
        $('.fail_action').text(message);
        $('.fail_action').fadeIn(1000);
        $('.fail_action').fadeOut(3000);
    }
};