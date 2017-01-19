<?php require("header.php"); ?>
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    <?php echo  $TITLE; ?>
                    <small><?php echo  $SUBTITLE; ?></small>
                    </h1>
					<?php //echo  $BREADCRUMB; ?>
                   
                </section> 
                <!-- Main content -->
                
                <section class="content">
					<form role="form" id="myform" method="post">
					
						<div class="col-md-12">
							<div class="box box-primary">
								<div class="box-header"><h3 class="box-title">Generate Kupon</h3></div>
								<div class="box-body">
									<div class="form-group">
										<label>Kode</label>
										<input type="text" name="kode" id="kode" class="form-control">
									</div>
									<div class="form-group">
										<label>Keterangan</label>
										<input type="text" name="ket" id="ket" class="form-control">
									</div>

									<div class="form-group">
										<label>Awal Tanggal</label>
										<input type="text" name="startdate" id="datepicker" class="form-control datepicker">
									</div>

									<div class="form-group">
										<label>Akhir Tanggal</label>
										<input type="text" name="enddate" id="tgl" class="form-control">
									</div>
									<div class="form-group">
										<label>Diskon</label>
										<input type="text" name="diskon" id="diskon" class="form-control">
									</div>
									<div class="form-group">
										<label>Total Potongan</label>
										<input type="text" name="jumlah" id="jumlah" class="form-control">
									</div>
								</div>
								<div class="box-footer">
									<button type="submit" class="btn btn-primary" name="submit" id="submit" value="simpan" ><i class="fa fa-save"></i> Simpan</button>
								</div>
							</div>
						</div>

					</form>		

					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-body">
								<table class="table table-striped">
									<head>
										<tr>
											<th>Kode</th>
											<th>Keterangan</th>
											<th>Awal Tanggal</th>
											<th>Akhir Tanggal</th>
											<th>Diskon</th>
											<th>Jumlah Potongan</th>
										</tr>
									</head>
									<tbody>
										<?php
										foreach ($query->result_array() as $key) {
											echo '<tr>
													<td>'.$key['kodekupon'].'</td>
													<td>'.$key['nama'].'</td>
													<td>'.$key['startdate'].'</td>
													<td>'.$key['enddate'].'</td>
													<td>'.$key['diskon'].' %</td>
													<td>'.$key['jumlah'].'</td>
												</tr>';
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>	 
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->

<?php require("footer.php"); ?>
