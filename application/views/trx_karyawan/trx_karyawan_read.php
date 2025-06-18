<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">KARYAWAN DETAIL</h3>
 
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">
	    <tr><td style="width 350px;">Nama Lengkap</td><td>  <?php echo $karyawan_id ." | " .$karyawan_nama; ?></td></tr>
		<tr><td>NIK</td><td>  <?php echo $karyawan_deskripsi; ?></td></tr>
		<tr><td>Nama Ibu</td><td>  <?php echo $karyawan_ibu; ?></td></tr>
	    <tr><td>Alamat</td><td>  <?php echo $karyawan_alamat; ?></td></tr>
	    <tr><td>Jenis Kelamin</td><td>  <?php  echo form_dropdown('kelamin', $kelamin, $karyawan_jk); ?></td></tr>
	    <tr><td>Nomor Telp</td><td>  <?php echo $karyawan_telp; ?></td></tr>
	    <tr><td>Email</td><td>  <?php echo $karyawan_email; ?></td></tr>
	    <tr><td>No Rekening</td><td>  <?php echo $karyawan_norek; ?></td></tr>
	    <tr><td>Rekening Atas Nama</td><td>  <?php echo $karyawan_norek_an; ?></td></tr>	        
	    <tr><td>Status Karyawan</td><td> <?php echo form_dropdown('xstatus', $xstatus, $karyawan_status);  
                ?> </td></tr>
	    <tr><td>Jumlah Anak</td><td>  <?php echo $karyawan_jml_anak; ?></td></tr>	   
	    <tr><td>Username</td> <td>  <?php echo $karyawan_username; ?></td></tr>
	    <tr><td>Password</td><td>  <?php echo $karyawan_password; ?></td></tr>
	    <tr><td>Jabatan</td><td> 
                <select class="form-control input-sm select2" name="karyawan_jabatan_id">
                <?php 
                foreach($jabatan as $g){?>
                
                <option value="<?php echo $g['jabatan_id']; ?>" <?php if($karyawan_jabatan_id==$g['jabatan_id']) echo "Selected" ?>><?php echo $g['jabatan_nama']; ?></option>
                <?php } 
                ?>
              </select></td></tr>
	    	
	    <tr><td>Foto</td><td>  <?php echo $karyawan_foto; ?></td></tr>
	    <tr><td>Status Karyawan</td>
	    <td>	
		
          <?php 
          if(!empty($karyawan_aktif)) {
            if($karyawan_aktif=='Aktif') $chek="checked"; else $chek="No"; 
          }else{
            $chek="No";
          }
          ?>
          
            <input type="checkbox" name="karyawan_aktif" value="Aktif" <?php echo $chek; ?>> &nbsp; Active   

	    </td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('trx_karyawan') ?>" class="btn btn-danger pull-right">Cancel</a></td></tr>
	</table></div></div>
