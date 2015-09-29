// PROFIL - TAB
$("ul.tabs a").click(function (e) {
    e.preventDefault();
    $(this).closest("li").addClass("active").siblings().removeClass("active");
    var i = $(this).closest("li").index();
    $("#container section:eq(" + i + ")").show().siblings().hide();
});

// PROFIL - EDIT
$(".btn").click(function() {
    $("#avatar-input").focus().click();
});