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
        <h2>Trx_susun List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Susun Karyawan Id</th>
		<th>Susun Produk Id</th>
		<th>Susun Karu</th>
		<th>Susun Master Id</th>
		<th>Susun Krat1</th>
		<th>Susun Krat2</th>
		<th>Susun Krat3</th>
		<th>Susun Krat4</th>
		<th>Susun Krat5</th>
		<th>Susun Krat6</th>
		<th>Susun Krat7</th>
		<th>Susun Krat8</th>
		<th>Susun Krat9</th>
		<th>Susun Krat10</th>
		<th>Susun Krat11</th>
		<th>Susun Krat12</th>
		<th>Susun Krat13</th>
		<th>Susun Krat14</th>
		<th>Susun Krat15</th>
		<th>Susun Upah</th>
		<th>Susun Tgllaporan</th>
		<th>Susun Userinput</th>
		<th>Susun Tglinput</th>
		
            </tr><?php
            foreach ($trx_susun_data as $trx_susun)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $trx_susun->susun_karyawan_id ?></td>
		      <td><?php echo $trx_susun->susun_produk_id ?></td>
		      <td><?php echo $trx_susun->susun_karu ?></td>
		      <td><?php echo $trx_susun->susun_master_id ?></td>
		      <td><?php echo $trx_susun->susun_krat1 ?></td>
		      <td><?php echo $trx_susun->susun_krat2 ?></td>
		      <td><?php echo $trx_susun->susun_krat3 ?></td>
		      <td><?php echo $trx_susun->susun_krat4 ?></td>
		      <td><?php echo $trx_susun->susun_krat5 ?></td>
		      <td><?php echo $trx_susun->susun_krat6 ?></td>
		      <td><?php echo $trx_susun->susun_krat7 ?></td>
		      <td><?php echo $trx_susun->susun_krat8 ?></td>
		      <td><?php echo $trx_susun->susun_krat9 ?></td>
		      <td><?php echo $trx_susun->susun_krat10 ?></td>
		      <td><?php echo $trx_susun->susun_krat11 ?></td>
		      <td><?php echo $trx_susun->susun_krat12 ?></td>
		      <td><?php echo $trx_susun->susun_krat13 ?></td>
		      <td><?php echo $trx_susun->susun_krat14 ?></td>
		      <td><?php echo $trx_susun->susun_krat15 ?></td>
		      <td><?php echo $trx_susun->susun_upah ?></td>
		      <td><?php echo $trx_susun->susun_tgllaporan ?></td>
		      <td><?php echo $trx_susun->susun_userinput ?></td>
		      <td><?php echo $trx_susun->susun_tglinput ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
