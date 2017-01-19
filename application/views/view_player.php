<!doctype html>
<html lang=en>
<head>
<title>Player das-PORTAL AEA</title>
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"5140e7c3137decd86557afb1a4b4465e",petok:"9b758f282e3d99444e362512b0a4a83388065e63-1423707106-1800",zone:"demosthenes.info",rocket:"0",apps:{"ga_key":{"ua":"UA-9896842-1","ga_bs":"2"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="//ajax.cloudflare.com/cdn-cgi/nexp/dok3v=919620257c/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<link href="//cloud.webtype.com/css/094b1fa9-6433-4dce-966d-931c186185d8.css" rel="stylesheet" type="text/css"/>
<style>
body{margin:0;background:#000}
video{
	position:fixed;
	right:0;
	bottom:0;
	min-width:100%;
	min-height:100%;
	width:auto;
	height:auto;
	z-index:-100;
	/*background-size:cover;*/
	-webkit-transition:1s opacity;
	transition:1s opacity
}
div{
	font-family:Agenda-Light,Agenda\ Light,Agenda,Arial\ Narrow,sans-serif;
	font-weight:100;
	background:rgba(0,0,0,.3);
	color:#fff;
	padding:2rem;
	width:33%;
	margin:2rem;
	float:right;
	font-size:1.2rem
	}
h1{
	font-size:3rem;
	text-transform:uppercase;
	margin-top:0;
	letter-spacing:.3rem
}
a{
	display:inline-block;
	color:#fff;
	text-decoration:none;
	background:rgba(0,0,0,.5);
	padding:.5rem;
	-webkit-transition:.6s background;
	transition:.6s background
}
a:hover{
	background:rgba(0,0,0,.9)
}
.stopfade{opacity:.5}
#polina button{
	display:block;
	width:80%;
	padding:.4rem;
	border:none;
	margin:1rem auto;
	font-size:1.3rem;
	background:rgba(255,255,255,.23);
	color:#fff;
	border-radius:3px;
	cursor:pointer;
	-webkit-transition:.3s background;
	transition:.3s background
}
#polina button:hover{
	background:rgba(0,0,0,.5)
}
@media screen and (max-width:500px){
	div{
		width:70%
	}
}
@media all and (max-device-width:800px){
	body{ background-size:cover}
	#bgvid,
	#polina button{
		display:none
	}
	div{width:70%}
}
</style>
<meta charset=utf-8>

</head>
<body>
<!--<video autoplay loop  id="bgvid">

<source src="<?php echo base_url();?>uploads/video.mp4" type="video/mp4">
</video>-->
<video autoplay loop id="bgvid"> 
	<source src='<?php echo base_url();?>uploads/SamsungSMARTSignageCaseStudy_BEANPOLEFashionRetailer.mp4' type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'> 
	Your browser does not support the video tag. 
</video>
<div id="polina" style="display:none;">
<h1>Polina</h1>
<p>filmed by Alexander Wagner 2011
<p><a href="/blog/777/Create-Fullscreen-HTML5-Page-Background-Video">return to article</a>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur porta dictum turpis, eu mollis justo gravida ac. Proin non eros blandit, rutrum est a, cursus quam. Nam ultricies, velit ac suscipit vehicula, turpis eros sollicitudin lacus, at convallis mauris magna non justo. Etiam et suscipit elit. Morbi eu ornare nulla, sit amet ornare est. Sed vehicula ipsum a mattis dapibus. Etiam volutpat vel enim at auctor.
<p>Aenean pharetra convallis pellentesque. Vestibulum et metus lectus. Nunc consectetur, ipsum in viverra eleifend, erat erat ultricies felis, at ultricies mi massa eu ligula. Suspendisse in justo dapibus metus sollicitudin ultrices id sed nisl.</p>
<button>Pause</button>
</div>
<script>var video=document.getElementById("bgvid"),pauseButton=document.querySelector("#polina button");function vidFade(){video.classList.add("stopfade");}
video.addEventListener('ended',function()
{video.pause();vidFade();},false);pauseButton.addEventListener("click",function(){video.classList.toggle("stopfade");if(video.paused){video.play();pauseButton.innerHTML="Pause";}else{video.pause();pauseButton.innerHTML="Paused";}},false);video.addEventListener('touchstart',function(e){e.preventDefault();video.play();})</script>
</body>
</html>