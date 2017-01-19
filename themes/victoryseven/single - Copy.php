<?php require("header.php") ?>
<style type="text/css">
	.thumbnails li {
	display: inline-block;
	width: 100px;
	margin: 0 5px;
}

.thumbnails img {
	display: block;
	min-width: 100%;
	max-width: 100%;
}
</style>
<?php
foreach ($productdetail as $key => $row) {
    # code...
    $photo = base_url() . 'uploads/'.$row['photo'];
    $thumb = explode(".",$row['photo']);
    $photothumb = base_url() . 'uploads/thumb/'.$thumb[0] .'_thumb.'.$thumb[1];
    $productcode = $row['productcode'];
    $productname = $row['productname'];
    $price = $row['sale'];
    $stock = $row['stock'];
    $min_stock = $row['min_stock'];
    $description = $row['description'];
    $poin = $row['poin'];
    $namakategori = $row['namakategori'];
    $diskon = $row['diskon'];
    if($row['diskon'] != '0'){
    	$hrgDisk = $row['sale'] - $row['diskon'];
    } else {
    	$hrgDisk = $row['sale'];
    }
}
?>
	<br><br>
	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home"></i></a></li>
		  <li><a href="#">Kategori</a></li>
		  <li><a href=""><?php echo ucwords( strtolower($namakategori)) ?></a></li>
		  <li class="active"><?php echo $productname ?></li>
		</ol>
		
		<!--<div id="bc1" class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-default"><i class="fa fa-home"></i></a>
            <a href="#" class="btn btn-default"><div>Product</div></a>
            <a href="#" class="btn btn-default"><div>Category</div></a>
        </div>-->
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div style="padding: 10px; text-align: center;">
				<h1 class="big-title"><?php echo $productname ?></h1>
				<h3 class="md-title"><?php echo $namakategori ?></h3>
			</div>

			<div align="center" class="col-md-12">
				<!-- Placeholder for demo purposes only -->
				<!-- <div style="float: right; width: 310px; height: 400px; background: #EEE;"></div> -->
				<div class="easyzoom easyzoom--adjacent">
					<a href="<?php echo $photo ?>" class="item">
						<img id="zoom_01" src="<?php echo $photothumb ?>" data-zoom-image="<?php echo $photo ?>" >
					</a>
				</div>
				<br><br>
				<ul class="thumbnails">
				<?php
					foreach ($otherimg->result_array() as $key => $value) {
						$pathThumb = base_url() . 'uploads/thumb/'.$value['image'];
						$path = base_url() . 'uploads/'.$value['image'];
						echo '<li><a href="'.$path.'" data-standard="'.$path.'"><img src="'.$pathThumb.'" class="thumbnail" ></a></li>';
					}
				?>
				</ul>
			</div>
			<br>
			<div class="col-md-12">
				<div align="center">
				
				</div>
			</div>
			
			<br>
			<div align="center">
			 	<p style="width:50%;"><?php echo $description ?></p>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<h1><?php echo $productname ?></h1>
						<h2>RP. <?php echo number_format($hrgDisk) ?>,-</h2>
						<?php if($diskon != '0'){ ?>
						<h4><strike>RP. <?php echo number_format($price); ?></strike></h4>
						<?php } ?>
						<form>
							<div class="form-group">
								<label>Quantity</label>
								<input type="number" name="qty" id="qty" placeholder="0" class="form-control" required="required">
							</div>
							<div class="form-group">
								<label>Ukuran</label>
								<select class="form-control" name="size" id="size">
									<option value=""> [ Pilih Ukuran ]</option>
									<?php foreach ($size as $value) {
										echo '<option value="'.$value['size'].'">'.$value['size'].'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Warna</label>
								<!--<button class="btn btn-default btn-sm" type="button" title="gray">&nbsp;</button>
								<button class="btn btn-primary btn-sm" type="button" title="blue">&nbsp;</button>
								<button class="btn btn-danger btn-sm" type="button" title="maroon">&nbsp;</button>
								<button class="btn btn-info btn-sm" type="button" title="soft blue">&nbsp;</button>
								<button class="btn btn-success btn-sm" type="button" title="green">&nbsp;</button>-->
								<select class="form-control" name="color" id="color">
									<option value=""> [ Pilih Warna ]</option>
									<?php foreach ($color as $value) {
										echo '<option value="'.$value['color'].'">'.$value['color'].'</option>';
									}
									?>
								</select>
							</div>
						</form>
						<button class="btn btn-lg btn-primary" onclick="addtocart('<?php echo $productcode ?>','<?php echo $productname ?>','<?php echo $hrgDisk ?>')" ><i class="fa fa-shopping-cart"></i> Beli</button>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		
	</div>
	</div>
	<script type="text/javascript">

        function addtocart(pc,pn,pr){

            var qty = $("#qty").val();
            var cl = $("#color").val();
            var sz = $("#size").val();
            $.post("<?php echo base_url() ?>cart/add", {product_id: pc, pn:pn, quantity :qty, pr:pr, size :sz, color:cl}, function(feedback){
                //window.location.reload();
                $("#cart-info").html(feedback);
                $(".dropdown-toggle").dropdown('toggle');
            })
             //e.stopPropagation();
    		//$(".btn").find('[data-toggle=dropdown]').dropdown('toggle');
    		
            /*var cart = $('.fa-shopping-cart');
	        var imgtodrag = $(".easyzoom").parent('.item').find("img").eq(0);
	        if (imgtodrag) {
	            var imgclone = imgtodrag.clone()
	                .offset({
	                top: imgtodrag.offset().top,
	                left: imgtodrag.offset().left
	            })
	                .css({
	                'opacity': '0.5',
	                    'position': 'absolute',
	                    'height': '150px',
	                    'width': '150px',
	                    'z-index': '100'
	            })
	                .appendTo($('body'))
	                .animate({
	                'top': cart.offset().top + 10,
	                    'left': cart.offset().left + 10,
	                    'width': 75,
	                    'height': 75
	            }, 1000, 'easeInOutExpo');
	            
	            setTimeout(function () {
	                cart.effect("shake", {
	                    times: 2
	                }, 200);
	            }, 1500);

	            imgclone.animate({
	                'width': 0,
	                    'height': 0
	            }, function () {
	                $(".easyzoom").detach()
	            });
	        }*/
        }

        $("#zoom_01").elevateZoom();
		// Instantiate EasyZoom instances
		// var $easyzoom = $('.easyzoom').easyZoom();

		// // Setup thumbnails example
		// var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		// $('.thumbnails').on('click', 'a', function(e) {
		// 	var $this = $(this);

		// 	e.preventDefault();

		// 	// Use EasyZoom's `swap` method
		// 	api1.swap($this.data('standard'), $this.attr('href'));
		// });

		// // Setup toggles example
		// var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		// $('.toggle').on('click', function() {
		// 	var $this = $(this);

		// 	if ($this.data("active") === true) {
		// 		$this.text("Switch on").data("active", false);
		// 		api2.teardown();
		// 	} else {
		// 		$this.text("Switch off").data("active", true);
		// 		api2._init();
		// 	}
		// });
    </script>
	<?php require("footer.php") ?>