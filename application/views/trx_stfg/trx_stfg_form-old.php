<div class="box box-default">
<div class="box-body"> 

    <form method="POST" action="<?php echo $action; ?>" id="frm_submit">
            <div class="col-md-12">
            <fieldset><legend>STFG Form</legend>
            
            <div class="inline">  
       
          <div class="form-group">
           <label class="col-sm-1 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-3 col-xs-12">
              <select class="form-control input-sm select2" name="stfg_shift">
                <option>--- Pilih Shift ---</option>
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($stfg_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>           
                <label class="col-sm-2 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('stfg_tgllaporan') ?></label>
                 <div class="col-sm-3 col-xs-12">
                <input type="text" name="stfg_tgllaporan" id="datepicker" class="form-control input-sm" placeholder="Tanggal Laporan Pekerjaan stfg" value="<?php echo $stfg_tgllaporan; ?>" required=""/>
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
                <strong>Ada kesalahan , Mohon di ulang kebali</strong>
                </div>
            </div>
            </div>

                        <!-- Text input-->
                        <table style="width: 100%;" class="table">
                            <thead style="background-color: #ddd;"><tr><th>No.</th><th>Nama Produk</th><th>Qt1</th><th>Qt2</th><th>Qt3</th><th>Qt4</th><th>Qt5</th><th>Qt6</th><th>Qt7</th><th>Qt8</th><th>Qt9</th><th>Qt10</th><th>Rijek</th><th>Total</th></tr></thead>
                            <tbody id="table-details"><tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td style="width: 250px;">
                                    <select class="form-control input-sm select2" name="stfg_produk_id">
                                        <option>--- Pilih Produk ---</option>
                                        <?php 
                                        foreach($produk as $g){?>
                                        
                                        <option value="<?php echo $g['produk_id']; ?>" <?php if($stfg_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_nama']; ?></option>
                                        <?php } 
                                        ?>
                                    </select>
                                    </td>
                                    <td ><input type="text" id="stfg_mbox1" class="form-control input-sm " name="stfg_mbox1[]" value ="0" placeholder="" required="" onkeyup="sum();"/></td> 
                                    <td><input type="text" id="stfg_mbox2" class="form-control input-sm " name="stfg_mbox2[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td>
                                    <td><input type="text" id="stfg_mbox3" class="form-control input-sm " name="stfg_mbox3[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td> 
                                    <td><input type="text" id="stfg_mbox4" class="form-control input-sm " name="stfg_mbox4[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td>
                                    <td><input type="text" id="stfg_mbox5" class="form-control input-sm " name="stfg_mbox5[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td> 
                                    <td><input type="text" id="stfg_mbox6" class="form-control input-sm " name="stfg_mbox6[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td>
                                    <td><input type="text" id="stfg_mbox7" class="form-control input-sm " name="stfg_mbox7[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td> 
                                    <td><input type="text" id="stfg_mbox8" class="form-control input-sm " name="stfg_mbox8[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td>
                                    <td><input type="text" id="stfg_mbox9" class="form-control input-sm " name="stfg_mbox9[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td> 
                                    <td><input type="text" id="stfg_mbox10" class="form-control input-sm " name="stfg_mbox10[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td>
                                    <td><input type="text" id="stfg_rijek" class="form-control input-sm " name="stfg_rijek[]"  value ="0" placeholder="" required="" onkeyup="sum();"/></td>
                                    <td> <input type="text" onkeyup="sum();" class="stfg_total" name="stfg_total[]" id="stfg_total"  placeholder="Total" /></td>                          

                                </tr>

                            </tbody>
                              <thead style="background-color: #ddd;"><tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th><input type="text" id="total" class="total" name="total" placeholder="" required="" disabled/></th></tr></thead>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
                        </fieldset>


            
                           <div class="col-md-12" style="text-align: right;">
                               <hr>
                               <a href="<?php echo site_url('trx_stfg') ?>" class="btn btn-default" style="margin-right: 10px;">Cancel</a>
                               <input class="btn btn-success pull-right" type="submit" value="submit" name="submit">
                           </div>
                           </form>
                </div>
             
            <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
            <script src="<?php echo base_url();?>assets/plugins/jquery/material.min.js"></script>
            <script src="<?php echo base_url();?>assets/plugins/jquery/jquery-ui.min.js"></script> 
            <script>
    
            $("body").on(document).ready(function (){
              var xsatu = parseInt(document.getElementById('stfg_mbox1').value);
              var xdua = parseInt(document.getElementById('stfg_mbox2').value);
              var xtiga = parseInt(document.getElementById('stfg_mbox3').value);
              var empat = parseInt(document.getElementById('stfg_mbox4').value);
              var lima = parseInt(document.getElementById('stfg_mbox5').value);
              var enam = parseInt(document.getElementById('stfg_mbox6').value);
              var tujuh = parseInt(document.getElementById('stfg_mbox7').value);
              var delapan = parseInt(document.getElementById('stfg_mbox8').value);
              var sembilan = parseInt(document.getElementById('stfg_mbox9').value);
              var sepuluh = parseInt(document.getElementById('stfg_mbox10').value);
              var rijek = parseInt(document.getElementById('stfg_rijek').value);
              
              var jumlah = (xsatu);
              document.getElementById('stfg_total').value = jumlah;
           

              $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});


           
                $("body").on('click', '.btn-add-more', function (e) {
            e.preventDefault();
              var $sr = ($(".jdr1").length + 1);
              var rowid = Math.random();     

            var $html = '<tr class="jdr1" id="' + rowid + '">' +
                    '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' +
                    '<td><select class="form-control input-sm select2" name="stfg_produk_id[]" id="stfg_produk_id">' +
                    '<option>--- Pilih Produk ---</option> <?php foreach($produk as $g){ ?> ' +                                        
                    '<option value=" <?php echo $g['produk_id']; ?>" <?php if($stfg_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_nama']; ?> </option><?php }?></select></td>' +
                    '<td><input type="text" id ="tfg_mbox1" class="form-control input-sm " name="stfg_mbox1[]" value="<?php echo $stfg_total; ?>" required="" /></td> ' +
                    '<td><input type="text" id="stfg_mbox2" class="form-control input-sm " name="stfg_mbox2[]" value="0"  placeholder="" required="" /></td> '+
                    '<td><input type="text"  id ="stfg_mbox3" class="form-control input-sm " name="stfg_mbox3[]"  placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="stfg_mbox4" class="form-control input-sm " name="stfg_mbox4[]"  placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="stfg_mbox5" class="form-control input-sm " name="stfg_mbox5[]"  placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="stfg_mbox6" class="form-control input-sm " name="stfg_mbox6[]"  placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="stfg_mbox7" class="form-control input-sm " name="stfg_mbox7[]"  placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="stfg_mbox8" class="form-control input-sm " name="stfg_mbox8[]" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="stfg_mbox9" class="form-control input-sm " name="stfg_mbox9[]" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="stfg_mbox10" class="form-control input-sm " name="stfg_mbox10[]"  placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="stfg_rijek" class="form-control input-sm " name="stfg_rijek[]"  placeholder="" required="" /></td> '+
                    '<td><input type="text"  id="stfg_total"  class="stfg_total" name="stfg_total[]"   placeholder="Total" value="<?php echo $stfg_total; ?>" />' +
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
  

  $("body").on('.stfg_total').keyup(function () {
 
    // initialize the sum (total price) to zero
    var sum = 0;
     
    // we use jQuery each() to loop through all the textbox with 'price' class
    // and compute the sum for each loop
    $('.stfg_total').each(function() {
        sum += Number($(this).val());
    });
     
    // set the computed value to 'totalPrice' textbox
    $('#total').val(sum);
     
});



        $("#frm_submit").on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '<?php echo base_url() ?>trx_stfg/create_action',
                type: 'POST',
                data: $("#frm_submit").serialize()
            }).always(function (response){
                var r = (response.trim());
                if(r == 1){
                    $(".alert-success").show();
                    window.location.href = '<?php echo base_url() ?>trx_stfg/create';
                }
                else{
                    $(".alert-danger").show();
                }
            });
        });
            });



        function sum() {

          var satu = parseInt(document.getElementById('stfg_mbox1').value);
          var dua = parseInt(document.getElementById('stfg_mbox2').value);
          var tiga = parseInt(document.getElementById('stfg_mbox3').value);
          var empat = parseInt(document.getElementById('stfg_mbox4').value);
          var lima = parseInt(document.getElementById('stfg_mbox5').value);
          var enam = parseInt(document.getElementById('stfg_mbox6').value);
          var tujuh = parseInt(document.getElementById('stfg_mbox7').value);
          var delapan = parseInt(document.getElementById('stfg_mbox8').value);
          var sembilan = parseInt(document.getElementById('stfg_mbox9').value);
          var sepuluh = parseInt(document.getElementById('stfg_mbox10').value);
          var rijek = parseInt(document.getElementById('stfg_rijek').value);
          var jumlah = (satu + dua + tiga + empat + lima + enam + tujuh + delapan + sembilan + sepuluh ) - rijek;
        
           document.getElementById('stfg_total').value = jumlah;
        }
        </script>
