       <script type="text/javascript"> 
        function sum() {
          var txtFirstNumberValue = document.getElementById('line_mulai').value;
          var txtSecondNumberValue = document.getElementById('line_selesai').value;
          var txtThirthNumberValue = document.getElementById('line_istirahat').value;
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
             document.getElementById('line_totalmenit').value = selisih;
          }
        }
        </script>


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
    <h3 class="box-title">UPDATE LINE FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
    <form action="<?php echo $action; ?>" method="post">
         <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">ID Transaksi (*) <?php echo form_error('line_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_master_id" id="line_master_id" placeholder="ID Transaksi Line" value="<?php echo $line_master_id; ?>" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">ID Karyawan<?php echo form_error('line_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_karyawan_id" id="line_karyawan_id" placeholder="Kode Karyawan" value="<?php echo $line_karyawan_id; ?>"/>
            <input type="hidden" class="form-control" name="line_id" id="line_id" placeholder="line Karyawan Id" value="<?php echo $line_id; ?>" readonly/>
        </div></div>
        <div class='inline'>
              <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" >Nama Produk (*)</label>
                <div class="col-sm-9 col-xs-12">
                  <select class="form-control input-sm select2" name="line_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($line_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . "   | " . $g['produk_nama']; ?></option>
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
              <select class="form-control input-sm select2" name="line_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($line_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>
            </div>
            </div>   
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Box<?php echo form_error('line_display') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_box" id="line_box" placeholder="line Box" value="<?php if(!empty($line_box)) echo $line_box; else echo '0'; ?>"  required="" />
      </div></div>


      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">No. line <?php echo form_error('line_nomor') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_nomor" id="line_nomor" placeholder="line Selesai" value="<?php if(!empty($line_nomor)) echo $line_nomor; else echo '0'; ?>" />
        </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">Waktu Mulai <?php echo form_error('line_mulai') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_mulai" id="line_mulai" placeholder="line Mulai" value="<?php if(!empty($line_mulai)) echo $line_mulai; else echo '07:30'; ?>" onkeyup="sum();" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="time">Waktu Selesai <?php echo form_error('line_selesai') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_selesai" id="line_selesai" placeholder="line Selesai" value="<?php if(!empty($line_selesai)) echo $line_selesai; else echo '17:00'; ?>" onkeyup="sum();" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Waktu Istirahat <?php echo form_error('line_istirahat') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_istirahat" id="line_istirahat" placeholder="line Istirahat" value="<?php if(!empty($line_istirahat)) echo $line_istirahat; else echo '0'; ?>" onkeyup="sum();" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Total menit <?php echo form_error('line_totalmenit') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_totalmenit" id="line_totalmenit" placeholder="line Totalmenit" value="<?php echo $line_totalmenit; ?>" onkeyup="sum();" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal Laporan (*) <?php echo form_error('line_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="line_tgllaporan" id="datepicker" placeholder="line Tgllaporan" value="<?php echo $line_tgllaporan; ?>" required=""/>
        </div></div>

    <div class="col-md-12" style="text-align: right;">
         <hr>
        <input type="hidden" name="" value="<?php echo $line_id; ?>" />       
        <a href="<?php echo site_url('trx_line') ?>" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
      </div>
	</form>
