<?php
require("header.php");
$productcode = "";
$productname = "";
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
$getPrev = $this->db->query("SELECT * FROM um_productpreview WHERE productcode = '{$productcode}' ORDER BY seq ASC");

?>
	<!-- <br><br>
	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home"></i></a></li>
		  <li><a href="#">Produk</a></li>
		  <li><a href="">Ulasan</a></li>
		  <li class="active"><?php echo $productname ?></li>
		</ol>
	</div> -->

	<div class="row">
		<div class="col-md-12">
			<!-- <div style="padding: 10px; text-align: center;">
				<h1 class="big-title"><?php echo $productname ?></h1>
			</div> -->
			<?php
			$i = 1;
			foreach ($getPrev->result_array() as $key => $value) {
				$dump = explode("-", $value['text-pos']);
				$txt_align = $dump[1];
				switch ($value['text-pos']) {
					case 'top-left':
						$css_txt_pos = 'caption-preview-top-left';
					break;
					case 'top-center':
						$css_txt_pos = 'caption-preview-top-center';
					break;
					case 'top-right':
						$css_txt_pos = 'caption-preview-top-right';
					break;
					case 'center-left':
						$css_txt_pos = 'caption-preview-center-left';
					break;
					case 'center-center':
						$css_txt_pos = 'caption-preview-center-center';
					break;
					case 'center-right':
						$css_txt_pos = 'caption-preview-center-right';
					break;
					case 'bottom-left':
						$css_txt_pos = 'caption-preview-bottom-left';
					break;
					case 'bottom-center':
						$css_txt_pos = 'caption-preview-bottom-center';
					break;
					case 'bottom-right':
						$css_txt_pos = 'caption-preview-bottom-right';
					break;
					default :
						$css_txt_pos = 'caption-preview-top-left';
					break;
				}
				if($i == 1){
			?>
			<div class="row" style="position:relative">
				<div class="<?php echo $css_txt_pos ?>">
					<h1><?php echo $value['judul'] ?></h1>
					<p><?php echo $value['text'] ?></p>
				</div>
				<img src="<?php echo base_url() ?>uploads/preview/<?php echo $value['image'] ?>" class="img-responsive" width="100%">
			</div>

			<div align="center">
			 	<h1>Keuntungan : </h1>
			</div>
			<?php
			} else {
				if($value['kolom'] == '2'){
					if($txt_align == 'right'){
			?>
					<div class="row" style="position:relative">
						<div class="col-md-8" style="padding-right:0px;" >
							<img src="<?php echo base_url() ?>uploads/preview/<?php echo $value['image'] ?>" class="img-responsive" width="100%" style="">
						</div>
						<div class="col-md-4" style="padding-right:0px;">
							<div class="<?php echo $css_txt_pos ?>" >
								<h1><?php echo $value['judul'] ?></h1>
								<p><?php echo $value['text'] ?></p>
							</div>
						</div>
					</div>

			<?php
					} else {
						?>
						<div class="row" style="position:relative">
							<div class="col-md-4" style="padding-right:0px;">
								<div class="<?php echo $css_txt_pos ?>" >
									<h1><?php echo $value['judul'] ?></h1>
									<p><?php echo $value['text'] ?></p>
								</div>
							</div>
							<div class="col-md-8" style="padding-right:0px;" >
								<img src="<?php echo base_url() ?>uploads/preview/<?php echo $value['image'] ?>" class="img-responsive" width="100%" style="">
							</div>
						</div>
						<?php
					}
				} else {
					?>
					<div class="row" style="position:relative">
						<div class="<?php echo $css_txt_pos ?>" >
							<h1><?php echo $value['judul'] ?></h1>
							<p><?php echo $value['text'] ?></p>
						</div>
						<img src="<?php echo base_url() ?>uploads/preview/<?php echo $value['image'] ?>" class="img-responsive" width="100%"  >
					</div>
					<?php
				}
			}
			$i++;
			} ?>
			<br>
			<center>
				<button class="btn btn-default" type="button" id="beli"><i class="fa fa-shopping-cart fa-3x"></i> Beli</button>
			</center>

		</div>

	</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".container").removeClass("container");
      $("#beli").click(function(){
        window.location = "<?php echo base_url() ."product/view/".$productcode."/".str_replace(" ", "_", $productname) ?>";
      });
		});
	</script>
	<style type="text/css">
		.row{
			padding: 0;
			margin:0;
		}
		.col-md-12 {
			padding: 0;
			margin:0;
		}
	</style>
	<?php require("footer.php") ?>
