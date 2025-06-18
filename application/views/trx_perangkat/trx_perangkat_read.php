<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">PERANGKAT DETAIL</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">
        <tr><td style="width: 300px;">ID ( Perangkat & Transaksi )</td><td><?php echo $perangkat_id . "  |  " . $perangkat_master_id; ?></td></tr>
	    <tr><td>ID & Nama Karyawan</td><td><?php echo $perangkat_karyawan_id . " | " . $karyawan_nama; ?></td></tr>
	    <tr><td>Shift</td><td><?php echo $perangkat_shift; ?></td></tr>
	    <tr><td>Upah</td><td><?php echo $perangkat_upah; ?></td></tr>
	    <tr><td>Laporan</td><td><?php echo $perangkat_tgllaporan; ?></td></tr>
	</table>
	<div class="col-md-12" style="text-align: right;">
    <hr>
    <a href="<?php echo site_url('trx_perangkat') ?>" class="btn btn-danger">Cancel</a>
    </div>
</div></div>
