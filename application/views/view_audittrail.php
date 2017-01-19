<?php require("header.php"); ?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    <?php echo  $TITLE; ?>
                    <small><?php echo  $SUBTITLE; ?></small>
                    </h1>
					<?php echo  $BREADCRUMB; ?>
                   
                </section> 
                <!-- Main content -->
                <section class="content">
                <form role="form">
				
				<div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Audit Reference No</th>
                                    <th>Audit Date</th>
                                    <th>Audit Time</th>
                                    <th>Application Module Code</th>
                                    <th>Login ID</th>
                                    <th>User Action</th>
                                    <th>Reference</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>InitiateNew</td>
                                    <td>2015-01-28</td>
                                    <td>16:24:26</td>
                                    <td>ERP-UMT-ACT-EMP-INT</td>
                                    <td>ADMIN</td>
                                    <td>UPDATE</td>
                                    <td>JHT MARK. DEVELOP</td>
                                </tr>
                                <tr>
                                    <td>InitiateNew</td>
                                    <td>2015-01-28</td>
                                    <td>16:24:26</td>
                                    <td>ERP-UMT-ACT-EMP-INT</td>
                                    <td>ADMIN</td>
                                    <td>UPDATE</td>
                                    <td>JHT MARK. DEVELOP</td>
                                </tr>
                                <tr>
                                    <td>InitiateNew</td>
                                    <td>2015-01-28</td>
                                    <td>16:24:26</td>
                                    <td>ERP-UMT-ACT-EMP-INT</td>
                                    <td>ADMIN</td>
                                    <td>UPDATE</td>
                                    <td>JHT MARK. DEVELOP</td>
                                </tr>
                                <tr>
                                    <td>InitiateNew</td>
                                    <td>2015-01-28</td>
                                    <td>16:24:26</td>
                                    <td>ERP-UMT-ACT-EMP-INT</td>
                                    <td>ADMIN</td>
                                    <td>UPDATE</td>
                                    <td>JHT MARK. DEVELOP</td>
                                </tr>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Audit Reference No</th>
                                    <th>Audit Date</th>
                                    <th>Audit Time</th>
                                    <th>Application Module Code</th>
                                    <th>Login ID</th>
                                    <th>User Action</th>
                                    <th>Reference</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
			
			 	</form>
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->

<?php require("footer.php"); ?>