<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Trx_master" .date('Ymd_hms') .".xls");
header("Pragma: no-cache"); 
header("Expires: 0");

?>

<table border="1">
  <thead>

    <tr>
      <td colspan="10" style="text-align: center;">Laporan Module Master : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="10">Username : <?php echo $this->session->userdata('username'); ?></td>
    </tr>
    <tr>
      <th width="10px">No</th>
      <th>User</th>
      <th>Master ID</th>
      <th>Module ID</th>
      <th>Produk ID</th>
      <th>Shift</th>
      <th>Jumlah Team</th>
      <th>Display</th>
      <th>Jumlah Box</th>
      <th>Tanggal Laporan</th>
      <th>Upah</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($xdata_master as $d) {
      $no++;
      ?>
    <tr>

      <td><?php echo $no; ?></td>
      <td><?php echo $d['master_usersupervisor'];?></td>
      <td><?php echo $d['master_id'];?></td>
      <td><?php echo $d['master_module_id'];?></td>
      <td><?php echo $d['master_produk_id'];?></td>
      <td><?php echo $d['master_shift'];?></td>
      <td><?php echo $d['master_jumlahteam'];?></td>
      <td><?php echo $d['master_display'];?></td>
      <td><?php echo $d['master_box'];?></td>     
      <td><?php echo $d['master_tgllaporan'];?></td>
      <td><?php echo $d['master_bayarstfg'];?></td>
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="10" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>
