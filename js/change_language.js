//Switch the language
'use strict'
let langeUkr = document.querySelector('.ukr');
let langeRus = document.querySelector('.rus');
let langeEng = document.querySelector('.eng');
//Catches clicks on language panel
document.querySelector('.header').addEventListener('click', function (event) {
    if (event.target.classList.contains('ukr')) {
        //Activate ukr language (style class) and inactivate other languages
        langeUkr.classList.add('lang_active');
        langeRus.classList.remove('lang_active');
        langeEng.classList.remove('lang_active');
        //Sets cookies with current language for closest parent separately for front pages and admin panel
        if (event.target.closest('.lang')) {
            $.cookie('lang', 'ukr', { expires: 7, path: '/' });
        } else if (event.target.closest('.admin_lang')) {
            $.cookie('admin_lang', 'ukr', { expires: 7, path: '/admin' });
        }
    } else if (event.target.classList.contains('rus')) {
        //Activate rus language (style class) and inactivate other languages
        langeRus.classList.add('lang_active');
        langeUkr.classList.remove('lang_active');
        langeEng.classList.remove('lang_active');
        //Sets cookies with current language for closest parent separately for front pages and admin panel
        if (event.target.closest('.lang')) {
            $.cookie('lang', 'rus', { expires: 7, path: '/' });
        } else if (event.target.closest('.admin_lang')) {
            $.cookie('admin_lang', 'rus', { expires: 7, path: '/admin' });
        }
    } else if (event.target.classList.contains('eng')) {
        //Activate eng language (style class) and inactivate other languages
        langeEng.classList.add('lang_active');
        langeUkr.classList.remove('lang_active');
        langeRus.classList.remove('lang_active');
        //Sets cookies with current language for closest parent separately for front pages and admin panel
        if (event.target.closest('.lang')) {
            $.cookie('lang', 'eng', { expires: 7, path: '/' });
        } else if (event.target.closest('.admin_lang')) {
            $.cookie('admin_lang', 'eng', { expires: 7, path: '/admin' });
        }
    }
    //Reload current page to send cookies to server
    location.reload();
});