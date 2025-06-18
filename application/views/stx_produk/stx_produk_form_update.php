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

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">PRODUK FORM</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>



<div class="box-body">

        <form action="<?php echo $action; ?>" method="post">
	    
      <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Kode Produk <?php echo form_error('produk_id') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_id" id="produk_id" placeholder="Kode Produk" value="<?php echo $produk_id; ?>" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Nama Produk <?php echo form_error('produk_nama') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_nama" id="produk_nama" placeholder="Nama Produk" value="<?php echo $produk_nama; ?>" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="varchar">Tipe <?php echo form_error('produk_tipe') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_tipe" id="produk_tipe" placeholder="Tipe" value="<?php if(!empty($produk_tipe)) echo $produk_tipe; else echo '0'; ?>" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="double">Masterbox <?php echo form_error('produk_masterbox') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_masterbox" id="produk_masterbox" placeholder="Masterbox" value="<?php if(!empty($produk_masterbox)) echo $produk_masterbox; else echo '0'; ?>" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int"> Harga Mesin <?php echo form_error('produk_mesin') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_mesin" id="produk_mesin" placeholder="Harga Mesin" value="<?php if(!empty($produk_mesin)) echo $produk_mesin; else echo '0'; ?>" onkeypress="return Angka(event)" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Harga Mbox <?php echo form_error('produk_mbox') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_mbox" id="produk_mbox" placeholder="Harga Mbox" value="<?php if(!empty($produk_mbox)) echo $produk_mbox; else echo '0'; ?>" onkeypress="return Angka(event)" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Harga Susun <?php echo form_error('produk_susun') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_susun" id="produk_susun" placeholder="Harga Susun" value="<?php if(!empty($produk_susun)) echo $produk_susun; else echo '0'; ?>" onkeypress="return Angka(event)" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Harga Manual <?php echo form_error('produk_manual') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_manual" id="produk_manual" placeholder="Harga Manual" value="<?php if(!empty($produk_manual)) echo $produk_manual; else echo '0'; ?>" onkeypress="return Angka(event)" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Harga Wip <?php echo form_error('produk_wip') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_wip" id="produk_wip" placeholder="Produk Wip" value="<?php if(!empty($produk_wip)) echo $produk_wip; else echo '0'; ?>" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Harga PP <?php echo form_error('produk_pp') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_pp" id="produk_pp" placeholder="Harga PP" value="<?php if(!empty($produk_pp)) echo $produk_pp; else echo '0'; ?>" onkeypress="return Angka(event)" required=""/>
        </div></div>
	    <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" for="int">Harga Step Final <?php echo form_error('produk_step_final') ?></label><div class="col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="produk_step_final" id="produk_step_final" placeholder="Harga Step Final" value="<?php if(!empty($produk_step_final)) echo $produk_step_final; else echo '0'; ?>" onkeypress="return Angka(event)" required=""/>
        </div></div>

        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Kategori Acuan</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="produk_kategori_id">
                <?php 
                foreach($acuan as $g){?>
                
                <option value="<?php echo $g['acuan_id']; ?>" <?php if($produk_kategori_id==$g['acuan_id']) echo "Selected" ?>><?php echo $g['acuan_nama']; ?></option>
                <?php } 
                ?>
              </select>
            </div>
          </div>
        </div>
        <?php if ($id_group == '5'){ ?>

        <?php }else{ ?>
        <div class='inline'>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >Group User</label>
            <div class="col-sm-9 col-xs-12">
              <select class="form-control input-sm select2" name="produk_usersupervisor">
                <?php foreach($xsupervisor as $u){
                  if(!empty($produk_userinput)){
                    if($produk_userinput==$u['username']) $ass="selected"; else $ass="";;
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

        <?php } ?>
        <div class='inline'>
          <?php 
          if(!empty($produk_status)) {
            if($produk_status=='Aktif') $chek="checked"; else $chek=""; 
          }else{
            $chek="";
          }
          ?>
          <div class="form-group">
            <label class="col-sm-3 col-xs-12 control-label" >&nbsp;</label>
            <div class="col-sm-9 col-xs-12">
            <input type="checkbox" name="produk_status" value="Aktif" <?php echo $chek; ?>> &nbsp; Active
            </div>
          </div>
        </div>



        <br>
<hr>
<div class="pull-right">
      <a href="<?php echo site_url('stx_produk') ?>" class="btn btn-danger">Cancel</a>
	    <button type="submit" class="btn btn-primary">Save</button> 
	    
      </div>
	</form>
    </div>
  
  <script>
    function Angka(evt) {
      var charCode = (evt.which) ? evt.which : event.keyCode
       if (charCode > 31 && (charCode < 48 || charCode > 57))
 
        return false;
      return true;
    }
  </script>
