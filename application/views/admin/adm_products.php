<?php require("header.php"); ?>
<script type="text/javascript">
    function editData(id){
        /*$.getJSON("<?php echo uri_string();?>/geteditdata", {productcode : id }, function(data){
            var value ='';
            if(data !== 'null'){
                var x = 1;
                for (var i = 0; i < data.length; i++) {
                    value = data[i];
                    $("#productcode").val(value.productcode);
                    $("#prodcode").val(value.productcode);
                    $("#productname").val(value.productname);
                    //$("#categorycode").val(value.categorycode);
                    //$record['categoryname'] = $row['categoryname);
                    $("#suppliercode").val(value.suppliercode);
                    //$record['suppliername'] = $row['suppliername'];
                    $("#stock").val(value.stock);
                    $("#price").val(value.price);
                    $("#sale").val(value.sale);
                    $("#description").code(value.description);

                    $("#productcode").attr("readonly","readonly");
                    $("#productname").focus();

                    //$("option").removeAttr("selected");
                    $("#category option[value="+ value.categorycode +"]").attr("selected","selected");
                    //$("option[value="+ value.suppliercode +"]").attr("selected","selected");
                    
                    $("#metatitle").val(value.meta_title);
                    $("#metadesc").val(value.meta_description);
                    $("#metakeyword").val(value.meta_keyword);

                    $("#poin").val(value.poin);
                    $("#publish").val(value.publish);

                    $("#imgproduk").attr("src","<?php echo base_url() . "uploads/" ?>"+value.photo)
                    
                    $("#size").val('');
                    $("#jmlsize").val('');

                    $("#color").val('');
                    $("#jmlcolor").val('');
                    //window.location = '<?php echo uri_string();?>/editproduct';
                }
            }
        });
        $("#myModal").modal("show");
        $("#uploadfoto").removeAttr("disabled");
        loadsizeproduct(id);
        loadcolorproduct(id);
        return false;*/
        window.location= '<?php echo base_url() ?>admproducts/addproduct/'+id;
    }
    

    function delData(id){
        var psn = confirm("Anda yakin akan menghapus?");
        if(psn == true){
            $.post("<?php echo base_url() ?>admproducts/deldata/", {productcode : id }, function(data){
                if(data == 'done'){
                    //location.reload(true);
                    //alert(data)
                    loadDataDetail();
                }
                //location.reload(true);
            });
        }
        return false;
    }

    function loadDataDetail(){
        
        $.getJSON("<?php echo base_url() ?>admproducts/getdatalist/", function(data){
            var value ='';
            $("#datadetail").html('<img src="img/ajax-loader.gif" />');
            if(data !== 'null'){
                $("#datadetail").html('');
                var x = 1;
                for (var i = 0; i < data.length; i++) {
                    value = data[i];

                    var str = '<tr>'+
                                '<td>'+ x +'</td>'+
                                '<td><img src="<?php echo base_url() ?>uploads/'+ value.photo +'" width="100" class="thumbnail" /></td>'+
                                '<td>Kode : '+ value.productcode +'<input type="hidden" name="id'+x+'" id="id'+x+'" value="'+value.productcode+'" /><br>'+
                                'Nama : '+ value.productname +'<br>'+
                                'Stok : '+ value.stock +'<br>'+
                                'Harga Beli : '+ value.price +'<br>'+
                                'Harga Jual :'+ value.sale +'</br>'+
                                'Poin : '+ value.poin +'</td>'+
                                '<td><button type="button" name="edit" id="edit" class="btn btn-info btn-sm" onclick="editData(\''+value.productcode+'\')" ><i class="fa fa-edit"></i></button>'+
                                '<button type="button" name="del" type="button" id="del" class="btn btn-danger btn-sm" onclick="delData(\''+value.productcode+'\')" ><i class="fa fa-trash-o"></i></button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
                };
            } else {
                $("#datadetail").html('');
            }
        });
        
    }

    function searchDataDetail(id){
        $("#datadetail").html('<img src="img/ajax-loader.gif" />');
        $.getJSON("<?php echo base_url() ?>admproducts/searchdatalist/", {productname : id}, function(data){
            var value ='';
            if(data !== 'null'){
                $("#datadetail").html('');
                var x = 1;
                for (var i = 0; i < data.length; i++) {
                    value = data[i];

                    var str = '<tr>'+
                                '<td>'+ x +'</td>'+
                                '<td><img src="<?php echo base_url() ?>uploads/'+ value.photo +'" width="100" class="thumbnail" /></td>'+
                                '<td>Kode : '+ value.productcode +'<input type="hidden" name="id'+x+'" id="id'+x+'" value="'+value.productcode+'" /><br>'+
                                'Nama :' + value.productname +'<br>'+
                                'Stok : '+ value.stock +'</br>'+
                                'Harga Beli :'+ value.price +'</br>'+
                                'Harga Jual :'+ value.sale +'</br>'+
                                'Poin : '+ value.poin +'</td>'+
                                '<td><button type="button" name="edit" id="edit" class="btn btn-info btn-sm" onclick="editData(\''+value.productcode+'\')" ><i class="fa fa-edit"></i></button>'+
                                '<button type="button" name="del" type="button" id="del" class="btn btn-danger btn-sm" onclick="delData(\''+value.productcode+'\')" ><i class="fa fa-trash-o"></i></button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
                };
            } else {
                $("#datadetail").html('');
            }
        });
    }

    function savesizeproduct(){
        var id = $("#productcode").val();
        var postdata = {
            productcode : id,
            size : $("#size").val(),
            jumlah : $("#jmlsize").val()
        };
        $.post("<?php echo base_url() ?>admproducts/savesizeproduct/", postdata, function(data){
            //alert(data);
            loadsizeproduct(id);
        })
    }

    function loadsizeproduct(id){
        $("#sizedetail").html('');
        var tot = 0;
        $.getJSON("<?php echo base_url() ?>admproducts/loadsizeproduct/", {productcode : id}, function(data){
            
            $.each(data, function(index, val){
                //$("#size").val(val.size);
                //$("#jmlsize").val(val.jumlah);

                var str = '<tr><td>'+val.size+'</td><td>'+val.jumlah+'</td></tr>';
                tot = tot + parseInt(val.jumlah);
                $("#sizedetail").append(str);
                //console.log(tot);
                $("#totsize").val(tot);
            })
        });
        
    }

    function savecolorproduct(){
        var id = $("#productcode").val();
        var postdata = {
            productcode : id,
            color : $("#color").val(),
            jumlah : $("#jmlcolor").val()
        };
        $.post("<?php echo base_url() ?>admproducts/savecolorproduct/", postdata, function(data){
            //alert(data);
            loadcolorproduct(id);
        })
    }

    function loadcolorproduct(id){
        $("#colordetail").html('');
        totcolor = 0;
        $.getJSON("<?php echo base_url() ?>admproducts/loadcolorproduct/", {productcode : id}, function(data){
            
            $.each(data, function(index, val){
                //$("#color").val(val.color);
                //$("#jmlcolor").val(val.jumlah);

                var str = '<tr><td>'+val.color+'</td><td>'+val.jumlah+'</td></tr>';
                totcolor = totcolor + parseInt(val.jumlah);
                $("#colordetail").append(str);
                $("#totcolor").val(totcolor);
            })
        });
    }

    function checkstok(){
        var stok = $("#stock").val(); 

    }

    $(document).ready(function(){
        $("#myform").submit(function(){
            if($("#productcode").val() !== "" &&  $("#productname").val() !== "" && $("#categorycode").val() !== "" && $("#price").val() !== "" && $("#sale").val() !== ""){
                var postdata = {
                    productcode : $("#productcode").val(),
                    productname : $("#productname").val(),
                    categorycode: $("#categorycode").val(),
                    suppliercode: $("#suppliercode").val(),
                    stock       : $("#stock").val(),
                    price       : $("#price").val(),
                    sale        : $("#sale").val(),
                    description : $("#description").val(),
                    metatitle   : $("#metatitle").val(),
                    metadesc    : $("#metadesc").val(),
                    metakeyword : $("#metakeyword").val()
                }
                $.post("<?php echo base_url() ?>admproducts/savedata/", $(this).serialize() + "&description="+ $("#description").code(), function(data){
                    alert(data);
                    loadDataDetail();
                    $("#uploadfoto").removeAttr("disabled");
                    //location.reload(true);
                });
            } else {
                alert("Field tidak boleh kosong")
            }
            return false;
        });

        $("#add").click(function(){
            /*$("input").val('')
            $("select").val('');
            $("#productcode").removeAttr("readonly");
            $("#productcode").focus();
            $("#myModal").modal("show");
            $("#uploadfoto").attr("disabled","disabled");
            $(".msg").html('<small>Simpan produk terlebih dahulu untuk mengupload foto</small>');*/
            window.location = '<?php echo base_url() ?>admproducts/addproduct';
        });

        $("#btn-search").click(function(){

        });

        $("#search").autocomplete({source : <?php echo $query ?>});

        $("#search").keyup(function(){
           $("#btn-search").trigger("click");
        })

        $("#btn-search").click(function(){
            searchDataDetail( $("#search").val() );
        });

        $("#close").click(function(){
            $("#myModal").modal("hide");
        });

        loadDataDetail();

        $('#description').summernote({
            height: 150
        });

        $("#tabs").tabs();

        $("#tambahukuran").click(function(){
            savesizeproduct();
        });

        $("#tambahwarna").click(function(){
            savecolorproduct();
        });

        $("#jmlsize").keyup(function(){
            var stok = new Number($("#stock").val());
            var tot  = new Number($("#totsize").val());
            var baru = parseInt( $(this).val() ) + tot;

            if(baru > stok){
                alert("Maaf angka yang anda masukan lebih besar dari stok.");
                $("#tambahukuran").attr("disabled","disabled");
            }else {
                $("#tambahukuran").removeAttr("disabled");
            }
        });

        $("#jmlcolor").keyup(function(){
            var stok = new Number($("#stock").val());
            var tot  = new Number($("#totcolor").val());
            var baru = parseInt( $(this).val() ) + tot;

            if(baru > stok){
                alert("Maaf angka yang anda masukan lebih besar dari stok.");
                $("#tambahwarna").attr("disabled","disabled");
            } else {
                $("#tambahwarna").removeAttr("disabled");
            }
        });
        
        // upload foto 
        var options = { 
            url     : "<?php echo uri_string();?>/uploadfoto/",
            type : "POST",
            data    : '&code='+$("#productcode").val(),
            beforeSend: function() 
            {
                $(".progress").show();
                //clear everything
                $(".bar").width('0%');
                $("#message").html("");
                $(".percent").html("0%");
            },
            uploadProgress: function(event, position, total, percentComplete) 
            {
                $(".bar").width(percentComplete+'%');
                $(".percent").html(percentComplete+'%');    
            },
            success: function() 
            {
                $(".bar").width('100%');
                $(".percent").html('100%');
                
            },
            complete: function(response) 
            {
                $("#message").html("<font color='green'>"+response.responseText+"</font>");
                $(".msg").html("<font color='green'>"+response.responseText+"</font>");
                //alert($("#userfile").val());
                $("#imgproduk").attr("src","<?php echo base_url() . "uploads/" ?>"+$("#userfile").val() )
            },
            error: function()
            {
                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");
            }
        }
        $("#myformfoto").ajaxForm(options);
        

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
                    <?php echo  $BREADCRUMB; ?>
                   
                </section> 
                <!-- Main content -->
                <section class="content">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header">
                                    <h3 class="box-title">List Produk</h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="search" id="search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default" id="btn-search"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="50">No</th>
                                    <th width="100">Photo</th>
                                    <th>Produk</th>
                                    
                                    <th>Edit/Delete</th>
                                </tr>
                            </thead>
                            <tbody id="datadetail">
                                
                            </tbody>
                            </table>

                            <div class="box-footer">
                                <button type="button" class="btn btn-primary btn-sm" name="add" id="add" ><i class="fa fa-plus"></i> Tambah</button>
                                <!-- <button type="submit" class="btn btn-primary" name="save" id="save" >Save</button>-->
                            </div>
                        </div>
                    </div>
                </div>
            
                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
<form id="myform">
<div id="myModal" class="modal fade ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Produk Baru</h4>
            </div>
            <div class="modal-body">
                <div id="tabs">
                    <ul>
                        <li class="1"><a href="#tabs1">Umum</a></li>
                        <li class="2"><a href="#tabs2">Ukuran</a></li>
                        <li class="2"><a href="#tabs5">Warna</a></li>
                        <li class="3"><a href="#tabs3">Foto Produk</a></li>
                        <li class="4"><a href="#tabs4">SEO</a></li>
                    </ul>

                    <div id="tabs1">
                        <div class="form-group">
                            <label for="productcode">Kode Produk</label>
                            <input type="text" name="productcode" id="productcode" required class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="productname">Nama Produk</label>
                            <input type="text" name="productname" id="productname" required class="form-control" >
                        </div>
                        <div class="form-group" id="kat">
                            <label for="category">Kategori</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="">[ Pilih ]</option>
                                <?php
                                $kat = $this->db->query("SELECT * FROM ss_category WHERE parent = '0' ");
                                foreach($kat->result_array() as $r){
                                    echo '<option value="'.$r['categorycode'].'">'.$r['categoryname'].'</option>';
                                    $qry2=$this->db->query("SELECT * FROM ss_category WHERE parent = '".$r['categorycode']."'");
                                    foreach($qry2->result_array() as $rr){
                                        echo '<option value="'.$rr['categorycode'].'"> - '.$rr['categoryname'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" name="stock" id="stock" class="form-control" required placeholder="0" >
                        </div>
                        <div class="form-group">
                            <label for="sale">Harga Jual</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-number">Rp</i></div>
                                <input type="text" name="sale" id="sale" class="form-control pull-right" required >
                                <div class="input-group-addon"><i class="fa fa-decimal">.00</i></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price">Harga Beli</label>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-number">Rp</i></div>
                                <input type="text" name="price" id="price" class="form-control pull-right" required >
                                <div class="input-group-addon"><i class="fa fa-decimal">.00</i></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="poin">Poin</label>
                            <input type="number" name="poin" id="poin" class="form-control" required >
                        </div>

                        <div class="form-group">
                            <label for="poin">Tampilkan Produk</label>
                            <select name="publish" id="publish" class="form-control">
                                <option value="">[ Pilih ]</option>
                                <option value="1">Ya</option>
                                <option value="0">Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Keterangan</label>
                            <input type="text" name="description" id="description" class="form-control" >
                        </div>
                    </div>

                    <div id="tabs4">
                        <div class="form-group">
                            <label for="metatitle">Meta Title</label>
                            <input type="text" name="metatitle" id="metatitle" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="metadesc">Meta Description</label>
                            <input type="text" name="metadesc" id="metadesc" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="metakeyword">Meta Keyword</label>
                            <input type="text" name="metakeyword" id="metakeyword" class="form-control" >
                        </div>
                    </div>
                    </form>

                    <div id="tabs2">
                        <div class="form-group">
                            <label for="size">Ukuran </label>
                            <input type="text" name="size" id="size" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="jmlsize">Jumlah</label>
                            <input type="text" name="jmlsize" id="jmlsize" class="form-control" >
                            <input type="hidden" name="totsize" id="totsize">
                        </div>
                        <hr>
                            <button name="tambahukuran" id="tambahukuran" type="button"><i class="fa fa-plus"></i> Tambah</button>
                        <hr>
                        <table class="table">
                        <thead>
                        <tr>
                            <th>Ukuran</th>
                            <th>Jumlah</th>
                        </tr>
                        </thead>
                        <tbody id="sizedetail"></tbody>
                        </table>
                    </div>

                    <div id="tabs5">
                        <div class="form-group">
                            <label for="color">Warna </label>
                            <input type="text" name="color" id="color" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="jmlcolor">Jumlah</label>
                            <input type="text" name="jmlcolor" id="jmlcolor" class="form-control" >
                            <input type="hidden" name="totcolor" id="totcolor" >
                        </div>
                        <hr>
                            <button name="tambahwarna" id="tambahwarna" type="button"><i class="fa fa-plus"></i> Tambah</button>
                        <hr>
                        <table class="table">
                        <thead>
                        <tr>
                            <th>Warna</th>
                            <th>Jumlah</th>
                        </tr>
                        </thead>
                        <tbody id="colordetail"></tbody>
                        </table>
                    </div>

                    <div id="tabs3">
                        <form id="myformfoto">
                        <div class="form-group">
                            <label for="userfile">Unggah Foto</label>
                            <input type="file" name="userfile" id="userfile" accept="image/*" ><br>
                            <input type="hidden" name="prodcode" id="prodcode" value="">
                            <div class="progress">
                                <div class="bar progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div >
                                <div class="percent">0%</div >
                            </div>
                            <br>
                        </div>
                        <div class="form-group">
                            <p class="text-info msg" id="message">adsasd asd ad asd ad asd ads</p>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-sm" name="uploadfoto" id="uploadfoto" ><i class="fa fa-upload"></i> Unggah</button>
                            
                        </div><br>
                        
                        <br>
                        <div class="row">
                            <div class="col-md-3" align="center" style="margin-bottom:5px;">
                                <img id="imgproduk" class="img-responsive" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" style="height: 100px;">
                            </div>
                        </div>
                        </form>
                    </div>

                </div> <!-- Block Tabs -->

            </div><!-- ENd modal body -->
            
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="save" id="save" >Simpan</button>
                <button type="button" class="btn btn-default" name="close" id="close" ><i class="fa fa-power"></i> Keluar</button>
            </div>
        </div>
    </div>
</div>

<?php require("footer.php"); ?>