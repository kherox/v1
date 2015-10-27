function notif() {
    $.ajax({

        url: "",

        success: function(content){
            $('#notifications').html(content); //span où tu veux que ce nombre apparaisse
        }
    });
    setTimeout(notif, 10000);
}

notif();

