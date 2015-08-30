<?php $this->load->view('include/admin_header'); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header">Chỉnh sửa</h4>
        <?php echo form_error('subdomain', '<div class="alert alert-danger">', '</div>'); ?>
        <?php if (!empty($error_msg)): ?>
            <div class="alert alert-danger"><?php echo $error_msg ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="subdomain" value="<?php echo $data['subdomain']; ?>" class="form-control"/>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('include/admin_footer'); ?>