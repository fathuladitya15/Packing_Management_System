<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">Archive Reporting</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class='row'>

    <form method="POST" action="<?php echo base_url() ."trx_archive/reporting"; ?>">
    <div class="inline">  
            <div class="form-group">
            <div class="col-sm-8 col-xs-12"> <input type="text" name="tgl_daftar" class="form-control" placeholder="Input Tanggal Archive Reporting" required></div>
            <div class="col-sm-3 col-xs-12">

            <select class="form-control input-sm select2" name="jarchive_id">
                <?php 
                foreach($module as $g){?>                
                <option value="<?php echo $g['module_id']; ?>" <?php if($xmodule_id==$g['module_id']) echo "Selected" ?>><?php echo $g['module_nama']; ?></option>
                
                <?php } 
                ?>
              </select>
            </div>
            <div class="col-sm-1 col-xs-12"><button class="btn btn-info btn-flat glyphicon glyphicon-search"></button></div>
            
            </div>

        </div>
        </form>  

    </div>
    <br/>
  </div>
</div>
<strong>Note:</strong> <br/>
1. Pastikan tanggal dan module telah terisi (tidak boleh kosong)<br/>
2. Export laporan excel menggunakan periode bulanan untuk menghindari "Exhausted" Memory

</div>

