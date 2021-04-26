'use strict';
//Catching a click on all articles in table
document.querySelector('.articles_table').addEventListener('click', function (event) {
    //Remember id of current article
    let currentId = event.target.dataset.id_article;
    //If click was on input and user confirms action, send ajax-query with current id
    if (currentId) {
        if (confirm ('Стаття буде видалена. Підтвердити?')) {
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