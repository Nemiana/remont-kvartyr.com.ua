'use strict';
//On click article title sent with ajax for generate url
$('.generate_url').click(function () {
    $.ajax ({
        url: '/admin/generate_url.php',
        method: 'post',
        dataType: 'html',
        data: {
            title: $('.title_article').val()
        },
        //The result of the generated url is written into the corresponding field
        success: function (data) {
            $('.url_article').val(data);
        }
    });
});