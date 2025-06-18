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
        <form action="<?php echo site_url('stx_produk/index'); ?>" method="get" name="search" action="">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Pencarian" required>
            
            <div class="input-group-btn">
            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('stx_produk'); ?>" class="btn btn-default">x</a>
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
    <h3 class="box-title">DAFTAR PRODUK</h3>

    <div class="box-tools pull-right">
      <a href="<?php echo base_url() ."stx_produk"; ?>" type="button" class="btn btn-box-tool"><i class="fa fa-refresh fa-spin"></i></a>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>


  <div class='box-body'>
        <?php                 
            if(!empty($add)){
                  if($add=='Y'){ ?>
        <a class='btn btn-success' href="<?php echo base_url(); ?>stx_produk/create"><span class="fa fa-plus-circle">Tambah</span></a>
        <?php } } ?>

        <?php                 
          if(!empty($plus)){
            if($plus=='Y'){ ?>
                <a class='btn btn-warning' href="<?php echo base_url(); ?>stx_produk/plus"><span class="fa fa-plus-circle">Manual</span></a>
            <?php } } ?>

            <?php if($report=='Y') { ?>
            <div class="pull-right">
              <form method="POST" action="<?php echo base_url() ."stx_produk/download"; ?>">
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
                <th>SKu</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Masterbox</th>
                <th>Mesin</th>
                <th>Susun</th>
                <th>Manual</th>
                <th>Wip</th>
                <th>PP</th>
                <th>Final</th>
                <th >Status</th>
                 <th width="100px" style="text-align: center;">Action</th>
            </tr>

            </thead> 
            
            <?php
            foreach ($stx_produk_data as $stx_produk)
            {
                ?>
            <tr>
              <td width="20px"><input type="checkbox"></td>
                <td width="40px"><?php echo ++$start ?></td>
                <td><?php echo $stx_produk->produk_id ?></td>
                <td><?php echo $stx_produk->produk_nama ?></td>
                <td><?php echo $stx_produk->produk_tipe ?></td>
                <td><?php echo $stx_produk->produk_masterbox ?></td>
                <td><?php echo $stx_produk->produk_mesin ?></td>
                <td><?php echo $stx_produk->produk_susun ?></td>
                <td><?php echo $stx_produk->produk_manual ?></td>
                <td><?php echo $stx_produk->produk_wip ?></td>
                <td><?php echo $stx_produk->produk_pp ?></td>
                <td><?php echo $stx_produk->produk_step_final ?></td>
            <td style="text-align: center;">
                <?php 
                $data = $stx_produk->produk_status;
                if($data =='Aktif'){
                ?>
                <span class="btn btn-default btn-xs"><?php echo $stx_produk->produk_status; ?></span>
                <?php
                }else{
                ?>
                <span class="btn btn-danger btn-xs"><?php echo $stx_produk->produk_status; ?></span>
                <?php
                }
                ?>
            </td>

      <td style="text-align: center; width: 100px;">
                  
                <a href="<?php echo base_url() ."stx_produk/read/" .$stx_produk->produk_id;?>">
                    <span class="btn btn-info btn-xs glyphicon glyphicon-search" title="Read"></span>
                </a>
    
                  
                <?php                 
                if(!empty($update)){
                  if($update=='Y'){
                ?>  <a href="<?php echo base_url() ."stx_produk/update/" .$stx_produk->produk_id;?>">
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
                  <a onclick='return konfirmasi()' href="<?php echo base_url() ."stx_produk/delete/" .$stx_produk->produk_id;?>">
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
    </div>
  </div>
</div>
</div>
