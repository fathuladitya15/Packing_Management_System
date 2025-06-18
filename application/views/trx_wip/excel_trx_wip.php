<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Trx_wip_" .date('Ymd_hms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");
 
?>

<table border="1">
  <thead>

    <tr>
      <td colspan="13" style="text-align: center;">Laporan Module wip : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="13">Username : <?php echo $this->session->userdata('username'); ?></td>
    </tr>
    <tr>
      <th width="10px">No</th>
      <th>ID Produk</th>
      <th>Nama Produk</th>
      <th>Shift</th>
      <th>Box 1</th>
      <th>Box 2</th>
      <th>Box 3</th>
      <th>Box 4</th>
      <th>Box 5</th>
      <th>Box 6</th>
      <th>Box 7</th>
      <th>Box 8</th>
      <th>Box 9</th>
      <th>Box 10</th>
      <th>Rijek</th>
      <th>Total</th>
      <th>Upah</th>
      <th>Laporan</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($data_wip as $d) {
      $no++;
      ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $d['wip_produk_id'];?></td>
      <td><?php echo $d['produk_nama'];?></td>
      <td><?php echo $d['wip_shift'];?></td>
      <td><?php echo $d['wip_mbox1'];?></td>
      <td><?php echo $d['wip_mbox2'];?></td>
      <td><?php echo $d['wip_mbox3'];?></td>
      <td><?php echo $d['wip_mbox4'];?></td>
      <td><?php echo $d['wip_mbox5'];?></td>
      <td><?php echo $d['wip_mbox6'];?></td>
      <td><?php echo $d['wip_mbox7'];?></td>
      <td><?php echo $d['wip_mbox8'];?></td>
      <td><?php echo $d['wip_mbox9'];?></td>
      <td><?php echo $d['wip_mbox10'];?></td>
      <td><?php echo $d['wip_rijek'];?></td>
      <td><?php echo $d['wip_total'];?></td>
      <td><?php echo $d['wip_upah'];?></td>
      <td><?php echo $d['wip_tgllaporan'];?></td>
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="13" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>
