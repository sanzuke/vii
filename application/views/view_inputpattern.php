<?php require("header.php"); ?>
<script type="text/javascript">
    function loadDataDetail(){
        $.getJSON("<?php echo uri_string();?>/getdatadetail/", function(data){
            var value ='';
            if(data !== 'null'){
                $("#datadetail").html('');
                var x = 1;
                for (var i = 0; i <= data.length; i++) {
                    value = data[i];

                    var str = '<tr>'+
                                '<td>'+ value.tablename +'</td>'+
                                '<td>'+ value.displaypattern +'</td>'+
                                '<td>'+ value.editpattern +'</td>'+
                                '<td><button name="edit" id="edit" class="btn btn-info btn-sm"  onclick="editData(\''+value.tablename+'\',\''+value.displaypattern+'\',\''+value.editpattern+'\')">Edit</button>'+
                                '<button name="edit" id="edit" class="btn btn-danger btn-sm" onclick="delData(\''+value.tablename+'\')">Delete</button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
                };
            }
        });
    }

    function editData(id, name, parent){
        $("#tablename").attr('readonly','readonly').val(id);
        $("#displaypattern").val(name);
        $("#editpattern").val(parent);
        $("#myModal").modal('show');
    }

    function delData(id){
        var psn = confirm("Anda yakin akan menghapus?");
        if(psn == true){
            $.post("<?php echo uri_string();?>/deldata/", {tablename : id }, function(data){
                if(data == 'done'){
                    //location.reload(true);
                    loadDataDetail()
                }
                //location.reload(true);
            });
        }
    }

    $(document).ready(function(){
        $("#add").click(function(){
            $("#tablename").removeAttr('readonly').val('');
            $("#displaypattern").val('');
            $("#editpattern").val('');
            $("#myModal").modal('show');
        });

        $("#myform").submit(function(){
            $.post("<?php echo uri_string();?>/savedata/", $(this).serialize(), function(data){
                //location.reload();
                loadDataDetail();
            });
            return false;
        })
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
					<?php echo  $BREADCRUMB; ?>
                   
                </section> 
                <!-- Main content -->
                <section class="content">
            
				
				<div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Table Name</th>
                                    <th>Display Pattern</th>
                                    <th>Edit Pattern</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody id="datadetail">
                            <?php 
                                foreach ($query as $row) {
                                    echo '<tr>
                                        <td>'.$row['tablename'].'</td>
                                        <td>'.$row['displaypattern'].'</td>
                                        <td>'.$row['editpattern'].'</td>
                                        <td><button name="edit" id="edit" class="btn btn-info btn-sm" onclick="editData(\''.$row['tablename'].'\',\''.$row['displaypattern'].'\',\''.$row['editpattern'].'\')">Edit</button>
                                        <button name="edit" id="edit" class="btn btn-danger btn-sm" onclick="delData(\''.$row['tablename'].'\')">Delete</button></td>
                                    </tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-primary" name="add" id="add" >Add New</button>
                    </div>
                </div><!-- /.box -->
			    
			 	
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->

<form id="myform">
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add New data</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="contentname">Table Name</label>
                    <input type="text" name="tablename" id="tablename" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="contentname">Display Pattern</label>
                    <input type="text" name="displaypattern" id="displaypattern" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="contentname">Edit Pattern</label>
                    <input type="text" name="editpattern" id="editpattern" class="form-control" >
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