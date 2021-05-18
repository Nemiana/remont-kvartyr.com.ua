'use strict';
//Ajax-query for delete image on click (send id article)
$('.delete_start_image').click(function (event) {
    //Undo the default action (go to a new page)
    event.preventDefault();
    $.ajax({
        url: '/admin/delete_start_image.php',
        method: 'post',
        dataType: 'html',
        data: {
            id: $('.delete_start_image').data('id_gallery'),
        },
        //If ok, delete src attribute from image
        success: function () {
            $('.object_start_image').attr('src', '');
        }
    });
});