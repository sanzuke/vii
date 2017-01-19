<div class="clearfix"></div>
	<br><br><br>
	<div class="containercc">
	<div class="footer">
		
		<!-- <div class="col-md-2"></div> -->
		<div class="col-md-12" style="text-align:center; padding:0;"> 
			<br>
			<div style="margin-bottom:40px;">  
				<ul>
				<?php
				$page = $this->db->query("SELECT * FROM cm_post WHERE post_type = 'page' AND publish = '1' AND post_title NOT IN ('main Page')");
				foreach ($page->result_array() as $key => $value) {
					# code...
					echo '<li><a href="'.base_url() .'page/view/'.$value['id'].'" >'.$value['post_title'].'</a></li>';
				}
				?>
				</ul>
				
			</div>
			<div class="clearfix"></div>
			
			<!-- <div style="background:url(<?php echo base_url() . 'themes/victoryseven/' ?>assets/video-replace-mobile.jpg) no-repeat; background-position: 0 0;background-size: cover; min-height:300px;"> -->
			<div style="background:url(<?php echo $this->core->getFooterImg() ?>) no-repeat; background-position: 0 0;background-size: cover; min-height:300px;">
			<br><br><br><br>
				<div class="container">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6" style="text-align:center; margin-top:20px;" align="center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc commodo, orci quis lobortis semper, magna est sodales nunc, et maximus metus nisi eu dui. Donec mollis est nisl. In ullamcorper lobortis egestas. </div>
					<div class="col-md-2"></div>
				</div>
				</div>
				<div class="clearfix"></div>
				<div align="center" style="margin-bottom:10px; margin-top:100px; ">
					<?php echo $this->core->getLinkSosMed() ?>
				</div>
				<span style="font-size:12px; margin-bottom:10px;">Copyright &copy; 2016 VICTORYVII All rights reserved.</span>
				<br><br>
			</div>
		</div>
		<!-- <div class="col-md-2"></div> -->
		<div class="clearfix"></div>
	</div>
	</div>
</div>
</body>
</html>