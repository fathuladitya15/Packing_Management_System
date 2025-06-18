<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Trx_karyawan_" .date('Ymd_hms') .".xls");
header("Pragma: no-cache");
header("Expires: 0");


?>

<table border="1">
  <thead>

    <tr>
      <td colspan="20" style="text-align: center;">Laporan Module Karyawan : <?php echo $tgl_awal; ?> To <?php echo $tgl_akhir; ?></td>
    </tr>
    <tr>
      <td colspan="20">Username : <?php echo $this->session->userdata('username'); ?></td>
    </tr>
    <tr>
      <th width="10px">No</th>
      <th>ID karyawan</th>
      <th>Nama Karyawan</th>
	  <th>Alamat</th>
      <th>Jenis Kelamin</th>
      <th>No Telp</th>
	  <th>Group</th>
      <th>Packing</th>
	  <th>Status</th>
      <th>NIK</th>
      <th>Pendidikan</th>
      <th>Pernikahan</th>
      <th>No. BPJS Kesehatan</th>
      <th>No. BPJS Tenagakerja</th>
      <th>Agama</th>
      <th>Join Date</th>
	  <th>Tempat & Lahir</th>
      <th>Nama Ibu</th>
      <th>Jumlah Anak</th>      
      <th>Email</th>
    </tr>
  </thead> 
  <?php
    $no=0;
    foreach ($data_karyawan as $d) {
      $no++;
      ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $d['karyawan_id'];?></td>	 
      <td><?php echo $d['karyawan_nama'];?></td>
	  <td><?php echo $d['karyawan_alamat'];?></td>
      <td><?php echo $d['karyawan_jk'];?></td>
      <td><?php echo $d['karyawan_telp'];?></td>
      <td><?php echo $d['karyawan_norek'];?></td>
      <td><?php echo $d['karyawan_norek_an'];?></td>
      <td><?php echo $d['karyawan_status'];?></td>
      <td><?php echo $d['karyawan_deskripsi'];?></td>
      <td><?php echo $d['karyawan_pendidikan'];?></td>
      <td><?php echo $d['karyawan_nikah'];?></td>
      <td><?php echo $d['karyawan_bpjskesehatan'];?></td>
	  <td><?php echo $d['karyawan_bpjstenagakerja'];?></td>
	  <td><?php echo $d['karyawan_agama'];?></td>      
      <td><?php echo date('d/m/y',strtotime($d['karyawan_joindate']));?></td>
	  <td><?php echo $d['karyawan_tempatlahir'];?></td>
	  <td><?php echo $d['karyawan_ibu'];?></td>
      <td><?php echo $d['karyawan_jml_anak'];?></td>
      <td><?php echo $d['karyawan_email'];?></td>      
  

      
    </tr>
    <?php
    }
    ?>   
    <tr>
      <td colspan="20" style="text-align: right;">Record Count : <?php echo $no; ?></td>
    </tr>  
</table>
