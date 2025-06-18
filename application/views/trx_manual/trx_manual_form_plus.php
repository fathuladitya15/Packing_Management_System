  <?php  
    $error=$this->session->flashdata('message');
    if (!empty($error)) {
      foreach ($error as $key => $value) {
  ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      <?php echo $error[$key]; ?>
    </div>
  <?php
        echo ""; 
      }   
    }
  ?>

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">UPDATE MANUAL FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
    <form action="<?php echo $action; ?>" method="post">
         <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">ID Transaksi <?php echo form_error('manual_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="manual_master_id" id="manual_master_id" placeholder="manual master" value="<?php echo $manual_master_id; ?>" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">Manual Karyawan Id <?php echo form_error('manual_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="manual_karyawan_id" id="manual_karyawan_id" placeholder="Manual Karyawan Id" value="<?php echo $manual_karyawan_id; ?>" required="" />
        </div></div>
        <div class='inline'>
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" >Produk</label>
                <div class="col-sm-9 col-xs-12">
                  <select class="form-control input-sm select2" name="manual_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($manual_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " . $g['produk_nama']; ?></option>
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
              <select class="form-control input-sm select2" name="manual_acuan_id">
                <?php 
                foreach($acuan as $g){?>
                
                <option value="<?php echo $g['acuan_id']; ?>" <?php if($manual_acuan_id==$g['acuan_id']) echo "Selected" ?>><?php echo $g['acuan_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>
            </div>
            </div>
	       <div class='inline'>
            <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="manual_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($manual_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>
            </div>
            </div>   
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Box <?php echo form_error('manual_box') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="manual_box" id="manual_box" placeholder="Manual Box" value="<?php if(!empty($manual_box)) echo $manual_box; else echo '0'; ?>" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">Waktu Mulai <?php echo form_error('manual_mulai') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="manual_mulai" id="manual_mulai" placeholder="Manual Mulai" value="<?php if(!empty($manual_mulai)) echo $manual_mulai; else echo '07:30'; ?>" onkeyup="sum();" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">Waktu Selesai <?php echo form_error('manual_selesai') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="manual_selesai" id="manual_selesai" placeholder="Manual Selesai" value="<?php if(!empty($manual_selesai)) echo $manual_selesai; else echo '17:00'; ?>" onkeyup="sum();" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Waktu Istirahat <?php echo form_error('manual_istirahat') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="manual_istirahat" id="manual_istirahat" placeholder="Manual Istirahat" value="<?php if(!empty($manual_istirahat)) echo $manual_istirahat; else echo '0'; ?>" onkeyup="sum();" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Total Menit <?php echo form_error('manual_totalmenit') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="manual_totalmenit" id="manual_totalmenit" placeholder="Manual Totalmenit" value="<?php echo $manual_totalmenit; ?>" onkeyup="sum();" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal laporan <?php echo form_error('manual_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="manual_tgllaporan" id="datepicker" placeholder="Manual Tgllaporan" value="<?php echo $manual_tgllaporan; ?>" required="" />
        </div></div>

	    <div class="col-md-12" style="text-align: right;">
	    <hr>
	    	<input type="hidden" name="manual_id" value="<?php echo $manual_id; ?>" />
	    	<a href="<?php echo site_url('trx_manual') ?>" class="btn btn-danger">Cancel</a>
		    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    </div>


	</form>
    </div>

           <script type="text/javascript">
        function sum() {
          var txtFirstNumberValue = document.getElementById('manual_mulai').value;
          var txtSecondNumberValue = document.getElementById('manual_selesai').value;
          var txtThirthNumberValue = document.getElementById('manual_istirahat').value;
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
             document.getElementById('manual_totalmenit').value = selisih;
          }
        }
        </script>
