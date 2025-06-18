<script type="text/javascript" language="JavaScript">
    function konfirmasi1() 
    {
      tanya = confirm("Yakin Password akan direset ?");
      if (tanya == true) return true;
      else return false;
    }
  </script>
<?php if($priv_count>0){?>
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Search</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class='row'>
      <div class='col-xs-12'>
        <form method="POST" name="search" action="">
          <div class="input-group input-group-sm">
            
            <input type="text" class="form-control" name="cari" placeholder="Pencarian" required>
            
            <div class="input-group-btn">
              <button class="btn btn-info btn-flat glyphicon glyphicon-search"></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">List Of Users</h3>

    <div class="box-tools pull-right">
      <a href="<?php echo base_url() ."users"; ?>" type="button" class="btn btn-box-tool"><i class="fa fa-refresh fa-spin"></i></a>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
<div class="box-body">
  <div class='row'>
    <div class='col-xs-12'>
      <div class='box'>
        
        <!--div class='information msg'>Account administrator tidak bisa di hapus, tapi bisa di non aktifkan.</div--> 
        <div class='box-body'>
        <a class='btn btn-primary' href="<?php echo base_url(); ?>users/form"><span class="fa fa-plus-circle"></span>&nbsp; Add</a>
        <div style="overflow-x:auto;">
          <table id='dataadmin1' class='table table-bordered table-striped'>
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>Username</th>
                <th>User Fullname</th>
                <th>User Address</th>
                <th>User Email</th>
                <th>User Telp</th>
                <th>Group</th>
                <th>Reset Pass</th>
                <th>Status</th>
                <th width="80px" align="center">Aksi</th>
              </tr>

            </thead> 
            <?php
              $no=0;
              foreach ($data as $d) {
                $no++;
              ?>
              <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $d['username'];?></td>
                <td><?php echo $d['user_fullname'];?></td>
                <td><?php echo $d['user_address'];?></td>
                <td><?php echo $d['user_email'];?></td>
                <td><?php echo $d['user_telp'];?></td>
                <td><span class="btn btn-success btn-xs"><?php echo $d['group_name'];?></span></td>
                <td><a onclick='return konfirmasi1()' href="<?php echo base_url() ."users/reset_password/" .$d['username'];?>"><span class="btn btn-danger btn-xs">Reset</span></a></td>
                <td><span class="btn btn-primary btn-xs"><?php echo $d['user_status'];?></span></td>
                <td>
                <?php 
                if(!empty($update)){
                  if($update=='Y'){
                ?>
                  <a href="<?php echo base_url() ."users/form/" .$d['username'];?>">
                    <span class="btn btn-primary btn-xs glyphicon glyphicon-edit"></span>
                  </a>|
                <?php
                  }
                }
                
                if(!empty($delete)){
                  if($delete=='Y'){
                ?>  
                  <a onclick='return konfirmasi()' href="<?php echo base_url() ."users/remove/" .$d['username'];?>">
                    <span class="btn btn-danger btn-xs glyphicon glyphicon-remove-circle"></span>
                  </a>
                </td>
                <?php
                  }
                }
                ?>
              </tr>
              <?php
              }
              ?>   
              <tr>
                <td colspan="9" style="text-align: right;">Record Count : <?php echo $jumlahpost; ?></td>
                
              </tr>  
              <tr>
                <td colspan="9" style="text-align: center;"><?php echo $this->pagination->create_links() ;?></td>
              </tr>           
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php }else{
  $this->load->view('access_denied');
} ?>
