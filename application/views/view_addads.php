<?php require("header.php"); ?>
<script type="text/javascript">
$(document).ready(function(){
	$("#tgl").datepicker({
		multidate : true
	});

    $("#locationAds input[type=text]").autocomplete({source : <?php echo $listlocation  ?>});

    $("#addmorelocation").click(function(){
    	var counter = new Number($("#counter").val());
    	var countLocation = new Number(<?php echo $countLocation ?>);

    	if(counter < countLocation){
    		var nil = counter + 1;
    		var str = '<input type="text" name="locads'+nil+'" id="locads'+nil+'" class="form-control" style="margin-top:5px;" >'
	    	$("#locationAds").append(str);
	    	$("#counter").val(nil);
    	} else {
    		alert("Lokasi hanya ada "+countLocation+", anda tidak bisa menambah lagi.");
    		//$("#message").removeClass("alert-danger").addClass("alert-danger").html("<strong>Warning!</strong> Lokasi hanya ada "+countLocation+", anda tidak bisa menambah lagi.").fadeIn('slow').delay(5000).fadeOut('slow');
    	}
    	

    	return false;
    });
});
</script>
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
				<div class="col-md-12">
					<div class="box box-primary">
						<div class="box-header"><h3 class="box-title">Add New Ads</h3></div>
						
						<div class="box-body">
							<div class="form-group">
								<label for="locads">Location Ads</label>
								<input type="hidden" name="counter" id="counter" value="1" >
								<div id="locationAds">
									<input type="text" name="locads1" id="locads1" class="form-control" >
								</div>
								<button class="btn btn-primary" type="button" id="addmorelocation" style="margin-top:5px;">Add New Location</button>
							</div>
							<div class="form-group">
								<label for="contentname">Content Name</label>
								<input type="text" name="contentname" id="contentname" class="form-control" >
							</div>

							<div class="form-group">
								<label for="tgl">Date</label>
								<div class="input-group">
									<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
									<input type="text" name="tgl" id="tgl" class="form-control pull-right" >
								</div>
							</div>

							<div class="form-group">
								<label for="time">Time</label>
								<select class="form-control">
									<option>Time 1</option>
									<option>Time 2</option>
									<option>Time 3</option>
									<option>Time 4</option>
									<option>Time 5</option>
									<option>Time 6</option>
									<option>Time 7</option>
								</select>
							</div>

							<div class="form-group">
								<label for="duration">Duration</label>
								<input type="text" name="duration" id="duration" class="form-control" placeholder="Second" >
							</div>

							<div class="form-group">
								<label for="video">File Upload</label>
								<input type="file" name="video" id="video" ></input>
								<p class="help-block">Allow format video .mp4, .mkv, .flv</p>
							</div>

							<div class="form-group">
								<label for="agreement">Agreement</label>
								<textarea class="form-control" readonly="readonly" name="agreement" id="agreement" rows="3"></textarea>
							</div>

							<div class="form-group">
								<label for="cekbox"></label>
								<input type="checkbox" name="cekbox" id="cekbox" class="form-control">
								I Accept the Video Licensing Agreement
							</div>
							<div class="box-footer">
		                        <button type="button" class="btn btn-primary" name="add" id="add" >Order</button>
		                    </div>
						</div>
					</div>
				</div>
				<!--
				<div class="col-md-8">
					<div class="box box-warning">
						<div class="box-header"><h3 class="box-title">Video Content</h3></div>
						<div class="box-body">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
				-->
			 	</form>
                </section><!-- /.content -->
				
            </aside><!-- /.right-side -->

<?php require("footer.php"); ?>