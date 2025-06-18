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
        <form action="<?php echo site_url('trx_karyawan/index'); ?>" method="get" name="search" action="">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Pencarian" required>
            
            <div class="input-group-btn">
            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('trx_karyawan'); ?>" class="btn btn-default">x</a>
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
    <h3 class="box-title">DAFTAR KARYAWAN</h3>

    <div class="box-tools pull-right">
      <a href="<?php echo base_url() ."trx_karyawan"; ?>" type="button" class="btn btn-box-tool"><i class="fa fa-refresh fa-spin"></i></a>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>


<div class='box-body'>
        <?php                 
            if(!empty($add)){
                  if($add=='Y'){ ?>
        <a class='btn btn-success' href="<?php echo base_url(); ?>trx_karyawan/create"><span class="fa fa-plus-circle">Tambah</span></a>
        <a class='btn btn-warning' href="#" data-toggle="modal" data-target="#upload"><span class="fa fa-upload" ></span>&nbsp; Upload</a>
        <a class='btn btn-info' href="<?php echo base_url(); ?>upload/format_data_karyawan.xls"><span class="fa fa-plus-circle">Template</span></a>

        <?php } } ?>

        <?php                 
          if(!empty($plus)){
            if($plus=='Y'){ ?>
                <a class='btn btn-warning' href="<?php echo base_url(); ?>trx_karyawan/plus"><span class="fa fa-plus-circle">Manual</span></a>
            <?php } } ?>

            <?php if($report=='Y') { ?>
            <div class="pull-right">
              <form method="POST" action="<?php echo base_url() ."trx_karyawan/download"; ?>">
                <div class="input-group input-group-sm" >
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <!--input type="text" class="form-control" name="tgl_daftar"  id="datepicker" placeholder="Tanggal Daftar" required-->
                  <input type="text" name="tgl_daftar" class="form-control" placeholder="Input Date" required>
                  <div class="input-group-btn">
                  <button type="button" class="btn btn-info btn-flat fa fa-file-excel-o  dropdown-toggle" data-toggle="dropdown">
                    <span class="fa fa-caret-down"></span></button>
                    <ul class="dropdown-menu">
                      <li><button class="btn btn-flat">Download Report <span class="fa fa-download"></span></button></li>
                      
                    </ul>
                    <!--button class="btn btn-info btn-flat fa fa-file-excel-o "></button-->
                  </div>
                </div>
                  
              </form>
            </div>
            <?php } ?>
          <!--/div-->
          <br>&nbsp;
        <div style="overflow-x:auto;">
          <table id='dataadmin1' class='table table-bordered table-striped'>
            <thead >
              <tr>
              <th><input type="checkbox"></th>
                <th>No</th>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Group</th>
                <th>Packing</th>
                <th>Jabatan</th> 
                <th>Status</th>
                <th>Group User</th>                
                <th width="100px" style="text-align: center;" >Aktif</th>
                <th width="150px" style="text-align: center;">Action</th>
            </tr>
            </thead> 
            
            <?php
            foreach ($trx_karyawan_data as $trx_karyawan)
            {
                ?>
            <tr>
            <td width="20px"><input type="checkbox"></td>
            <td width="40px"><?php echo ++$start ?></td>
            <td><?php echo $trx_karyawan->karyawan_id ?></td>
            <td><?php echo $trx_karyawan->karyawan_nama ?></td>           
            <td><?php echo $trx_karyawan->karyawan_norek ?></td>
            <td><?php echo $trx_karyawan->karyawan_norek_an ?></td>            
            <td><?php echo $trx_karyawan->jabatan_nama ?></td>
            <td><?php echo $trx_karyawan->karyawan_status ?></td>
            <td><?php echo $trx_karyawan->karyawan_usersupervisor ?></td>
            <td style="text-align: center;">
                <?php 
                $data = $trx_karyawan->karyawan_aktif;
                if($data=='Aktif'){
                ?>
                <span class="btn btn-primary btn-xs"><?php echo $trx_karyawan->karyawan_aktif; ?></span>
                <?php
                }else{
                ?>
                		<span class="btn btn-danger btn-xs"><?php echo $trx_karyawan->karyawan_aktif; ?></span>
                <?php
                }
                ?>
            </td>

            <td style="text-align: center; width: 100px;">
                  
                <a href="<?php echo base_url() ."trx_karyawan/read/" .$trx_karyawan->karyawan_id;?>">
                    <span class="btn btn-info btn-xs glyphicon glyphicon-search" title="Read"></span>
                </a>
    
                  
                <?php                 
                if(!empty($update)){
                  if($update=='Y'){
                ?>  <a href="<?php echo base_url() ."trx_karyawan/update/" .$trx_karyawan->karyawan_id;?>">
                    <span class="btn btn-primary btn-xs glyphicon glyphicon-edit" title="Update"></span>
                  </a>
                <?php
                  }
                }
                ?>

                <?php                 
                if(!empty($delete)){
                  if($delete=='Y'){
                ?>
                  <a onclick='return konfirmasi()' href="<?php echo base_url() ."trx_karyawan/delete/" .$trx_karyawan->karyawan_id;?>">
                    <span class="btn btn-danger btn-xs glyphicon glyphicon-remove-circle" title="Delete"></span>
                  </a>
                <?php
                  }
                }
                ?>


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

        <div class="modal fade" id="upload" role="dialog">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Data Karyawan</h4>
              </div>
              <div class="modal-body">
              
                <div class="row">
                  <form method="post" action="<?php echo base_url() ."trx_karyawan/upload_karyawan"; ?>" enctype="multipart/form-data">
                    <div class="col-md-12">

                    <div class="form-group">
                     <label>Jabatan</label>
              <select class="form-control select2" name="karyawan_jabatan_id" style="width: 100%;">
        
                <?php 
                foreach($jabatan as $g){?>
                
                <option value="<?php echo $g['jabatan_id']; ?>"><?php echo $g['jabatan_nama']; ?></option>
                <?php } 
                ?>
              </select> 
                      </div>

                      <div class="form-group">
                        <label>File Exel</label>
                        <input type="file" name="file" required>
                      </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <input type="submit" name="upload" class="btn btn-primary fa fa-upload" value="Upload" >
                        
                      </div>
                    </div>
                  </form>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

    </div>
  </div>
</div>
</div>
