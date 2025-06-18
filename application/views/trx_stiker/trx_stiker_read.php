<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">STIKER DETAIL</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">

	    <tr><td style="width: 350px;">ID ( Stiker & Transaksi )</td><td><?php echo $stiker_id . "  |  " . $stiker_master_id; ?></td></tr>
	   	<tr><td>ID &  Nama Karyawan</td><td><?php echo $stiker_karyawan_id . " |  " . $karyawan_nama; ?></td></tr>
	    <tr><td>ID & Nama Produk</td><td><?php echo $stiker_produk_id ." | ". $produk_nama; ?></td></tr>
	    <tr><td>Kategori</td><td><?php echo $stiker_kategori; ?></td></tr>
	    <tr><td>Shift</td><td><?php echo $stiker_shift; ?></td></tr>
	    <tr><td>Jumlah Stiker</td><td><?php echo $stiker_jumlahstiker; ?></td></tr>
	    <tr><td>Upah</td><td><?php echo $stiker_upah; ?></td></tr>
	    <tr><td>Laporan</td><td><?php echo $stiker_tgllaporan; ?></td></tr>
	    <tr><td></td><td ><a href="<?php echo site_url('trx_stiker') ?>" class="btn btn-danger pull-right">Cancel</a></td></tr>
	</table>
</div>
