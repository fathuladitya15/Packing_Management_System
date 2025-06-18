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
        <tr><td>ID ( Mesin & Transaksi )</td><td><?php echo $mesin_id . "  |  " . $mesin_master_id; ?></td></tr>
	   	<tr><td>ID &  Nama Karyawan</td><td><?php echo $mesin_karyawan_id . " |  " . $karyawan_nama; ?></td></tr>
	    <tr><td>ID & Nama Produk</td><td><?php echo $produk_id ." | ". $produk_nama; ?></td></tr>
	    <tr><td>Acuan Id</td><td><?php echo $mesin_acuan_id; ?></td></tr>
	    <tr><td>No. Line</td><td><?php echo $mesin_line; ?></td></tr>
	    <tr><td>No. Mesin</td><td><?php echo $mesin_mesin; ?></td></tr>
	    <tr><td>Shift</td><td><?php echo $mesin_shift; ?></td></tr>
	    <tr><td>Jumlah Display</td><td><?php echo $mesin_display; ?></td></tr>
	    <tr><td>Waktu Mulai</td><td><?php echo substr($mesin_mulai,0,5); ?></td></tr>
	    <tr><td>Waktu Selesai</td><td><?php echo substr($mesin_selesai,0,5); ?></td></tr>
	    <tr><td>Waktu Istirahat</td><td><?php echo $mesin_istirahat; ?></td></tr>
	    <tr><td>Total menit</td><td><?php echo $mesin_totalmenit; ?></td></tr>
	    <tr><td>Tanggal laporan</td><td><?php echo $mesin_tgllaporan; ?></td></tr>
	</table>
	<div class="col-md-12" style="text-align: right;">
    <hr>
    <a href="<?php echo site_url('trx_mesin') ?>" class="btn btn-danger">Cancel</a>
    </div>
</div></div>
