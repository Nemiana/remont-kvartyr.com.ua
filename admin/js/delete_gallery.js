'use strict';
//Catching a click on all gallery objects in table
document.querySelector('.gallery_objects').addEventListener('click', function (event) {
    //Remember id of current object
    let currentId = event.target.dataset.id_gallery;
    //If click was on input and user confirms action, send ajax-query with current id
    if (currentId) {
        if (confirm ('Об\'єкт галереї буде видалено. Підтвердити?')) {
            $.ajax ({
                url: '/admin/delete_gallery.php',
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