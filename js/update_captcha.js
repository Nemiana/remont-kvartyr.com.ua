'use strict';
//Handling click on update input
document.querySelector('.update_captcha').addEventListener('click', function (event) {
    //Prevent default action
    event.preventDefault();
    //Send empty ajax
    $.ajax({
        url: '/view/update_captcha.php',
        method: 'post',
        dataType: 'html',
        data: {}, 
        //Adds resulting image name to attributes
        success: function (data) {
            $('.img_captcha').attr('src', '/captcha/' + data + '.png');
            $('.name_captcha').attr('value', data);
        }
    });
});