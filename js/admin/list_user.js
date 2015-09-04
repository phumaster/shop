$(document).ready(function () {

    ////
    $('.focus-me').keyup(function () {
        $.ajax({
            url: "C_search?m=" + Math.random(),
            method: 'POST',
            data: {
                'str': $(this).val()
            },
            success: function (data) {
                $('.search-content').html(data);
            },
        });
    });
    ///
    $('.delete').click(function (event) {
        var u = $(this).attr('href');
        $.ajax({
            url: u + '?m=' + Math.random(),
            success: function (data) {
                $('#notify').html('<div class="alert alert-success">' + data + '</div>').slideDown(500).delay(1500).slideUp(300);
                $(window).scrollTop(0);
            },
            error: function () {
                alert('ERR');
            }
        });
        var tr = $(this).closest('tr');
        tr.fadeOut(1000, function () {
            tr.remove();
        });
        event.preventDefault();
    });
});