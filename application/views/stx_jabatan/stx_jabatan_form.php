<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">JABATAN FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
	<form action="<?php echo $action; ?>" method="post">
	
		<div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Jabatan <?php echo form_error('jabatan_nama') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control input-sm" name="jabatan_nama" id="jabatan_nama" placeholder="Nama jabatan" value="<?php echo $jabatan_nama; ?>" required="" /> </div>
        </div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Deskripsi <?php echo form_error('Deskripsi Jabatan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control input-sm" name="jabatan_info1" id="jabatan_info1" placeholder="Deskripsi Jabatan" value="<?php echo $jabatan_info1; ?>" /> </div>
        </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Info <?php echo form_error('Info') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control input-sm" name="jabatan_info2" id="jabatan_info2" placeholder="Info" value="<?php echo $jabatan_info2; ?>" />
            </div>
        </div>

    <div class='inline'>
      <?php 
      if(!empty($jabatan_status)) {
        if($jabatan_status=='Aktif') $chek="checked"; else $chek=""; 
      }else{
        $chek="";
      }
      ?>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >&nbsp;</label>
        <div class="col-sm-9 col-xs-12">
        <input  type="checkbox" name="jabatan_status" value="Aktif" <?php echo $chek; ?>> &nbsp; Active
        </div>
      </div>
    </div>

<hr>
<div class="col-md-12" style="text-align: right;">
<a href="<?php echo site_url('stx_jabatan') ?>" class="btn btn-danger btn-primary">Cancel</a>
	    <input type="hidden" name="jabatan_id" value="<?php echo $jabatan_id; ?>" /> 
	    <button type="submit" class="btn btn-primary">Save</button> 
	    
</div>



	</form>        
</div>
