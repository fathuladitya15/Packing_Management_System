<script> 
 function check() {
    if (document.getElementById("line_shift").value == "1") {
         document.getElementById("jline_mulai").value="06:45";
         document.getElementById("jline_selesai").value="14:45";

    }else if(document.getElementById("line_shift").value == "2"){
      document.getElementById("jline_mulai").value="14:45";
        document.getElementById("jline_selesai").value="22:45";

    }else {
      document.getElementById("jline_mulai").value="22:45";
        document.getElementById("jline_selesai").value="06:45";
    }
    } 
 </script>


<div class="box box-default">
<div class="box-body">

    <form method="POST" action="<?php echo $action; ?>" id="frm_submit">
            <div class="col-md-12">
            <fieldset><legend>LINE FORM</legend>
            
            <div class="inline">  
            <div class="form-group">
                <label class="col-sm-2 col-xs-12 control-label" for="int">Line <?php echo form_error('line_nomor') ?></label>
                 <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control input-sm" name="line_nomor" id="line_nomor" placeholder="Line" value="<?php echo $line_nomor; ?>" required=""/>
            </div>

            
                <label class="col-sm-2 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('line_tgllaporan') ?></label>
                 <div class="col-sm-3 col-xs-12">
                <input type="text" name="line_tgllaporan" id="datepicker" class="form-control input-sm" placeholder="Tanggal Laporan Pekerjaan line" value="<?php echo $line_tgllaporan; ?>" required=""/>
            </div>
            </div>
            <div class="inline">

            <div class="inline">
              <div class="form-group">
                
           <label class="col-sm-2 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-3 col-xs-12">
              <select class="form-control input-sm select2" name="line_shift" id="line_shift" onChange="check();">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($line_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>

                <label class="col-sm-2 col-xs-12 control-label" >Produk</label>
                <div class="col-sm-5 col-xs-12">
                  <select class="form-control input-sm select2" name="line_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($line_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " . $g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
                </div>
              </div>
            </div>   

            <div class="inline"> 
            <div class="form-group">
                <label class="col-sm-2 col-xs-12 control-label" for="int">Box <?php echo form_error('line_box') ?></label>
                 <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control input-sm" name="line_box" id="line_box" placeholder="Jumlah Box" value="<?php echo $line_box; ?>" required=""/>
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
                <strong>Ada kesalahan transaksi , Mohon di ulang kembali</strong>
                </div>
            </div>
            </div>

                        <!-- Text input-->
                        <table style="width: 100%;" class="table">
                            <thead style="background-color: #ddd;"><tr><th>No.</th><th>ID Karyawan</th><th>Waktu Mulai</th><th>Waktu Selesai</th><th>Istirahat</th><th></th></tr></thead>
                            <tbody id="table-details"><tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td><input type="text" class="form-control input-sm" name="jline_karyawan_id[]"  placeholder="line Karyawan Id" required=""/></td>
                                    <td><input type="text" id ="jline_mulai" class="form-control input-sm timepicker" name="jline_mulai[]" value="06:45"  placeholder="line Mulai" required="" onkeyup="sum();"/></td>
                                    <td><input type="text" class="form-control input-sm timepicker" name="jline_selesai[]"  id ="jline_selesai" value="14:45" placeholder="line Selesai" required="" onkeyup="sum();"/></td>
                                    <td><input type="text" class="form-control input-sm" value="0" name="jline_istirahat[]" placeholder="Lama Istirahat" onkeyup="sum();" id ="jline_istirahat" value ="0" required=""></td>                        

                                </tr>

                            </tbody>
                              <thead style="background-color: #ddd;"><tr><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
                        </fieldset>


            
                           <div class="col-md-12" style="text-align: right;">
                               <hr>
                               <a href="<?php echo site_url('trx_line') ?>" class="btn btn-danger" style="margin-right: 10px;">Cancel</a>
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
              var txtFirstNumberValue = document.getElementById('jline_mulai').value;
              var txtSecondNumberValue = document.getElementById('jline_selesai').value;
              var txtThirthNumberValue = document.getElementById('jline_istirahat').value;    
        
            var $html = '<tr class="jdr1" id="' + rowid + '">' +
                    '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' +
                    '<td><input type="text" class="form-control input-sm" name="jline_karyawan_id[]" placeholder="line Karyawan Id" onkeyup="sum();" required=""/></td>' +
                    '<td><input type="text" class="form-control input-sm timepicker" name="jline_mulai[]" value="'+ txtFirstNumberValue +'" id="jline_mulai" placeholder="line Mulai" onkeyup="sum();" required=""/></td>' +
                    '<td><input type="text" class="form-control input-sm timepicker" name="jline_selesai[]" value="'+ txtSecondNumberValue +'"  id="jline_selesai" onkeyup="sum();" placeholder="line Selesai" required=""/>'+          
                    '<td><input type="text" id="jline_istirahat" class="form-control input-sm" name="jline_istirahat[]" value="'+ txtThirthNumberValue +'" placeholder="Lama Istirahat" onkeyup="sum();" required="">' +
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
                url: '<?php echo base_url() ?>trx_line/create_action',
                type: 'POST',
                data: $("#frm_submit").serialize()
            }).always(function (response){
                var r = (response.trim());
                if(r == 1){
                    $(".alert-success").show();
                    window.location.href = '<?php echo base_url() ?>trx_line/create';
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
          $(".jline_totalmenit").each(function() {

            $(this).keyup(function(){
              calculateSum();
            });
          });

        });

        function calculateSum() {

          var sum = 0;
          //iterate through each textboxes and add the values
          $(".jline_totalmenit").each(function() {

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
          var txtFirstNumberValue = document.getElementById('jline_mulai').value;
          var txtSecondNumberValue = document.getElementById('jline_selesai').value;
          var txtThirthNumberValue = document.getElementById('jline_istirahat').value;
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
             document.getElementById('jline_totalmenit').value = selisih;
          }
        }
        </script>
