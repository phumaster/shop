<?php $this->load->view('include/admin_header');?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header"><i class="fa fa-user"></i> Chỉnh sửa thông tin <i><?php echo $username; ?></i></h4>
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group">
                <div class="input-group">
                    <label for="username" class="input-group-addon"><i class="fa fa-user"></i></label>
                    <input type="text" name="username" value="<?php echo $username; ?>" id="username" class="form-control" placeholder="Tên người dùng"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="email" class="input-group-addon"><i class="fa fa-envelope"></i></label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Email"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="number" class="input-group-addon"><i class="fa fa-phone"></i></label>
                    <input type="number" name="mobile" value="<?php echo $mobile; ?>" id="number" class="form-control" placeholder="Số điện thoại"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="address" class="input-group-addon"><i class="fa fa-home"></i></label>
                    <input type="text" name="address" value="<?php echo $address; ?>" id="address" class="form-control" placeholder="Địa chỉ"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="city" class="input-group-addon"><i class="fa fa-location-arrow"></i></label>
                    <input type="text" name="city" value="<?php echo $city; ?>" id="city" class="form-control" placeholder="Thành phố"/>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="birth" class="input-group-addon"><i class="fa fa-birthday-cake"></i></label>
                    <input type="text" name="birthday" value="<?php echo $birthday; ?>" id="birth" class="form-control" placeholder="Sinh nhật"/>
                </div>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="disable"/>
                    <span>Vô hiệu hóa người dùng này.</span>
                </label>
            </div>
            <div class="form-group">
                <label>Vai trò:</label>
                <label>
                    <input type="radio" name="type" value="2"/>
                    <span>Quản trị viên</span>
                </label>
                <label>
                    <input type="radio" name="type" value="1" checked="checked"/>
                    <span>Người dùng</span>
                </label>
                <label>
                    <input type="radio" name="type" value="0"/>
                    <span>Bị cấm</span>
                </label>
            </div>
            <div class="form-group">
                <label>
                    <span>Ảnh đại diện</span>
                    <input type="file" name="avatar" class="btn btn-default"/>
                    <br/>
                    <?php if (isset($avatar)): ?>
                        <input type="text" value="<?php echo $avatar; ?>" readonly="readonly"/>
                    <?php endif; ?>
                </label>
            </div>
            <div class="form-group">
                <input type="submit" name="btn-edit" class="btn btn-primary" value="Lưu thay đổi"/>
                <input type="reset" value="Nhập lại" class="btn btn-danger"/>
            </div>
        </form>
    </div>
</div><!-- end row-->
<?php $this->load->view('include/admin_footer');?>
