<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Stx_group <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Group <?php echo form_error('id_group') ?></label>
            <input type="text" class="form-control" name="id_group" id="id_group" placeholder="Id Group" value="<?php echo $id_group; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Group Name <?php echo form_error('group_name') ?></label>
            <input type="text" class="form-control" name="group_name" id="group_name" placeholder="Group Name" value="<?php echo $group_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Admin <?php echo form_error('admin') ?></label>
            <input type="text" class="form-control" name="admin" id="admin" placeholder="Admin" value="<?php echo $admin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Dasboard Type <?php echo form_error('dasboard_type') ?></label>
            <input type="text" class="form-control" name="dasboard_type" id="dasboard_type" placeholder="Dasboard Type" value="<?php echo $dasboard_type; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Group Client <?php echo form_error('group_client') ?></label>
            <input type="text" class="form-control" name="group_client" id="group_client" placeholder="Group Client" value="<?php echo $group_client; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Info1 <?php echo form_error('info1') ?></label>
            <input type="text" class="form-control" name="info1" id="info1" placeholder="Info1" value="<?php echo $info1; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Info2 <?php echo form_error('info2') ?></label>
            <input type="text" class="form-control" name="info2" id="info2" placeholder="Info2" value="<?php echo $info2; ?>" />
        </div>
	    <input type="hidden" name="" value="<?php echo $; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('stx_group') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>