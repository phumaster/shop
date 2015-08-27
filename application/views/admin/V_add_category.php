<?php $this->load->view('include/admin_header'); ?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="" method="post">
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