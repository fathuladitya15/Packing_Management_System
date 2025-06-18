<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">Update PP Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <div class="box-body">
        <form action="<?php echo $action; ?>" method="post">

        <div class='inline'>
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" >Produk</label>
                <div class="col-sm-9 col-xs-12">
                  <select class="form-control input-sm select2" name="pp_produk_id">
                    <option>--- Pilih Produk ---</option>
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($pp_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] ." | ". $g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
                </div>
              </div>
            </div>
                <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Shift <?php echo form_error('pp_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
                <select class="form-control input-sm select2" name="pp_shift">
                <?php 
                foreach($shift as $g){?>                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($pp_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
        </div> </div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Pp Mbox1 <?php echo form_error('pp_mbox1') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="pp_mbox1" id="pp_mbox1" placeholder="Pp Mbox1" value="<?php echo $pp_mbox1; ?>" /> </div>
        </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Pp Mbox2 <?php echo form_error('pp_mbox2') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="pp_mbox2" id="pp_mbox2" placeholder="Pp Mbox2" value="<?php echo $pp_mbox2; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Pp Total <?php echo form_error('pp_total') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="pp_total" id="pp_total" placeholder="Pp Total" value="<?php echo $pp_total; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="double">Pp Upah <?php echo form_error('pp_upah') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="pp_upah" id="pp_upah" placeholder="Pp Upah" value="<?php echo $pp_upah; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="date">Pp Tgllaporan <?php echo form_error('pp_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="pp_tgllaporan" id="pp_tgllaporan" placeholder="Pp Tgllaporan" value="<?php echo $pp_tgllaporan; ?>" />
        </div> </div>
       <hr>
           <div class="col-md-12" style="text-align: right;">
	    <input type="hidden" name="pp_id" value="<?php echo $pp_id; ?>" />
      <a href="<?php echo site_url('trx_pp') ?>" class="btn btn-danger">Cancel</a> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    
      </div>
	</form>
</div>
