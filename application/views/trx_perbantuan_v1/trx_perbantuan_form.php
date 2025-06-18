<script>
 function check() {
        if (document.getElementById("perbantuan_shift").value == "1") {
             document.getElementById("jperbantuan_mulai").value="06:45";
             document.getElementById("jperbantuan_selesai").value="14:45";

        }else if(document.getElementById("perbantuan_shift").value == "2"){
            document.getElementById("jperbantuan_mulai").value="14:45";
            document.getElementById("jperbantuan_selesai").value="22:45";

        }else {
            document.getElementById("jperbantuan_mulai").value="22:45";
            document.getElementById("jperbantuan_selesai").value="06:45";
        }
    } 
 </script>



<div class="box box-default">
<div class="box-body">

    <form method="POST" action="<?php echo $action; ?>" id="frm_submit">
            <div class="col-md-12">
            <fieldset><legend>PERBANTUAN FORM</legend>
            
            <div class="inline">  
            <div class="form-group">
                            
           <label class="col-sm-2 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-3 col-xs-12">
              <select class="form-control input-sm select2" name="perbantuan_shift" id="perbantuan_shift" onChange="check();">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($perbantuan_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>            
                <label class="col-sm-2 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('perbantuan_tgllaporan') ?></label>
                 <div class="col-sm-3 col-xs-12">
                <input type="text" name="perbantuan_tgllaporan" id="datepicker" class="form-control input-sm" placeholder="Tanggal Laporan Pekerjaan perbantuan" value="<?php echo $perbantuan_tgllaporan; ?>" required=""/>
            </div>
            </div></div>            

            <div class="inline">
              <div class="form-group">

                <label class="col-sm-2 col-xs-12 control-label" >Tipe Produk</label>
                <div class="col-sm-10 col-xs-12">
                     <?php echo form_dropdown('perbantuan', $perbantuan, $perbantuan_kategori);  ?>   
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
                            <thead style="background-color: #ddd;"><tr><th>No.</th><th>ID Karyawan</th><th>Waktu Mulai</th><th>Waktu Selesai</th><th>Istirahat</th></tr></thead>
                            <tbody id="table-details"><tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td><input type="text" class="form-control input-sm" name="jperbantuan_karyawan_id[]"  placeholder="perbantuan Karyawan Id" required=""/></td>
                                    <td><input type="text" id ="jperbantuan_mulai" class="form-control input-sm timepicker" name="jperbantuan_mulai[]"  placeholder="perbantuan Mulai" required="" value="06:45" /></td>
                                    <td><input type="text" class="form-control input-sm timepicker" name="jperbantuan_selesai[]"  id ="jperbantuan_selesai" placeholder="perbantuan Selesai" required="" value="14:45" /></td>
                                    <td><input type="text" class="form-control input-sm" name="jperbantuan_istirahat[]" value="0" placeholder="Lama Istirahat" onkeyup="sum();" id ="jperbantuan_istirahat" required=""></td>                          

                                </tr>

                            </tbody>
                              <thead style="background-color: #ddd;"><tr><th></th><th></th><th></th><th></th><th></th></tr></thead>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
                        </fieldset>


            
                           <div class="col-md-12" style="text-align: right;">
                               <hr>
                               <a href="<?php echo site_url('trx_perbantuan') ?>" class="btn btn-danger" style="margin-right: 10px;">Cancel</a>
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
              var txtFirstNumberValue = document.getElementById('jperbantuan_mulai').value;
              var txtSecondNumberValue = document.getElementById('jperbantuan_selesai').value;
              var txtThirthNumberValue = document.getElementById('jperbantuan_istirahat').value;   

            var $html = '<tr class="jdr1" id="' + rowid + '">' +
                    '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' +
                    '<td><input type="text" class="form-control input-sm" name="jperbantuan_karyawan_id[]" placeholder="perbantuan Karyawan Id" onkeyup="sum();" required=""/></td>' +
                    '<td><input type="text" class="form-control input-sm timepicker" name="jperbantuan_mulai[]" value="'+ txtFirstNumberValue +'" id="jperbantuan_mulai" placeholder="perbantuan Mulai" onkeyup="sum();" required=""/></td>' +
                    '<td><input type="text" class="form-control input-sm timepicker" name="jperbantuan_selesai[]" value="'+ txtSecondNumberValue +'"  id="jperbantuan_selesai" onkeyup="sum();" placeholder="perbantuan Selesai" required=""/>'+          
                    '<td><input type="text" id="jperbantuan_istirahat" class="form-control input-sm" value="'+ txtThirthNumberValue +'" name="jperbantuan_istirahat[]"  placeholder="Lama Istirahat" onkeyup="sum();" required="">' +
            
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
                url: '<?php echo base_url() ?>trx_perbantuan/create_action',
                type: 'POST',
                data: $("#frm_submit").serialize()
            }).always(function (response){
                var r = (response.trim());
                if(r == 1){
                    $(".alert-success").show();
                    window.location.href = '<?php echo base_url() ?>trx_perbantuan/create';
                }
                else{
                    $(".alert-danger").show();
                }
            });
        });
            });

        </script>
