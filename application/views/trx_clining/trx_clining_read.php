<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">DETAIL CLINING</h3>  

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">
      <tr><td style="width: 350px;">ID ( Clining & Transaksi )</td><td><?php echo $clining_id . "  |  " . $clining_master_id; ?></td></tr>
      <tr><td>ID &  Nama Karyawan</td><td><?php echo $clining_karyawan_id . " |  " . $karyawan_nama; ?></td></tr>
	    <tr><td>Shift</td><td><?php echo $clining_shift; ?></td></tr>
	    <tr><td>No Line</td><td><?php echo $clining_line; ?></td></tr>
	    <tr><td>Pekerjaan</td><td><?php echo $clining_pekerjaan; ?></td></tr>
	    <tr><td>Posisi</td><td><?php echo $clining_posisi; ?></td></tr>
	    <tr><td>laporan</td><td><?php echo $clining_tgllaporan; ?></td></tr>
	    <tr><td></td><td align="right"><a href="<?php echo site_url('trx_clining') ?>" class="btn btn-danger">Cancel</a></td></tr>
        </table>
    </div>
</div>
