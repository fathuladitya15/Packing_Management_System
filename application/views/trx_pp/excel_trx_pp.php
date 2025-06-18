<?php  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Trx_pp_" .date('Ymd_hms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
  <thead>

    <tr>
      <td colspan="10" style="text-align: center;">Laporan Module pp : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="10">Username : <?php echo $this->session->userdata('username'); ?></td>
    </tr>
    <tr>
      <th width="10px">No</th>
      <th>User Group</th>
      <th>ID Produk</th>
      <th>Nama Produk</th>
      <th>Shift</th>
      <th>Box 1</th>
      <th>Box 2</th>
      <th>Total</th>
      <th>Upah</th>
      <th>Laporan</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($data_pp as $d) {
      $no++;
      ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $d['pp_usersupervisor'];?></td>
      <td><?php echo $d['pp_produk_id'];?></td>
      <td><?php echo $d['produk_nama'];?></td>
      <td><?php echo $d['pp_shift'];?></td>
      <td><?php echo $d['pp_mbox1'];?></td>
      <td><?php echo $d['pp_mbox2'];?></td>
      <td><?php echo $d['pp_total'];?></td>
      <td><?php echo $d['pp_upah'];?></td>
      <td><?php echo $d['pp_tgllaporan'];?></td>
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="10" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>
