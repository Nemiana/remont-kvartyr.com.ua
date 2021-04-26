'use strict';
//Ajax-query for delete image on click (send id article)
$('.delete_image').click(function (event) {
    //Undo the default action (go to a new page)
    event.preventDefault();
    $.ajax({
        url: '/admin/delete_image.php',
        method: 'post',
        dataType: 'html',
        data: {
            id: $('.delete_image').data('id_article'),
        },
        //If ok, delete src attribute from image
        success: function () {
            $('.image_article').attr('src', '');
        }
    });
});