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
        <h2 style="margin-top:0px">Stx_nav_group List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('stx_nav_group/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('stx_nav_group/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('stx_nav_group'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Nav</th>
		<th>Id Group</th>
		<th>Add1</th>
		<th>Update1</th>
		<th>Delete1</th>
		<th>Comment1</th>
		<th>Report1</th>
		<th>Action</th>
            </tr><?php
            foreach ($stx_nav_group_data as $stx_nav_group)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $stx_nav_group->id_nav ?></td>
			<td><?php echo $stx_nav_group->id_group ?></td>
			<td><?php echo $stx_nav_group->add1 ?></td>
			<td><?php echo $stx_nav_group->update1 ?></td>
			<td><?php echo $stx_nav_group->delete1 ?></td>
			<td><?php echo $stx_nav_group->comment1 ?></td>
			<td><?php echo $stx_nav_group->report1 ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('stx_nav_group/read/'.$stx_nav_group->id_nav_group),'Read'); 
				echo ' | '; 
				echo anchor(site_url('stx_nav_group/update/'.$stx_nav_group->id_nav_group),'Update'); 
				echo ' | '; 
				echo anchor(site_url('stx_nav_group/delete/'.$stx_nav_group->id_nav_group),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>