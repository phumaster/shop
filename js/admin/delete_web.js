$.noConflict();
jQuery(document).ready(function ($) {
    $('.delete').click(function (event) {
        var conf = confirm("You are sure?");
        if (conf == true) {
            $.ajax({
                url: $(this).attr('href') + '?m=' + Math.random(),
                contentType: 'json',
                success: function (data) {
                    var obj = JSON.parse(data);
                    $(window).scrollTop(0);
                    if (obj.success == true) {
                        $('.div-success').addClass('text-success').html(obj.msg)
                                .fadeIn('slow').delay(1000).fadeOut('slow');
                    } else {
                        $('.div-success').addClass('text-danger').html(obj.msg)
                                .fadeIn('slow').delay(1000).fadeOut('slow');
                    }
                },
                error: function (status, jqXHR) {
                    console.log(status+'-'+jqXHR);
                }
            });
        }
        event.preventDefault();
    });
});