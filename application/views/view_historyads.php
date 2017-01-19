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
                                    <h3 class="box-title">List Ads History</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Content Name</th>
                                                <th>Location Ads</th>
                                                <th>Date</th>
                                                <th>Duration</th>
                                                <th>Video Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Trident</td>
                                                <td>Internet
                                                    Explorer 4.0</td>
                                                <td>Win 95+</td>
                                                <td> 4</td>
                                                <td>X</td>
                                            </tr>
                                            <tr>
                                                <td>Trident</td>
                                                <td>Internet
                                                    Explorer 5.0</td>
                                                <td>Win 95+</td>
                                                <td>5</td>
                                                <td>C</td>
                                            </tr>
                                            <tr>
                                                <td>Trident</td>
                                                <td>Internet
                                                    Explorer 5.5</td>
                                                <td>Win 95+</td>
                                                <td>5.5</td>
                                                <td>A</td>
                                            </tr>
                                            <tr>
                                                <td>Trident</td>
                                                <td>Internet
                                                    Explorer 6</td>
                                                <td>Win 98+</td>
                                                <td>6</td>
                                                <td>A</td>
                                            </tr>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Content Name</th>
                                                <th>Location Ads</th>
                                                <th>Date</th>
                                                <th>Duration</th>
                                                <th>Video Name</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
			
			 	</form>
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->

<?php require("footer.php"); ?>