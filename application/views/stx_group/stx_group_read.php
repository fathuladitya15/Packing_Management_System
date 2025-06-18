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
        <h2 style="margin-top:0px">Stx_group Read</h2>
        <table class="table">
	    <tr><td>Id Group</td><td><?php echo $id_group; ?></td></tr>
	    <tr><td>Group Name</td><td><?php echo $group_name; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	    <tr><td>Admin</td><td><?php echo $admin; ?></td></tr>
	    <tr><td>Dasboard Type</td><td><?php echo $dasboard_type; ?></td></tr>
	    <tr><td>Group Client</td><td><?php echo $group_client; ?></td></tr>
	    <tr><td>Info1</td><td><?php echo $info1; ?></td></tr>
	    <tr><td>Info2</td><td><?php echo $info2; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('stx_group') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>