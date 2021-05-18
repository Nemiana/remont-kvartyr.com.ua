'use strict'
document.querySelector('.gallery_article').addEventListener ('click', function (event) {
    if (event.target.className == 'gallery_image') {
        document.querySelector('.full_image').setAttribute('src', event.target.getAttribute('src'));
        $('.overlay').fadeIn(500);
    }
});
//Click function on cancel button in modal window slowly closes it with overlay
$('.close').click (function () {
    $('.overlay').fadeOut(500);
});