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
        <h2 style="margin-top:0px">Trx_masterdetail List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('trx_masterdetail/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('trx_masterdetail/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('trx_masterdetail'); ?>" class="btn btn-default">Reset</a>
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
		<th>Masterdetail Master Id</th>
		<th>Masterdetail Karyawan Id</th>
		<th>Masterdetail Mulai</th>
		<th>Masterdetail Selesai</th>
		<th>Masterdetail Jamkerja</th>
		<th>Masterdetail Istirahat</th>
		<th>Masterdetail Totalkerja</th>
		<th>Masterdetail Box</th>
		<th>Masterdetail Jumlahstiker</th>
		<th>Masterdetail Jumlahkrat</th>
		<th>Masterdetail Upah</th>
		<th>Masterdetail Userinput</th>
		<th>Masterdetail Tglinput</th>
		<th>Action</th>
            </tr><?php
            foreach ($trx_masterdetail_data as $trx_masterdetail)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_master_id ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_karyawan_id ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_mulai ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_selesai ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_jamkerja ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_istirahat ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_totalkerja ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_box ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_jumlahstiker ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_jumlahkrat ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_upah ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_userinput ?></td>
			<td><?php echo $trx_masterdetail->masterdetail_tglinput ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('trx_masterdetail/read/'.$trx_masterdetail->masterdetail_id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('trx_masterdetail/update/'.$trx_masterdetail->masterdetail_id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('trx_masterdetail/delete/'.$trx_masterdetail->masterdetail_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
