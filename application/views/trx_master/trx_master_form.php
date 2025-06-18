<!doctype html>
<html>
    <head> 
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Trx_master <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Master Module Id <?php echo form_error('master_module_id') ?></label>
            <input type="text" class="form-control" name="master_module_id" id="master_module_id" placeholder="Master Module Id" value="<?php echo $master_module_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Acuan Id <?php echo form_error('master_acuan_id') ?></label>
            <input type="text" class="form-control" name="master_acuan_id" id="master_acuan_id" placeholder="Master Acuan Id" value="<?php echo $master_acuan_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Master Produk Id <?php echo form_error('master_produk_id') ?></label>
            <input type="text" class="form-control" name="master_produk_id" id="master_produk_id" placeholder="Master Produk Id" value="<?php echo $master_produk_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Line <?php echo form_error('master_line') ?></label>
            <input type="text" class="form-control" name="master_line" id="master_line" placeholder="Master Line" value="<?php echo $master_line; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Master Tgllaporan <?php echo form_error('master_tgllaporan') ?></label>
            <input type="text" class="form-control" name="master_tgllaporan" id="master_tgllaporan" placeholder="Master Tgllaporan" value="<?php echo $master_tgllaporan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Shift <?php echo form_error('master_shift') ?></label>
            <input type="text" class="form-control" name="master_shift" id="master_shift" placeholder="Master Shift" value="<?php echo $master_shift; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Nomesin <?php echo form_error('master_nomesin') ?></label>
            <input type="text" class="form-control" name="master_nomesin" id="master_nomesin" placeholder="Master Nomesin" value="<?php echo $master_nomesin; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Jumlahteam <?php echo form_error('master_jumlahteam') ?></label>
            <input type="text" class="form-control" name="master_jumlahteam" id="master_jumlahteam" placeholder="Master Jumlahteam" value="<?php echo $master_jumlahteam; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Display <?php echo form_error('master_display') ?></label>
            <input type="text" class="form-control" name="master_display" id="master_display" placeholder="Master Display" value="<?php echo $master_display; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Box <?php echo form_error('master_box') ?></label>
            <input type="text" class="form-control" name="master_box" id="master_box" placeholder="Master Box" value="<?php echo $master_box; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Istirahat <?php echo form_error('master_istirahat') ?></label>
            <input type="text" class="form-control" name="master_istirahat" id="master_istirahat" placeholder="Master Istirahat" value="<?php echo $master_istirahat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Totalkerjamenit <?php echo form_error('master_totalkerjamenit') ?></label>
            <input type="text" class="form-control" name="master_totalkerjamenit" id="master_totalkerjamenit" placeholder="Master Totalkerjamenit" value="<?php echo $master_totalkerjamenit; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Totalkerjajam <?php echo form_error('master_totalkerjajam') ?></label>
            <input type="text" class="form-control" name="master_totalkerjajam" id="master_totalkerjajam" placeholder="Master Totalkerjajam" value="<?php echo $master_totalkerjajam; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Master Karu <?php echo form_error('master_karu') ?></label>
            <input type="text" class="form-control" name="master_karu" id="master_karu" placeholder="Master Karu" value="<?php echo $master_karu; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Master Stfg <?php echo form_error('master_stfg') ?></label>
            <input type="text" class="form-control" name="master_stfg" id="master_stfg" placeholder="Master Stfg" value="<?php echo $master_stfg; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Master Bayarstfg <?php echo form_error('master_bayarstfg') ?></label>
            <input type="text" class="form-control" name="master_bayarstfg" id="master_bayarstfg" placeholder="Master Bayarstfg" value="<?php echo $master_bayarstfg; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Master Acuanmesin <?php echo form_error('master_acuanmesin') ?></label>
            <input type="text" class="form-control" name="master_acuanmesin" id="master_acuanmesin" placeholder="Master Acuanmesin" value="<?php echo $master_acuanmesin; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Master Acuanline <?php echo form_error('master_acuanline') ?></label>
            <input type="text" class="form-control" name="master_acuanline" id="master_acuanline" placeholder="Master Acuanline" value="<?php echo $master_acuanline; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Master Userinput <?php echo form_error('master_userinput') ?></label>
            <input type="text" class="form-control" name="master_userinput" id="master_userinput" placeholder="Master Userinput" value="<?php echo $master_userinput; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Master Tglinput <?php echo form_error('master_tglinput') ?></label>
            <input type="text" class="form-control" name="master_tglinput" id="master_tglinput" placeholder="Master Tglinput" value="<?php echo $master_tglinput; ?>" />
        </div>
	    <input type="hidden" name="master_id" value="<?php echo $master_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('trx_master') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
