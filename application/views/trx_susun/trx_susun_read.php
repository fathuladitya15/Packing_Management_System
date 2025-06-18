<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">SUSUN DETAIL</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">
	    <tr><td style="width: 350px;">ID ( Susun & Transaksi )</td><td><?php echo $susun_id . "  |  " . $susun_master_id; ?></td></tr>
	   	<tr><td>ID &  Nama Karyawan</td><td><?php echo $susun_karyawan_id . " |  " . $karyawan_nama; ?></td></tr>
	    <tr><td>ID & Nama Produk</td><td><?php echo $produk_id ." | ". $produk_nama; ?></td></tr>
	    <tr><td>Shift</td><td><?php echo $susun_shift; ?></td></tr>
	    <tr><td>Jumlah Krat1</td><td><?php echo $susun_krat1; ?></td></tr>
	    <tr><td>Jumlah Krat2</td><td><?php echo $susun_krat2; ?></td></tr>
	    <tr><td>Jumlah Krat3</td><td><?php echo $susun_krat3; ?></td></tr>
	    <tr><td>Jumlah Krat4</td><td><?php echo $susun_krat4; ?></td></tr>
	    <tr><td>Jumlah Krat5</td><td><?php echo $susun_krat5; ?></td></tr>
	    <tr><td>Jumlah Krat6</td><td><?php echo $susun_krat6; ?></td></tr>
	    <tr><td>Jumlah Krat7</td><td><?php echo $susun_krat7; ?></td></tr>
	    <tr><td>Jumlah Krat8</td><td><?php echo $susun_krat8; ?></td></tr>
	    <tr><td>Jumlah Krat9</td><td><?php echo $susun_krat9; ?></td></tr>
	    <tr><td>Jumlah Krat10</td><td><?php echo $susun_krat10; ?></td></tr>
	    <tr><td>Jumlah Krat11</td><td><?php echo $susun_krat11; ?></td></tr>
	    <tr><td>Jumlah Krat12</td><td><?php echo $susun_krat12; ?></td></tr>
	    <tr><td>Jumlah Krat13</td><td><?php echo $susun_krat13; ?></td></tr>
	    <tr><td>Jumlah Krat14</td><td><?php echo $susun_krat14; ?></td></tr>
	    <tr><td>Jumlah Krat15</td><td><?php echo $susun_krat15; ?></td></tr>
	    <tr><td>Jumlah Krat15</td><td><?php echo $susun_krat15; ?></td></tr>
	     <tr><td>Jumlah Total Krat</td><td><?php echo $susun_totalkrat; ?></td></tr>
	    <tr><td>Jumlah Upah</td><td><?php echo $susun_upah; ?></td></tr>
	    <tr><td>Laporan</td><td><?php echo $susun_tgllaporan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('trx_susun') ?>" class="btn btn-danger pull-right">Cancel</a></td></tr>
	</table>
</div>
