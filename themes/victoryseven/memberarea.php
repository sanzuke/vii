<?php require("header.php") ?>
<br><br>
	<div class="col-md-12">
		<?php
		$msg = $this->session->flashdata("msg");
		if($msg != ""){
			?>
			<div class="alert alert-success" id="msg"><?php echo $msg ?></div>
			
		<?php	
		}
		?>
		<?php if(!$this->session->userdata("userlogin")){ //Cek jika session login user blm ada ?>
		<div class="panel panel-default">
			<div class="panel-heading"><h3>Login Area</h3></div>
			<div class="panel-body">
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
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<a onclick="$('#forgotpassModal').modal('show');">Lupa Password?</a>
				<a href="<?php echo base_url() ?>register" class="pull-right">Daftar Member</a>
			</div>
		</div>

		<!-- Begin Modal Dialog -->
		<div id="forgotpassModal" class="modal fade ">
	    	<div class="modal-dialog">
	        	<div class="modal-content">
	            	<div class="modal-header">
	            		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            		<h4>Lupa Password</h4>
	            	</div>
	            	<div class="modal-body">
	            		<form >
	            			<div class="form-group">
	            				<label>Email Anda</label>
	            				<input type="email" name="emailRecovery" id="emailRecovery" required="required" class="form-control">
	            			</div>
	            			<div class="form-group">
	            				<span class="label label-danger">Pastikan email yang anda masukan adalah email aktif.</span>
	            			</div>
	            			<div class="form-group">
	            				<button class="btn btn-default"><i class="fa fa-envelope"></i> Kirim</button>
	            			</div>
	            		</form>
	            	</div>
	            </div>
	        </div>
	    </div>
		<!-- End Modal Dialog -->
		<?php }  else {  ?>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Menu</h4></div>
				<ul class="list-group">
					<li class="list-group-item"><a href="<?php echo base_url() ?>memberarea">Beranda</a></li>
					<li class="list-group-item"><a href="<?php echo base_url() ?>memberarea/profile">Profil</a></li>
					<li class="list-group-item"><a href="<?php echo base_url() ?>memberarea/changepassword">Ubah Password</a></li>
					<li class="list-group-item"><a href="<?php echo base_url() ?>memberarea/order">Pesanan</a></li>
					<li class="list-group-item"><a href="<?php echo base_url() ?>memberarea/history">History Transaksi</a></li>
					<li class="list-group-item"><a href="<?php echo base_url() ?>memberarea/logout">Logout</a></li>
				</ul>
			</div>
		</div>
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading"><h4><?php echo $judulHalaman ?></h4></div>
				<div class="panel-body">
					<?php echo $contents ?>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<?php require("footer.php") ?>