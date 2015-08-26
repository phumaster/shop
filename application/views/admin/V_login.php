<!DOCTYPE html>

<html>
    <head>
        <title>Login</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <link href="<?php echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div style="position: relative;top: 100px">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4><i class="fa fa-lock"></i> LOGIN</h4>
                            </div>
                            <div class="panel-body">
                                <form action="<?php echo site_url('admin/C_login/signin'); ?>" method="post">
                                    <?php if ($this->session->flashdata('error_msg')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $this->session->flashdata('error_msg'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" value="<?php echo set_value('email');?>" autofocus/>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"/>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>