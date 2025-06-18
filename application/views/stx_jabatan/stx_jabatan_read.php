<div class="box box-default">
  <div class="box-header with-border"> 
    <h3 class="box-title">JABATAN DETAIL</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
    <table class="table">
	    <tr><td>Nama Jabatan</td><td><?php echo $jabatan_nama; ?></td></tr>	    
	    <tr><td>Deskripsi</td><td><?php echo $jabatan_info1; ?></td></tr>
	    <tr><td>Info</td><td><?php echo $jabatan_info2; ?></td></tr>
      <tr><td>Status</td><td><?php echo $jabatan_status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('stx_jabatan') ?>" class="btn btn-danger pull-right">Cancel</a></td></tr>
	</table>
</div></div>>
