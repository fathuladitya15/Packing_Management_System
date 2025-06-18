<?php  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Trx_arc_stfg_" .date('Ymd_hms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
  <thead>

    <tr>
      <td colspan="24" style="text-align: center;">Laporan Module Stfg : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="24">Username : <?php echo $this->session->userdata('username'); ?></td>
    </tr>
    <tr>
      <th width="10px">No</th>
      <th>User Group</th>
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
      <th>Box 11</th>
      <th>Box 12</th>
      <th>Box 13</th>
      <th>Box 14</th>
      <th>Box 15</th>
      <th>Rijek</th>
      <th>Total</th>
      <th>Upah</th>
      <th>Laporan</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($data_stfg as $d) {
      $no++;
      ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $d['stfg_usersupervisor'];?></td>
      <td><?php echo $d['stfg_produk_id'];?></td>
      <td><?php echo $d['produk_nama'];?></td>
      <td><?php echo $d['stfg_shift'];?></td>
      <td><?php echo $d['stfg_mbox1'];?></td>
      <td><?php echo $d['stfg_mbox2'];?></td>
      <td><?php echo $d['stfg_mbox3'];?></td>
      <td><?php echo $d['stfg_mbox4'];?></td>
      <td><?php echo $d['stfg_mbox5'];?></td>
      <td><?php echo $d['stfg_mbox6'];?></td>
      <td><?php echo $d['stfg_mbox7'];?></td>
      <td><?php echo $d['stfg_mbox8'];?></td>
      <td><?php echo $d['stfg_mbox9'];?></td>
      <td><?php echo $d['stfg_mbox10'];?></td>
      <td><?php echo $d['stfg_mbox11'];?></td>
      <td><?php echo $d['stfg_mbox12'];?></td>
      <td><?php echo $d['stfg_mbox13'];?></td>
      <td><?php echo $d['stfg_mbox14'];?></td>
      <td><?php echo $d['stfg_mbox15'];?></td>
      <td><?php echo $d['stfg_rijek'];?></td>
      <td><?php echo $d['stfg_total'];?></td>
      <td><?php echo $d['stfg_upah'];?></td>
      <td><?php echo $d['stfg_tgllaporan'];?></td>
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="24" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>
