//Sets the block height to the size of the client area for the sidebar image
'use strict';
let right_block = document.querySelector('.right_side'); 
	document.addEventListener("DOMContentLoaded", function() {
        right_block.style.height = document.querySelector('article').offsetHeight + 'px';
    });