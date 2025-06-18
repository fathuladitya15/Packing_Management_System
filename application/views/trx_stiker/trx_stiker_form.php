<div class="box box-default"> 
<div class="box-body">

    <form method="POST" action="<?php echo $action; ?>" id="frm_submit">
            <div class="col-md-12">
            <fieldset><legend>Stiker Form</legend>
            
            <div class="inline">  
            <div class="form-group"> 
                       <label class="col-sm-2 col-xs-12 control-label" >Shift</label>
            <div class="col-sm-2 col-xs-12">
              <select class="form-control input-sm select2" name="stiker_shift">
                <?php 
                foreach($shift as $g){?>
                
                <option value="<?php echo $g['shift_id']; ?>" <?php if($stiker_shift==$g['shift_id']) echo "Selected" ?>><?php echo $g['shift_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div> 

            
                <label class="col-sm-2 col-xs-12 control-label" for="date">Tanggal Laporan <?php echo form_error('stiker_tgllaporan') ?></label>
                 <div class="col-sm-6 col-xs-12">
                <input type="text" name="stiker_tgllaporan" id="datepicker" class="form-control input-sm" placeholder="Tanggal Laporan Pekerjaan stiker" value="<?php echo $stiker_tgllaporan; ?>" required=""/>
            </div>

            </div>
            </div>            

            <div class="inline">
              <div class="form-group">

              <label class="col-sm-2 col-xs-12 control-label" for="date">Jumlah Stiker <?php echo form_error('stiker_jumlahstiker') ?></label>
                 <div class="col-sm-2 col-xs-12">
                <input type="text" name="stiker_jumlahstiker" class="form-control input-sm" placeholder="jumlah stiker" value="<?php echo $stiker_jumlahstiker; ?>" required=""/>
            </div>
                <label class="col-sm-2 col-xs-12 control-label" >Produk</label>
                <div class="col-sm-6 col-xs-12">
                  <select class="form-control input-sm select2" name="stiker_produk_id">
                    <?php 
                    foreach($produk as $g){?>
                    
                    <option value="<?php echo $g['produk_id']; ?>" <?php if($stiker_produk_id==$g['produk_id']) echo "Selected" ?>><?php echo $g['produk_id'] . " | " . $g['produk_nama']; ?></option>
                    <?php } 
                    ?>
                  </select>
                </div>
              </div>
            </div>   

            <div class="inline">
            <div class="form-group">

            <label class="col-sm-2 col-xs-12 control-label" >Tipe Stiker</label>
            <div class="col-sm-9 col-xs-12">
                <?php 
                echo form_dropdown('stiker', $stiker, $stiker_kategori);  ?>   
            </div>
            </div></div>
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
                            <thead style="background-color: #ddd;"><tr><th>No.</th><th>ID Karyawan</th></tr></thead>
                            <tbody id="table-details"><tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td><input type="text" class="form-control input-sm" id="jstiker_karyawan_id" name="jstiker_karyawan_id[]"  placeholder="stiker Karyawan Id" required=""/></td>                                                    

                                </tr>

                            </tbody>
                              <thead style="background-color: #ddd;"><tr><th></th><th></th></tr></thead>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
                        </fieldset>


            
                           <div class="col-md-12" style="text-align: right;">
                               <hr>
                               <a href="<?php echo site_url('trx_stiker') ?>" class="btn btn-default" style="margin-right: 10px;">Cancel</a>
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
                    '<td><input type="text" class="form-control input-sm" id="jstiker_karyawan_id" name="jstiker_karyawan_id[]" placeholder="stiker Karyawan Id" required=""/></td></tr>';
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
                url: '<?php echo base_url() ?>trx_stiker/create_action',
                type: 'POST',
                data: $("#frm_submit").serialize()
            }).always(function (response){
                var r = (response.trim());
                if(r == 1){
                    $(".alert-success").show();
                    window.location.href = '<?php echo base_url() ?>trx_stiker/create';
                }
                else{
                    $(".alert-danger").show();
                }
            });
        });
            });


        </script>
