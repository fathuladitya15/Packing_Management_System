<?php if($priv_count>0){?> 
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">User Form</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
<div class="box-body">
  
  <form method="post" action='<?php echo base_url(); ?>users/save'>
    

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >User Fullname</label>
        <div class="col-sm-9 col-xs-12">
          <input type=text name='user_fullname' class="form-control input-sm" value="<?php if(!empty($user_fullname)) echo $user_fullname; ?>" required>
        </div>
      </div>
    </div>

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >User Group</label>
        <div class="col-sm-9 col-xs-12">
          <select class="form-control input-sm select2" name="id_group">
            <option>Group</option>
            <?php 
            
            foreach($group as $g){?>
            <option value="<?php echo $g['id_group']; ?>" <?php if($id_group==$g['id_group']) echo "Selected" ?>><?php echo $g['group_name']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>


    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >Supervisor Group</label>
        <div class="col-sm-9 col-xs-12">
          <select class="form-control input-sm select2" name="user_supervisor">
            <option>Supervisor Group</option>
            <?php 
            
            foreach($supervisor as $y){?>
            <option value="<?php echo $y['username']; ?>" <?php if($supervisor==$y['username']) echo "Selected" ?>><?php echo $y['user_fullname'] . " | " . $y['username'] ; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >User Email</label>
        <div class="col-sm-9 col-xs-12">
          <input type=text name='user_email' class="form-control input-sm" value="<?php if(!empty($user_email)) echo $user_email; ?>" required>
        </div>
      </div>
    </div>

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >User Telp</label>
        <div class="col-sm-9 col-xs-12">
          <input type=text name='user_telp' class="form-control input-sm" value="<?php if(!empty($user_telp)) echo $user_telp; ?>" required>
        </div>
      </div>
    </div>
    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >User Address</label>
        <div class="col-sm-9 col-xs-12">
        <textarea name="user_address" class="form-control input-sm"><?php if(!empty($user_address)) echo $user_address; ?></textarea>
        </div>
      </div>
    </div>

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >Username</label>
        <div class="col-sm-9 col-xs-12">

          <input type=hidden name='username1' value="<?php if(!empty($username)) echo $username; ?>" >
          <input type=text name='username' class="form-control input-sm" value="<?php if(!empty($username)) echo $username; ?>" required <?php if(!empty($username)) echo "disabled";?>>
        </div>
      </div>
    </div>

    <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label" >User Password</label>
        <div class="col-sm-9 col-xs-12">
          <?php if(empty($username1)){ ?>

          <input type=password name='user_password' class="form-control input-sm" value="<?php if(!empty($user_password)) echo $user_password; ?>" required>
          <?php }else{?>
          <input type=hidden name='user_password' class="form-control input-sm" value="<?php if(!empty($user_password)) echo $user_password; ?>" required>
          <input type=password name='user_password_view' class="form-control input-sm" value="<?php if(!empty($user_password)) echo $user_password; ?>" disabled>
          <?php }?>
          <input type=hidden name='user_photo' class="form-control input-sm" value="<?php if(!empty($user_photo)) echo $user_photo; ?>" >
        </div>
      </div>
    </div>

   <div class='inline'>
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 control-label">&nbsp;</label>
        <div class="col-sm-9 col-xs-12">
        <?php if(!empty($user_status)){
          if($user_status=='Active') $status="checked"; else $status="";
        ?>
        <?php
        }else{
          $status="";
        }
        ?>
        <input type=checkbox name='user_status' value="Active" <?php echo $status; ?> >Aktive
        </div>
      </div>
    </div>
    

    <div class='form-group'>
     <hr>
      <label class="col-sm-3 control-label" ></label>

      <div class="col-sm-9"><p align="right">        
        <input class='btn btn-danger input-sm' type=button value=Cancel onclick=self.history.back()>
        <input class='btn btn-primary input-sm' type=submit value=Save>
        </p>
      </div>
    </div>
  </form>
</div>
<?php }else{
  $this->load->view('access_denied');
} ?>
