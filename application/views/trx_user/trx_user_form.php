
<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">USERS FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>

<div class="box-body">
        <form action="<?php echo $action; ?>" method="post">


	    <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" for="varchar">User Fullname <?php echo form_error('user_fullname') ?></label>
                 <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="user_fullname" id="user_fullname" placeholder="User Fullname" value="<?php echo $user_fullname; ?>" />
        </div></div>

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" >User Group</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="id_group">
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
            <label class="col-sm-2 col-xs-12 control-label" >Group User</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="user_supervisor">
                <?php foreach($supervisor as $u){
                  if(!empty($user_supervisor)){
                    if($user_supervisor==$u['username']) $ass="selected"; else $ass="";;
                  }else{
                    $ass="";
                  }
                ?>
                <option value="<?php echo $u['username'];?>" <?php echo $ass;?>><?php echo $u['username'] . " | " . $u['group_name'] ;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div> 

	    <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" for="varchar">User Email <?php echo form_error('user_email') ?></label>
                 <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="user_email" id="user_email" placeholder="User Email" value="<?php echo $user_email; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" for="char">User Telp <?php echo form_error('user_telp') ?></label>
                 <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="user_telp" id="user_telp" placeholder="User Telp" value="<?php echo $user_telp; ?>" />
        </div></div>
	    <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" for="varchar">User Address <?php echo form_error('user_address') ?></label>
                 <div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="user_address" id="user_address" placeholder="User Address" value="<?php echo $user_address; ?>" />
        </div></div>
        <?php if(empty($user3)){ ?>
        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" >Username</label>
            <div class="col-sm-9 col-xs-12">
              <input type=text name='username' class="form-control input-sm" id="username" value="<?php echo $username; ?>">
            </div>
          </div>
        </div>
        <?php } ?>
        
        

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-2 col-xs-12 control-label" >User Password</label>
            <div class="col-sm-9 col-xs-12">
              <?php if(empty($user3)){ ?>

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
        <label class="col-sm-2 col-xs-12 control-label">&nbsp;</label>
        <div class="col-sm-9 col-xs-12">
        <?php if(!empty($user_status)){
          if($user_status=='Active') $status="checked"; else $status="";
        ?>
        <?php
        }else{
          $status="";
        }
        ?>
        <input type=checkbox name='user_status' value="Active" <?php echo $status; ?> >Active
        </div>
      </div>
    </div>
        <br>
        <hr>
        <div class="pull-right">  
        <input type="hidden" name="username1" value="<?php echo $username2; ?>" />    
	    <a href="<?php echo site_url('trx_user') ?>" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        </div>
	</form>
</div>
