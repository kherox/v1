// verification text for comment
$(document).ready(function(){
    $('.sendButton').attr('disabled', true);
    document.getElementById('sendButton').style.display = 'none';

    $('#emoji').keyup(function(){
        if($(this).val().length > 10 && $(this).val().length < 550){
            document.getElementById('sendButton').style.display = 'inline-block';
        }else{
            document.getElementById('sendButton').style.display = 'none';
        }
    })
});



//
/**
function post_comment(){
    $.ajax({
        url: "http://127.0.0.1/OranTicket/tickets/view/3",
        data: {
            comment: $('#emoji').val()
        },
        dataType: 'html',
        success: function (response) {
            $("#emoji").empty();
            document.getElementById("comments").innerHTML=response+document.getElementById("comments").innerHTML;
            $("#emoji").value="";
        }
    });
}
**/