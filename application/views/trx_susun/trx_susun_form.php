<div class="box box-default"> 
<div class="box-body">

    <form method="POST" action="<?php echo $action; ?>" id="frm_submit">
            <div class="col-md-12">
            <fieldset><legend>SUSUN POST</legend>
            
            <div class="inline">  
       
          <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-2 col-xs-12">
              <select class="form-control input-sm select2" name="jsusun_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($susun_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div> 
         
                <label class="col-sm-2 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('jsusun_tgllaporan') ?></label>
                 <div class="col-sm-3 col-xs-12">
                <input type="text" name="jsusun_tgllaporan" id="datepicker" class="form-control input-sm" placeholder="Tanggal Laporan Pekerjaan susun" value="<?php echo $susun_tgllaporan; ?>" required=""/>
            </div>
            </div>
            </div>

            <div class="form-group">
      
                <label class="col-sm-2 col-xs-12 control-label" >Nama Produk</label>
                <div class="col-sm-7 col-xs-12">
                  <select class="form-control input-sm select2" name="jsusun_produk_id">
                  <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($susun_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " . $g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
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
                <strong>Ada kesalahan , Mohon di ulang kembali</strong>
                </div>
            </div>
            </div>

                        <!-- Text input-->
                        <table style="width: 100%;" class="table">
                            <thead style="background-color: #ddd;"><tr><th>No.</th><th>ID Karyawan</th><th>K1</th><th>K2</th><th>K3</th><th>K4</th><th>K5</th><th>K6</th><th>K7</th><th>K8</th><th>K9</th><th>K10</th><th>K11</th><th>K12</th><th>K13</th><th>K14</th><th>K15</th></tr></thead>
                            <tbody id="table-details"><tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td style="width: 150px;">
                                    <input type="text" id="jsusun_karyawan_id" class="form-control input-sm " name="jsusun_karyawan_id[]" placeholder="" required="" /></td>
                                    <td ><input type="text" id="jsusun_krat1" class="form-control input-sm " name="jsusun_krat1[]" value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jsusun_krat2" class="form-control input-sm " name="jsusun_krat2[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jsusun_krat3" class="form-control input-sm " name="jsusun_krat3[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jsusun_krat4" class="form-control input-sm " name="jsusun_krat4[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jsusun_krat5" class="form-control input-sm " name="jsusun_krat5[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jsusun_krat6" class="form-control input-sm " name="jsusun_krat6[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jsusun_krat7" class="form-control input-sm " name="jsusun_krat7[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jsusun_krat8" class="form-control input-sm " name="jsusun_krat8[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jsusun_krat9" class="form-control input-sm " name="jsusun_krat9[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jsusun_krat10" class="form-control input-sm " name="jsusun_krat10[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jsusun_krat11" class="form-control input-sm " name="jsusun_krat11[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jsusun_krat12" class="form-control input-sm " name="jsusun_krat12[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jsusun_krat13" class="form-control input-sm " name="jsusun_krat13[]"  value ="0" placeholder="" required="" /></td>
                                    <td><input type="text" id="jsusun_krat14" class="form-control input-sm " name="jsusun_krat14[]"  value ="0" placeholder="" required="" /></td> 
                                    <td><input type="text" id="jsusun_krat15" class="form-control input-sm " name="jsusun_krat15[]"  value ="0" placeholder="" required="" /></td>                  
                                </tr>

                            </tbody>
                              <thead style="background-color: #ddd;"><tr><th></th><th></th><th></th><th><th></th><th></th><th></th><th></th><th></th><th></th><th></th<th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr></thead>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
                        </fieldset>


            
                           <div class="col-md-12" style="text-align: right;">
                               <hr>
                               <a href="<?php echo site_url('trx_susun') ?>" class="btn btn-danger" style="margin-right: 10px;">Cancel</a>
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
                    '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="'+Math.floor((Math.random() * 100000) + 1)+'"></td>' +
                    '<td style="width: 150px;"><input type="text" id="jsusun_karyawan_id" class="form-control input-sm " name="jsusun_karyawan_id[]" placeholder="" required="" /></td>' +
                    '<td><input type="text" id ="jsusun_krat1" class="form-control input-sm " name="jsusun_krat1[]" value ="0" required="" /></td> ' +
                    '<td><input type="text" id="jsusun_krat2" class="form-control input-sm " name="jsusun_krat2[]" value ="0"  placeholder="" required="" /></td> '+
                    '<td><input type="text"  id ="jsusun_krat3" class="form-control input-sm " name="jsusun_krat3[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat4" class="form-control input-sm " name="jsusun_krat4[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat5" class="form-control input-sm " name="jsusun_krat5[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat6" class="form-control input-sm " name="jsusun_krat6[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat7" class="form-control input-sm " name="jsusun_krat7[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat8" class="form-control input-sm " name="jsusun_krat8[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat9" class="form-control input-sm " name="jsusun_krat9[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat10" class="form-control input-sm " name="jsusun_krat10[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat11" class="form-control input-sm " name="jsusun_krat11[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat12" class="form-control input-sm " name="jsusun_krat12[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat13" class="form-control input-sm " name="jsusun_krat13[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat14" class="form-control input-sm " name="jsusun_krat14[]" value ="0" placeholder="" required="" /></td> ' +
                    '<td><input type="text"  id ="jsusun_krat15" class="form-control input-sm " name="jsusun_krat15[]" value ="0" placeholder="" required="" /></td> ' +
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
                url: '<?php echo base_url() ?>trx_susun/create_action',
                type: 'POST',
                data: $("#frm_submit").serialize()
            }).always(function (response){
                var r = (response.trim());
                if(r == 1){
                    $(".alert-success").show();
                    window.location.href = '<?php echo base_url() ?>trx_susun/create';
                }
                else{
                    $(".alert-danger").show();
                }
            });
        });
            });

        </script>
