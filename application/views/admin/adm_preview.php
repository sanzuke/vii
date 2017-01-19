<?php require("header.php"); ?>
<script type="text/javascript">
	function del(id, img){
		var psn = confirm("Anda yakin akan menghapus data dengan ID '"+id+"' ?");
		if(psn){
			$.post("<?php echo base_url() ?>admpreview/del",{no :id, img : img}, function(feedback){
				alert(feedback);
			}).fail(function(xhr){
				alert("Kesalahan pada server."+xhr.responseText);
			})
		} 
	}
</script>
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php echo  $TITLE; ?>
        <small><?php echo  $SUBTITLE; ?></small>
        </h1>
        <?php echo  $BREADCRUMB; ?>
       
    </section> 
    <!-- Main content -->
    <section class="content">
    	<table class="table table-striped dataTable">
    		<thead>
    			<tr>
    				<th>No.</th>
    				<th>Nama Produk</th>
    				<th>Judul</th>
    				<th>Keterangan</th>
    				<th>Gambar</th>
    				<th>Posisi Text</th>
    				<th>Kolom</th>
    				<th>Urutan</th>
    				<th>Opsi</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php
    			$i=1;
    			foreach ($query->result_array() as $key => $value) {
    				# code...
    				echo '<tr>
	    				<td>'.$i.'</td>
	    				<td>'.$value['productname'].'</td>
	    				<td>'.$value['judul'].'</td>
	    				<td>'.$value['text'].'</td>
	    				<td><img src="'.base_url() .'uploads/preview/'. $value['image'].'" class="img-responsive" width="200"></td>
	    				<td>'.$value['text-pos'].'</td>
	    				<td>'.$value['kolom'].'</td>
	    				<td>'.$value['seq'].'</td>
	    				<td>
	    					<button class="btn btn-danger btn-xs" onclick="del(\''.$value['no'].'\',\''.$value['image'].'\')"><i class="fa fa-trash-o"></i></button>
	    					<a class="btn btn-success btn-xs" href="'.base_url().'admpreview/addpreview/'.$value['no'].'"><i class="fa fa-edit"></i></a>
	    				</td>
	    			</tr>';
    				$i++;
    			}
    			?>
    		</tbody>
    	</table>
    	<a class="btn btn-primary" href="<?php echo base_url(); ?>admpreview/addpreview"><i class="fa fa-plus"></i> Tambah</a>
    </section>
</aside>
<?php require("footer.php"); ?>