<?php
if($qry->num_rows() > 0){
	$r=$qry->row();
	$nama = $r->name;
	$tempat_lahir = $r->tempat_lahir;
	$tgl_lahir = date("d/m/Y", strtotime($r->tgl_lahir));
	$address = $r->address;
	if($r->jenis_kelamin == 'L'){
		$L = 'selected="selected"';
		$P = '';
	} else {
		$L = '';
		$P = 'selected="selected"';
	}
	$phone = $r->phone;
	$email = $r->email;
	$propinsi = $r->kode_propinsi;
	$kota = $r->kode_kota;
	$kecamatan = $r->kode_kec;

}
?>
<form action="<?php echo base_url() ?>memberarea/saveprofile" method="post">
	<div class="form-group">
		<label>Nama lengkap</label>
		<input type="text" name="nama" id="nama" class="form-control" required="required" value="<?php echo $nama ?>">
		
	</div>
	<div class="form-group">
		<label>Tempat Lahir</label>
		<input type="text" name="tmp_lahir" id="tmp_lahir" class="form-control" required="required" value="<?php echo $tempat_lahir ?>">
	</div>
	<div class="form-group">
		<label>Tanggal Lahir</label>
		<input type="text" name="tgl_lahir" id="tgl" class="form-control" value="<?php echo $tgl_lahir ?>">
	</div>
	<div class="form-group">
		<label>Jenis Kelamin</label>
		<select name="jk" id="jk" class="form-control">
			<option value="">[Pilih]</option>
			<option value="L" <?php echo $L ?> >Pria</option>
			<option value="P" <?php echo $P ?> >Wanita</option>
		</select>
	</div>
	<div class="form-group">
		<label>Propinsi</label>
		<select name="prop" id="prop" class="form-control" onchange="getKota(this.value)">
			<option value="">[Pilih]</option>
			<?php
			$prop = $this->db->query("SELECT * FROM ss_propinsi");
			foreach ($prop->result_array() as $key) {
				if($key['kode_propinsi'] == $propinsi){
					$sel = 'selected="selected"';
				} else {
					$sel = '';
				}
				echo "<option value=\"".$key['kode_propinsi']."\" ".$sel.">".$key['nama_propinsi']."</option>";
			}
			?>
		</select>
	</div>
	<div class="form-group">
		<label>Kab. / Kota</label>
		<select name="kota" id="kota" class="form-control">
			<option value="<?php echo $kota ?>"><?php echo $r->nama_kota ?></option>
			<option value="">[Pilih]</option>
		</select>
	</div>
	<div class="form-group">
		<label>Kecamatan</label>
		<select name="kec" id="kec" class="form-control">
			<option value="<?php echo $kecamatan ?>"><?php echo $r->nama_kecamatan ?></option>
			<option value="">[Pilih]</option>
		</select>
	</div>
	<div class="form-group">
		<label>Alamat</label>
		<input type="text" name="alamat" id="alamat" class="form-control" required="required" value=""><?php echo $address ?>
	</div>
	<div class="form-group">
		<label>Telp.</label>
		<input type="text" name="telp" id="telp" class="form-control" required="required" value="<?php echo $phone ?>">
	</div>
	<div class="form-group">
		<label>Email</label>
		<input type="email" name="email" id="email" class="form-control" required="required" value="<?php echo $email ?>">
	</div>
	<div class="form-group">
		<button class="btn btn-default"><i class="fa fa-save"></i> Simpan</button>
	</div>
</form>


<script type="text/javascript">
	$("#tgl").datepicker({format: "dd/mm/yyyy"});

	function getKota(kode){
		$.getJSON("<?php echo base_url() ?>register/getkota", {prop: kode}, function(json){
			if(json.length >0){
				$("#kota").html('<option value="<?php echo $kota ?>"><?php echo $r->nama_kota ?></option>').append("<option value=''>[Pilih]</option>");
				$.each(json, function(i,v){
					var str = '<option value="'+v.kode_kota+'">'+v.nama_kota+'</option>';
					$("#kota").append(str);
				});
			}
		})
	}
</script>