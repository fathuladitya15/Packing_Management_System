<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">UPDATE WIP FORM</h3>
 
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
                  <select class="form-control input-sm select2" name="wip_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($wip_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " .$g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
                </div>
              </div>
            </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Shift <?php echo form_error('wip_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
            <select class="form-control input-sm select2" name="wip_shift">
                <?php 
                foreach($shift as $g){?>                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($wip_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
        </div></div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox1 <?php echo form_error('wip_mbox1') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox1" id="wip_mbox1" placeholder="wip Mbox1" value="<?php echo $wip_mbox1; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox2 <?php echo form_error('wip_mbox2') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox2" id="wip_mbox2" placeholder="wip Mbox2" value="<?php echo $wip_mbox2; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox3 <?php echo form_error('wip_mbox3') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox3" id="wip_mbox3" placeholder="wip Mbox3" value="<?php echo $wip_mbox3; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox4 <?php echo form_error('wip_mbox4') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox4" id="wip_mbox4" placeholder="wip Mbox4" value="<?php echo $wip_mbox4; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox5 <?php echo form_error('wip_mbox5') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox5" id="wip_mbox5" placeholder="wip Mbox5" value="<?php echo $wip_mbox5; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox6 <?php echo form_error('wip_mbox6') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox6" id="wip_mbox6" placeholder="wip Mbox6" value="<?php echo $wip_mbox6; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox7 <?php echo form_error('wip_mbox7') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox7" id="wip_mbox7" placeholder="wip Mbox7" value="<?php echo $wip_mbox7; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox8 <?php echo form_error('wip_mbox8') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox8" id="wip_mbox8" placeholder="wip Mbox8" value="<?php echo $wip_mbox8; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox9 <?php echo form_error('wip_mbox9') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox9" id="wip_mbox9" placeholder="wip Mbox9" value="<?php echo $wip_mbox9; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox10 <?php echo form_error('wip_mbox10') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox10" id="wip_mbox10" placeholder="wip Mbox10" value="<?php echo $wip_mbox10; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox11 <?php echo form_error('wip_mbox11') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox11" id="wip_mbox11" placeholder="wip Mbox11" value="<?php echo $wip_mbox11; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox12 <?php echo form_error('wip_mbox12') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox12" id="wip_mbox12" placeholder="wip Mbox12" value="<?php echo $wip_mbox12; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Mbox13 <?php echo form_error('wip_mbox13') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox13" id="wip_mbox13" placeholder="wip Mbox13" value="<?php echo $wip_mbox13; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Belum Bongkar <?php echo form_error('wip_mbox14') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox14" id="wip_mbox14" placeholder="wip Mbox14" value="<?php echo $wip_mbox14; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Berat <?php echo form_error('wip_mbox15') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_mbox15" id="wip_mbox15" placeholder="wip Mbox15" value="<?php echo $wip_mbox15; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Rijek <?php echo form_error('wip_rijek') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_rijek" id="wip_rijek" placeholder="wip Rijek" value="<?php echo $wip_rijek; ?>" />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">wip Total <?php echo form_error('wip_total') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_total" id="wip_total" placeholder="wip Total" value="<?php echo $wip_total; ?>" readonly />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="double">wip Upah <?php echo form_error('wip_upah') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_upah" id="wip_upah" placeholder="wip Upah" value="<?php echo $wip_upah; ?>" readonly />
        </div> </div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">wip Tgllaporan <?php echo form_error('wip_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="wip_tgllaporan" id="wip_tgllaporan" placeholder="wip Tgllaporan" value="<?php echo $wip_tgllaporan; ?>" readonly />
        </div> </div>
        <hr>
        <div class="pull-right">
        <a href="<?php echo site_url('trx_wip') ?>" class="btn btn-danger">Cancel</a>
            <input type="hidden" name="wip_id" value="<?php echo $wip_id; ?>" /> 
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
            
        </div>

    </form>
    </div>
