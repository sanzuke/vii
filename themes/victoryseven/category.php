<?php require("header.php") ?>
	<br><br><br>
	<!-- <div class="row">
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
		  <li><a href="#">Kategori</a></li>
		  <li class="active">Sepatu</li>
		</ol>
	</div> -->
	
    <div class="row">
        <div class="well well-sm">
            <strong>Display</strong>
            <div class="btn-group">
                <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                    class="glyphicon glyphicon-th"></span>Grid</a>
            </div>
        </div>
    </div>

    <div class="row">
    <div id="products" class="row list-group">
        <?php
        $harga = 0;
        $coret = '&nbsp;';
        $disk  = '&nbsp;';
        $diskIcon = '';
        if(count($listlastproducts) >0 ){
            foreach ($listlastproducts as $key => $value) { ?>
            <?php 
                if($value['diskon'] == "0"){
                    $hrgDisk = 0;
                    $harga = number_format($value['sale']);
                    $coret = '&nbsp;';
                    $disk  = '&nbsp;';
                    $diskIcon = '';
                } else {
                    $hrgDisk = $value['sale'] - $value['diskon'];
                    $harga = number_format($value['sale']);
                    $coret = number_format($value['sale']);
                    $disk  = number_format($value['diskon']);
                    $diskIcon = '<div style="position:absolute; top:5px; right:5px; z-index:99999;"><span class="badge">Disc '.$disk.'</span></div>';
                }
        
        ?>
        <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
                <div style="height:20px;"></div>
                <img class="group list-group-image" src="<?php echo base_url().'uploads/'.$value['photo']; ?>" alt="<?php echo $value['productcode'] . ' - ' . $value['productname']; ?>" width="223" height="223" />
                <div class="caption" style="margin-left:12px; text-align:justify; padding-right:25px;">
                    <h1 class="group inner list-group-item-heading">
                        <?php echo $value['productname']  ?></h1>
                    <p class="group inner list-group-item-text">
                        <?php echo $value['description'] ?></p>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 pull-left " align="left">
                            <p style="font-size:18px;">Rp. <?php 
                            if( $hrgDisk != 0 ) { 
                                echo number_format($hrgDisk); 
                            } else { 
                                echo $harga;
                            } ?></p> 
                            <?php  if($hrgDisk != 0 ) { ?>
                            <p style="color:#999;"><strike>Rp. <?php echo $harga ?></strike>
                            <?php } else { $hrgDisk = str_replace(",","",$harga); } ?>
                            </p>
                        </div>
                        <div class="col-xs-12 col-md-6" align="right">
                            <div class="btn-group">
                                <a class="btn btn-info responsive-width" href="<?php echo base_url().'product/view/'.$value['productcode'].'/'. str_replace(" ","-", strtolower($value['productname'])).'.html' ?>"><i class="fa fa-search"></i> Lihat</a>
                                <a class="btn btn-success responsive-width" href="javascript:showModal('<?php echo  $value['productcode'] ?>','<?php echo  $value['productname'] ?>','<?php echo  $hrgDisk  ?>')">Beli <i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } 
        } ?>
    </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Pilih ukuran dan warna</h4>
          </div>
          <div class="modal-body">
            <input type="hidden" name="pcModal" id="pcModal">
            <input type="hidden" name="pnModal" id="pnModal">
            <input type="hidden" name="prModal" id="prModal">
            <div class="form-group">
                <label>Ukuran</label>
                <select name="ukuran" id="ukuran" class="form-control"></select>
            </div>
            <div class="form-group">
                <label>Warna</label>
                <select name="warna" id="warna" class="form-control"></select>
            </div>
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="beli()">Beli</button>
          </div>
        </div>
      </div>
    </div>

	</div>
	<script type="text/javascript">
        function beli(){
            var qty = 1;//$("#qty").val();
            var cl = $("#warna").val();
            var sz = $("#ukuran").val();
            var pc = $("#pcModal").val();
            var pn = $("#pnModal").val();
            var pr = $("#prModal").val();

            if(cl.length > 0 && sz.length > 0 ){
                $("#myModal").modal("hide");
                addtocart(pc,pn,pr,qty,sz,cl);               
            } else {
                alert("Isi dulu ukuran dan warna yang diinginkan");
            }
        }

        function showModal(pc,pn,pr){
            var qty = 1;//$("#qty").val();
            var cl = $("#color").val();
            var sz = $("#size").val();

            $("#pcModal").val(pc)
            $("#pnModal").val(pn)
            $("#prModal").val(pr)

            // load ukuran
            $.getJSON("<?php echo base_url() ?>category/getsize", {pc:pc}, function(json){
                if (json.length > 0){
                    $('#ukuran').html('<option value="">[Pilih]</option>')
                    $.each(json, function(i, val){
                        var str = '<option value="'+val.size+'">'+val.size+'</option>';
                        $("#ukuran").append(str);
                    })
                }
            })

            // load warna
            $.getJSON("<?php echo base_url() ?>category/getcolor", {pc:pc}, function(json){
                if (json.length > 0){
                    $('#warna').html('<option value="">[Pilih]</option>')
                    $.each(json, function(i, val){
                        var str = '<option value="'+val.color+'">'+val.color+'</option>';
                        $("#warna").append(str);
                    })
                }
            })

            //addtocart(pc,pn,pr,qty,sz,cl);
            $("#myModal").modal("show");
        }

        function addtocart(pc,pn,pr,qty,sz,cl){

            // var qty = 1;//$("#qty").val();
            // var cl = $("#color").val();
            // var sz = $("#size").val();
            // if(cl.length > 0 && sz.length > 0 ){
                $.post("<?php echo base_url() ?>cart/add", {product_id: pc, pn:pn, quantity :qty, pr:pr, size :sz, color:cl}, function(feedback){
                    //window.location.reload();
                    $("#cart-info").html(feedback);
                    $(".dropdown-toggle").dropdown('toggle');
                })
            // } else {
            //     alert("Isi dulu ukuran dan warna yang diinginkan");
            // }
        }
        $(document).ready(function() {
		    $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
		    $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});
		});
    </script>
<?php require("footer.php") ?>