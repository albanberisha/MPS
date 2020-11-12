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