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
                                <h4><i class="fa fa-lock"></i> Đăng ký</h4>
                            </div>
                            <div class="panel-body">
                                <form action="<?php echo site_url('C_register/facebook'); ?>" method="post" id="register-facebook">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <div class="input-group">
                                            <input type="text" name="website" id="website" class="form-control"/>
                                            <label class="input-group-addon">.faceweb.vn</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Lĩnh vự kinh doanh</label>
                                        <select class="ip-reg btn-reg form-control" style="appearance: none;-moz-appearance: none;" name="category">
                                            <?php foreach ($category as $key => $value): ?>
                                                <option value="<?php echo $value['value']; ?>"><?php echo $value['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-register">Đăng ký</button>
                                        <input type="reset" value="Nhập lại" class="btn btn-default"/>
                                    </div>
                                </form>
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
                $('#register-facebook').submit(function (event) {
                    var url = $(this).attr('action')+'?m='+Math.random();
                    var data = $(this).serialize();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        processData: false,
                        cache: false,
                        data: data,
                        success: function (data) {
                            alert(data);
                        },
                        error: function () {
                            alert('Error');
                        }
                    });
                    event.preventDefault();
                });
            });
        </script>
    </body>
</html>