       <script type="text/javascript">
        function sum() {
          var txtFirstNumberValue = document.getElementById('perbantuan_mulai').value;
          var txtSecondNumberValue = document.getElementById('perbantuan_selesai').value;
          var txtThirthNumberValue = document.getElementById('perbantuan_istirahat').value;
          var jam_first = parseInt(txtFirstNumberValue.substring(0,2)) * 60;
          var jam_second = parseInt(txtSecondNumberValue.substring(0,2)) * 60;
          var menit_first = parseInt(txtFirstNumberValue.substring(3,5));
          var menit_second = parseInt(txtSecondNumberValue.substring(3,5));
          var hasil_first = jam_first + menit_first;
          var hasil_second = jam_second + menit_second;
          var selisih = hasil_second - hasil_first - txtThirthNumberValue;
          var jam = Math.floor(selisih / 60);
          var menit = selisih - (jam * 60);

          if (!isNaN(jam || menit)) {
             document.getElementById('perbantuan_totalmenit').value = selisih;
          }
        }
        </script>

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">UPDATE PERBANTUAN FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="varchar">ID Transaksi (*)<?php echo form_error('perbantuan_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_master_id" id="perbantuan_master_id" placeholder="Perbantuan Master Id" value="<?php echo $perbantuan_master_id; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">ID Perbantuan<?php echo form_error('perbantuan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_id" id="perbantuan_id" placeholder="Perbantuan Id" value="<?php echo $perbantuan_id; ?>" readonly/>
            <input type="hidden" class="form-control" name="codeid" id="codeid" placeholder="Perbantuan Id" value="<?php echo $codeid; ?>" />
      </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="char">ID Karyawan<?php echo form_error('perbantuan_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_karyawan_id" id="perbantuan_karyawan_id" placeholder="Perbantuan Karyawan Id" value="<?php echo $perbantuan_karyawan_id; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="varchar">Tipe Produk (*) <?php echo form_error('perbantuan_produk_id') ?></label>
            <div class="col-sm-9 col-xs-12">
                   <?php echo form_dropdown('perbantuan', $perbantuan, $perbantuan_kategori);  ?> 
                </div>
        </div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Shift <?php echo form_error('perbantuan_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="perbantuan_shift" id="perbantuan_shift" placeholder="perbantuan_shift" value="<?php echo $perbantuan_shift; ?>"/>
        </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="time">Waktu Mulai <?php echo form_error('perbantuan_mulai') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_mulai" id="perbantuan_mulai" placeholder="Perbantuan Mulai" value="<?php echo substr($perbantuan_mulai,0,5); ?>" onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="time">Waktu Selesai <?php echo form_error('perbantuan_selesai') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_selesai" id="perbantuan_selesai" placeholder="Perbantuan Selesai" value="<?php echo substr($perbantuan_selesai,0,5); ?>" onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Waktu Istirahat <?php echo form_error('perbantuan_istirahat') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_istirahat" id="perbantuan_istirahat" placeholder="Perbantuan Istirahat" value="<?php echo $perbantuan_istirahat; ?>" onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Total Kerja <?php echo form_error('perbantuan_totalmenit') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_totalmenit" id="perbantuan_totalmenit" placeholder="Perbantuan Totalmenit" value="<?php echo $perbantuan_totalmenit; ?>" onkeyup="sum();" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="double">Upah <?php echo form_error('perbantuan_upah') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_upah" id="perbantuan_upah" placeholder="Perbantuan Upah" value="<?php echo $perbantuan_upah; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="date">Tanngal Laporan (*)<?php echo form_error('perbantuan_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="perbantuan_tgllaporan" id="perbantuan_tgllaporan" placeholder="Perbantuan Tgllaporan" value="<?php echo $perbantuan_tgllaporan; ?>" readonly/>
        </div></div>

          <div class="col-md-12" style="text-align: right;">
    <hr>
      <input type="hidden" name="perbantuan_id" value="<?php echo $perbantuan_id; ?>" />       
      <a href="<?php echo site_url('trx_perbantuan') ?>" class="btn btn-danger">Cancel</a>
      <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
    </div>
	    
	</form>
</div>