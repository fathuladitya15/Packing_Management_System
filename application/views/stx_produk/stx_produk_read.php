<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">DETAIL PRODUK</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>


<div class="box-body">
        <table class="table">
	        <tr><td>Kode Produk</td><td><?php echo $produk_id; ?></td></tr>
		    <tr><td>Nama Produk</td><td><?php echo $produk_nama; ?></td></tr>
		    <tr><td>Tipe</td><td><?php echo $produk_tipe; ?></td></tr>
		    <tr><td>Masterbox</td><td><?php echo $produk_masterbox; ?></td></tr>
		    <tr><td>Harga Mesin</td><td><?php echo $produk_mesin; ?></td></tr>
		    <tr><td>Harga Mbox</td><td><?php echo $produk_mbox; ?></td></tr>
		    <tr><td>Harga Susun</td><td><?php echo $produk_susun; ?></td></tr>
		    <tr><td>Harga Manual</td><td><?php echo $produk_manual; ?></td></tr>
		    <tr><td>Harga WIP</td><td><?php echo $produk_wip; ?></td></tr>
		    <tr><td>Harga PP</td><td><?php echo $produk_pp; ?></td></tr>
		    <tr><td>Harga Step Final</td><td><?php echo $produk_step_final; ?></td></tr>
		    <tr><td>Kategori Produk</td><td><?php echo $produk_kategori_id; ?></td></tr>
		    <tr><td>Status Produk</td>
		    <td>	
			
	          <?php 
	          if(!empty($produk_status)) {
	            if($produk_status=='Aktif') $chek="checked"; else $chek="No"; 
	          }else{
	            $chek="No";
	          }
	          ?>
	          
	            <input type="checkbox" name="produk_status" value="Aktif" <?php echo $chek; ?>> &nbsp; Active
	     

		    </td></tr>
		   
		    <hr>
		    <tr><td></td><td class="pull-right"><a href="<?php echo site_url('stx_produk') ?>" class="btn btn-danger">Cancel</a></td></tr>
		</table>
	</div>
</div>
