$(function() {
    $('a.closebtn').click(function() {
        $('.centered-name-1').addClass('active');
        $('.dropdown-content-1').addClass('active');
    });
});
$(function() {
    $('span.openbtn').click(function() {
        $('.centered-name-1').removeClass('active');
        $('.dropdown-content-1').removeClass('active');
    });
});
$(function() {
    $('div.page').click(function() {
        var widthOutput = window.innerWidth;
        if (widthOutput < 960) {
            $('.centered-name-1').addClass('active');
            $('.dropdown-content-1').addClass('active');
            $(".closebtn").css("display", "none");
            $(".openbtn").css("display", "inline");
            $(".sidenav").css("width", "60px");
        }
    });
});