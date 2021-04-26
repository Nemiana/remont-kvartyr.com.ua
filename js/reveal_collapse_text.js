//Shows and hides full text of text block
'use strict';
function reveal_collapse_text (length, text) {
    //Length of short text
    let lengthText = length;
    //Collection of all texts
    let collectionText = text;
    //Original texts full size
    let fullText = {};
    for (let i = 0; i < collectionText.length; i++) {
        //Check text length
        if (collectionText[i].innerText.length > lengthText) {
            //Remember original variant
            fullText[i] = collectionText[i].innerText;
            //Trim the line
            collectionText[i].innerText = collectionText[i].innerText.slice(0, lengthText) + '...';
            //Create and add button
            let but_click = document.createElement('button');
            but_click.className = 'button_click';
            but_click.innerText = 'Розгорнути...';
            but_click.value = 'open';
            collectionText[i].append(but_click);
        }
    };
    let block = document.querySelector('article');
    //Handler of event click
    block.addEventListener('click', function (event) {
        let target = event.target;
        //Only for button clicks
        if (target.tagName != 'BUTTON') return;
        //Button for deploy
        if (target.value == 'open') {
            target.previousSibling.data = fullText[target.parentNode.dataset.index];
            target.innerText = 'Згорнути...';
            target.value = 'close';
        //Button for roll up
        } else if (target.value == 'close') {
            target.previousSibling.data = fullText[target.parentNode.dataset.index].slice(0, lengthText) + '...';
            target.innerText = 'Розгорнути...';
            target.value = 'open';            
        };
        //Resize block for sidebar image
        document.querySelector('.left_side').style.height = 
        document.querySelector('.right_side').style.height = 
        document.querySelector('article').offsetHeight + 'px';
    });
}