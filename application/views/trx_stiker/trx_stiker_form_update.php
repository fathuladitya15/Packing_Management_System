<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">UPDATE STIKER FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Stiker Master ID (*)<?php echo form_error('stiker_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_master_id" id="stiker_master_id" placeholder="Stiker Master ID" value="<?php echo $stiker_master_id; ?>" readonly/>
        </div></div>
    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">ID Karyawan<?php echo form_error('stiker_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_karyawan_id" id="stiker_karyawan_id" placeholder="Stiker Karyawan Id" value="<?php echo $stiker_karyawan_id; ?>"/>
            <input type="hidden" class="form-control" name="codeid" id="codeid" placeholder="Stiker Karyawan Id" value="<?php echo $codeid; ?>"/>
        </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Nama Produk (*)<?php echo form_error('stiker_produk_id') ?></label>
                <div class="col-sm-9 col-xs-12">
                  <select class="form-control input-sm select2" name="stiker_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($stiker_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
                </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="enum">Kategori (*)<?php echo form_error('stiker_kategori') ?></label>
             <div class="col-sm-9 col-xs-12">
            <?php 
                echo form_dropdown('stiker', $stiker, $stiker_kategori);  ?> 
        </div></div>
	   <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Shift (*)<?php echo form_error('stiker_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
             <input type="text" class="form-control" name="stiker_shift" id="stiker_shift" placeholder="stiker_shift" value="<?php echo $stiker_shift; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Stiker<?php echo form_error('stiker_jumlahstiker') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_jumlahstiker" id="stiker_jumlahstiker" placeholder="Stiker Jumlahstiker" value="<?php echo $stiker_jumlahstiker; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Upah <?php echo form_error('stiker_upah') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_upah" id="stiker_upah" placeholder="Stiker Upah" value="<?php echo $stiker_upah; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal laporan (*)<?php echo form_error('stiker_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="stiker_tgllaporan" id="stiker_tgllaporan" placeholder="Stiker Tgllaporan" value="<?php echo $stiker_tgllaporan; ?>" readonly/>
        </div></div>
<hr>
<div class="pull-right">
      <a href="<?php echo site_url('trx_stiker') ?>" class="btn btn-danger">Cancel</a>
	    <input type="hidden" name="stiker_id" value="<?php echo $stiker_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
</div>
	</form>
</div>
