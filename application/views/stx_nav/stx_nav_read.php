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
        <h2 style="margin-top:0px">Stx_nav Read</h2>
        <table class="table">
	    <tr><td>Nav Title</td><td><?php echo $nav_title; ?></td></tr>
	    <tr><td>Nav Url</td><td><?php echo $nav_url; ?></td></tr>
	    <tr><td>Parent Idx</td><td><?php echo $parent_idx; ?></td></tr>
	    <tr><td>Child Idx</td><td><?php echo $child_idx; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Fit Add</td><td><?php echo $fit_add; ?></td></tr>
	    <tr><td>Fit Update</td><td><?php echo $fit_update; ?></td></tr>
	    <tr><td>Fit Delete</td><td><?php echo $fit_delete; ?></td></tr>
	    <tr><td>Fit Comment</td><td><?php echo $fit_comment; ?></td></tr>
	    <tr><td>Fit Report</td><td><?php echo $fit_report; ?></td></tr>
	    <tr><td>Info1</td><td><?php echo $info1; ?></td></tr>
	    <tr><td>Info2</td><td><?php echo $info2; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('stx_nav') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
