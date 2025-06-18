<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">Transaksi Detail</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
<div class="box-body">
        <table class="table">
	    <tr><td style="width: 300px;">Master Module Id</td><td><?php echo $module_nama; ?></td></tr>
	    <tr><td>Master Acuan Id</td><td><?php 
            if ($master_acuan_id =='1'){
                echo "STFG"; 
            }elseif($master_acuan_id =='2'){
                echo "STFG MANUAL";
            }elseif($master_acuan_id =='3'){
                echo "WIP";
            }else{
                echo "TIDAK ADA";
            }
            ?></td></tr>
	    <tr><td>Master Produk Id</td><td><?php echo $master_produk_id; ?></td></tr>
	    <tr><td>Master Line</td><td><?php echo $master_line; ?></td></tr>
	    <tr><td>Master Tgllaporan</td><td><?php echo $master_tgllaporan; ?></td></tr>
	    <tr><td>Master Shift</td><td><?php echo $master_shift; ?></td></tr>
	    <tr><td>Master Nomesin</td><td><?php echo $master_nomesin; ?></td></tr>
	    <tr><td>Master Jumlahteam</td><td><?php echo $master_jumlahteam; ?></td></tr>
	    <tr><td>Master Display</td><td><?php echo $master_display; ?></td></tr>
	    <tr><td>Master Box</td><td><?php echo $master_box; ?></td></tr>
	    <tr><td>Master Istirahat</td><td><?php echo $master_istirahat; ?></td></tr>
	    <tr><td>Master Totalkerjamenit</td><td><?php echo $master_totalkerjamenit; ?></td></tr>
	    <tr><td>Master Totalkerjajam</td><td><?php echo $master_totalkerjajam; ?></td></tr>
	    <tr><td>Master Karu</td><td><?php echo $master_karu; ?></td></tr>
	    <tr><td>Master Stfg</td><td><?php echo $master_stfg; ?></td></tr>
	    <tr><td>Master Bayarstfg</td><td><?php echo $master_bayarstfg; ?></td></tr>
	    <tr><td>Master Acuanmesin</td><td><?php echo $master_acuanmesin; ?></td></tr>
	    <tr><td>Master Acuanline</td><td><?php echo $master_acuanline; ?></td></tr>
	    <tr><td>Master Userinput</td><td><?php echo $master_userinput; ?></td></tr>
	    <tr><td>Master Tglinput</td><td><?php echo $master_tglinput; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('trx_gl') ?>" class="btn btn-danger pull-right">Cancel</a></td></tr>
	</table>
</div></div>
