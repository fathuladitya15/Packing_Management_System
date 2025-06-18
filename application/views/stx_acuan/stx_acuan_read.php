<div class="box box-default"> 
  <div class="box-header with-border">
    <h3 class="box-title">Acuan Detail</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
        <table class="table">
	    <tr><td style="width: 250px;">Nama Acuan</td><td><?php echo $acuan_nama; ?></td></tr>
        <tr><td>Status Acuan</td>
        <td>    
        
          <?php 
          if(!empty($acuan_status)) {
            if($acuan_status=='Aktif') $chek="checked"; else $chek=""; 
          }else{
            $chek="";
          }
          ?>
          
            <input type="checkbox" name="acuan_status" value="Aktif" <?php echo $chek; ?>> &nbsp; Active   

        </td></tr>


	    <tr><td><a href="<?php echo site_url('stx_acuan') ?>" class="btn btn-default">Cancel</a></td><td></td></tr>
	</table>
</div>
