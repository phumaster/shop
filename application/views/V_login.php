<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
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
                                    <a class="btn btn-primary btn-block" href="javascript:;">Đăng nhập bằng Facebook</a>
                                </div>
                                <div class="col-md-6">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="username" class="form-control"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"/>
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
    </body>
</html>