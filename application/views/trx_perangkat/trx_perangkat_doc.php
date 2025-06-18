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
        <h2>Trx_perangkat List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Perangkat Karyawan Id</th>
		<th>Perangkat Shift</th>
		<th>Perangkat Master Id</th>
		<th>Perangkat Upah</th>
		<th>Perangkat Tgllaporan</th>
		<th>Perangkat Userinput</th>
		<th>Perangkat Tglinput</th>
		
            </tr><?php
            foreach ($trx_perangkat_data as $trx_perangkat)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $trx_perangkat->perangkat_karyawan_id ?></td>
		      <td><?php echo $trx_perangkat->perangkat_shift ?></td>
		      <td><?php echo $trx_perangkat->perangkat_master_id ?></td>
		      <td><?php echo $trx_perangkat->perangkat_upah ?></td>
		      <td><?php echo $trx_perangkat->perangkat_tgllaporan ?></td>
		      <td><?php echo $trx_perangkat->perangkat_userinput ?></td>
		      <td><?php echo $trx_perangkat->perangkat_tglinput ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
