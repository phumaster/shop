$(function () {
    $('.delete').click(function (event) {
        var conf = confirm('You are sure?');
        if (conf == true) {
            $(this).closest('tr').remove();
            $.ajax({
                url: $(this).attr('href') + '?m=' + Math.random(),
                contentType: 'json',
                method: 'POST',
                success: function (data) {
                    var obj = JSON.parse(data);
                    $(window).scrollTop(0);
                    if (obj.success == true) {
                        $('.div-success').addClass('text-success').html(obj.msg)
                                .fadeIn('slow').delay(800).fadeOut('slow');
                    } else {
                        $('.div-success').addClass('text-danger').html(obj.msg)
                                .fadeIn('slow').delay(800).fadeOut('slow');
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }
        event.preventDefault();
    });
});