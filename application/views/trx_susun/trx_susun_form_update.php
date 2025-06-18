<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">UPDATE SUSUN FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Master Transaksi (*) <?php echo form_error('susun_master_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_master_id" id="susun_master_id" placeholder="Susun Master Id" value="<?php echo $susun_master_id; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="char">ID Karyawan <?php echo form_error('susun_karyawan_id') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_karyawan_id" id="susun_karyawan_id" placeholder="Susun Karyawan Id" value="<?php echo $susun_karyawan_id; ?>"/>
            <input type="hidden" class="form-control" name="codeid" id="codeid" placeholder="Perbantuan Id" value="<?php echo $codeid; ?>" />
        </div></div>

	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Nama Produk (*)<?php echo form_error('susun_produk_id') ?></label>
             <div class="col-sm-9 col-xs-12">
             <select class="form-control input-sm select2" name="susun_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($susun_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | ".$g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
            

            </div></div>
        <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label"  for="int">Shift (*) <?php echo form_error('susun_shift') ?></label>
             <div class="col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="susun_shift" id="susun_shift" placeholder="susun_shift" value="<?php echo $susun_shift; ?>" />
        </div></div>
   
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat1 <?php echo form_error('susun_krat1') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat1" id="susun_krat1" placeholder="Susun Krat1" value="<?php echo $susun_krat1; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat2 <?php echo form_error('susun_krat2') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat2" id="susun_krat2" placeholder="Susun Krat2" value="<?php echo $susun_krat2; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat3 <?php echo form_error('susun_krat3') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat3" id="susun_krat3" placeholder="Susun Krat3" value="<?php echo $susun_krat3; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat4 <?php echo form_error('susun_krat4') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat4" id="susun_krat4" placeholder="Susun Krat4" value="<?php echo $susun_krat4; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat5 <?php echo form_error('susun_krat5') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat5" id="susun_krat5" placeholder="Susun Krat5" value="<?php echo $susun_krat5; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat6 <?php echo form_error('susun_krat6') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat6" id="susun_krat6" placeholder="Susun Krat6" value="<?php echo $susun_krat6; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat7 <?php echo form_error('susun_krat7') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat7" id="susun_krat7" placeholder="Susun Krat7" value="<?php echo $susun_krat7; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat8 <?php echo form_error('susun_krat8') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat8" id="susun_krat8" placeholder="Susun Krat8" value="<?php echo $susun_krat8; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat9 <?php echo form_error('susun_krat9') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat9" id="susun_krat9" placeholder="Susun Krat9" value="<?php echo $susun_krat9; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat10 <?php echo form_error('susun_krat10') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat10" id="susun_krat10" placeholder="Susun Krat10" value="<?php echo $susun_krat10; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat11 <?php echo form_error('susun_krat11') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat11" id="susun_krat11" placeholder="Susun Krat11" value="<?php echo $susun_krat11; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat12 <?php echo form_error('susun_krat12') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat12" id="susun_krat12" placeholder="Susun Krat12" value="<?php echo $susun_krat12; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat13 <?php echo form_error('susun_krat13') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat13" id="susun_krat13" placeholder="Susun Krat13" value="<?php echo $susun_krat13; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat14 <?php echo form_error('susun_krat14') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat14" id="susun_krat14" placeholder="Susun Krat14" value="<?php echo $susun_krat14; ?>"  onkeyup="sum();"/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Krat15 <?php echo form_error('susun_krat15') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_krat15" id="susun_krat15" placeholder="Susun Krat15" value="<?php echo $susun_krat15; ?>"  onkeyup="sum();"/>
        </div></div>
                <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Jumlah Total Krat <?php echo form_error('susun_totalkrat') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_totalkrat" id="susun_totalkrat" placeholder="Susun Krat15" value="<?php echo $susun_totalkrat; ?>" onkeyup="sum();" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="double">Upah <?php echo form_error('susun_upah') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_upah" id="susun_upah" placeholder="Susun Upah" value="<?php echo $susun_upah; ?>" readonly/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="date">Tanggal laporan (*)<?php echo form_error('susun_tgllaporan') ?></label>
             <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="susun_tgllaporan" id="susun_tgllaporan" placeholder="Susun Tgllaporan" value="<?php echo $susun_tgllaporan; ?>" readonly/>
        </div></div>
      <br>
        <hr>
           <div class="col-md-12" style="text-align: right;">
      <a href="<?php echo site_url('trx_susun') ?>" class="btn btn-danger">Cancel</a>
	    <input type="hidden" name="susun_id" value="<?php echo $susun_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 

      </div>
	</form>
</div>

       <script type="text/javascript">
        function sum() {
          var txt1 = document.getElementById('susun_krat1').value;
          var txt2 = document.getElementById('susun_krat2').value;
          var txt3 = document.getElementById('susun_krat3').value;
          var txt4 = document.getElementById('susun_krat4').value;
          var txt5 = document.getElementById('susun_krat5').value;
          var txt6 = document.getElementById('susun_krat6').value;
          var txt7 = document.getElementById('susun_krat7').value;
          var txt8 = document.getElementById('susun_krat8').value;
          var txt9 = document.getElementById('susun_krat9').value;
          var txt10 = document.getElementById('susun_krat10').value;
          var txt11 = document.getElementById('susun_krat11').value;
          var txt12 = document.getElementById('susun_krat12').value;
          var txt13 = document.getElementById('susun_krat13').value;
          var txt14 = document.getElementById('susun_krat14').value;
          var txt15 = document.getElementById('susun_krat15').value;

          var result = (parseInt(txt1)+parseInt(txt2)+parseInt(txt3)+parseInt(txt4)+parseInt(txt5)+parseInt(txt6)+parseInt(txt7)+parseInt(txt8)+parseInt(txt9)+parseInt(txt10)+parseInt(txt11)+parseInt(txt12)+parseInt(txt13)+parseInt(txt14)+parseInt(txt15));

      if (!isNaN(result)) {
         document.getElementById('susun_totalkrat').value = result;
      }

        }
        </script>
