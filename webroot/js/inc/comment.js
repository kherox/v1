// verification text for comment
$(document).ready(function(){
    /*
    $('.sendButton').attr('disabled', true);


    $('#emoji').keyup(function(){
        if($(this).val().length){
            $('.sendButton').attr('disabled', false);
        }else{
            if($(this).val().length > 10 && $(this).val().length < 550){
                $('.sendButton').attr('disabled', false);
            }else{
                $('.sendButton').attr('disabled', true);
            }
        }
    })
   */
});


/**
function post_comment(){
    $.ajax({
        method:"post",
        url: "http://127.0.0.1/OranTicket/comments/add",
        data: {
            content: $('#emoji').val()
        },
        dataType: 'html',
        success: function (response) {
            console.log(response);
            return false;
            $("#emoji").empty();
            document.getElementById("comments").innerHTML=response+document.getElementById("comments").innerHTML;
            $("#emoji").value="";
        }
    });
}
**/