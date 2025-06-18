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
        <h2 style="margin-top:0px">Stx_nav_group Read</h2>
        <table class="table">
	    <tr><td>Id Nav</td><td><?php echo $id_nav; ?></td></tr>
	    <tr><td>Id Group</td><td><?php echo $id_group; ?></td></tr>
	    <tr><td>Add1</td><td><?php echo $add1; ?></td></tr>
	    <tr><td>Update1</td><td><?php echo $update1; ?></td></tr>
	    <tr><td>Delete1</td><td><?php echo $delete1; ?></td></tr>
	    <tr><td>Comment1</td><td><?php echo $comment1; ?></td></tr>
	    <tr><td>Report1</td><td><?php echo $report1; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('stx_nav_group') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>