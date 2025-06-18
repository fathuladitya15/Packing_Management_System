<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">UPDATE PERANGKAT FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">ID Karyawan <?php echo form_error('perangkat_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perangkat_karyawan_id" id="perangkat_karyawan_id" placeholder="Perangkat Karyawan Id" value="<?php echo $perangkat_karyawan_id; ?>" />
              <input type="hidden" class="form-control" name="codeid" id="codeid" placeholder="codeid" value="<?php echo $codeid; ?>" />
              <input type="hidden" class="form-control" name="perangkat_master_id" id="perangkat_master_id" placeholder="perangkat_master_id" value="<?php echo $perangkat_master_id; ?>" />
        </div></div>
         <div class='inline'>
            <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Shift (*)</label>
            <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perangkat_shift" id="perangkat_shift" placeholder="perangkat_shift" value="<?php echo $perangkat_shift; ?>" readonly/>
            </div>
            </div>
            </div> 
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="double">Upah <?php echo form_error('perangkat_upah') ?></label>
             <div class="col-sm-9 col-xs-12">
              <input type="hidden" class="form-control" name="perangkat_master_id" id="perangkat_master_id" placeholder="perangkat_master_id" value="<?php echo $perangkat_master_id; ?>" readonly/>
            <input type="text" class="form-control" name="perangkat_upah" id="perangkat_upah" placeholder="Perangkat Upah" value="<?php echo $perangkat_upah; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('perangkat_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perangkat_tgllaporan" id="perangkat_tgllaporan" placeholder="Perangkat Tgllaporan" value="<?php echo $perangkat_tgllaporan; ?>" readonly />
        </div></div>

<div class="col-md-12" style="text-align: right;">
    <hr>
      <input type="hidden" name="perangkat_id" value="<?php echo $perangkat_id; ?>" />       
      <a href="<?php echo site_url('trx_perangkat') ?>" class="btn btn-danger">Cancel</a> 
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    </div>

	   
	</form>
</div>
