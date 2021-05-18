'use strict';
//Ajax-query for delete image on click (send id article)
$('.edit_gallery').click(function (event) {
    //Undo the default action (go to a new page)  
    if (event.target.dataset.id_image) {
        event.preventDefault();
        if (confirm('Фото буде видалено. Підтвердити?')) {
            $.ajax({
                url: '/admin/delete_object_image.php',
                method: 'post',
                dataType: 'html',
                data: {
                    id: event.target.dataset.id_image
                },
                //
                success: function () {
                    event.target.parentElement.parentElement.parentElement.remove();
                }
            });
        }
    }   
});