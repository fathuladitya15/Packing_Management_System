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
        <form action="<?php echo site_url('trx_stfg/index'); ?>" method="get" name="search" action="">
          <div class="input-group input-group-sm">
            <div class="col-sm-9 col-xs-12"><input type="text" class="form-control" name="q" value="<?php echo $q; ?>" placeholder="Pencarian (ID Produk / Nama Produk )"></div>
            <div class="col-sm-2 col-xs-12"><input type="text" class="form-control" id="datepicker" name="t" value="<?php echo $t; ?>" placeholder="Tanggal" required></div>
            <div class="col-sm-1 col-xs-12"><input type="text" class="form-control" name="s" value="<?php echo $s; ?>" placeholder="Shift" required></div>               
            <div class="input-group-btn">
            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('trx_stfg'); ?>" class="btn btn-default">x</a>
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
    <h3 class="box-title">DAFTAR STFG</h3>

    <div class="box-tools pull-right">
      <a href="<?php echo base_url() ."trx_stfg"; ?>" type="button" class="btn btn-box-tool"><i class="fa fa-refresh fa-spin"></i></a>
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>


  <div class='box-body'>
        <?php                 
            if(!empty($add)){
                  if($add=='Y'){ ?>
        <a class='btn btn-success' href="<?php echo base_url(); ?>trx_stfg/create"><span class="fa fa-plus-circle">Tambah</span></a>
        <?php } } ?>

        <?php                 
          if(!empty($plus)){
            if($plus=='Y'){ ?>
                <a class='btn btn-warning' href="<?php echo base_url(); ?>trx_stfg/plus"><span class="fa fa-plus-circle">Manual</span></a>
            <?php } } ?>

            <?php if($report=='Y') { ?>
            <div class="pull-right">
              <form method="POST" action="<?php echo base_url() ."trx_stfg/download"; ?>">
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
      				<th>Nama Produk</th>              
      				<th>Shift</th>
      				<th>Box1</th>
      				<th>Box2</th>
      				<th>Box3</th>
      				<th>Box4</th>
      				<th>Box5</th>
      				<th>Rijek</th>
              <th>Masterbox</th>
      				<th>Total</th>
      				<th>Laporan</th>
      				<th>Action</th>
            </tr><?php
            foreach ($trx_stfg_data as $trx_stfg)
            {
                ?>
                <tr>
                <td width="20px"><input type="checkbox"></td>
    			    <td width="40px"><?php echo ++$start ?></td>
        			<td><?php echo $trx_stfg->stfg_produk_id ?></td>
        			<td><?php echo $trx_stfg->produk_nama ?></td>              
        			<td><?php echo $trx_stfg->stfg_shift ?></td>
        			<td><?php echo $trx_stfg->stfg_mbox1 ?></td>
        			<td><?php echo $trx_stfg->stfg_mbox2 ?></td>
        			<td><?php echo $trx_stfg->stfg_mbox3 ?></td>
        			<td><?php echo $trx_stfg->stfg_mbox4 ?></td>
        			<td><?php echo $trx_stfg->stfg_mbox5 ?></td>
        			<td><?php echo $trx_stfg->stfg_rijek ?></td>
              <td><?php echo $trx_stfg->produk_masterbox ?></td>
        			<td><?php echo $trx_stfg->stfg_total ?></td>
        			<td><?php echo $trx_stfg->stfg_tgllaporan ?></td>
			
			        <td style="text-align: center; width: 100px;">
                  
                <a href="<?php echo base_url() ."trx_stfg/read/" .$trx_stfg->stfg_id;?>">
                    <span class="btn btn-info btn-xs glyphicon glyphicon-search" title="Read"></span>
                </a>
    
                  
                <?php                 
                if(!empty($update)){
                  if($update=='Y'){
                ?>  <a href="<?php echo base_url() ."trx_stfg/update/" .$trx_stfg->stfg_id;?>">
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
                  <a onclick='return konfirmasi()' href="<?php echo base_url() ."trx_stfg/delete/" .$trx_stfg->stfg_id;?>">
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
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
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
<?php }else{
  $this->load->view('access_denied');
} ?>
