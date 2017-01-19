<?php require("header.php") ?>
	<div id="myCarousel" class="carousel slide" data-ride="carousel"> 
  <!-- Indicators -->
  <?php $banner = $this->db->query("SELECT * FROM ss_banner WHERE publish = '1'"); ?>
  <ol class="carousel-indicators">
  	<?php 
  	$dd=0;
  	foreach ($banner->result_array() as $key) { 
  		if($dd == 0){
  			$act = 'class="active"';
  		} else {
  			$act ='';
  		}
  	?>
    <li data-target="#myCarousel" data-slide-to="<?php echo $dd ?>"  <?php echo $act ?> ></li>
    <?php $dd++; } ?>
  </ol>

  <div class="carousel-inner">
  	<?php
  	$x = 1;
  	foreach ($banner->result_array() as $key => $value) {
		if($x == 1){
			$sel = 'class="selected"';
		} else {
			$sel = '';
		}

		$link = explode("|",$value['link']);
		$judul = explode("|",$value['judul']);

		if($x == 1){
  			$active = 'active';
  		} else {
  			$active ='';
  		}
  	?>
    <div class="item <?php echo $active ?>"> 
    	<img src="<?php echo base_url() . 'uploads/banner/' . $value['foto'] ?>" style="width:100%" alt="<?php echo $judul[0] ?>">
        <div class="carousel-caption">
          <h1><?php echo $value['title'] ?></h1>
          <p><?php echo $value['keterangan'] ?></p>
          	<p><?php
          	$jml = count($link);
			if($jml > 1){
			?>
				<a href="<?php echo $link[0] ?>" class="btn btn-lg btn-primary" role="button"><?php echo $judul[0] ?></a>
				<a href="<?php echo $link[1] ?>" class="btn btn-lg btn-success" role="button"><?php echo $judul[1] ?></a>
			<?php } else {?>
				<a href="<?php echo $link[0] ?>" class="btn btn-lg btn-primary"><?php echo $judul[0] ?></a>
			<?php } ?>
          </p>
        </div>

    </div>
    <?php $x++; } ?>
    
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a> <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a> 
 </div>

	
	<main class="cd-main-content" >
		<div class="col-md-12">
			<?php echo $mainpageContent ?>
		</div>
	</main> <!-- .cd-main-content -->

	<?php require("footer.php") ?>