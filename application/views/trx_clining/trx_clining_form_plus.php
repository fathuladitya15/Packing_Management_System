<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">MANUAL CILINING FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="varchar">ID Master <?php echo form_error('clining_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="clining_master_id" id="clining_master_id" placeholder="Clining Master Id" value="<?php echo $clining_master_id; ?>" required/>
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">ID Karyawan <?php echo form_error('clining_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="clining_karyawan_id" id="clining_karyawan_id" placeholder="Clining Karyawan Id" value="<?php echo $clining_karyawan_id; ?>" required/>
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Shift <?php echo form_error('clining_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
            <select class="form-control input-sm select2" name="clining_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($clining_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="date">No. Line <?php echo form_error('clining_line') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="clining_line" id="clining_line" placeholder="Clining Line" value="<?php echo $clining_line; ?>" required/>
        </div> </div>
        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Type Pekerjaan</label>
            <div class="col-sm-9 col-xs-12">
                <?php 
                echo form_dropdown('clining', $clining, $clining_pekerjaan);  ?>   
            </div>
          </div>
        </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="varchar">Posisi <?php echo form_error('clining_posisi') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="clining_posisi" id="clining_posisi" placeholder="Clining Posisi" value="<?php echo $clining_posisi; ?>" required/>
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="date">Laporan <?php echo form_error('trx_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="clining_tgllaporan" id="datepicker" placeholder="clining Tgllaporan" value="<?php echo $clining_tgllaporan; ?>"  required/>
        </div> </div>
          <div class="col-md-12" style="text-align: right;">
    <hr>	   
	    <input type="hidden" name="clining_id" value="<?php echo $clining_id; ?>" /> 	    
	    <a href="<?php echo site_url('trx_clining') ?>" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	</form>
</div>
