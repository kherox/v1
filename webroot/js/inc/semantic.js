// Message
$('.message .close')
    .on('click', function() {
        $(this)
            .closest('.message')
            .transition('fade')
        ;
    })
;
// Dropdown
$('.ui.dropdown')
    .dropdown()
;

// Icon
$('.icon')
    .popup({
        inline: true
    })
;
// Checkbox
$('.checkbox').checkbox('attach events', '.toggle.button');