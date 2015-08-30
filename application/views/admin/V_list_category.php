<?php $this->load->view('include/admin_header');?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header"><i class="fa fa-list-alt"></i> Danh mục chính</h4>
        <div class="table-responsive">
            <?php if ($this->session->flashdata('success_msg')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                </div>
            <?php endif; ?>
            <div class="text-center div-success">
            </div>
            <div>
                <a href="<?php echo site_url('admin/C_list_category/add');?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Thêm danh mục</a>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Danh mục</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $vals):?>
                    <tr>
                        <td><?php echo $vals['id'];?></td>
                        <td><?php echo $vals['name'];?></td>
                        <td>
                            <a href="<?php echo site_url('admin/C_list_category/edit/'.$vals['id']);?>" class="btn btn-info btn-sm">
                                <i class="fa fa-pencil"></i> Sửa
                            </a>
                            <a href="<?php echo site_url('admin/C_list_category/delete/'.$vals['id']);?>" class="delete btn btn-danger btn-sm">
                                <i class="fa fa-times"></i> Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('include/admin_footer');?>