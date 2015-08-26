<?php $this->load->view('include/admin_header'); ?>
<div class="row">
    <div class="col-md-12">
        <h2 class="page-header"><i class="fa fa-users"></i> Danh sách người dùng</h2>
        <div id="notify" style="display: none;"></div>
        <?php if ($this->session->flashdata('success_message')): ?>
            <div class="alert alert-success"><?php echo $this->session->flashdata('success_message') ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error_message')): ?>
            <div class="alert alert-danger"><?php echo $this->session->flashdata('error_message') ?></div>
        <?php endif; ?>
        <div style="margin: 2px;">
            <form action="<?php echo site_url('/admin/C_list_user/delete_all'); ?>" method="post" id="del" onsubmit="return confirm('Bạn có chắc xóa toàn bộ mục đã chọn?');" class="form-inline">
                Sắp xếp: <select class="btn btn-primary" style="appearance: none; -moz-appearance: none;" onchange="window.location = this.value">
                    <option>--Chọn</option>
                    <option value="?by=desc">Giảm dần</option>
                    <option value="?by=asc">Tăng dần</option>
                    <option value="?by=name">Tên</option>
                    <option value="?by=email">Email</option>
                </select>
                <a href="<?php echo site_url('/admin/'); ?>" class="btn btn-success" title="Thêm"><i class="fa fa-plus"></i></a>
                <button type="submit" class="btn btn-danger" title="Xóa mục đã chọn"><i class="fa fa-remove"></i></button>
                <input type="text" class="form-control focus-me" placeholder="Nhập tên hoặc email." size="48"/>
            </form>
        </div>
        <div class="table-responsive">
            <div class="search-content">
                <?php $this->load->view('admin/V_tbl_list_user'); ?>
            </div>
            <div style="text-align: center;">
                <ul class="pagination">
                    <?php echo $pagination; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/admin_footer'); ?>