// ANIMATION SCROLL
$(function() {
    jQuery.scrollSpeed(300, 300);
});

// MESSAGE FLASH
$("#flash-message").on('click', '.close', function() {
    $(this).parent("#flash-message").fadeOut(250);
});

// REPORT
$("#group_report").hide().fadeOut(250);
$("#report_btn").on('click', function(){
    $("#group_report").show("slow").fadeIn(250);
});


$('.ui.dropdown')
    .dropdown()
;

$('.special.cards .image').dimmer({
    on: 'hover'
});

$('.icon')
    .popup({
        inline: true
    })
;