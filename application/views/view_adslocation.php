<?php require("header.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#propinsi").autocomplete({source : <?php echo $datapropinsi; ?> });
	$("#kota").autocomplete({source : <?php echo $datakota; ?> });
	$("#tags").autocomplete({source : <?php echo $listlocation; ?> });

	$("#myform").submit(function(){
		$.post("<?php echo uri_string();?>/savedata/",$(this).serialize(), function(data){
			alert(data);
		});
		return false;
	});
});
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
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header"><h3 class="box-title">Find Location</h3></div>
							<div class="box-body">
								<div class="input-group input-group-sm">
									<input class="form-control" type="text" id="tags" class="typeahead" data-provide="typeahead">
									<span class="input-group-btn">
										<button class="btn btn-info btn-flat" type="button" id="find">Find</button>
									</span>
								</div>
								
							</div>
						</div>
					</div>

					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header"><h3 class="box-title">Add New Ads Location</h3></div>
							<div class="box-body">
								<div class="form-group">
									<label for="loccode">Ads Location Code</label>
									<input type="text" name="loccode" id="loccode" class="form-control required" >
								</div>
								<div class="form-group">
									<label for="propinsi">Province</label>
									<input type="text" name="propinsi" id="propinsi" class="form-control" >
								</div>
								<div class="form-group">
									<label for="kota">City</label>
									<input type="text" name="kota" id="kota" class="form-control" >
								</div>
								<div class="form-group">
									<label for="placename">Place Name</label>
									<input type="text" name="placename" id="placename" class="form-control" >
								</div>
								<div class="form-group">
									<label for="opentime">Open Time</label>
									<input type="time" name="opentime" id="opentime" class="form-control" >
								</div>
								<div class="form-group">
									<label for="closetime">Close Time</label>
									<input type="time" name="closetime" id="closetime" class="form-control" >
								</div>
							</div>
							<div class="box-footer">
		                        <button type="button" class="btn btn-primary" name="add" id="add" >Add New</button>
		                        <button type="submit" class="btn btn-primary" name="save" id="save" >Save</button>
		                        <button type="button" class="btn btn-danger" name="del" id="del" >Delete</button>
		                    </div>
						</div>
					</div>

					</form>			 
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->
			
       

<?php require("footer.php"); ?>
