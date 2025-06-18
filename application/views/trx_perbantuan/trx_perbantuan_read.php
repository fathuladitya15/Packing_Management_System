<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">PERBANTUAN DETAIL</h3>


    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">
        <tr><td style="width: 350px;">ID ( Perbantuan & Transaksi )</td><td><?php echo $perbantuan_id . "  |  " . $perbantuan_master_id; ?></td></tr>
	   	<tr><td>ID &  Nama Karyawan</td><td><?php echo $perbantuan_karyawan_id . " |  " . $karyawan_nama; ?></td></tr>
	    <tr><td>Shift</td><td><?php echo $perbantuan_shift; ?></td></tr>
	    <tr><td>Total Bekerja/Jam</td><td><?php echo $perbantuan_istirahat . ' Jam'; ?></td></tr>
	    <tr><td>Upah</td><td><?php echo $perbantuan_upah; ?></td></tr>
	    <tr><td>Laporan Pekerjaan</td><td><?php echo $perbantuan_tgllaporan; ?></td></tr>
	</table>
	<div class="col-md-12" style="text-align: right;">
    <hr>
    <a href="<?php echo site_url('trx_perbantuan') ?>" class="btn btn-danger">Cancel</a>
    </div>
</div></div>
