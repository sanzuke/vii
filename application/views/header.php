<!DOCTYPE html>
<html>
    <head>
		<script src="<?php echo base_url() ;?>js/jquery.js" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo base_url() ;?>jquery-ui.css">
        <script src="<?php echo base_url() ;?>jquery-ui.js"></script>

        <script src="<?php echo base_url();?>js/bootstrap3-typeahead.js"></script>
        <meta charset="UTF-8">
        <title><?php echo $title ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?php echo base_url();?>img/logodas-PORTAL.png">
        <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>css/font-awesome.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="<?php echo base_url();?>css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url();?>css/AdminLTE.css" rel="stylesheet" type="text/css" />
		<!-- DATA TABLES -->
        <link href="<?php echo base_url();?>css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
		<!-- Menu Context-->		
		<!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>css/menucontext/contextMenu.css">-->
		<!-- Theme style -->

        <script src="<?php echo base_url() ;?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url() ;?>js/summernote.js"></script>
        <link href="<?php echo base_url();?>css/summernote.css" rel="stylesheet" type="text/css" />


		<link href="<?php echo base_url();?>css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <!--<link href="<?php echo base_url();?>css/iCheck/all.css" rel="stylesheet" type="text/css" />-->

        <!-- Bootstrap Color Picker -->
        <link href="<?php echo base_url();?>css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url();?>css/datepicker/datepicker.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="<?php echo base_url();?>css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		<style>
		.merah {
			color:#B84D45;
		}
		.hijau {
			color:#01B034;
		}
		</style>
		
		<script>
         
			function hidemessage(){
			$('[data-toggle="message"]').popover('hide');
			}
			function hideoverlay(){
			
				$("#overlay").hide();
				$("#loadimage").hide();
			
			}
			function showoverlay(){
			
				$("#overlay").show();
				$("#loadimage").show();
			
			}
			
		 $(function() {
                //Datemask dd/mm/yyyy
                //$("#datemask1").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
                //$("#datemask2").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //$("#datemask3").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //$("#datemask4").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                //$("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                //$("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
		$(document).ready(function(){
		  
            $('#desc').summernote({
                height: 200
            });
		 $('html').on('click', function(e) {
			  if (typeof $(e.target).data('original-title') == 'undefined' &&
				 !$(e.target).parents().is('.popover.in')) {
				$('[data-original-title]').popover('hide');
				}
				});
				
		$('[data-toggle="popover"]').popover({
											trigger: 'hover',
												'placement': 'right',
												content:'a',
												title :'a',
												html:true
										});
	
			$('#<?php echo $MENU;?>').addClass('active');
			$('#<?php echo $SUBMENU;?>').addClass('active');
			$('#<?php echo $SUBSUBMENU;?>').addClass('active');
			
			
			$('#date1').datepicker({
							format: "dd/mm/yyyy",
							autoclose: true,
							orientation:"bottom"
						});  
			$('#date2').datepicker({
							format: "dd/mm/yyyy",
							autoclose: true,
							pickerPosition: "right"
						});  
			$('#date3').datepicker({
							format: "dd/mm/yyyy",
							autoclose: true,
							pickerPosition: "right"
						});  
			$('#date4').datepicker({
							format: "dd/mm/yyyy",
							autoclose: true,
							pickerPosition: "right"
						});  
			$('#date5').datepicker({
							format: "dd/mm/yyyy",
							autoclose: true,
							pickerPosition: "right"
						});  
			
			
			$('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
		});
		
		</script>
		
    </head>
    <body class="skin-blue">
        <div class="alert alert-danger" role="alert" id="message" style="display:none; position:fixed; z-index:9999; width:40%; bottom:-20px; right:0;" ></div>
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="<?php echo base_url();?>/index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Babymu SHOP
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" data-toggle="message" data-toggle="message1" data-toggle="message2" data-toggle="message3" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                      
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $USERID; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <!-- <img src="<?php echo base_url();?>/img/avatar3.png" class="img-circle" alt="User Image" /> -->
                                    <p>
                                        <?php echo $USERID; ?> - <?php echo $EMPCODE; ?>
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!--<li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li> -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                   <!--  <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div> -->
                                    <div class="pull-right">
										<form method="post" action="<?php echo base_url().'/index.php/auth/logout';?>">
										<input type="hidden" name="user" value="<?php echo $USERID; ?>" readonly>
										<input type="hidden" name="emp" value="<?php echo $EMPCODE; ?>" readonly>
                                        <input id="submit" name="submit" class="btn1" type="submit" value="Sign Out" style="margin:0 5px 0 0" />
										</form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div  class="pull-center" align="center" style="display:none" >
                            <img src="<?php echo base_url();?>/img/logodas-PORTAL.png" class="" style="width:75px;" />
                        </div>
                         <div class="info" align="center">
                                <!--   <p>das-POS</p> -->
                           <a ><!-- <i class="fa fa-circle text-success"></i> --> Online Shop</a>
                        </div> 
                    </div>
                 
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <?php
                        echo $treemenu;
                        ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
