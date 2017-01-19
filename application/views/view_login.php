<!DOCTYPE html>
<html>
<head>
<title>Login Admin</title>
<script src="<?php echo base_url() ;?>js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ;?>js/bootstrap.min.js"></script>
<link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet" type="text/css" />

<!--<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
 This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->
<script>
	$(document).ready(function(){
		$("#loginform").submit(function(){
			var u = $("#username").val();
			var p = $("#password").val();
			
			$.post('<?php echo base_url() ;?>adminlogin/auth/', {u : u, p : p }, function(data){
				if(data==='true'){
					window.location = '<?php echo base_url() ;?>dashboard/';
				} else {
					$("#msg").fadeIn('slow').html("<strong>Salah!</strong> User/Password salah, periksa kembali.").delay(5000).fadeOut('slow');
				}
			});
			return false;
		});
	});
</script>
<style>
body{
	background-color: #aaa;
}
#bg{
    background: url(<?php echo base_url();?>img/ss-maps.png);
	background-color: #000;
	opacity:0.5;
	width:100%;
	height:100%;
	top:0;
	left:0;
	z-index:-9999;
	position:absolute;
}
#msg {
	display:none;
	align:center;
	margin-top:5px;
}
.vertical-offset-100{
    padding-top:100px;
}
</style>
</head>
<body>
<div id="bg" >

</div>

<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4" style="border:none;">
			<div align="center" style="display:none;"><img src="<?php echo base_url();?>img/logodas-PORTAL.png" width="100"></div>
    		<div class="panel panel-default">
			  	<div class="panel-heading" style="background-color:#F39C12;">
			    	<h3 class="panel-title" >Please sign in</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form accept-charset="UTF-8" role="form" id="loginform">
					
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Username" name="username" id="username" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" id="password" value="">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input name="remember" type="checkbox" value="Remember Me"> Remember Me
			    	    	</label>
			    	    </div>
			    		<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
			<div id="msg" class="alert alert-danger" role="alert"></div>
		</div>
	</div>
</div>
</body>
</html>
