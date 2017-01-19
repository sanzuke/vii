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
            $("#datadetail").html('<img src="<?php echo base_url() . "/img/ajax-loader.gif" ?>" />');
			var value ='';
			if(data.length > 0){
				$("#datadetail").html('');
				var x = 1;
				for (var i = 0; i < data.length; i++) {
					value = data[i];
                    if(value.publish == '1'){
                        var pub = 'Ya';
                    } else {
                        var pub = 'Tidak';
                    }
					var str = '<tr>'+
                                '<td>'+ value.post_title +'</td>'+
                                '<td>'+ value.seq +'</td>'+
                                '<td>'+ pub +'</td>'+
                                '<td align="center"><button name="edit" id="edit" class="btn btn-info btn-sm" onclick="editForm(\''+value.id+'\')"><i class="fa fa-edit"></i></button></td>'+
                                '<td align="center"><button name="hapus" id="hapus" class="btn btn-danger btn-sm" onclick="delForm(\''+value.id+'\')"><i class="fa fa-times"></i></button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
				};
				//$("#parametercode").attr("readonly","readonly");
			} 
		});
	}

    function delForm(id){
        var psn = confirm("Anda yakin akan menghapus konten ini?");
        if(psn){
            $.post("<?php echo uri_string();?>/delete/", {id : id}, function(data){
                alert(data);
                loadDataDetail();
            });
        }
    }

    function editForm(id){
        $.getJSON("<?php echo uri_string();?>/edit/", {id : id }, function(data){
            for (var i = 0; i <= data.length; i++) {
                var value = data[i];
                var str = value.post_content;

                $("#id").val(id);

                $("#title").val(value.post_title);
                //$("#desc").text(value.post_content);note-editable
                $("#desc").code(value.post_content);
                //$(".note-codable").val(str);

                $("#tagtitle").val(value.meta_title);
                $("#tagdesc").val(value.meta_description);
                $("#tagkeyword").val(value.meta_keyword);
                $("#seq").val(value.seq);

                $("#myModal").modal('show');
            };
        });
    }

	$(document).ready(function(){
		
		$("#tags").keypress(function(e){
			code= (e.keyCode ? e.keyCode : e.which);
            if (code == 13) {
            	loadData();
            	return false;
            }
        	//e.preventDefault();
		});
       
       $("#add").click(function(){
            $("#desc").val('');
            $("#myform input").val('');
            $("#myModal").modal('show');
        });

       $("#myform").submit(function(){
            $.post("<?php echo uri_string();?>/savedata/", 
                $(this).serialize(), 
                function(data){
                    //location.reload();
                    alert(data);
                    loadDataDetail();
                    $("#myModal").modal('hide');
                }
            );
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

       loadDataDetail();
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
		<div class="col-md-12">
			<div class="box box-warning">
				<div class="box-header">
                    <h3 class="box-title"><i class="fa fa-list" ></i> Daftar Halaman</h3>
                    <div class="pull-right" style="margin: 5px 10px 0px 0px">
                        <button type="button" class="btn btn-primary btn-sm" name="add" id="add" >Tambah <i class="fa fa-plus"></i></button>
                    </div>
                </div>
				<div class="box-body">
                    <table class="table table-bordered">
                    	<thead>
                        <tr>
                            <th>Judul Halaman</th>
                            <th>Urutan</th>
                            <th>Publish</th>
                            <th style="align:center">Ubah</th>
                            <th style="align:center">Hapus</th>
                        </tr>
                        </thead>
                        <tbody id="datadetail"></tbody>
                    </table>
                </div><!-- /.box-body -->
                <div class="box-footer">
					<!--<a data-original-title="Add New" href="#" data-toggle="tooltip" title="" class="btn btn-primary"><i class="fa fa-plus"></i></a>-->
                    
                    <!--<a type="button" title="" class="btn btn-danger" onclick="confirm('Are you sure?') ? $('#form-information').submit() : false;"><i class="fa fa-trash-o"></i></a>-->
				</div>
			</div>
		</div>
					 
    </section><!-- /.content -->
	
</aside><!-- /.right-side -->
			
<form id="myform">
<div id="myModal" class="modal fade modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Halaman Baru</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="title">Judul Halaman</label>
                    <input type="text" name="title" id="title" class="form-control" >
                    <input type="hidden" name="id" id="id" class="form-control" >
                    <input type="hidden" name="userid" id="userid" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="desc">Deskripsi</label>
                    <textarea id="desc" name="desc" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="tagtitle">Meta Tag title</label>
                    <input type="text" name="tagtitle" id="tagtitle" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="tagdesc">Meta Tag Description</label>
                    <input type="text" name="tagdesc" id="tagdesc" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="tagkeyword">Meta Tag Keyword</label>
                    <input type="text" name="tagkeyword" id="tagkeyword" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="seq">Urutan</label>
                    <input type="text" name="seq" id="seq" class="form-control" >
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
