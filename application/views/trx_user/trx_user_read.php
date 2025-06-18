<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">USERS DETAIL</h3> 

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <table class="table">
	    <tr><td>Id Group</td><td><?php echo $id_group; ?></td></tr>
	    <tr><td>User Fullname</td><td><?php echo $user_fullname; ?></td></tr>
	    <tr><td>User Email</td><td><?php echo $user_email; ?></td></tr>
	    <tr><td>User Telp</td><td><?php echo $user_telp; ?></td></tr>
	    <tr><td>User Address</td><td><?php echo $user_address; ?></td></tr>
	    <tr><td>User Status</td><td><?php echo $user_status; ?></td></tr>
	    <tr><td>User Photo</td><td><?php echo $user_photo; ?></td></tr>
	    <tr><td>Info1</td><td><?php echo $info1; ?></td></tr>
	    <tr><td>Info2</td><td><?php echo $info2; ?></td></tr>
	    <tr><td>Info3</td><td><?php echo $info3; ?></td></tr>
	    <tr><td>Info4</td><td><?php echo $info4; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('trx_user') ?>" class="btn btn-danger pull-right">Cancel</a></td></tr>
	</table>
</div>
