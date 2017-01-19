<?php 
	$controler = $this->uri->segment("1"); 
	if($controler == ""){
		$container = '<div class="containerx">';
		$css_reset = '<link rel="stylesheet" href="' . base_url() . 'themes/victoryseven/css/reset.css">';
	} else {
		$container = '<div class="container">';
		$css_reset = '';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $sitename ?></title>
	<link href="<?php echo base_url() . 'themes/victoryseven/' ?>css/bootstrap.css" rel="stylesheet">
    <!--<link href="<?php echo base_url() . 'themes/victoryseven/' ?>css/bootstrap-responsive.min.css" rel="stylesheet">-->
    <link href="<?php echo base_url() . 'themes/victoryseven/' ?>css/easyzoom.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'themes/victoryseven/' ?>css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'themes/victoryseven/' ?>css/yamm.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'themes/victoryseven/' ?>css/custom.css">
	<script type="text/javascript" src="<?php echo base_url() . 'themes/victoryseven/' ?>js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'themes/victoryseven/' ?>plugin/datepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'themes/victoryseven/' ?>js/bootstrap.js"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'themes/victoryseven/' ?>js/main.js"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'themes/victoryseven/' ?>js/jquery.elevatezoom.js"></script>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>

	<?php //echo $css_reset ?><!-- CSS reset -->
	<link rel="stylesheet" href="<?php echo base_url() . 'themes/victoryseven/' ?>css/one-page-wonder.css">
	<link rel="stylesheet" href="<?php echo base_url() . 'themes/victoryseven/' ?>css/style.css"> <!-- Resource style -->
	<link rel="stylesheet" href="<?php echo base_url() . 'themes/victoryseven/' ?>plugin/datepicker/datepicker3.css">
	<link rel="icon" type="icon/png" href="<?php echo base_url() . 'themes/victoryseven/' ?>assets/favicon.png">
	<script src="<?php echo base_url() . 'themes/victoryseven/' ?>js/modernizr.js"></script> <!-- Modernizr -->

	<!--<style type="text/css">
		.nav > li.dropdown.open {
		    position: static;
		}
		.nav > li.dropdown.open .dropdown-menu {
		    display:table; width: 100%; text-align: center; left:0; right:0;
		}
		.dropdown-menu>li {
		    display: table-cell;
		}
	</style>-->
</head>
<body style="background-color: #F2F2F2">

<?php echo $container ?>
	<nav class="yamm navbar navbar-inverse navbar-fixed-top">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="<?php echo base_url() ?>" alt=""><img src="<?php echo base_url() . 'themes/victoryseven/' ?>assets/logo.png" width="45" style="position: relative; top:-5px;"></a>
	    </div>


	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      	      
	      <ul class="nav navbar-nav navbar-right">
	      	<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"> <span class="caret"></span></i></a>
	      		<ul class="dropdown-menu">
	        		<li>
	        			<div class="yamm-content">
	        				<?php if(!$this->session->userdata("userlogin")){ ?>
		        			<form id="loginmember" action="<?php echo base_url() ?>memberarea/auth" method="post">
		        				<div class="form-group">
		        					<label>Username</label>
		        					<input type="text" name="username" id="username" class="form-control">
		        				</div>
		        				<div class="form-group">
		        					<label>Password</label>
		        					<input type="password" name="password" id="password" class="form-control">
		        				</div>
		        				<div class="form-group">
		        					<button class="btn btn-primary"><i class="fa fa-sign-in"></i> Login</button>
		        					<a class="btn btn-success pull-right" href="<?php echo base_url() ?>register"><i class="fa fa-user-plus"></i> Daftar</a>
		        				</div>
		        			</form>
		        			
		        			<?php }  else {  ?>
		        				<div class="btn-group">
	        						<a href="<?php echo base_url() ?>memberarea" class="btn btn-default" ><i class="fa fa-user"></i> Member Area</a>
	        						<a href="<?php echo base_url() ?>memberarea/order" class="btn btn-default" ><i class="fa fa-shopping-cart"></i> Pesanan</a>
	        						<a href="<?php echo base_url() ?>memberarea/history" class="btn btn-default" ><i class="fa fa-history"></i> History</a>
	        						<a href="<?php echo base_url() ?>memberarea/logout" class="btn btn-default" ><i class="fa fa-sign-out"></i> Logout</a>
	        					</div>
		        			<?php } ?>
	        			</div>
	        		</li>
	        	</ul>
	      	</li>
	      </ul>

	      <ul class="nav navbar-nav" style="text-align:center">
	      	<?php foreach ($listNavCategory as $key => $value) { 
	      		$subMenu = $this->core->listNavSubCategory($value['categorycode']); 
	      		if( count($subMenu->result_array()) < 1){
	      		?>
            	<li><a href="<?php echo $value['uri_category'] ?>"><span><?php echo $value['categoryname'] ?></span></a></li>
            	<?php
            	} else {
            		?>
            		<li class="dropdown">
            			<a href="<?php echo $value['uri_category'] ?>" class="dropdown-toggle" data-toggle="dropdown" ><span><?php echo $value['categoryname'] ?></span> <span class="caret"></span></a>
            			<ul class="dropdown-menu">
            			<?php
            				$strUrlReplace = array ('&',' ','#');
            				foreach ($subMenu->result_array() as $key) {
            				 	$title = str_replace($strUrlReplace, "-", strtolower($key['categoryname']) ) . ".html";
            				 	$link = base_url().'category/view/'.$key['categorycode'] .'/'.$title; 
            				 	?>
            				 	<li><a href="<?php echo $link ?>"><span><?php echo $key['categoryname'] ?></span></a></li>
            				 	<?php
            				 }
            			?>
            			</ul>
            		</li>
            		<?php
            	}
            	?>
            <?php } ?> 
	      </ul>


	      <ul class="nav navbar-nav navbar-right">

	        
            
	        <li class="dropdown">
	        	<?php
	        	$jml = count($this->cart->contents() );
	        	if($jml > 0){
	        		$badge = '<span class="badge">'.$jml.'</span>';
	        	} else {
	        		$badge = '';
	        	}
	        	?>
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-cart" id="countcart"> <?php echo $badge ?> <span class="caret"></span></i></a>
	        	<ul class="dropdown-menu">
	        		<li>
	        			<div class="yamm-content" id="cart-info">   		
	        				<?php
	        				$checkout = $this->uri->segment("1");
						    if($checkout != 'checkout'){
						      
					            $t = 0;
					            foreach ($this->cart->contents() as $items){
					                $t+= $items['subtotal'];
					            }
					            $isi['countitem'] = count($this->cart->contents());
					            $isi['total'] = $this->cart->format_number($t);
					            echo $this->load->view('cart', $isi, true); 
					        }
	        				?>		
	        			</div>
	        		</li>
	      		</ul>
	      </li>
	      </ul>
	      <!--<form class="navbar-form navbar-right" role="search">
	        <div class="form-group">
	        	<div class="input-group">
	          		<input type="text" class="form-control" placeholder="Search">
	          		<div class="input-group-btn">
	          			<button type="submit" class="btn btn-default"> <i class="fa fa-search"></i></button>
	          		</div>
	          	</div>
	        </div>
	      </form>-->
	    </div><!-- /.navbar-collapse -->

	  </div><!-- /.container-fluid -->
	</nav>
	