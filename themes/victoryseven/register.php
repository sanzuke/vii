<?php require("header.php") ?>
<br><br>
	<div class="row">
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url() ?>"><i class="fa fa-home"></i></a></li>
		  <li><a href="#">Register</a></li>
		  <li class="active">Daftar</li>
		</ol>
	</div>
	<br>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading"><h3>Register</h3></div>
			<div class="panel-body">
				<?php $msg = $this->session->flashdata("msg");
				if($msg != ""){
				?>
				<div class="alert alert-danger" id="msg"><?php echo $msg ?></div>
				<?php } else  {?>
				<form id="loginmember" action="<?php echo base_url() ?>register/save" method="post">
					<div class="form-group">
						<label>Nama lengkap</label>
						<input type="text" name="nama" id="nama" class="form-control" required="required">
						
					</div>
					<div class="form-group">
						<label>Tempat Lahir</label>
						<input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label>Tanggal Lahir</label>
						<input type="text" name="tgl_lahir" id="tgl" class="form-control">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select name="jk" id="jk" class="form-control">
							<option value="">[Pilih]</option>
							<option value="L">Pria</option>
							<option value="P">Wanita</option>
						</select>
					</div>
					<div class="form-group">
						<label>Propinsi</label>
						<select name="prop" id="prop" class="form-control" onchange="getKota(this.value)">
							<option value="">[Pilih]</option>
							<?php
							$prop = $this->db->query("SELECT * FROM ss_propinsi");
							foreach ($prop->result_array() as $key) {
								echo "<option value=\"".$key['kode_propinsi']."\">".$key['nama_propinsi']."</option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Kab. / Kota</label>
						<select name="kota" id="kota" class="form-control">
							<option value="">[Pilih]</option>
						</select>
					</div>
					<div class="form-group">
						<label>Kecamatan</label>
						<select name="kec" id="kec" class="form-control">
							<option value="">[Pilih]</option>
						</select>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" name="alamat" id="alamat" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label>Telp.</label>
						<input type="text" name="telp" id="telp" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" required="required">
					</div>
					<div class="form-group">
						<?php
						$vals = array(
						    'img_path'	=> './captcha/',
						    'img_url'	=> base_url() . 'captcha/'
						    );

						$cap = create_captcha($vals);

						$data = array(
						    'captcha_time'	=> $cap['time'],
						    'ip_address'	=> $this->input->ip_address(),
						    'word'	=> $cap['word']
						    );

						$query = $this->db->insert_string('captcha', $data);
						$this->db->query($query);

						echo '<label>Submit the word you see below:</label>';
						echo $cap['image'];
						echo '<br>';
						echo '<input type="text" name="captcha" id="captcha" value="" class="form-control" required="required" />';
						?>
						
					</div>
					<hr>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" id="username" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="Password" name="password" id="password" class="form-control" required="required">
					</div>
					<div class="form-group">
						<label>Password Lagi</label>
						<input type="Password" name="password2" id="password2" class="form-control" required="required">
					</div>
				
			</div>
			<div class="panel-footer">
				<button class="btn btn-default"><i class="fa fa-user-plus"></i> Daftar</button>
			</div>
			</form>
			<?php } ?>
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
		
	</div>
</div>
<script type="text/javascript">
	$("#tgl").datepicker({format: "dd/mm/yyyy"});

	function getKota(kode){
		$.getJSON("<?php echo base_url() ?>register/getkota", {prop: kode}, function(json){
			if(json.length >0){
				$("#kota").html('').append("<option value=''>[Pilih]</option>");
				$.each(json, function(i,v){
					var str = '<option value="'+v.kode_kota+'">'+v.nama_kota+'</option>';
					$("#kota").append(str);
				});
			}
		})
	}
</script>
<?php require("footer.php") ?>