// ANIMATION SCROLL
$(function() {
    jQuery.scrollSpeed(570, 2400);
});

// MESSAGE FLASH
$("#flash-message").on('click', '.close', function() {
    $(this).parent("#flash-message").fadeOut(250);
});