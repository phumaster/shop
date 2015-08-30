<?php $this->load->view('include/admin_header'); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header">Thêm danh mục mới</h4>
        <form action="" method="post">
            <?php if(isset($error_msg)):?>
            <div class="alert alert-danger">
                <?php echo $error_msg;?>
            </div>
            <?php endif;?>
            <div class="form-group">
                <label>Tiêu đề</label>
                <input type="text" name="name" class="form-control"/>
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Add</button>
            </div>
        </form>
    </div>
</div>
<?php $this->load->view('include/admin_footer'); ?>