<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('font-awesome/css/font-awesome.css') ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>"/>
    </head>
    <body>
        <a href="javascript:;" class="reg-link">Sign up</a>
        <div class="popup-register">
            <div id="btn-close"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="tab-parent">
                            <?php echo validation_errors(); ?>
                            <form action="<?php echo site_url('C_register/Register'); ?>" method="post" id="form-register">
                                <div id="tab1" class="tab-group tab-active">
                                    <div class="form-group" style="text-align: center;">
                                        <a href="#" class="btn-fb"><i class="fa fa-facebook"></i> Đăng nhập tài khoản Faccebook</a>
                                        <a href="#" class="btn-g"><i class="fa fa-google-plus"></i> Đăng nhập tài khoản Google</a>
                                    </div>
                                    <div class="form-group">
                                        <h2 style="text-align: center;text-shadow: 1px 1px 1px rgba(0,0,0,0.15);">Đăng ký hoàn toàn miễn phí</h2>
                                    </div>
                                    <div class="form-group notify" style="color: #fbae17;"></div>
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Nhập email của bạn" id="email" class="ip-reg" autocomplete="off"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Mật khẩu" id="password" class="ip-reg" maxlength="60" />
                                    </div>
                                    <div class="form-group" style="text-align: right;">
                                        <a href="javascript:;" class="btn-reg btn-c">Bắt đầu</a>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <ul class="break">
                                            <li class="ac">1</li>
                                            <li class="act"></li>
                                            <li>2</li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-group">
                                    <div class="form-group">
                                        <h2 style="text-align: center;text-shadow: 1px 1px 1px rgba(0,0,0,0.15);">Tên shop/website của bạn</h2>
                                    </div>
                                    <div class="form-group notify2" style="color: #fbae17;"></div>
                                    <div class="form-group">
                                        <input type="text" name="website" id="website" autocomplete="off" placeholder="Tên website" class="ip-reg" maxlength="240" /> 
                                    </div>
                                    <div class="form-group">
                                        <label>Website của bạn là: <i class="website">name</i><i>.faceshop.com.vn</i></label>
                                    </div>
                                    <div class="form-group">
                                        <select class="ip-reg btn-reg" style="appearance: none;-moz-appearance: none;" name="category">
                                            <option value="mobile" selected>Điện thoại</option>
                                            <option value="dacap">Đa cấp</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><input type="checkbox" name="check"/> Tôi đồng ý với <a href="#">quy định sử dụng</a> & <a href="#">chính sách bảo mật</a> của faceweb</label>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <button type="submit" class="btn-ok-register btn-reg" name="register">Hoàn tất</button>
                                    </div>
                                    <div class="form-group" style="text-align: center;">
                                        <ul class="break">
                                            <li class="ac">1</li>
                                            <li class="act"></li>
                                            <li class="ac">2</li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- javascript -->
        <script type="text/javascript" src="<?php echo base_url('js/jquery.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/bootstrap.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('js/view/Register.js'); ?>"></script>
    </body>
</html>