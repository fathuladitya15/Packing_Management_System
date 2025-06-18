
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
        <h2>Trx_perbantuan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Perbantuan Id</th>
		<th>Perbantuan Karyawan Id</th>
		<th>Perbantuan Produk Id</th>
		<th>Perbantuan Shift</th>
		<th>Perbantuan Master Id</th>
		<th>Perbantuan Mulai</th>
		<th>Perbantuan Selesai</th>
		<th>Perbantuan Istirahat</th>
		<th>Perbantuan Totalmenit</th>
		<th>Perbantuan Upah</th>
		<th>Perbantuan Tgllaporan</th>
		<th>Perbantuan Userinput</th>
		<th>Perbantuan Tglinput</th>
		
            </tr><?php
            foreach ($trx_perbantuan_data as $trx_perbantuan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_id ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_karyawan_id ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_produk_id ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_shift ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_master_id ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_mulai ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_selesai ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_istirahat ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_totalmenit ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_upah ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_tgllaporan ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_userinput ?></td>
		      <td><?php echo $trx_perbantuan->perbantuan_tglinput ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
