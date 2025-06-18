<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Trx_master" .date('Ymd_hms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");
 
?>

<table border="1">
  <thead>

    <tr>
      <td colspan="14" style="text-align: center;">Laporan Module Transaksi : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="14">Username : <?php echo $this->session->userdata('username'); ?></td>
    </tr>
    <tr>
      <th width="10px">No</th>
      <th>User</th>
      <th>ID karyawan</th>
      <th>Nama Karyawan</th>
      <th>Laporan</th>
      <th>Shift</th>
      <th>Type Module</th>
      <th>Produk</th>
      <th>No. Mesin</th>
      <th>Jumlah Box</th>
      <th>Waktu Mulai</th>
      <th>Waktu Selesai</th>
      <th>Total Menit</th>
      <th>Upah</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($data_master as $d) {
      $no++;
      ?>
    <tr>

      <td><?php echo $no; ?></td>
      <td><?php echo $d['masterdetail_usersupervisor'];?></td>
      <td><?php echo $d['karyawan_id'];?></td>
      <td><?php echo $d['karyawan_nama'];?></td>
      <td><?php echo $d['master_tgllaporan'];?></td>
      <td><?php echo $d['master_shift'];?></td>
      <td><?php echo $d['module_nama'];?></td>
      <td><?php echo $d['produk_nama'];?></td>
      <td><?php echo $d['master_nomesin'];?></td>     
      <td><?php echo $d['master_display'] . $d['masterdetail_jumlahkrat'] . $d['master_box'];?></td>
      <td><?php echo substr($d['masterdetail_mulai'],0,5);?></td>
      <td><?php echo substr($d['masterdetail_selesai'],0,5);?></td>
      <td><?php echo $d['masterdetail_totalkerja'];?></td>
      <td><?php echo $d['masterdetail_upah'];?></td>
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="14" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>
