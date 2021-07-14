'use strict'
//Adding block of code for upload image
let addButton = document.querySelector('.add_image');
addButton.addEventListener('click', function () {
    let htmlAdd = `<table class="edit_gallery">
                    <tr>
                        <!-- id gallery image -->
                        <td><input type="hidden" name="id_gallery_image[]" value="0"></td>
                    </tr>
                    <tr>
                        <td><label for="object_image">Photo: </label></td>
                        <!-- Input for chosen image file -->
                        <td><input type="file" name="object_image[]"></td>
                        <td><img src="" class="object_image"></td>
                    </tr>
                    <tr>
                        <td><label for="image_description">Description: </label></td>
                        <td colspan="2"><input type="text" name="image_description[]" size="80" value=""></td>
                    </tr>
                </table>`;
    addButton.parentNode.parentNode.insertAdjacentHTML ('beforebegin', htmlAdd);
});