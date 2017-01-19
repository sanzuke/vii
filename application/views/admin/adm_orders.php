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
			if(data !== 'null'){
				$("#datadetail").html('');
				var x = 1;
				for (var i = 0; i <= data.length; i++) {
					value = data[i];

					var str = '<tr>'+
                                '<td><input type="checkbox" name="check'+x+'" id="check'+x+'" ></td>'+
                                '<td>'+ value.post_title +'</td>'+
                                '<td>'+ value.seq +'</td>'+
                                '<td align="right"><button name="edit" id="edit" class="btn btn-info btn-sm" onclick="editForm(\''+value.id+'\')"><i class="fa fa-edit"></i></button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
				};
				//$("#parametercode").attr("readonly","readonly");
			} 
		});
	}

    function editForm(id){
        $.getJSON("<?php echo uri_string();?>/edit/", {id : id }, function(data){
            for (var i = 0; i <= data.length; i++) {
                var value = data[i];
                var str = value.post_content;

                $("#title").val(value.post_title);
                //$("#desc").text(value.post_content);note-editable
                //$("#desc").val('value.post_content');
                $(".note-codable").val(str);

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
            $.post("<?php echo uri_string();?>/savedata/", 
                $(this).serialize(), 
                function(data){
                    //location.reload();
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
				<div class="box-header"><h3 class="box-title"><i class="fa fa-list" ></i> Daftar Pesanan</h3></div>
				<div class="box-body">
                    <table class="table table-bordered">
                    	<thead>
                        <tr>
                            <th>NO</th>
                            <th>Kode Transaksi</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Pembayaran</th>
                            <th style="text-align:center;">Qty</th>
                            <th style="text-align:center;">Total</th>
                            <th align="right" width="50">Lihat</th>
                        </tr>
                        </thead>
                        <tbody id="datadetail">
                            <?php
                            $i = 1;
                            foreach ($query as $key => $value) {
                                # code...
                                ?>
                                <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $value['transactioncode'] ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo date("d-m-Y", strtotime($value['date']) ) ?></td>
                                <td><?php 
                                    switch($value['payment_method'] ){
                                    case '1': echo 'Transfer Bank';
                                    break;
                                    case '2': echo 'COD';
                                    break;
                                    }
                                    ?></td>
                                <td align="right"><?php echo $value['qty'] == null ? 0 : number_format($value['qty']);  ?></td>
                                <td align="right"><?php echo $value['total'] == null ? 0 :  number_format($value['total']);?></td>
                                <td><button type="button" class="btn btn-primary btn-sm" name="lihat" id="lihat" title="Lihat" data="<?php echo $value['transactioncode'] ?>" ><i class="fa fa-search"></i></button></td>
                                <tr>
                                <?php
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
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
                <h4 class="modal-title">Detil Pesanan</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <td><b>No Invoice</b></td>
                        <td><span id="kode"></span></td>
                    </tr>
                    <tr>
                        <td><b>Nama</b></td>
                        <td><span id="nama"></span></td>
                    </tr>
                    <tr>
                        <td><b>Alamat</b></td>
                        <td><span id="alamat"></span></td>
                    </tr>
                    <tr>
                        <td><b>Kota</b></td>
                        <td><span id="kota"></span></td>
                    </tr>
                    <tr>
                        <td><b>Kecamata</b></td>
                        <td><span id="kec"></span></td>
                    </tr>
                    <tr>
                        <td><b>Telp</b></td>
                        <td><span id="telp"></span></td>
                    </tr>
                </table><br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="detil"></tbody>
                </table>
                <h3 id="total"></h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>
<script type="text/javascript">
    $("#lihat").click(function(){
        var t = $(this).attr("data");
        $.getJSON("<?php echo base_url() ?>orders/getdetail", {p : t }, function(json){
            if(json.length > 0) {
                $("#detil").html('');
                $("#kode").html('');
                $("#nama").html('');
                $("#alamat").html('');
                $("#kota").html('');
                $("#kec").html('');
                $("#telp").html('');
                var x =1, total = 0;
                $.each(json, function(i, v){
                    $("#kode").html(v.transactioncode);
                    $("#nama").html(v.nama);
                    $("#alamat").html(v.alamat);
                    $("#kota").html(v.kota);
                    $("#kec").html(v.kec);
                    $("#telp").html(v.telp);

                    var str = '<tr><td>'+x+'</td><td>'+v.productname+'</td><td>'+v.qty+'</td><td>'+v.price+'</td><td>'+v.subtotal+'</td></tr>';
                    $("#detil").append(str);
                    x++;
                    total = total + parseInt(v.subtotal);
                })
                $("#total").html("Total Rp. "+total);
            }
        })
        $("#myModal").modal("show");
    });
</script>
<?php require("footer.php"); ?>
