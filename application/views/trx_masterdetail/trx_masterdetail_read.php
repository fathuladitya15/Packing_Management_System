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
        <h2 style="margin-top:0px">Trx_masterdetail Read</h2>
        <table class="table">
	    <tr><td>Masterdetail Master Id</td><td><?php echo $masterdetail_master_id; ?></td></tr>
	    <tr><td>Masterdetail Karyawan Id</td><td><?php echo $masterdetail_karyawan_id; ?></td></tr>
	    <tr><td>Masterdetail Mulai</td><td><?php echo $masterdetail_mulai; ?></td></tr>
	    <tr><td>Masterdetail Selesai</td><td><?php echo $masterdetail_selesai; ?></td></tr>
	    <tr><td>Masterdetail Jamkerja</td><td><?php echo $masterdetail_jamkerja; ?></td></tr>
	    <tr><td>Masterdetail Istirahat</td><td><?php echo $masterdetail_istirahat; ?></td></tr>
	    <tr><td>Masterdetail Totalkerja</td><td><?php echo $masterdetail_totalkerja; ?></td></tr>
	    <tr><td>Masterdetail Box</td><td><?php echo $masterdetail_box; ?></td></tr>
	    <tr><td>Masterdetail Jumlahstiker</td><td><?php echo $masterdetail_jumlahstiker; ?></td></tr>
	    <tr><td>Masterdetail Jumlahkrat</td><td><?php echo $masterdetail_jumlahkrat; ?></td></tr>
	    <tr><td>Masterdetail Upah</td><td><?php echo $masterdetail_upah; ?></td></tr>
	    <tr><td>Masterdetail Userinput</td><td><?php echo $masterdetail_userinput; ?></td></tr>
	    <tr><td>Masterdetail Tglinput</td><td><?php echo $masterdetail_tglinput; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('trx_masterdetail') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>
