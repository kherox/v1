// MODAL NOTIFICATION
;(function($, undefined) {
    'use strict';

    var $launch = $('.launch'),
        $modal = $('.modal');

    $launch.on('click', function(e) {
        e && e.preventDefault();

        $('.modal-overlay').show();
        window.setTimeout(function() {
            $modal.addClass('open');
        }, 0);
    });

    $modal.on('click', '.close', function(e) {
        e && e.preventDefault();
        $('.modal-overlay').css('display', 'none');
        $modal.removeClass('open').one('transitionend', function() {
        });
    });
}(jQuery));