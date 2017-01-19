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
					
						<div class="col-md-8">
							<div class="box box-primary">
								<div class="box-header"><h3 class="box-title">Pengaturan SMS Gateway</h3></div>
								<div class="box-body">
									<div class="form-group">
										<label>Link</label>
										<input type="text" name="link" id="link" class="form-control" value="<?php echo $getLink ?>">
									</div>
									<div class="form-group">
										<label>User</label>
										<input type="text" name="user" id="user" class="form-control" value="<?php echo $getUser ?>">
									</div>

									<div class="form-group">
										<label>Password</label>
										<input type="text" name="pass" id="pass" class="form-control" value="<?php echo $getPass ?>">
									</div>
								</div>
								<div class="box-footer">
									<button type="submit" class="btn btn-primary" name="submit" id="submit" value="simpan" ><i class="fa fa-save"></i> Simpan</button>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="box box-success">
								<div class="box-header"><h3 class="box-title">Informasi SMS Gateway</h3></div>
								<div class="box-body">
									<div class="form-group">
										<label>Total SMS</label>
										<input type="text" name="totalsms" id="totalsmsm" readonly="readonly" placeholder="0" class="form-control">
									</div>
								</div>
							</div>
						</div>
					
					</form>			 
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->

<?php require("footer.php"); ?>
