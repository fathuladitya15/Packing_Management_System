<?php if($priv_count>0){?>
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Group Privilage Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
<div class="box-body">
  <?php 
    $error=$this->session->flashdata('message');
    if (!empty($error)) {
      foreach ($error as $key => $value) {
  ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-ban"></i> Alert!</h4>
      <?php echo $error[$key]; ?>
    </div>
  <?php
        echo ""; 
      }   
    }
  ?>

  <form method="post" action='<?php echo base_url(); ?>group/save'>
    <div class="row">
    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label" >Group Name</label>
        <div class="col-sm-10 col-xs-12">
        <input type="hidden" name="id_group" value="<?php if(!empty($id_group)) echo $id_group; ?>">
        <input type="text" name="group_name" class="form-control input-sm" value="<?php if(!empty($group_name)) echo $group_name; ?>">
        
        </div>
      </div>
    </div>
    <hr>
    </div>
    <div class="row">
    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label" >Hak Akses</label>
        <div class="col-sm-10 col-xs-12">
          <?php echo $hak_akses; ?>
        </div>
          
      </div>
    </div>
    </div>
    <hr>
    <div class="row">
      <div class='inline'>
        <?php 
        if(!empty($status)) {
          if($status=='Active') $chek="checked"; else $chek=""; 
        }else{
          $chek="";
        }
        ?>
        <div class="form-group">
        <div class="col-sm-12 col-xs-12">
          <label class="col-sm-2 col-xs-12 control-label" >&nbsp;</label>
          <div class="col-sm-10 col-xs-12">
          <input type="checkbox" name="status" value="Active" <?php echo $chek; ?>> &nbsp; Active
          </div>
        </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class='inline'>
        <?php 
        if(!empty($admin)) {
          if($admin=='Y') $chek_a="checked"; else $chek_a=""; 
        }else{
          $chek_a="";
        }
        ?>
        <div class="form-group">
        <div class="col-sm-12 col-xs-12">
          <label class="col-sm-2 col-xs-12 control-label" >&nbsp;</label>
          <div class="col-sm-9 col-xs-12">
          <input type="checkbox" name="admin" value="Y" <?php echo $chek_a; ?>> &nbsp; Set As Administrator
          </div>
        </div>
        </div>
      </div>

    </div>
    <hr>
    <div class='inline'>
      <div class='form-group'>
        <label class="col-sm-3 control-label" >&nbsp;</label>
        <div class="col-sm-9 col-xs-12"><p align="right">
          <input class='btn btn-primary input-sm' type=submit value=Save>
          <input class='btn btn-danger input-sm' type=button value=Cancel onclick=self.history.back()></p>
        </div>
      </div>
    </div>
  </form>
</div>
<?php }else{
  $this->load->view('access_denied');
} ?>