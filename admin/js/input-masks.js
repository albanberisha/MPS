$(document).ready(function() {
    $(":input").inputmask();



    $("#phone-number").inputmask({
        mask: '+999 99 999 999'
    });


    $("#barcode").inputmask({
        mask: '9 999999 999999',
        showMaskOnHover: true,
    });

});