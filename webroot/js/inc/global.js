// ANIMATION SCROLL
$(function() {
    jQuery.scrollSpeed(130, 800, 'easeOutCubic');
});

// MESSAGE FLASH
$("#flash-message").on('click', '.close', function() {
    $(this).parent("#flash-message").fadeOut(250);
});