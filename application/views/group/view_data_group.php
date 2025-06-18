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
    <h3 class="box-title">List Of Group</h3>

    <div class="box-tools pull-right">
      <a href="<?php echo base_url() ."group"; ?>" type="button" class="btn btn-box-tool"><i class="fa fa-refresh fa-spin"></i></a>
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
        <a class='btn btn-primary' href="<?php echo base_url(); ?>group/form"><span class="fa fa-plus-circle"></span>&nbsp; Add Group</a>
        <div style="overflow-x:auto;">
          <table id='dataadmin1' class='table table-bordered table-striped'>
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>Group Name</th>
                <th width="100px">Status</th>
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
                <td><?php echo $d['group_name'];?></td>
                <td>
                <?php 
                if($d['status']=='Active'){
                ?>
                <span class="btn btn-primary btn-xs"><?php echo $d['status']; ?></span>
                <?php
                }else{
                ?>
                <span class="btn btn-danger btn-xs"><?php echo $d['status']; ?></span>
                <?php
                }
                ?>
                </td>
                <td>
                  <a href="<?php echo base_url() ."group/form/" .$d['id_group'];?>">
                    <span class="btn btn-primary btn-xs glyphicon glyphicon-edit"></span>
                  </a>|
                  <a onclick='return konfirmasi()' href="<?php echo base_url() ."group/remove/" .$d['id_group'];?>">
                    <span class="btn btn-danger btn-xs glyphicon glyphicon-remove-circle"></span>
                  </a>
                </td>
                
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