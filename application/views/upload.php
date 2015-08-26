<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8"/>
        <title>Upload</title>
        <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
        <link href="<?php echo base_url('font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    </head>
    <body>
        <div class="process"></div>
        <form action="<?php echo site_url('upload/process'); ?>" method="post" enctype="multipart/form-data" id="form-upload">
            <input type="file" name="img" id="img"/>
            <input type="submit" name="btn-upload" value="Upload"/>
            <input type="reset" name="btn-upload" value="Clear"/>
        </form>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#img').change(function () {
                    var reader = new FileReader(); // html5 file reader
                    reader.onload = function (e) { // onload
                        $('.process').html('<img src="' + e.target.result + '" width="120px"/>');
                    };
                    reader.readAsDataURL($(this)[0].files[0]); // read url data
                });
                $('#form-upload').submit(function (event) {
                    event.preventDefault();

                    $('input[type=submit]').val('Processing...');
                    $('.process').html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
                    $.ajax({
                        url: "<?php echo site_url('upload/process'); ?>?m=" + Math.random(),
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            //console.log(data);
                            $('input[type=submit]').val('Upload');
                            $('.process').html(data);
                        }
                    });
                });
            });
        </script>
    </body>
</html>