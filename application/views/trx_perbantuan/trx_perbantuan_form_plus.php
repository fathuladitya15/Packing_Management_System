


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
    <h3 class="box-title">MANUAL PERBANTUAN FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="varchar">ID Transaksi<?php echo form_error('perbantuan_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_master_id" id="perbantuan_master_id" placeholder="Perbantuan Master Id" value="<?php echo $perbantuan_master_id; ?>" required/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="char">ID Karyawan<?php echo form_error('perbantuan_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_karyawan_id" id="perbantuan_karyawan_id" placeholder="Perbantuan Karyawan Id" value="<?php echo $perbantuan_karyawan_id; ?>" required/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="varchar">Nama Produk <?php echo form_error('perbantuan_produk_id') ?></label>
            <div class="col-sm-9 col-xs-12">
                  <?php echo form_dropdown('perbantuan', $perbantuan, $perbantuan_kategori);  ?> 
                </div>
        </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Shift <?php echo form_error('perbantuan_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
            <select class="form-control input-sm select2" name="perbantuan_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($perbantuan_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Waktu Kerja(Jam) <?php echo form_error('perbantuan_istirahat') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_istirahat" id="perbantuan_istirahat" placeholder="Perbantuan Istirahat" value="<?php if(!empty($perbantuan_istirahat)) echo $perbantuan_istirahat; else echo '0'; ?>"  required/>
        </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="date">Laporan <?php echo form_error('perbantuan_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_tgllaporan" id="datepicker" placeholder="Perbantuan Tgllaporan" value="<?php echo $perbantuan_tgllaporan; ?>" required />
        </div></div>

          <div class="col-md-12" style="text-align: right;">
    <hr>
      <input type="hidden" name="" value="<?php echo $perbantuan_id; ?>" />       
      <a href="<?php echo site_url('trx_perbantuan') ?>" class="btn btn-danger">Cancel</a>
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    </div>
	    
	</form>
</div>
