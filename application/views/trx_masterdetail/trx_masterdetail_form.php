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
        <h2 style="margin-top:0px">Trx_masterdetail <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="char">Masterdetail Master Id <?php echo form_error('masterdetail_master_id') ?></label>
            <input type="text" class="form-control" name="masterdetail_master_id" id="masterdetail_master_id" placeholder="Masterdetail Master Id" value="<?php echo $masterdetail_master_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Masterdetail Karyawan Id <?php echo form_error('masterdetail_karyawan_id') ?></label>
            <input type="text" class="form-control" name="masterdetail_karyawan_id" id="masterdetail_karyawan_id" placeholder="Masterdetail Karyawan Id" value="<?php echo $masterdetail_karyawan_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="time">Masterdetail Mulai <?php echo form_error('masterdetail_mulai') ?></label>
            <input type="text" class="form-control" name="masterdetail_mulai" id="masterdetail_mulai" placeholder="Masterdetail Mulai" value="<?php echo $masterdetail_mulai; ?>" />
        </div>
	    <div class="form-group">
            <label for="time">Masterdetail Selesai <?php echo form_error('masterdetail_selesai') ?></label>
            <input type="text" class="form-control" name="masterdetail_selesai" id="masterdetail_selesai" placeholder="Masterdetail Selesai" value="<?php echo $masterdetail_selesai; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Masterdetail Jamkerja <?php echo form_error('masterdetail_jamkerja') ?></label>
            <input type="text" class="form-control" name="masterdetail_jamkerja" id="masterdetail_jamkerja" placeholder="Masterdetail Jamkerja" value="<?php echo $masterdetail_jamkerja; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Masterdetail Istirahat <?php echo form_error('masterdetail_istirahat') ?></label>
            <input type="text" class="form-control" name="masterdetail_istirahat" id="masterdetail_istirahat" placeholder="Masterdetail Istirahat" value="<?php echo $masterdetail_istirahat; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Masterdetail Totalkerja <?php echo form_error('masterdetail_totalkerja') ?></label>
            <input type="text" class="form-control" name="masterdetail_totalkerja" id="masterdetail_totalkerja" placeholder="Masterdetail Totalkerja" value="<?php echo $masterdetail_totalkerja; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Masterdetail Box <?php echo form_error('masterdetail_box') ?></label>
            <input type="text" class="form-control" name="masterdetail_box" id="masterdetail_box" placeholder="Masterdetail Box" value="<?php echo $masterdetail_box; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Masterdetail Jumlahstiker <?php echo form_error('masterdetail_jumlahstiker') ?></label>
            <input type="text" class="form-control" name="masterdetail_jumlahstiker" id="masterdetail_jumlahstiker" placeholder="Masterdetail Jumlahstiker" value="<?php echo $masterdetail_jumlahstiker; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Masterdetail Jumlahkrat <?php echo form_error('masterdetail_jumlahkrat') ?></label>
            <input type="text" class="form-control" name="masterdetail_jumlahkrat" id="masterdetail_jumlahkrat" placeholder="Masterdetail Jumlahkrat" value="<?php echo $masterdetail_jumlahkrat; ?>" />
        </div>
	    <div class="form-group">
            <label for="double">Masterdetail Upah <?php echo form_error('masterdetail_upah') ?></label>
            <input type="text" class="form-control" name="masterdetail_upah" id="masterdetail_upah" placeholder="Masterdetail Upah" value="<?php echo $masterdetail_upah; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Masterdetail Userinput <?php echo form_error('masterdetail_userinput') ?></label>
            <input type="text" class="form-control" name="masterdetail_userinput" id="masterdetail_userinput" placeholder="Masterdetail Userinput" value="<?php echo $masterdetail_userinput; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Masterdetail Tglinput <?php echo form_error('masterdetail_tglinput') ?></label>
            <input type="text" class="form-control" name="masterdetail_tglinput" id="masterdetail_tglinput" placeholder="Masterdetail Tglinput" value="<?php echo $masterdetail_tglinput; ?>" />
        </div>
	    <input type="hidden" name="masterdetail_id" value="<?php echo $masterdetail_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('trx_masterdetail') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>
