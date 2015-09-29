// verification text for comment
$(document).ready(function(){
    $('.sendButton').attr('disabled', true);

    $('#emoji').keyup(function(){
        if($(this).val().length > 10 && $(this).val().length < 550){
            $('.sendButton').attr('disabled', false);
        }else{
            $('.sendButton').attr('disabled', true);
        }
    })
});