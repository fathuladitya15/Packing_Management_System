       <script type="text/javascript">
        function sum() { 
          var txtFirstNumberValue = document.getElementById('mesin_mulai').value;
          var txtSecondNumberValue = document.getElementById('mesin_selesai').value;
          var txtThirthNumberValue = document.getElementById('mesin_istirahat').value;
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
             document.getElementById('mesin_totalmenit').value = selisih;
          }
        }
        </script>

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">UPDATE MESIN FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
    <form action="<?php echo $action; ?>" method="post">
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">ID Master <?php echo form_error('mesin_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_master_id" id="mesin_master_id" placeholder="mesin master" value="<?php echo $mesin_master_id; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">ID Karyawan<?php echo form_error('mesin_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_karyawan_id" id="mesin_karyawan_id" placeholder="mesin Karyawan Id" value="<?php echo $mesin_karyawan_id; ?>" />
            <input type="hidden" class="form-control" name="codeid" id="codeid" placeholder="codeid" value="<?php echo $codeid; ?>" />
        </div></div>
        <div class='inline'>
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" >Nama Produk (*)</label>
                <div class="col-sm-9 col-xs-12">
                  <select class="form-control input-sm select2" name="mesin_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($mesin_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " . $g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class='inline'>
            <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Acuan</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="mesin_acuan_id">
                <?php 
                foreach($acuan as $g){?>
                
                <option value="<?php echo $g['acuan_id']; ?>" <?php if($mesin_acuan_id==$g['acuan_id']) echo "Selected" ?>><?php echo $g['acuan_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>
            </div>
            </div>
	       <div class='inline'>
            <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Shift (*)</label>
            <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_shift" id="mesin_shift" placeholder="mesin_shift" value="<?php echo $mesin_shift; ?>" />
            </div>
            </div>
            </div>   
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Display <?php echo form_error('mesin_display') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_display" id="mesin_display" placeholder="mesin Box" value="<?php echo $mesin_display; ?>" />
        </div></div>

              <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">No. Line (*)<?php echo form_error('mesin_line') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_line" id="mesin_line" placeholder="mesin Mulai" value="<?php echo $mesin_line; ?>" />
        </div></div>
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">No. Mesin (*)<?php echo form_error('mesin_mesin') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_mesin" id="mesin_mesin" placeholder="mesin Selesai" value="<?php echo $mesin_mesin; ?>" />
        </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">Watu Mulai <?php echo form_error('mesin_mulai') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_mulai" id="mesin_mulai" placeholder="mesin Mulai" value="<?php echo substr($mesin_mulai,0,5); ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">Waktu Selesai <?php echo form_error('mesin_selesai') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_selesai" id="mesin_selesai" placeholder="mesin Selesai" value="<?php echo substr($mesin_selesai,0,5); ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Waktu Istirahat <?php echo form_error('mesin_istirahat') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_istirahat" id="mesin_istirahat" placeholder="mesin Istirahat" value="<?php echo $mesin_istirahat; ?>" onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Total menit <?php echo form_error('mesin_totalmenit') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_totalmenit" id="mesin_totalmenit" placeholder="mesin Totalmenit" value="<?php echo $mesin_totalmenit; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal Laporan (*)<?php echo form_error('mesin_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="mesin_tgllaporan" id="mesin_tgllaporan" placeholder="mesin Tgllaporan" value="<?php echo $mesin_tgllaporan; ?>" readonly/>
        </div></div>
    <div class="col-md-12" style="text-align: right;">
    <hr>
    
      <input type="hidden" name="mesin_id" value="<?php echo $mesin_id; ?>" /> 
      <button type="submit" class="btn btn-primary pull-right"><?php echo $button ?></button> 
      <a href="<?php echo site_url('trx_mesin') ?>" class="btn btn-danger">Cancel</a>
      
    </div>	    
	</form>




</div>
