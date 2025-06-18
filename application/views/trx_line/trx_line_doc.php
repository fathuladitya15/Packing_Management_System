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
        <h2>Trx_line List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Line Karyawan Id</th>
		<th>Line Produk Id</th>
		<th>Line Nomor</th>
		<th>Line Shift</th>
		<th>Line Box</th>
		<th>Line Mulai</th>
		<th>Line Selesai</th>
		<th>Line Istirahat</th>
		<th>Line Totalmenit</th>
		<th>Line Tgllaporan</th>
		<th>Line Userinput</th>
		<th>Line Tglinput</th>
		
            </tr><?php
            foreach ($trx_line_data as $trx_line)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $trx_line->line_karyawan_id ?></td>
		      <td><?php echo $trx_line->line_produk_id ?></td>
		      <td><?php echo $trx_line->line_nomor ?></td>
		      <td><?php echo $trx_line->line_shift ?></td>
		      <td><?php echo $trx_line->line_box ?></td>
		      <td><?php echo $trx_line->line_mulai ?></td>
		      <td><?php echo $trx_line->line_selesai ?></td>
		      <td><?php echo $trx_line->line_istirahat ?></td>
		      <td><?php echo $trx_line->line_totalmenit ?></td>
		      <td><?php echo $trx_line->line_tgllaporan ?></td>
		      <td><?php echo $trx_line->line_userinput ?></td>
		      <td><?php echo $trx_line->line_tglinput ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
