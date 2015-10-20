// ANIMATION SCROLL
$(function() {
    jQuery.scrollSpeed(300, 300);
});

// MESSAGE FLASH
$("#flash-message").on('click', '.close', function() {
    $(this).parent("#flash-message").fadeOut(250);
});


