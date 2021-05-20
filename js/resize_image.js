'use strict'
//Catches click event on all area of images
document.querySelector('.gallery_article').addEventListener ('click', function (event) {
    //If click was on the image
    if (event.target.className == 'gallery_image') {
        //Set image in src attribute
        document.querySelector('.full_image').setAttribute('src', event.target.getAttribute('src'));
        //jQuery for smooth appearance
        $('.overlay').fadeIn(500);
    }
});
//Click function on cancel button in modal window slowly closes it with overlay
$('.close').click (function () {
    $('.overlay').fadeOut(500);
});