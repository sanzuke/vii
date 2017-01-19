<?php require("header.php"); ?>
<script type="text/javascript">

    function loadDataEdit(){
        var id = '<?php echo $this->uri->segment(3); ?>';
        if( id !== "" ){
            $.getJSON("<?php echo base_url();?>admproducts/geteditdata", {productcode : id }, function(data){
                var value ='';
                if(data.length > 0){
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
                        $("#diskon").val(value.diskon);
                        $("#description").val(value.description);

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
                    loadsizeproduct(id);
                    loadcolorproduct(id);
                    $("#tabs").tabs({disabled:false})
                }
            });
            //$("#myModal").modal("show");
            //$("#uploadfoto").removeAttr("disabled");
            
        }
    }
    
    function savesizeproduct(){
        var id = $("#productcode").val();
        var postdata = {
            productcode : id,
            size : $("#size").val(),
            jumlah : $("#jmlsize").val()
        };
        $.post("<?php echo base_url();?>admproducts/savesizeproduct/", postdata, function(data){
            //alert(data);
            loadsizeproduct(id);
        })
    }

    function loadsizeproduct(id){
        $("#sizedetail").html('');
        var tot = 0;
        $.getJSON("<?php echo base_url();?>admproducts/loadsizeproduct/", {productcode : id}, function(data){
            
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
        $.post("<?php echo base_url();?>admproducts/savecolorproduct/", postdata, function(data){
            //alert(data);
            loadcolorproduct(id);
        })
    }

    function loadcolorproduct(id){
        $("#colordetail").html('');
        totcolor = 0;
        $.getJSON("<?php echo base_url();?>admproducts/loadcolorproduct/", {productcode : id}, function(data){
            
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

    function delData(id){
        var psn = confirm("Anda yakin akan menghapus?");
        if(psn == true){
            $.post("<?php echo base_url();?>admproducts/deldata/", {productcode : id }, function(data){
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
        $("#datadetail").html('<img src="img/ajax-loader.gif" />');
        $.getJSON("<?php echo base_url();?>admproducts/getdatalist/", function(data){
            var value ='';
            if(data !== 'null'){
                $("#datadetail").html('');
                var x = 1;
                for (var i = 0; i <= data.length; i++) {
                    value = data[i];

                    var str = '<tr>'+
                                '<td>'+ x +'</td>'+
                                '<td>'+ value.productcode +'<input type="hidden" name="id'+x+'" id="id'+x+'" value="'+value.productcode+'" /></td>'+
                                '<td>'+ value.productname +'</td>'+
                                '<td>'+ value.stock +'</td>'+
                                '<td>'+ value.price +'</td>'+
                                '<td>'+ value.sale +'</td>'+
                                '<td><button type="button" name="edit" id="edit" class="btn btn-info btn-sm" onclick="editData(\''+value.productcode+'\')" >Edit</button></td>'+
                                '<td><button type="button" name="del" type="button" id="del" class="btn btn-danger btn-sm" onclick="delData(\''+value.productcode+'\')" >Delete</button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
                };
            }
        });
    }

    function searchDataDetail(id){
        $("#datadetail").html('<img src="img/ajax-loader.gif" />');
        $.getJSON("<?php echo base_url();?>admproducts/searchdatalist/", {productname : id}, function(data){
            var value ='';
            if(data !== 'null'){
                $("#datadetail").html('');
                var x = 1;
                for (var i = 0; i <= data.length; i++) {
                    value = data[i];

                    var str = '<tr>'+
                                '<td>'+ x +'</td>'+
                                '<td>'+ value.productcode +'<input type="hidden" name="id'+x+'" id="id'+x+'" value="'+value.productcode+'" /></td>'+
                                '<td>'+ value.productname +'</td>'+
                                '<td>'+ value.stock +'</td>'+
                                '<td>'+ value.price +'</td>'+
                                '<td>'+ value.sale +'</td>'+
                                '<td><button type="button" name="edit" id="edit" class="btn btn-info btn-sm" onclick="editData(\''+value.productcode+'\')" >Edit</button></td>'+
                                '<td><button type="button" name="del" type="button" id="del" class="btn btn-danger btn-sm" onclick="delData(\''+value.productcode+'\')" >Delete</button></td>'+
                              '</tr>';

                    $("#datadetail").append(str);
                    x++;
                };
            }
        });
    }

    $(document).ready(function(){
        // load data edit jika id ada
        loadDataEdit();
        // upload foto 
        var options = { 
            url     : "<?php echo base_url();?>admproducts/uploadfoto/",
            type : "POST",
            data    :'&code='+$("#productcode").val(),
            //data    :'&code='+$("#productcode").val(),
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
                //$("#message").html("<font color='green'>"+response.responseText+"</font>");
                $(".msg").html("<font color='green'>"+response.responseText+"</font>");
                $(".msg").css("display","block");
                $("#tabs").tabs({ disabled: false });
                $(window).scrollTop(0)
            },
            error: function()
            {
                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");
            }
        }
        //$("#myformfoto").ajaxForm(options);
        $("#myform").ajaxForm(options);

        document.getElementById("userfile").onchange = function () {
            var reader = new FileReader();

            reader.onload = function (e) {
                // get loaded data and render thumbnail.
                document.getElementById("imgproduk").src = e.target.result;
            };

            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);
        };
        /*$("#myform").submit(function(){
            if($("#productcode").val() !== "" &&  $("#productname").val() !== "" && $("#categorycode").val() !== "" && $("#price").val() !== "" && $("#sale").val() !== ""){
                var postdata = {
                    productcode : $("#productcode").val(),
                    productname : $("#productname").val(),
                    categorycode : $("#categorycode").val(),
                    suppliercode : $("#suppliercode").val(),
                    stock      : $("#stock").val(),
                    price      : $("#price").val(),
                    sale      : $("#sale").val(),
                    description      : $("#description").val()
                }
                $.post("<?php echo base_url();?>admproducts/savedata/", $(this).serialize() , function(data){
                    $("#uploadfoto").trigger("click");
                    alert(data);
                    //loadDataDetail();
                    //location.reload(true);
                });
            } else {
                alert("Field tidak boleh kosong")
            }
            return false;
        });*/

        
        //$("#myformfoto").ajaxForm(options);

        $("#add").click(function(){
            $("input").val('')
            $("select").val('');
            $("#productcode").removeAttr("readonly");
            $("#productcode").focus();
            $("#myModal").modal("show");
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

        $("#tabs").tabs({ disabled: [1, 2, 3, 4] });

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
                <div class="alert alert-success msg" style="display:none;"></div>
                <form id="myform" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Tambah Produk</h4></div>
                    <div class="panel-body">
                        <div id="tabs">
                            <ul>
                                <li class="1"><a href="#tabs1">Umum</a></li>
                                <li class="2"><a href="#tabs2">Ukuran</a></li>
                                <li class="2"><a href="#tabs5">Warna</a></li>
                                <li class="3"><a href="#tabs3">Foto Produk</a></li>
                                <li class="4"><a href="#tabs4">SEO</a></li>
                            </ul>
                            
                            <!-- Tab 1 Umum -->
                            <div id="tabs1">
                                <div class="col-md-8">
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

                                    <!--<div class="form-group">
                                        <label for="poin">Poin</label>
                                        <input type="number" name="poin" id="poin" class="form-control" required >
                                    </div>-->
                                    <input type="hidden" name="poin" id="poin" class="form-control" value="1" >

                                    <div class="form-group">
                                        <label for="poin">Tampilkan Produk</label>
                                        <select name="publish" id="publish" class="form-control">
                                            <option value="">[ Pilih ]</option>
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="poin">Diskon</label>
                                        <input type="number" name="diskon" id="diskon" class="form-control" required >
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Keterangan</label>
                                        <input type="text" name="description" id="description" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                        <p class="text-info" id="message">adsasd asd ad asd ad asd ads</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" align="center" style="margin-bottom:5px;">
                                            <img id="imgproduk" class="img-responsive">
                                        </div>
                                    </div>

                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <!-- Tab SEO -->
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

                            <!-- Tab Ukuran -->
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

                            <!-- Tab Warna -->
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

                            <!-- Tab Unggah foto -->
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

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary" name="save" id="save" >Simpan</button>
                        
                    </div>
                </div>
                </form>
                </section><!-- /.content -->
                
            </aside><!-- /.right-side -->
<?php require("footer.php"); ?>