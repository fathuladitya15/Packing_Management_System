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
        <h2 style="margin-top:0px">Stx_module <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Module Nama <?php echo form_error('module_nama') ?></label>
            <input type="text" class="form-control" name="module_nama" id="module_nama" placeholder="Module Nama" value="<?php echo $module_nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Module Group <?php echo form_error('module_group') ?></label>
            <input type="text" class="form-control" name="module_group" id="module_group" placeholder="Module Group" value="<?php echo $module_group; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Module Status <?php echo form_error('module_status') ?></label>
            <input type="text" class="form-control" name="module_status" id="module_status" placeholder="Module Status" value="<?php echo $module_status; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Module Userinput <?php echo form_error('module_userinput') ?></label>
            <input type="text" class="form-control" name="module_userinput" id="module_userinput" placeholder="Module Userinput" value="<?php echo $module_userinput; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Module Tglinput <?php echo form_error('module_tglinput') ?></label>
            <input type="text" class="form-control" name="module_tglinput" id="module_tglinput" placeholder="Module Tglinput" value="<?php echo $module_tglinput; ?>" />
        </div>
	    <input type="hidden" name="module_id" value="<?php echo $module_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('stx_module') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
