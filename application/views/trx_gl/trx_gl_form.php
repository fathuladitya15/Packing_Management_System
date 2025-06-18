
<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">UPDATE GL MASTER FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Nama Module<?php echo form_error('master_module_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_module_id" id="master_module_id" placeholder="Master Module Id" value="<?php echo $module_nama; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Acuan<?php echo form_error('master_acuan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_acuan_id" id="master_acuan_id" placeholder="Master Acuan Id" value="<?php 
            if ($master_acuan_id =='1'){
                echo "STFG"; 
            }elseif($master_acuan_id =='2'){
                echo "STFG MANUAL";
            }elseif($master_acuan_id =='3'){
                echo "WIP";
            }else{
                echo "TIDAK ADA";
            }
            ?>" readonly/>
        </div></div>
        
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Nama Produk<?php echo form_error('master_produk_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_produk_id" id="master_produk_id" placeholder="Master Produk Id" value="<?php echo $master_produk_id . " | " . $produk_nama; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Master Line <?php echo form_error('master_line') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_line" id="master_line" placeholder="Master Line" value="<?php echo $master_line; ?>" readonly/>
        </div></div>
	   
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Master Shift <?php echo form_error('master_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_shift" id="master_shift" placeholder="Master Shift" value="<?php echo $master_shift; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Master Nomesin <?php echo form_error('master_nomesin') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_nomesin" id="master_nomesin" placeholder="Master Nomesin" value="<?php echo $master_nomesin; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Team <?php echo form_error('master_jumlahteam') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_jumlahteam" id="master_jumlahteam" placeholder="Master Jumlahteam" value="<?php echo $master_jumlahteam; ?>"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Display <?php echo form_error('master_display') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_display" id="master_display" placeholder="Master Display" value="<?php echo $master_display; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Box <?php echo form_error('master_box') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_box" id="master_box" placeholder="Master Box" value="<?php echo $master_box; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Total Kerja/Menit<?php echo form_error('master_totalkerjamenit') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_totalkerjamenit" id="master_totalkerjamenit" placeholder="Master Totalkerjamenit" value="<?php echo $master_totalkerjamenit; ?>"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Total Kerja / Jam<?php echo form_error('master_totalkerjajam') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_totalkerjajam" id="master_totalkerjajam" placeholder="Master Totalkerjajam" value="<?php echo $master_totalkerjajam; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="double">Total Pembayaran<?php echo form_error('master_bayarstfg') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_bayarstfg" id="master_bayarstfg" placeholder="Master Bayarstfg" value="<?php echo $master_bayarstfg; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal Laporan<?php echo form_error('master_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_tgllaporan" id="master_tgllaporan" placeholder="Master Tgllaporan" value="<?php echo $master_tgllaporan; ?>" readonly/>
        </div></div>

        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">Admin Input<?php echo form_error('master_userinput') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_userinput" id="master_userinput" placeholder="Master Userinput" value="<?php echo $master_userinput; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tannggal Input<?php echo form_error('master_tglinput') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="master_tglinput" id="master_tglinput" placeholder="Master Tglinput" value="<?php echo $master_tglinput; ?>" readonly/>
        </div></div>
        <hr>
        <div class="col-md-12" style="text-align: right;">
	    <input type="hidden" name="master_id" value="<?php echo $master_id; ?>" /> 
	    
	    <a href="<?php echo site_url('trx_gl') ?>" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        </div>
	</form>
    </body>
</html>
