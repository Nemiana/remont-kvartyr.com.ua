'use strict';
//Catching a click on all articles in table
document.querySelector('.articles_table').addEventListener('click', function (event) {
    //Remember id of current article
    let currentId = event.target.dataset.id_article;
    //If click was on input and user confirms action, send ajax-query with current id
    if (currentId) {
        //The message corresponding to the current language
        let message = $.cookie('admin_lang') == 'rus' ? 
            'Статья будет удалена. Подтвердить?' : $.cookie('admin_lang') == 'eng' ? 
            'The article will be deleted. Confirm?' : 'Стаття буде видалена. Підтвердити?';
        if (confirm (message)) {
            $.ajax ({
                url: '/admin/delete_article.php',
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