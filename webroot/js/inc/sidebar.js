'use strict';

(function() {

    var menu, trigger;

    menu    = document.querySelector('#sidebar');
    trigger = document.querySelector('#sidebar--trigger');

    trigger.addEventListener('click', function() {
        menu.classList.toggle('sidebar-animation');
    }, false);

    document.querySelector('#sidebar-close').addEventListener('click', function() {
        menu.classList.remove('sidebar-animation');
    }, false);
})();