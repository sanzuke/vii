<?php require("header.php"); ?>
<script type="text/javascript">
	function loadData(){
		$.post("<?php echo uri_string();?>/getdata/", {paramcode : $("#tags").val() }, function(data){
			$("#parametercode").val(data.split("|")[0]);
			$("#parametername").val(data.split("|")[1]);
		});
		loadDataDetail();
	}

	function editData(id, name, parent){
		$("#categorycode").val(id);
		$("#categoryname").val(name);
		$("#parent").val(parent);
		//$("option").removeAttr("selected");
		//$("select option[value="+parent+"]").attr("selected","selected");
		//alert(parent);
	}

	function delData(id){
		var psn = confirm("Anda yakin akan menghapus?");
		if(psn == true){
			$.post("<?php echo uri_string();?>/deldata/", {categorycode : id }, function(data){
				if(data == 'done'){
					location.reload(true);
				}
				location.reload(true);
			});
		}
	}

	function loadDataDetail(){
		$.getJSON("<?php echo uri_string();?>/getdatadetail/", function(data){
			var value ='';
			if(data !== 'null'){
				$("#datadetail").html('');
				var x = 1;
				for (var i = 0; i <= data.length; i++) {
					value = data[i];

					var str = '<tr>'+
                                '<td>'+ value.categoryname +'<input type="hidden" name="id'+x+'" id="id'+x+'" value="'+value.categorycode+'" /></td>'+
                                '<td><button type="button" name="edit" id="edit" class="btn btn-info btn-sm" onclick="editData(\''+value.categorycode+'\',\''+value.categoryname+'\',\''+value.parent+'\')" >Edit</button>'+
                                '<button name="del" type="button" id="del" class="btn btn-danger btn-sm" onclick="delData(\''+value.categorycode+'\')" >Delete</button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
				};
			}
		});
	}

	$(document).ready(function(){
		$("#myform").submit(function(){
			var postdata = {
				categorycode : $("#categorycode").val(),
				categoryname : $("#categoryname").val(),
				parent : $("#parent").val()
			}
			$.post("<?php echo uri_string();?>/savecategory/",postdata , function(data){
				//alert(data);
				//loadDataDetail();
				location.reload(true);
			});
			return false;
		});
	})
</script>
       
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    <?php echo  $TITLE; ?>
                    <small><?php echo  $SUBTITLE; ?></small>
                    </h1>
					<?php //echo  $BREADCRUMB; ?>
                   
                </section> 
                <!-- Main content -->
                <section class="content">
					<form role="form" id="myform">
					
					<div class="col-md-6">
						<div class="box box-primary">
							<div class="box-header"><h3 class="box-title">Tambah Kategori</h3></div>
							<div class="box-body">
								<div class="form-group">
									<label for="categoryname">Nama Kategori</label>
									<input type="text" name="categoryname" id="categoryname" class="form-control" >
									<input type="hidden" name="categorycode" id="categorycode" class="form-control" >
								</div>
								<div class="form-group">
									<label for="parametername">Sub Kategori</label>
									<select name="parent" id="parent" class="form-control">
										<option value="0">[ Pilih ]</option>
										<?php
										foreach ($query as $row){
											echo '<option value="'.$row['categorycode'].'">'.$row['categoryname'].'</option>';
										}
										?>
									</select>
								</div>
								<div class="box-footer">
									<button type="submit" class="btn btn-primary" name="submit" id="submit" >Save</button>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6">
						<div class="box box-warning">
							<div class="box-header"><h3 class="box-title">Daftar Kategori</h3></div>
							<div class="box-body">
	                            
	                            <table id="example1" class="table table-bordered table-striped">
		                            <thead>
		                                <tr>
		                                    <th>Kategori</th>
		                                    <th>Opsi</th>
		                                </tr>
		                            </thead>
		                            <tbody id="datadetail">
		                                <?php echo $listkategori ?>
		                            </tbody>
		                        </table>
	                        </div><!-- /.box-body -->
	                        <!--<div class="box-footer">
								<button type="submit" class="btn btn-primary" name="submit" id="submit" >Add Detail</button>
							</div>-->
						</div>
					</div>
					</form>			 
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->

<?php require("footer.php"); ?>
