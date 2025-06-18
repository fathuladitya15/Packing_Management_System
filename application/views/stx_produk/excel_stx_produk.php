<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Stx_produk_" .date('Ymd_hms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");


?>

<table border="1">
  <thead>

    <tr>
      <td colspan="13" style="text-align: center;">LAPORAN MODULE PRODUK : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="13">Uername : <?php echo $this->session->userdata('username'); ?></td>
    </tr>
    <tr>
      <th width="10px">No</th>
      <th>User Group</th> 
      <th>ID Produk</th>
      <th>Nama Produk</th>
      <th>tipe</th>
      <th>Masterbox</th>
      <th>Harga Mesin</th>
      <th>Harga Susun</th>
      <th>Harga Manual</th>
      <th>Harga WIP</th>
      <th>Harga PP</th>
      <th>Harga Step Final</th>
      <th>Status</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($data_produk as $d) {
      $no++;
      ?>
    <tr>

      <td><?php echo $no; ?></td>
      <td><?php echo $d['produk_usersupervisor']; ?></td>
      <td><?php echo $d['produk_id'];?></td>
      <td><?php echo $d['produk_nama'];?></td>
      <td><?php echo $d['produk_tipe'];?></td>
      <td><?php echo $d['produk_masterbox'];?></td>
      <td><?php echo $d['produk_mesin'];?></td>
      <td><?php echo $d['produk_susun'];?></td>
      <td><?php echo $d['produk_manual'];?></td>
      <td><?php echo $d['produk_wip'];?></td>
      <td><?php echo $d['produk_pp'];?></td>
      <td><?php echo $d['produk_step_final'];?></td>
      <td><?php echo $d['produk_status'];?></td>     
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="13" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>
