<?php $this->load->view('include/admin_header'); ?>
<div class="row">
    <div class="col-md-12">
        <h4 class="page-header"><i class="fa fa-list"></i> Danh sách website đã tạo</h4>
        <div class="table-responsive">
            <div class="div-success text-center"></div>
            <?php if ($this->session->flashdata('success_msg')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                </div>
            <?php endif; ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Domain</th>
                        <th>User</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Disable</th>
                        <th>Avaliable From</th>
                        <th>Avaliable To</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php //print_r($data);die;?>
                    <?php foreach ($data as $key => $vals): ?>
                        <tr>
                            <td><?php echo $vals['id']; ?></td>
                            <td><?php echo $vals['subdomain']; ?></td>
                            <td><?php echo $vals['email']; ?></td>
                            <td><?php echo $vals['type']; ?></td>
                            <td><?php echo $vals['status']; ?></td>
                            <td><?php echo $vals['disable']; ?></td>
                            <td><?php echo $vals['avaiableFrom']; ?></td>
                            <td><?php echo $vals['avaiableTo']; ?></td>
                            <td><?php echo $vals['IDcategoryLevel1']; ?></td>
                            <td>
                                <a href="<?php echo site_url('admin/C_list_web/edit/' . $vals['id']); ?>" class="edit btn btn-info btn-sm"><i class="fa fa-pencil"></i> Sửa</a>
                                <a href="<?php echo site_url('admin/C_list_web/delete/' . $vals['id']); ?>" class="delete btn btn-danger btn-sm"><i class="fa fa-remove"></i> Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-center">
                <ul class="pagination">
                    <?php echo $pagination; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/admin_footer'); ?>