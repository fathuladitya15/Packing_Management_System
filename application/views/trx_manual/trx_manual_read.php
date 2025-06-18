<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">MANUAL DETAIL</h3>
 
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">
        <tr><td>ID ( Manual & Transaksi )</td><td><?php echo $manual_id . "  |  " . $manual_master_id; ?></td></tr>
	    <tr><td>ID & Nama Karyawan</td><td><?php echo $manual_karyawan_id ." | " . $karyawan_nama; ?></td></tr>
	    <tr><td>ID & Nama Produk</td><td><?php echo $produk_id ." | " . $produk_nama; ?></td></tr>
	    <tr><td>Acuan</td><td><?php echo $manual_acuan_id; ?></td></tr>
	    <tr><td>Shift</td><td><?php echo $manual_shift; ?></td></tr>
	    <tr><td>Jumlah Box</td><td><?php echo $manual_box; ?></td></tr>
	    <tr><td>Waktu Mulai</td><td><?php echo substr($manual_mulai,0,5); ?></td></tr>
	    <tr><td>Waktu Selesai</td><td><?php echo substr($manual_selesai,0,5); ?></td></tr>
	    <tr><td>Istirahat</td><td><?php echo $manual_istirahat; ?></td></tr>
	    <tr><td>Total Waktu/Menit</td><td><?php echo $manual_totalmenit; ?></td></tr>
	    <tr><td>Tanggal Laporan</td><td><?php echo $manual_tgllaporan; ?></td></tr>
	  
	</table>
	<div class="col-md-12" style="text-align: right;">
    <hr>
    <a href="<?php echo site_url('trx_manual') ?>" class="btn btn-danger">Cancel</a>
    </div>
</div></div>
