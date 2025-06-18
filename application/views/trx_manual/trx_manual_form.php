<script> 
 function check() {
    if (document.getElementById("manual_shift").value == "1") {
         document.getElementById("jmanual_mulai").value="06:45";
         document.getElementById("jmanual_selesai").value="14:45";

    }else if(document.getElementById("manual_shift").value == "2"){
      document.getElementById("jmanual_mulai").value="14:45";
        document.getElementById("jmanual_selesai").value="22:45";

    }else {
      document.getElementById("jmanual_mulai").value="22:45";
        document.getElementById("jmanual_selesai").value="06:45";
    }
    } 
 </script>


<div class="box box-default">
<div class="box-body">

    <form method="POST" action="<?php echo $action; ?>" id="frm_submit">
            <div class="col-md-12">
            <fieldset><legend>MANUAL FORM</legend>
            
            <div class="inline">  
            <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" >Acuan</label>
            <div class="col-sm-3 col-xs-12">
              <select class="form-control input-sm select2" name="manual_acuan_id">
                <?php 
                foreach($acuan as $g){?>
                
                <option value="<?php echo $g['acuan_id']; ?>" <?php if($manual_acuan_id==$g['acuan_id']) echo "Selected" ?>><?php echo $g['acuan_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>    

            
                <label class="col-sm-2 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('manual_tgllaporan') ?></label>
                 <div class="col-sm-3 col-xs-12">
                <input type="text" name="manual_tgllaporan" id="datepicker" class="form-control input-sm" placeholder="Tanggal Laporan Pekerjaan Manual" value="<?php echo $manual_tgllaporan; ?>" required=""/>
            </div>
            </div>

            <div class="inline">
              <div class="form-group">
                
           <label class="col-sm-2 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-3 col-xs-12">
              <select class="form-control input-sm select2" name="manual_shift" id="manual_shift" onChange="check();">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($manual_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>

                <label class="col-sm-2 col-xs-12 control-label" >Produk</label>
                <div class="col-sm-5 col-xs-12">
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

            <div class="inline"> 
            <div class="form-group">
                <label class="col-sm-2 col-xs-12 control-label" for="int">Box <?php echo form_error('manual_box') ?></label>
                 <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control input-sm" name="manual_box" id="manual_box" placeholder="Jumlah Box" value="<?php echo $manual_box; ?>" required=""/>
            </div>

            </div>
            </div>
            
            <br><br>
  
            <div class="row">
                <div class="alert alert-dismissable alert-success" style="display: none">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Data berhasil di Simpan</strong>.
                </div>
                 
            <div class="alert alert-dismissable alert-danger"  style="display: none">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Ada kesalahan Transaksi, Mohon di ulang kembali</strong>
                </div>
            </div>
            </div>

                        <!-- Text input-->
                        <table style="width: 100%;" class="table">
                            <thead style="background-color: #ddd;"><tr><th>No.</th><th>ID Karyawan</th><th>Waktu Mulai</th><th>Waktu Selesai</th><th>Istirahat</th></tr></thead>
                            <tbody id="table-details"><tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td><input type="text" class="form-control input-sm" name="jmanual_karyawan_id[]"  placeholder="manual Karyawan Id" required=""/></td>
                                    <td><input type="text" id ="jmanual_mulai" class="form-control input-sm timepicker" name="jmanual_mulai[]"  placeholder="manual Mulai" required="" value="06:45" /></td>
                                    <td><input type="text" class="form-control input-sm timepicker" name="jmanual_selesai[]"  id ="jmanual_selesai" placeholder="manual Selesai" required="" value="14:45" /></td>
                                    <td><input type="text" class="form-control input-sm" name="jmanual_istirahat[]" value="0" placeholder="Lama Istirahat" onkeyup="sum();" id ="jmanual_istirahat" required=""></td>                         

                                </tr>

                            </tbody>
                              <thead style="background-color: #ddd;"><tr><th></th><th></th><th></th><th></th><th></tr></thead>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
                        </fieldset>


            
                           <div class="col-md-12" style="text-align: right;">
                               <hr>
                               <a href="<?php echo site_url('trx_manual') ?>" class="btn btn-danger" style="margin-right: 10px;">Cancel</a>
                               <input class="btn btn-success pull-right" type="submit" value="submit" name="submit">
                           </div>
                           </form>
                </div>
             
            <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>

            <script src="<?php echo base_url();?>assets/plugins/jquery/material.min.js"></script>
            <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-ui.min.js"></script> 
            <script>
            $(document).ready(function (){
                $("body").on('click', '.btn-add-more', function (e) {
            e.preventDefault();
              var $sr = ($(".jdr1").length + 1);
              var rowid = Math.random();
              var txtFirstNumberValue = document.getElementById('jmanual_mulai').value;
              var txtSecondNumberValue = document.getElementById('jmanual_selesai').value;
              var txtThirthNumberValue = document.getElementById('jmanual_istirahat').value; 
        
        
            var $html = '<tr class="jdr1" id="' + rowid + '">' +
                    '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' +
                    '<td><input type="text" class="form-control input-sm" name="jmanual_karyawan_id[]" placeholder="manual Karyawan Id" onkeyup="sum();" required=""/></td>' +
                    '<td><input type="text" class="form-control input-sm timepicker" name="jmanual_mulai[]" value="'+ txtFirstNumberValue +'" id="jmanual_mulai" placeholder="manual Mulai" onkeyup="sum();" required=""/></td>' +
                    '<td><input type="text" class="form-control input-sm timepicker" name="jmanual_selesai[]" value="'+ txtSecondNumberValue +'"  id="jmanual_selesai" onkeyup="sum();" placeholder="manual Selesai" required=""/>'+          
                    '<td><input type="text" id="jmanual_istirahat" class="form-control input-sm" name="jmanual_istirahat[]" value="'+ txtThirthNumberValue +'" placeholder="Lama Istirahat" onkeyup="sum();" required="">' +
                    '</tr>';
        $("#table-details").append($html);

        });                

        $("body").on('click', '.btn-remove-detail-row', function (e) {
            e.preventDefault();
            if($("#table-details tr:last-child").attr('id') != 'row1'){
                $("#table-details tr:last-child").remove();
            }
            
        });
        $("body").on('focus', ' .datepicker', function () {
            $(this).datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
        
        $("#frm_submit").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url() ?>trx_manual/create_action',
                type: 'POST',
                data: $("#frm_submit").serialize()
            }).always(function (response){
                var r = (response.trim());
                if(r == 1){
                    $(".alert-success").show();
                    window.location.href = '<?php echo base_url() ?>trx_manual/create';
                }
                else{
                    $(".alert-danger").show();
                }
            });
        });
            });


        $(document).ready(function(){

          //iterate through each textboxes and add keyup
          //handler to trigger sum event
          $(".jmanual_totalmenit").each(function() {

            $(this).keyup(function(){
              calculateSum();
            });
          });

        });

        function calculateSum() {

          var sum = 0;
          //iterate through each textboxes and add the values
          $(".jmanual_totalmenit").each(function() {

            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
              sum += parseFloat(this.value);
            }

          });
          //.toFixed() method will roundoff the final sum to 2 decimal places
          $("#total").html(sum.toFixed(2));
        }


        function sum() {
          var $sr = ($(".jdr1").length + 1);
          var rowid = Math.random();
          var txtFirstNumberValue = document.getElementById('jmanual_mulai').value;
          var txtSecondNumberValue = document.getElementById('jmanual_selesai').value;
          var txtThirthNumberValue = document.getElementById('jmanual_istirahat').value;
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
             document.getElementById('jmanual_totalmenit').value = selisih;
          }
        }
        </script>
