<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">Acuan Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
      <div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Nama Acuan <?php echo form_error('acuan_nama') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="acuan_nama" id="acuan_nama" placeholder="Nama Acuan" value="<?php echo $acuan_nama; ?>" />
        </div></div>

        <div class='inline'>
          <?php 
          if(!empty($acuan_status)) {
            if($acuan_status=='Aktif') $chek="checked"; else $chek=""; 
          }else{
            $chek="";
          }
          ?>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >&nbsp;</label>
            <div class="col-sm-9 col-xs-12">
            <input type="checkbox" name="acuan_status" value="Aktif" <?php echo $chek; ?>> &nbsp; Active
            </div>
          </div>
        </div>
	    <input type="hidden" name="acuan_id" value="<?php echo $acuan_id; ?>" /> 
	    <button type="submit" class="btn btn-primary">Save</button> 
	    <a href="<?php echo site_url('stx_acuan') ?>" class="btn btn-danger btn-primary">Cancel</a>
	</form>
    </div>
