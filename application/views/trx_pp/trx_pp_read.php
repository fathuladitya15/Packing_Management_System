<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">PP Detail</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">
        <tr><td style="width: 300px;">Nama Produk</td><td><?php echo $pp_produk_id . " | ".$produk_nama; ?></td></tr>
	    <tr><td>Shift</td><td><?php echo $pp_shift; ?></td></tr>
	    <tr><td>Jumlah Mbox1</td><td><?php echo $pp_mbox1; ?></td></tr>
	    <tr><td>Jumlah Mbox2</td><td><?php echo $pp_mbox2; ?></td></tr>
	    <tr><td>Total</td><td><?php echo $pp_total; ?></td></tr>
	    <tr><td>Upah</td><td><?php echo $pp_upah; ?></td></tr>
	    <tr><td>Laporan</td><td><?php echo $pp_tgllaporan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('trx_pp') ?>" class="btn btn-danger pull-right">Cancel</a></td></tr>
	</table>
</div></div>
