<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Trx_karyawan_" .date('Ymd_hms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<table border="1">
  <thead>

    <tr>
      <td colspan="13" style="text-align: center;">Laporan Module Karyawan : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="13">Username : <?php echo $this->session->userdata('username'); ?></td>
    </tr>
    <tr>
      <th width="10px">No</th>
      <th>Group User</th>
      <th>ID karyawan</th>
      <th>Nama Karyawan</th>
      <th>Jenis Kelamin</th>
      <th>Group</th>
      <th>Telp</th>
      <th>Email</th>
      <th>Tempat & Tgl Lahir</th>
      <th>Pernikahan</th>
      <th>Jumlah Anak</th>
      <th>No. BPJS Kesehatan</th>
      <th>No. BPJS Tenagakerja</th>
      <th>Agama</th>
      <th>Join</th>
      <th>Packing</th>
      <th>Jabatan</th>
      
      <th>Aktif</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($data_karyawan as $d) {
      $no++;
      ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $d['karyawan_usersupervisor'];?></td>
      <td><?php echo $d['karyawan_id'];?></td>
      <td><?php echo $d['karyawan_nama'];?></td>
      <td><?php echo $d['karyawan_jk'];?></td>
      <td><?php echo $d['karyawan_norek'];?></td>
      <td><?php echo $d['karyawan_telp'];?></td>
      <td><?php echo $d['karyawan_email'];?></td>
      <td><?php echo $d['karyawan_tempatlahir'];?></td>
      <td><?php echo $d['karyawan_nikah'];?></td>
      <td><?php echo $d['karyawan_jml_anak'];?></td>
      <td><?php echo $d['karyawan_bpjskesehatan'];?></td>
      <td><?php echo $d['karyawan_bpjstenagakerja'];?></td>
      <td><?php echo $d['karyawan_agama'];?></td>
      <td><?php echo $d['karyawan_joindate'];?></td>
      <td><?php echo $d['karyawan_norek_an'];?></td>
      <td><?php echo $d['jabatan_nama'];?></td>      
      <td><?php echo $d['karyawan_aktif'];?></td>

      
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="13" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>