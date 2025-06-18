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
        <h2 style="margin-top:0px">Stx_nav_group <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Id Nav <?php echo form_error('id_nav') ?></label>
            <input type="text" class="form-control" name="id_nav" id="id_nav" placeholder="Id Nav" value="<?php echo $id_nav; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Group <?php echo form_error('id_group') ?></label>
            <input type="text" class="form-control" name="id_group" id="id_group" placeholder="Id Group" value="<?php echo $id_group; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Add1 <?php echo form_error('add1') ?></label>
            <input type="text" class="form-control" name="add1" id="add1" placeholder="Add1" value="<?php echo $add1; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Update1 <?php echo form_error('update1') ?></label>
            <input type="text" class="form-control" name="update1" id="update1" placeholder="Update1" value="<?php echo $update1; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Delete1 <?php echo form_error('delete1') ?></label>
            <input type="text" class="form-control" name="delete1" id="delete1" placeholder="Delete1" value="<?php echo $delete1; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Comment1 <?php echo form_error('comment1') ?></label>
            <input type="text" class="form-control" name="comment1" id="comment1" placeholder="Comment1" value="<?php echo $comment1; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Report1 <?php echo form_error('report1') ?></label>
            <input type="text" class="form-control" name="report1" id="report1" placeholder="Report1" value="<?php echo $report1; ?>" />
        </div>
	    <input type="hidden" name="id_nav_group" value="<?php echo $id_nav_group; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('stx_nav_group') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>