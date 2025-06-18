  <?php 
    $error=$this->session->flashdata('message');
    if (!empty($error)) {
      foreach ($error as $key => $value) {
  ?> 
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      <?php echo $error[$key]; ?>
    </div>
  <?php
        echo ""; 
      }   
    }
  ?>

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">KARYAWAN FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>



<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Nama Lengkap <?php echo form_error('karyawan_nama') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_nama" id="karyawan_nama" placeholder="Nama Lengkap" value="<?php echo $karyawan_nama; ?>" required =""/>
        </div></div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">NIK <?php echo form_error('karyawan_deskripsi') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_deskripsi" id="karyawan_deskripsi" placeholder="Deskripsi Karyawan" value="<?php echo $karyawan_deskripsi; ?>" />
        </div></div>
		        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Nama Ibu <?php echo form_error('karyawan_ibu') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_ibu" id="karyawan_ibu" placeholder="Nama Ibu" value="<?php echo $karyawan_ibu; ?>" />
        </div></div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Telp <?php echo form_error('karyawan_telp') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_telp" id="karyawan_telp" placeholder="Nomor Telp" value="<?php echo $karyawan_telp; ?>" />
        </div></div>
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Email <?php echo form_error('karyawan_email') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_email" id="karyawan_email" placeholder="Email Karyawan" value="<?php echo $karyawan_email; ?>" />
        </div></div>

              <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Tempat & Tanggal lahir <?php echo form_error('karyawan_tempatlahir') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_tempatlahir" id="karyawan_tempatlahir" placeholder="Karyawan Tempatlahir" value="<?php echo $karyawan_tempatlahir; ?>" />
        </div></div>

 <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="enum">Pendidikan<?php echo form_error('karyawan_pendidikan') ?></label><div class="col-sm-9 col-xs-12">
           <?php   echo form_dropdown('pendidikan', $pendidikan, $karyawan_pendidikan);  ?> 
        </div></div>
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="enum">Status Pernikahan<?php echo form_error('karyawan_nikah') ?></label><div class="col-sm-9 col-xs-12">
            <?php   echo form_dropdown('nikah', $nikah, $karyawan_nikah);  ?>
        </div></div>
              <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Jumlah Anak<?php echo form_error('karyawan_jml_anak') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_jml_anak" id="karyawan_jml_anak" placeholder="Karyawan Jml Anak" value="<?php echo $karyawan_jml_anak; ?>" />
        </div></div>
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">No BPJS Kesehatan <?php echo form_error('karyawan_bpjskesehatan') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_bpjskesehatan" id="karyawan_bpjskesehatan" placeholder="No Bpjs Kesehatan" value="<?php echo $karyawan_bpjskesehatan; ?>" />
        </div></div>
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">No BPJS Tenagakerja <?php echo form_error('karyawan_bpjstenagakerja') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_bpjstenagakerja" id="karyawan_bpjstenagakerja" placeholder="No Bpjs tenagakerja" value="<?php echo $karyawan_bpjstenagakerja; ?>" />
        </div></div>

      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="enum">Agama <?php echo form_error('karyawan_agama') ?></label><div class="col-sm-9 col-xs-12">
            <?php   echo form_dropdown('agama', $agama, $karyawan_agama);  ?>
        </div></div>
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal Karyawan Join <?php echo form_error('karyawan_joindate') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_joindate" id="datepicker" placeholder="Karyawan Joindate" value="<?php echo $karyawan_joindate; ?>" />
        </div></div>



        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Group<?php echo form_error('karyawan_norek') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_norek" id="karyawan_norek" placeholder="Group" value="<?php echo $karyawan_norek; ?>" required =""/>
        </div></div>
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Packing<?php echo form_error('karyawan_norek_an') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_norek_an" id="karyawan_norek_an" placeholder="Packing" value="<?php echo $karyawan_norek_an; ?>" required ="" />
        </div></div> 

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Jabatan</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="karyawan_jabatan_id">
        
                <?php 
                foreach($jabatan as $g){?>
                
                <option value="<?php echo $g['jabatan_id']; ?>" <?php if($karyawan_jabatan_id==$g['jabatan_id']) echo "Selected" ?>><?php echo $g['jabatan_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>
          </div>
        </div>
        <?php if ($id_group == '5'){ ?>

        <?php }else{ ?>

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Group User</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="karyawan_usersupervisor">
                <?php foreach($xsupervisor as $u){
                  if(!empty($karyawan_usersupervisor)){
                    if($karyawan_usersupervisor==$u['username']) $ass="selected"; else $ass="";;
                  }else{
                    $ass="";
                  }
                ?>
                <option value="<?php echo $u['username'];?>" <?php echo $ass;?>><?php echo $u['username'] . " | " . $u['group_name'] ;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>  
        <?php } ?>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Alamat <?php echo form_error('karyawan_alamat') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_alamat" id="karyawan_alamat" placeholder="Alamat" value="<?php echo $karyawan_alamat; ?>" />
        </div></div>
	    <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Jenis Kelamin</label>
            <div class="col-sm-9 col-xs-12">
                <?php   echo form_dropdown('kelamin', $kelamin, $karyawan_jk);  ?>   
            </div>
          </div>
        </div>


 
	    
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="enum">Status Karyawan <?php echo form_error('karyawan_status') ?></label><div class="col-sm-9 col-xs-12">
           <?php 
                echo form_dropdown('xstatus', $xstatus, $karyawan_status);  
                ?>   
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Username <?php echo form_error('karyawan_username') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_username" id="karyawan_username" placeholder="Username Karyawan" value="<?php echo $karyawan_username; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">Password <?php echo form_error('karyawan_password') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_password" id="karyawan_password" placeholder="Password Karyawan" value="<?php echo $karyawan_password; ?>" />
        </div></div>

        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Foto <?php echo form_error('karyawan_foto') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="karyawan_foto" id="karyawan_foto" placeholder="Foto Karyawan" value="<?php echo $karyawan_foto; ?>" />
        </div></div>

         <div class='inline'>
          <?php 
          if(!empty($karyawan_aktif)) {
            if($karyawan_aktif=='Aktif') $chek="checked"; else $chek="Tidak Aktif"; 
          }else{
            $chek="";
          }
          ?>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >&nbsp;</label>
        <div class="col-sm-9 col-xs-12">
          <input type="checkbox" name="karyawan_aktif" value="Aktif" <?php if($karyawan_aktif=='Aktif') echo 'checked' ?>> Status
        </div>
      </div>
        </div><br>
  <hr>
  <div class="col-md-12" style="text-align: right;">
      <a href="<?php echo site_url('trx_karyawan') ?>" class="btn btn-danger">Cancel</a>
	    <button type="submit" class="btn btn-primary">Save</button> 
	 <div class="col-md-12" style="text-align: right;">  
	</form>
    </div>
