'use strict';
document.querySelector('.update_captcha').addEventListener('click', function (event) {
    event.preventDefault();
    $.ajax({
        url: '/view/update_captcha.php',
        method: 'post',
        dataType: 'html',
        data: {}, 
        success: function (data) {
            $('.img_captcha').attr('src', '/captcha/' + data + '.png');
            $('.name_captcha').attr('value', data);
        }
    });
});