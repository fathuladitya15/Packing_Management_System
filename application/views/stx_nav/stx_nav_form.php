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
        <h2 style="margin-top:0px">Stx_nav <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nav Title <?php echo form_error('nav_title') ?></label>
            <input type="text" class="form-control" name="nav_title" id="nav_title" placeholder="Nav Title" value="<?php echo $nav_title; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Nav Url <?php echo form_error('nav_url') ?></label>
            <input type="text" class="form-control" name="nav_url" id="nav_url" placeholder="Nav Url" value="<?php echo $nav_url; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Parent Idx <?php echo form_error('parent_idx') ?></label>
            <input type="text" class="form-control" name="parent_idx" id="parent_idx" placeholder="Parent Idx" value="<?php echo $parent_idx; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Child Idx <?php echo form_error('child_idx') ?></label>
            <input type="text" class="form-control" name="child_idx" id="child_idx" placeholder="Child Idx" value="<?php echo $child_idx; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Fit Add <?php echo form_error('fit_add') ?></label>
            <input type="text" class="form-control" name="fit_add" id="fit_add" placeholder="Fit Add" value="<?php echo $fit_add; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Fit Update <?php echo form_error('fit_update') ?></label>
            <input type="text" class="form-control" name="fit_update" id="fit_update" placeholder="Fit Update" value="<?php echo $fit_update; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Fit Delete <?php echo form_error('fit_delete') ?></label>
            <input type="text" class="form-control" name="fit_delete" id="fit_delete" placeholder="Fit Delete" value="<?php echo $fit_delete; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Fit Comment <?php echo form_error('fit_comment') ?></label>
            <input type="text" class="form-control" name="fit_comment" id="fit_comment" placeholder="Fit Comment" value="<?php echo $fit_comment; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Fit Report <?php echo form_error('fit_report') ?></label>
            <input type="text" class="form-control" name="fit_report" id="fit_report" placeholder="Fit Report" value="<?php echo $fit_report; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Info1 <?php echo form_error('info1') ?></label>
            <input type="text" class="form-control" name="info1" id="info1" placeholder="Info1" value="<?php echo $info1; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Info2 <?php echo form_error('info2') ?></label>
            <input type="text" class="form-control" name="info2" id="info2" placeholder="Info2" value="<?php echo $info2; ?>" />
        </div>
	    <input type="hidden" name="id_nav" value="<?php echo $id_nav; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('stx_nav') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
