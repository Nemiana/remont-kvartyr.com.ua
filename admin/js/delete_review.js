'use strict';
//Catching a click on all reviews in table
document.querySelector('.review').addEventListener('click', function (event) {
    //Remember id of current review
    let currentId = event.target.dataset.id_review;
    //If click was on input and user confirms action, send ajax-query with current id
    if (currentId) {
        //The message corresponding to the current language
        let message = $.cookie('admin_lang') == 'rus' ? 
            'Отзыв будет удален. Подтвердить?' : $.cookie('admin_lang') == 'eng' ? 
            'The review will be deleted. Confirm?' : 'Відгук буде видалено. Підтвердити?';
        if (confirm (message)) {
            $.ajax ({
                url: '/admin/delete_review.php',
                method: 'post',
                dataType: 'html',
                data: {
                    id: currentId
                },
                //Reload page after deletion
                success: function () {
                    location.reload ();    
                }
            });
        }
    };
});