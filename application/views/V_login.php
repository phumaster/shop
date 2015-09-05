<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <script src="<?php echo base_url('js/jquery.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('font-awesome/css/font-awesome.css') ?>"/>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="row">
                        <div class="panel panel-default" style="margin-top: 50px;">
                            <div class="panel-heading">
                                <h4><i class="fa fa-lock"></i> Đăng nhập</h4>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <a class="btn btn-primary btn-block" href="<?php echo $login_url; ?>">Đăng nhập bằng Facebook</a>
                                </div>
                                <div class="col-md-6">
                                    <?php if ($this->session->flashdata('msg')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $this->session->flashdata('msg'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="notify"></div>
                                    <form action="<?php echo site_url('C_login/login'); ?>" method="post" id="form-login">
                                        <div class="form-group">
                                            <label for="website">Website</label>
                                            <div class="input-group">
                                                <input type="text" name="website" id="website" class="form-control" autofocus/>
                                                <label class="input-group-addon">.faceweb.vn</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-info btn-block">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="panel-footer">
                                &COPY; 2015
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#form-login').submit(function (event) {
                    var url = $(this).attr('action') + '?m=' + Math.random();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        cache: false,
                        processData: false,
                        data: $(this).serialize(),
                        success: function (data) {
                            var obj = JSON.parse(data);
                            var success_tag = '<div class="text-success">';
                            var error_tag = '<div class="text-danger">';
                            var notify = $('.notify');
                            if (obj.error == true) {
                                error_tag += obj.msg + '</div>';
                                notify.hide(1).html(error_tag).fadeIn('slow');
                            } else {
                                success_tag += '<i class="fa fa-spinner fa-spin"></i> ' + obj.msg + '</div>';
                                notify.hide(1).html(success_tag).fadeIn('slow');
                                setTimeout(function () {
                                    window.location = url;
                                }, 2000);
                            }
                        },
                        error: function () {
                            console.log("Error");
                        }
                    });
                    event.preventDefault();
                });
            });
        </script>
    </body>
</html>