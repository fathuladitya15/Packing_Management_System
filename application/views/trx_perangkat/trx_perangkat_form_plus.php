<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">MANUAL PERANGKAT FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
              <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="double">ID Transaksi <?php echo form_error('perangkat_upah') ?></label>
             <div class="col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="perangkat_master_id" id="perangkat_master_id" placeholder="perangkat_master_id" value="<?php echo $perangkat_master_id; ?>" required/>
        
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">ID Karyawan <?php echo form_error('perangkat_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perangkat_karyawan_id" id="perangkat_karyawan_id" placeholder="Perangkat Karyawan Id" value="<?php echo $perangkat_karyawan_id; ?>" required />
        </div></div>
	    <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="perangkat_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($perangkat_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>
        </div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('perangkat_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perangkat_tgllaporan" id="datepicker" placeholder="Perangkat Tgllaporan" value="<?php echo $perangkat_tgllaporan; ?>" required/>
        </div></div>

<div class="col-md-12" style="text-align: right;">
    <hr>
      <input type="hidden" name="perangkat_id" value="<?php echo $perangkat_id; ?>" />       
      <a href="<?php echo site_url('trx_perangkat') ?>" class="btn btn-danger">Cancel</a> 
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    </div>

	   
	</form>
</div>
