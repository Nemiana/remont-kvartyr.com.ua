'use strict';
//Ajax-query for delete image on click (send id article)
$('.edit_gallery').click(function (event) {  
    if (event.target.dataset.id_image) {
        //Undo the default action (go to a new page)
        event.preventDefault();
        //The message corresponding to the current language
        let message = $.cookie('admin_lang') == 'rus' ? 
            'Фото будет удалено. Подтвердить?' : $.cookie('admin_lang') == 'eng' ? 
            'The photo will be deleted. Confirm?' : 'Фото буде видалено. Підтвердити?';
        if (confirm(message)) {
            $.ajax({
                url: '/admin/delete_object_image.php',
                method: 'post',
                dataType: 'html',
                data: {
                    id: event.target.dataset.id_image
                },
                //If success, removes whole block code of image and caption
                success: function () {
                    event.target.parentElement.parentElement.parentElement.remove();
                }
            });
        }
    }   
});