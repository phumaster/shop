
<?php if (!empty($info)): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th><input type="checkbox" id="check_all" onclick="$('.check_box').prop('checked', this.checked);"/></th>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Website</th>
                <th>Phone</th>
                <th>Address</th>
                <th>City</th>
                <th>Birthday</th>
                <th>Status</th>
                <th>Role</th>
                <th>Avatar</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($info as $key => $vals): ?>
                <tr>
                    <td><input type="checkbox" form="del" name="check[]" value="<?php echo $vals['id']; ?>" class="check_box"/></td>
                    <td><?php echo $vals['id']; ?></td>
                    <td><?php echo $vals['username']; ?></td>
                    <td><?php echo $vals['email']; ?></td>
                    <td><?php if(!empty($vals['subdomain'])){ echo $vals['subdomain']; }else{ echo '<font color="#F55E53">Not avaliable</font>';}?></td>
                    <td><?php echo $vals['mobile']; ?></td>
                    <td><?php echo $vals['address']; ?></td>
                    <td><?php echo $vals['city']; ?></td>
                    <td><?php echo $vals['birthday']; ?></td>
                    <td><?php echo $vals['status']; ?></td>
                    <td><?php echo $vals['type']; ?></td>
                    <td><?php echo $vals['avatar']; ?></td>
                    <td><?php echo $vals['created_at']; ?></td>
                    <td>
                        <a href="<?php echo site_url('admin/C_list_user/edit/' . $vals['id']); ?>"><i class="fa fa-pencil"></i> Sửa</a>
                        <br/>
                        <a href="<?php echo site_url('admin/C_list_user/delete/' . $vals['id']); ?>"  style="color: #F55E53;" class="delete"><i class="fa fa-remove"></i> Xóa</a>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-info">Không tìm thấy kết quả phù hợp.</div>
<?php endif; ?>