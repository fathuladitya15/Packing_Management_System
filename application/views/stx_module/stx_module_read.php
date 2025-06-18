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
        <h2 style="margin-top:0px">Stx_module Read</h2>
        <table class="table">
	    <tr><td>Module Nama</td><td><?php echo $module_nama; ?></td></tr>
	    <tr><td>Module Group</td><td><?php echo $module_group; ?></td></tr>
	    <tr><td>Module Status</td><td><?php echo $module_status; ?></td></tr>
	    <tr><td>Module Userinput</td><td><?php echo $module_userinput; ?></td></tr>
	    <tr><td>Module Tglinput</td><td><?php echo $module_tglinput; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('stx_module') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
