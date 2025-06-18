<?php  
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Trx_arc_perbantuan_" .date('Ymd_hms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
  <thead>

    <tr>
      <td colspan="13" style="text-align: center;">LAPORAN MODULE PERBANTUAN : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="13">Username : <?php echo $this->session->userdata('username'); ?></td>
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
      <th>Waktu Kerja (Jam)</th>
      <th>Total Menit</th>
      <th>Upah</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($data_perbantuan as $d) {
      $no++;
      ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $d['perbantuan_usersupervisor'];?></td>
      <td><?php echo $d['perbantuan_karyawan_id'];?></td>
      <td><?php echo $d['karyawan_nama'];?></td>
      <td><?php echo $d['perbantuan_tgllaporan'];?></td>
      <td><?php echo $d['perbantuan_shift'];?></td>
      <td><?php echo "Perbantuan";?></td>
      <td><?php echo $d['perbantuan_kategori'];?></td>
      <td></td>
      <td></td>      
      <td><?php echo substr($d['perbantuan_istirahat'],0,5);?></td>
      <td><?php echo $d['perbantuan_totalmenit'];?></td>
      <td><?php echo $d['perbantuan_upah'];?></td>
      
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="13" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>
