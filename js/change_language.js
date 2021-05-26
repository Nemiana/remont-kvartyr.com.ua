'use strict'
let langeUkr = document.querySelector('.ukr');
let langeRus = document.querySelector('.rus');
let langeEng = document.querySelector('.eng');
//
document.querySelector('.header').addEventListener('click', function (event) {
    if (event.target.classList.contains('ukr')) {
        //
        langeUkr.classList.add('lang_active');
        langeRus.classList.remove('lang_active');
        langeEng.classList.remove('lang_active');
        //
        if (event.target.closest('.lang')) {
            $.cookie('lang', 'ukr', { expires: 7, path: '/' });
        } else if (event.target.closest('.admin_lang')) {
            $.cookie('admin_lang', 'ukr', { expires: 7, path: '/admin' });
        }
    } else if (event.target.classList.contains('rus')) {
        //
        langeRus.classList.add('lang_active');
        langeUkr.classList.remove('lang_active');
        langeEng.classList.remove('lang_active');
        //
        if (event.target.closest('.lang')) {
            $.cookie('lang', 'rus', { expires: 7, path: '/' });
        } else if (event.target.closest('.admin_lang')) {
            $.cookie('admin_lang', 'rus', { expires: 7, path: '/admin' });
        }
    } else if (event.target.classList.contains('eng')) {
        //
        langeEng.classList.add('lang_active');
        langeUkr.classList.remove('lang_active');
        langeRus.classList.remove('lang_active');
        //
        if (event.target.closest('.lang')) {
            $.cookie('lang', 'eng', { expires: 7, path: '/' });
        } else if (event.target.closest('.admin_lang')) {
            $.cookie('admin_lang', 'eng', { expires: 7, path: '/admin' });
        }
    }
    location.reload();
});