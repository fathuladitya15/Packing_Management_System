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
        <form action="<?php echo site_url('stx_acuan/index'); ?>" method="get" name="search" action="">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Pencarian" required>
            
            <div class="input-group-btn">
            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('stx_acuan'); ?>" class="btn btn-default">x</a>
                                    <?php
                                }
                            ?>
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
    <h3 class="box-title">Daftar Acuan</h3>

    <div class="box-tools pull-right">
      <a href="<?php echo base_url() ."stx_acuan"; ?>" type="button" class="btn btn-box-tool"><i class="fa fa-refresh fa-spin"></i></a>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>


<div class="box-body">
  <div class='row'>
    <div class='col-xs-12'>
      <div class='box'>
        
        <!--div class='information msg'>Account administrator tidak bisa di hapus, tapi bisa di non aktifkan.</div--> 
        <div class='box-body'>
        <a class='btn btn-primary' href="<?php echo base_url(); ?>stx_acuan/create"><span class="fa fa-plus-circle">Tambah</span></a>
        <div style="overflow-x:auto;">
          <table id='dataadmin1' class='table table-bordered table-striped'>
            <thead >
              <tr>
                <th>No</th>
                <th>Nama Acuan</th>
                <th width="100px" style="text-align: center;" >Status</th>
                 <th width="150px" style="text-align: center;">Action</th>
            </tr>
            </thead> 
            
            <?php
            foreach ($stx_acuan_data as $stx_acuan)
            {
                ?>
            <tr>
            <td width="50px"><?php echo ++$start ?></td>
            <td><?php echo $stx_acuan->acuan_nama ?></td>
            <td style="text-align: center;">
                <?php 
                $data = $stx_acuan->acuan_status;
                if($data=='Aktif'){
                ?>
                <span class="btn btn-default btn-xs"><?php echo $stx_acuan->acuan_status; ?></span>
                <?php
                }else{
                ?>
                <span class="btn btn-danger btn-xs"><?php echo $stx_acuan->acuan_status; ?></span>
                <?php
                }
                ?>
            </td>

            <td style="text-align: center;">
                  <a href="<?php echo base_url() ."stx_acuan/read/" .$stx_acuan->acuan_id;?>">
                    <span class="btn btn-info btn-xs glyphicon glyphicon-search"></span>
                  </a>|
                  <a href="<?php echo base_url() ."stx_acuan/update/" .$stx_acuan->acuan_id;?>">
                    <span class="btn btn-primary btn-xs glyphicon glyphicon-edit"></span>
                  </a>|
                  <a onclick='return konfirmasi()' href="<?php echo base_url() ."stx_acuan/delete/" .$stx_acuan->acuan_id;?>">
                    <span class="btn btn-danger btn-xs glyphicon glyphicon-remove-circle"></span>
                  </a>
                </td>
            </tr>
                <?php
            }
            ?>        
                      
          </table>

            <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total : <?php echo $total_rows ?></a>
        </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

        </div>
      </div>
    </div>
  </div>
</div>
</div>
