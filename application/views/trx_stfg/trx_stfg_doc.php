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
        <h2>Trx_stfg List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Stfg Produk Id</th>
		<th>Stfg Shift</th>
		<th>Stfg Mbox1</th>
		<th>Stfg Mbox2</th>
		<th>Stfg Mbox3</th>
		<th>Stfg Mbox4</th>
		<th>Stfg Mbox5</th>
		<th>Stfg Mbox6</th>
		<th>Stfg Mbox7</th>
		<th>Stfg Mbox8</th>
		<th>Stfg Mbox9</th>
		<th>Stfg Mbox10</th>
		<th>Stfg Mbox11</th>
		<th>Stfg Mbox12</th>
		<th>Stfg Mbox13</th>
		<th>Stfg Mbox14</th>
		<th>Stfg Mbox15</th>
		<th>Stfg Rijek</th>
		<th>Stfg Total</th>
		<th>Stfg Upah</th>
		<th>Stfg Tgllaporan</th>
		<th>Stfg Userinput</th>
		<th>Stfg Tglinput</th>
		
            </tr><?php
            foreach ($trx_stfg_data as $trx_stfg)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $trx_stfg->stfg_produk_id ?></td>
		      <td><?php echo $trx_stfg->stfg_shift ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox1 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox2 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox3 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox4 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox5 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox6 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox7 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox8 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox9 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox10 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox11 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox12 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox13 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox14 ?></td>
		      <td><?php echo $trx_stfg->stfg_mbox15 ?></td>
		      <td><?php echo $trx_stfg->stfg_rijek ?></td>
		      <td><?php echo $trx_stfg->stfg_total ?></td>
		      <td><?php echo $trx_stfg->stfg_upah ?></td>
		      <td><?php echo $trx_stfg->stfg_tgllaporan ?></td>
		      <td><?php echo $trx_stfg->stfg_userinput ?></td>
		      <td><?php echo $trx_stfg->stfg_tglinput ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>
