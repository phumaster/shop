$.noConflict();
jQuery(function ($) {
    var tab1 = $('#tab1');
    var tab2 = $('#tab2');
    $('.btn-reg-2').attr('disabled','disabled').css({'cursor':'not-allowed'});
    $('input[name=check]').click(function(){
        if(this.checked === true){
            $('.btn-reg-2').removeAttr('disabled').css({'cursor':'pointer'});
        }else{
            $('.btn-reg-2').attr('disabled','disabled').css({'cursor':'not-allowed'});
        }
    });
    $('.reg-link').click(function () {
        $('.popup-register').fadeIn(500);
    });
    $('#btn-close').click(function () {
        $('.popup-register').fadeOut(300);
    });
    $('.btn-c').click(function (event) {
        var email = $('#email').val();
        var password = $('#password').val();
        if (email == '' || password == '') {
            $('.notify').html('Vui lòng nhập email và password!');
            event.preventDefault();
        } else {
            tab1.toggleClass('tab-active');
            tab2.toggleClass('tab-active');
        }
    });
    $('#website').keyup(function () {
        $('.website').html($(this).val());
    });
    $('#form-register').submit(function (e) {
        $('.btn-ok-register').html('<i class="fa fa-spinner fa-spin"></i> đang tạo trang web, vui lòng chờ trong 1 phút...');
        if ($('#website').val() == '') {
            $('.notify2').html('Vui lòng nhập tên website!');
            $('.btn-ok-register').html('Hoàn tất');
        } else {
            $.ajax({
                url: $(this).attr('action') + "?m=" + Math.random(),
                type: 'post',
                cache: false,
                data: $(this).serialize(),
                success: function (data) {
                    console.log(data);
                    var obj = JSON.parse(data);
                    if (obj.error == 1) {
                        tab1.removeClass('tab-active').addClass('tab-active');
                        tab2.removeClass('tab-active');
                        $('.notify').html(obj.msg);
                        $('.btn-ok-register').html('Hoàn tất');
                    } else {
                        $('.btn-ok-register').html('<i class="fa fa-spinner fa-spin"></i> ' + obj.msg);
                        setTimeout(function () {
                            window.location = obj.redirect;
                        }, 2000);
                    }
                },
                error: function () {
                    console.log('Cann\'t send request to server!');
                },
            });
        }
        e.preventDefault();
    });
});