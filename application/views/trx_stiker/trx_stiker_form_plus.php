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
    <h3 class="box-title">MANUAL FORM STIKER</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	   

        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stiker Master ID <?php echo form_error('stiker_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_master_id" id="stiker_master_id" placeholder="Stiker Master ID" value="<?php echo $stiker_master_id; ?>" required="" />
        </div></div>
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">ID Karyawan<?php echo form_error('stiker_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_karyawan_id" id="stiker_karyawan_id" placeholder="Stiker Karyawan Id" value="<?php echo $stiker_karyawan_id; ?>" required=""/>
        
        </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Nama Produk<?php echo form_error('stiker_produk_id') ?></label>
                <div class="col-sm-9 col-xs-12">
                  <select class="form-control input-sm select2" name="stiker_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($stiker_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " . $g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
                </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="enum">Kategori<?php echo form_error('stiker_kategori') ?></label>
             <div class="col-sm-9 col-xs-12">
            <?php 
                echo form_dropdown('stiker', $stiker, $stiker_kategori);  ?> 
        </div></div>
	   <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Shift <?php echo form_error('perbantuan_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
            <select class="form-control input-sm select2" name="stiker_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($stiker_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Stiker<?php echo form_error('stiker_jumlahstiker') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_jumlahstiker" id="stiker_jumlahstiker" placeholder="Stiker Jumlahstiker" value="<?php echo $stiker_jumlahstiker; ?>" required=""/>
        </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal laporan <?php echo form_error('stiker_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_tgllaporan" id="datepicker" placeholder="Stiker Tgllaporan" value="<?php echo $stiker_tgllaporan; ?>" required=""/>
        </div></div>
        <hr>
        <div class="pull-right">
      <a href="<?php echo site_url('trx_stiker') ?>" class="btn btn-danger">Cancel</a>
	    <input type="hidden" name="stiker_id" value="<?php echo $stiker_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 

      </div>
	</form>
</div>
