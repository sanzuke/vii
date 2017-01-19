<?php require("header.php"); ?>
<script type="text/javascript">
	function loadData(){
		$.post("<?php echo uri_string();?>/getdata/", {paramcode : $("#tags").val() }, function(data){
			$("#parametercode").val(data.split("|")[0]);
			$("#parametername").val(data.split("|")[1]);
			$("#parametercode").attr("readonly","readonly");
		});
		loadDataDetail();
	}

	function loadDataDetail(){
		$.getJSON("<?php echo uri_string();?>/getdatadetail/", {paramcode : $("#tags").val() }, function(data){
			var value ='';
			if(data !== 'null'){
				$("#datadetail").html('');
				var x = 1;
				for (var i = 0; i <= data.length; i++) {
					value = data[i];

					var str = '<tr>'+
                                '<td>'+x+'</td>'+
                                '<td>'+ value.parametervaluecode +'</td>'+
                                '<td>'+ value.parametervalue +'</td>'+
                                '<td><button name="edit" id="edit" class="btn btn-info btn-sm">Edit</button></td>'+
                                '<td><button name="edit" id="edit" class="btn btn-danger btn-sm">Delete</button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
				};
				//$("#parametercode").attr("readonly","readonly");
			} 
		});
	}

	$(document).ready(function(){
		$( "#tags" ).autocomplete({
            source: <?php echo $dataparam; ?>
        }); 

		$("#tags").keypress(function(e){
			code= (e.keyCode ? e.keyCode : e.which);
            if (code == 13) {
            	loadData();
            	return false;
            }
        	//e.preventDefault();
		});

		$("#find").click(function(){
			loadData();
		});
       
       $("#add").click(function(){
            //$("#paramcode").val('');
            $("#paramvaluecode").val('');
            $("#paramname").val('');
            $("#myModal").modal('show');
        });

       $("#addnew").click(function(){
       		$("#parametercode").val('');
       		$("#parametername").val('');
       		$("#tags").val('');
       		$("#datadetail").html('');
       		$("#parametercode").removeAttr("readonly");
       		$("#parametercode").focus();
       })

       $("#myform").submit(function(){
            $.post("<?php echo uri_string();?>/savedatadetail/", $(this).serialize()+"&paramcode="+$("#parametercode").val(), function(data){
                //location.reload();
                loadDataDetail();
                $("#myModal").modal('hide');
            });
            return false;
        });

       $("#masterform").submit(function(){
            $.post("<?php echo uri_string();?>/savedata/", $(this).serialize(), function(data){
                //location.reload();
                //loadDataDetail();
                alert(data);
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
					
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header"><h3 class="box-title">Find Parameter</h3></div>
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
					
					<form id="masterform">
					<div class="col-md-12">
						<div class="box box-primary">
							<div class="box-header"><h3 class="box-title">Master</h3></div>
							<div class="box-body">
								<div class="form-group">
									<label for="parametercode">Parameter Code</label>
									<input type="text" name="parametercode" id="parametercode" class="form-control" >
								</div>
								<div class="form-group">
									<label for="parametername">Parameter Name</label>
									<input type="text" name="parametername" id="parametername" class="form-control" >
								</div>
								<div class="box-footer">
									<button type="button" class="btn btn-primary" name="addnew" id="addnew" >Add New</button>
									<button type="submit" class="btn btn-primary" name="submit" id="submit" >Save</button>
									<button type="button" class="btn btn-danger" name="delete" id="delete" >Delete</button>
								</div>
							</div>
						</div>
					</div>
					</form>
					
					<div class="col-md-12">
						<div class="box box-warning">
							<div class="box-header"><h3 class="box-title">Details</h3></div>
							<div class="box-body">
                                    <table class="table table-bordered">
                                    	<thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Parameter Value Code</th>
                                            <th>Parameter Value Name</th>
                                            <th>Edit</th>
                                            <th style="width: 40px">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody id="datadetail"></tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
									<button type="button" class="btn btn-primary" name="add" id="add" >Add Detail</button>
								</div>
						</div>
					</div>
								 
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->
			
<form id="myform">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add new detail data</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="paramvaluecode">Parameter Value Code</label>
                    <input type="text" name="paramvaluecode" id="paramvaluecode" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="paramname">Parameter Value Name</label>
                    <input type="text" name="paramname" id="paramname" class="form-control" >
                </div>
                <!--<p>Do you want to save changes you made to document before closing?</p>
                <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>-->
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>

<?php require("footer.php"); ?>
