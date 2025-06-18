<!doctype html> 
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Trx_manual List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Manual Karyawan Id</th>
		<th>Manual Produk Id</th>
		<th>Manual Acuan Id</th>
		<th>Mesin Shift</th>
		<th>Mesin Box</th>
		<th>Mesin Mulai</th>
		<th>Mesin Selesai</th>
		<th>Mesin Istirahat</th>
		<th>Mesin Totalmenit</th>
		<th>Mesin Tgllaporan</th>
		<th>Master Userinput</th>
		<th>Master Tglinput</th>
		
            </tr><?php
            foreach ($trx_manual_data as $trx_manual)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $trx_manual->manual_karyawan_id ?></td>
		      <td><?php echo $trx_manual->manual_produk_id ?></td>
		      <td><?php echo $trx_manual->manual_acuan_id ?></td>
		      <td><?php echo $trx_manual->mesin_shift ?></td>
		      <td><?php echo $trx_manual->mesin_box ?></td>
		      <td><?php echo $trx_manual->mesin_mulai ?></td>
		      <td><?php echo $trx_manual->mesin_selesai ?></td>
		      <td><?php echo $trx_manual->mesin_istirahat ?></td>
		      <td><?php echo $trx_manual->mesin_totalmenit ?></td>
		      <td><?php echo $trx_manual->mesin_tgllaporan ?></td>
		      <td><?php echo $trx_manual->master_userinput ?></td>
		      <td><?php echo $trx_manual->master_tglinput ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
