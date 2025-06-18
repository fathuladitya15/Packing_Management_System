<?php if($priv_count>0){?>
<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">Navigation Form</h3>

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

  <form method="post" action='<?php echo base_url(); ?>navigation/save'>
    
    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label" >Title</label>
        <div class="col-sm-10 col-xs-12">
          <input type=hidden name='id_nav' value="<?php if(!empty($id_nav)) echo $id_nav; ?>" >
          <input type=text name='nav_title' class="form-control input-sm" value="<?php if(!empty($nav_title)) echo $nav_title; ?>" required>
        </div>
      </div>
    </div>

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label" >Url</label>
        <div class="col-sm-10 col-xs-12">
          <input type=text name='nav_url' class="form-control input-sm" value="<?php if(!empty($nav_url)) echo $nav_url; ?>" required>
        </div>
      </div>
    </div>

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label" >Parent Idx</label>
        <div class="col-sm-4 col-xs-12">
          <input type='number' name='parent_idx' class="form-control input-sm" value="<?php if(!empty($parent_idx)) echo $parent_idx; else echo "0"; ?>" required>
        </div>

        <label class="col-sm-2 col-xs-12 control-label" >Child Idx</label>
        <div class="col-sm-4 col-xs-12">
          <input type='number' name='child_idx' class="form-control input-sm" value="<?php if(!empty($child_idx)) echo $child_idx; else echo "0";?>" required>
        </div>
      </div>
    </div>

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-2 col-xs-12 control-label" >Fitur</label>
        <div class="col-sm-2 col-xs-12">
          <input type='checkbox' name='fit_add' value="Y" <?php if($fit_add=='Y') echo 'checked'; ?>>Add
        </div>
        <div class="col-sm-2 col-xs-12">
          <input type='checkbox' name='fit_update' value="Y" <?php if($fit_update=='Y') echo 'checked'; ?>>Update
        </div>
        <div class="col-sm-2 col-xs-12">
          <input type='checkbox' name='fit_delete' value="Y" <?php if($fit_delete=='Y') echo 'checked'; ?>>Delete
        </div>
        <div class="col-sm-2 col-xs-12">
          <input type='checkbox' name='fit_comment' value="Y" <?php if($fit_comment=='Y') echo 'checked'; ?>>Plus
        </div>
        <div class="col-sm-2 col-xs-12">
          <input type='checkbox' name='fit_report' value="Y" <?php if($fit_report=='Y') echo 'checked'; ?>>Report
        </div>
      </div>
    </div>
    
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
          <label class="col-sm-2 col-xs-12 control-label" >&nbsp;</label>
          <div class="col-sm-10 col-xs-12">
          <input type="checkbox" name="status" value="Active" <?php echo $chek; ?>> &nbsp; Active
          </div>
        </div>
      </div>
    </div>
    

    <div class='inline'>
      <div class='form-group'>
        <label class="col-sm-2 control-label" >&nbsp;</label>
        <div class="col-sm-10 col-xs-12"><p align="right">
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
