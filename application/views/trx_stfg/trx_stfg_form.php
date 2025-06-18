<div class="box box-default"> 
<div class="box-body">

    <form method="POST" action="<?php echo $action; ?>" id="frm_submit">
            <div class="col-md-12">
            <fieldset><legend>STFG POST</legend>
            
            <div class="inline">  
       
          <div class="form-group">
           <label class="col-sm-1 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-3 col-xs-12">
              <select class="form-control input-sm select2" name="jstfg_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($stfg_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>           
                <label class="col-sm-2 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('jstfg_tgllaporan') ?></label>
                 <div class="col-sm-6 col-xs-12">
                <input type="text" name="jstfg_tgllaporan" id="datepicker" class="form-control input-sm" placeholder="Tanggal Laporan Pekerjaan jstfg" value="<?php echo $stfg_tgllaporan; ?>" required=""/>
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
                <strong>Ada kesalahan Transaksi , Mohon di ulang kembali</strong>
                </div>
            </div>
            </div>

                        <!-- Text input-->
                        <table style="width: 100%;" class="table">
                            <thead style="background-color: #ddd;"><tr><th>No.</th><th>Nama Produk</th><th>Qt1</th><th>Qt2</th><th>Qt3</th><th>Qt4</th><th>Qt5</th><th>Qt6</th><th>Qt7</th><th>Qt8</th><th>Qt9</th><th>Qt10</th><th>Rijek</th></tr></thead>
                            <tbody id="table-details"><tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td style="width: 325px;">
                                    <select class="form-control input-sm select2" name="jstfg_produk_id[]">
                                        <?php 
                                        foreach($produk as $g){?>
                                        
                                        <option value="<?php echo $g['produk_id']; ?>" <?php if($stfg_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " . $g['produk_nama']; ?></option>
                                        <?php } 
                                        ?>
                                    </select>
                                    </td>
                                    <td ><input type="text" id="jstfg_mbox1" class="form-control input-sm " name="jstfg_mbox1[]" value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jstfg_mbox2" class="form-control input-sm " name="jstfg_mbox2[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jstfg_mbox3" class="form-control input-sm " name="jstfg_mbox3[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jstfg_mbox4" class="form-control input-sm " name="jstfg_mbox4[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jstfg_mbox5" class="form-control input-sm " name="jstfg_mbox5[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jstfg_mbox6" class="form-control input-sm " name="jstfg_mbox6[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jstfg_mbox7" class="form-control input-sm " name="jstfg_mbox7[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jstfg_mbox8" class="form-control input-sm " name="jstfg_mbox8[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jstfg_mbox9" class="form-control input-sm " name="jstfg_mbox9[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jstfg_mbox10" class="form-control input-sm " name="jstfg_mbox10[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jstfg_rijek" class="form-control input-sm " name="jstfg_rijek[]"  value ="0" placeholder="" required=""/></td>                        

                                </tr>

                            </tbody>
                              <thead style="background-color: #ddd;"><tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
                        </fieldset>


            
                           <div class="col-md-12" style="text-align: right;">
                               <hr>
                               <a href="<?php echo site_url('trx_stfg') ?>" class="btn btn-danger" style="margin-right: 10px;">Cancel</a>
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


            var $html = '<tr class="jdr1" id="' + rowid + '">' +
                    '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 10000) + 1)+'"></td>' +
                    '<td><select class="form-control input-sm select2" name="jstfg_produk_id[]" id="jstfg_produk_id">' +
                    '<?php foreach($produk as $g){ ?> ' +                                        
                    '<option value="<?php echo $g['produk_id']; ?>" <?php if($stfg_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " . $g['produk_nama']; ?> </option><?php }?></select></td>' +
                    '<td><input type="text" id ="jstfg_mbox1" class="form-control input-sm " name="jstfg_mbox1[]" value ="0" required=""</td> ' +
                    '<td><input type="text" id="jstfg_mbox2" class="form-control input-sm " name="jstfg_mbox2[]" value ="0"  placeholder="" required="" /></td> '+
                    '<td><input type="text"  id ="jstfg_mbox3" class="form-control input-sm " name="jstfg_mbox3[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jstfg_mbox4" class="form-control input-sm " name="jstfg_mbox4[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jstfg_mbox5" class="form-control input-sm " name="jstfg_mbox5[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jstfg_mbox6" class="form-control input-sm " name="jstfg_mbox6[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jstfg_mbox7" class="form-control input-sm " name="jstfg_mbox7[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jstfg_mbox8" class="form-control input-sm " name="jstfg_mbox8[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jstfg_mbox9" class="form-control input-sm " name="jstfg_mbox9[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jstfg_mbox10" class="form-control input-sm " name="jstfg_mbox10[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jstfg_rijek" class="form-control input-sm " name="jstfg_rijek[]" value ="0" placeholder="" required="" /></td> '+
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

        </script>
