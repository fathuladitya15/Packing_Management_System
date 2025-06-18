 
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
        <form action="<?php echo site_url('trx_line/index'); ?>" method="get" name="search" action="">
          <div class="input-group input-group-sm">
            <div class="col-sm-9 col-xs-12"><input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Pencarian (ID Produk / Nama Produk / ID Karyawan / Nama Karyawan )"></div>
            <div class="col-sm-2 col-xs-12"><input type="text" class="form-control" id="datepicker" name="t" value="<?php echo $t; ?>" placeholder="Tanggal" required></div>
            <div class="col-sm-1 col-xs-12"><input type="text" class="form-control" name="s" value="<?php echo $s; ?>" placeholder="Shift" required></div>
             
            <div class="input-group-btn">
            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('trx_line'); ?>" class="btn btn-default">x</a>
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
    <h3 class="box-title">DAFTAR LINE</h3>

    <div class="box-tools pull-right">
      <a href="<?php echo base_url() ."trx_line"; ?>" type="button" class="btn btn-box-tool"><i class="fa fa-refresh fa-spin"></i></a>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>


        <!--div class='information msg'>Account administrator tidak bisa di hapus, tapi bisa di non aktifkan.</div--> 
        <div class='box-body'>
        <?php                 
            if(!empty($add)){
                  if($add=='Y'){ ?>
        <a class='btn btn-success' href="<?php echo base_url(); ?>trx_line/create"><span class="fa fa-plus-circle">Tambah</span></a>
        <?php } } ?>

        <?php                 
          if(!empty($plus)){
            if($plus=='Y'){ ?>
                <a class='btn btn-warning' href="<?php echo base_url(); ?>trx_line/plus"><span class="fa fa-plus-circle">Manual</span></a>
            <?php } } ?>

            <?php if($report=='Y') { ?>
            <div class="pull-right">
              <form method="POST" action="<?php echo base_url() ."trx_line/download"; ?>">
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
            <tr>
            <th><input type="checkbox"></th>
            <th>No</th>
        		<th>ID</th>
        		<th>Nama Karyawan</th>
            <th>Nama Produk</th>
            <th>Shift</th> 
        		<th>Line</th>
        		<th>Box</th>
        		<th>Mulai</th>
        		<th>Selesai</th>
            <th>Rehat</th>
            <th>Upah</th>
        		<th>Tanggal</th>
        		<th>Action</th>
            </tr><?php
            foreach ($trx_line_data as $trx_line)
            {
                ?>
                <tr>
                <td width="20px"><input type="checkbox"></td>
      			<td width="40px"><?php echo ++$start ?></td>
      			<td><?php echo $trx_line->line_karyawan_id ?></td>
            <td><?php echo $trx_line->karyawan_nama ?></td>
            <td><?php echo $trx_line->produk_id . " | " . $trx_line->produk_nama ?></td>
            <td><?php echo $trx_line->line_shift ?></td> 
            <td><?php echo $trx_line->line_nomor ?></td>      			           
      			<td><?php echo $trx_line->line_box ?></td>
      			<td><?php echo substr($trx_line->line_mulai,0,5); ?></td>
      			<td><?php echo substr($trx_line->line_selesai,0,5); ?></td>
            <td><?php echo substr($trx_line->line_istirahat,0,5); ?></td>
      			<td><?php echo $trx_line->line_upah ?></td>
      			<td><?php echo $trx_line->line_tgllaporan ?></td>
			<td style="text-align: center; width: 100px;">
                  
                <a href="<?php echo base_url() ."trx_line/read/" .$trx_line->line_id;?>">
                    <span class="btn btn-info btn-xs glyphicon glyphicon-search" title="Read"></span>
                </a>
    
                  
                <?php                 
                if(!empty($update)){
                  if($update=='Y'){
                ?>  <a href="<?php echo base_url() ."trx_line/update/" .$trx_line->line_id;?>">
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
                  <a onclick='return konfirmasi()' href="<?php echo base_url() ."trx_line/delete/" .$trx_line->line_id;?>">
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


