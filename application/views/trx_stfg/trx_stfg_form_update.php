<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">Update STFG Form</h3>

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
                  <select class="form-control input-sm select2" name="stfg_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($stfg_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] ." | " . $g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
                </div>
              </div>
            </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Shift <?php echo form_error('stfg_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_shift" id="stfg_shift" placeholder="Stfg Shift" value="<?php echo $stfg_shift; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox1 <?php echo form_error('stfg_mbox1') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox1" id="stfg_mbox1" placeholder="Stfg Mbox1" value="<?php echo $stfg_mbox1; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox2 <?php echo form_error('stfg_mbox2') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox2" id="stfg_mbox2" placeholder="Stfg Mbox2" value="<?php echo $stfg_mbox2; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox3 <?php echo form_error('stfg_mbox3') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox3" id="stfg_mbox3" placeholder="Stfg Mbox3" value="<?php echo $stfg_mbox3; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox4 <?php echo form_error('stfg_mbox4') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox4" id="stfg_mbox4" placeholder="Stfg Mbox4" value="<?php echo $stfg_mbox4; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox5 <?php echo form_error('stfg_mbox5') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox5" id="stfg_mbox5" placeholder="Stfg Mbox5" value="<?php echo $stfg_mbox5; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox6 <?php echo form_error('stfg_mbox6') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox6" id="stfg_mbox6" placeholder="Stfg Mbox6" value="<?php echo $stfg_mbox6; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox7 <?php echo form_error('stfg_mbox7') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox7" id="stfg_mbox7" placeholder="Stfg Mbox7" value="<?php echo $stfg_mbox7; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox8 <?php echo form_error('stfg_mbox8') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox8" id="stfg_mbox8" placeholder="Stfg Mbox8" value="<?php echo $stfg_mbox8; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox9 <?php echo form_error('stfg_mbox9') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox9" id="stfg_mbox9" placeholder="Stfg Mbox9" value="<?php echo $stfg_mbox9; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox10 <?php echo form_error('stfg_mbox10') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox10" id="stfg_mbox10" placeholder="Stfg Mbox10" value="<?php echo $stfg_mbox10; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox11 <?php echo form_error('stfg_mbox11') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox11" id="stfg_mbox11" placeholder="Stfg Mbox11" value="<?php echo $stfg_mbox11; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox12 <?php echo form_error('stfg_mbox12') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox12" id="stfg_mbox12" placeholder="Stfg Mbox12" value="<?php echo $stfg_mbox12; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox13 <?php echo form_error('stfg_mbox13') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox13" id="stfg_mbox13" placeholder="Stfg Mbox13" value="<?php echo $stfg_mbox13; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox14 <?php echo form_error('stfg_mbox14') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox14" id="stfg_mbox14" placeholder="Stfg Mbox14" value="<?php echo $stfg_mbox14; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Mbox15 <?php echo form_error('stfg_mbox15') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_mbox15" id="stfg_mbox15" placeholder="Stfg Mbox15" value="<?php echo $stfg_mbox15; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Rijek <?php echo form_error('stfg_rijek') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_rijek" id="stfg_rijek" placeholder="Stfg Rijek" value="<?php echo $stfg_rijek; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stfg Total <?php echo form_error('stfg_total') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_total" id="stfg_total" placeholder="Stfg Total" value="<?php echo $stfg_total; ?>" />
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="double">Stfg Upah <?php echo form_error('stfg_upah') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_upah" id="stfg_upah" placeholder="Stfg Upah" value="<?php echo $stfg_upah; ?>" readonly/>
        </div> </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Stfg Tgllaporan <?php echo form_error('stfg_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stfg_tgllaporan" id="stfg_tgllaporan" placeholder="Stfg Tgllaporan" value="<?php echo $stfg_tgllaporan; ?>" readonly />
        </div> </div><br>
        <hr>
      <div class="pull-right">
    <a href="<?php echo site_url('trx_stfg') ?>" class="btn btn-danger">Cancel</a>
	    <input type="hidden" name="stfg_id" value="<?php echo $stfg_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 

      </div>
	</form>
    </div>
