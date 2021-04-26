//Sets the block height to the size of the client area for the sidebar image
'use strict';
let left_block = document.querySelector('.left_side');
        document.addEventListener("DOMContentLoaded", function() {
            left_block.style.height = document.querySelector('article').offsetHeight + 'px';
        });