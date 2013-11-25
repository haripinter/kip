<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$theme = config_item('public_theme');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>KIP v0.1 ~ Pemerintah Kota Indonesia</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sistem Keterbukaan Informasi Pemerintahan">
	<meta name="author" content="haripinter">

	<!--link href="<?php echo $theme; ?>css/bootstrap.min.css" id="bs-css" rel="stylesheet"-->
	<link href="<?php echo $theme; ?>css/bootstrap-classic.css" id="bs-css" rel="stylesheet">
	<link href="<?php echo $theme; ?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo $theme; ?>css/kip.css" rel="stylesheet">
	<link href="<?php echo $theme; ?>css/style.css" rel="stylesheet">
	<!--link href="<?php echo $theme; ?>css/menu.css" rel="stylesheet"-->
	
	<link rel="stylesheet" type="text/css" href="<?php echo $theme; ?>css/ddlevelsmenu-base.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $theme; ?>css/ddlevelsmenu-topbar.css" />

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="js/html5.js"></script>
	<![endif]-->
	
	<!--[if gte IE 9]>
	<style type="text/css">
		.gradient {
		filter: none;
		}
	</style>
	<![endif]-->

	<!-- The fav icon -->
	<!--link rel="shortcut icon" href="img/favicon.ico"-->
		
	<script src="<?php echo $theme; ?>js/jquery-1.10.1.min.js"></script>
	<script src="<?php echo $theme; ?>js/ddlevelsmenu.js"></script>

</head>
<body>
	<div class="kip-background background-blue">
	</div>
		<!-- topbar starts -->
	<div class="navbar navbar-fixed-top" style="background-color:#fff;">
		<div class="navbar-inner home-pad-header">
			<div class="container-fluid">
				<div class="pull-left" style="margin-top:5px; font-size:11px">
				<b>Alamat :</b> <span style="color:green">Jl. Kota Indonesia</span> 
				| <b>Telp & Fax :</b> <span style="color:green">1708 1945</span> 
				| <b>Email :</b> <span style="color:green">email@indonesia.go.id</span>
				</div>
				
				<div class="pull-right" style="margin-top:5px; font-size:11px">
					<a href="<?php echo site_url(); ?>login"><span class="icon-off"></span></a>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid home-width" style="margin-top:20px">
		<div class="row-fluid" style="margin-top:40px;">
			<div class="span6">
				<div style="float:left;"><img src="<?php echo $theme; ?>img/lambang.png" style="height:50px; margin-top:-8px"></img></div>
				<div style="float:left; margin-left:5px; font-size:1.9em; margin-top:0px; font-weight:bold; min-width:60%">PEMERINTAH KOTA INDONESIA</div>
				<div style="float:left; margin-left:5px; font-size:0.89em; margin-top:3px; color:green;">Sistem Keterbukaan Informasi Pemerintah</div>
			</div>
			<div class="span6">
				<div id="ddtopmenubar" class="mattblackmenu btn-group pull-right" style="margin-top:0px">
					<?php include_once('menu.php'); ?>
				</div>
				<script type="text/javascript">
					ddlevelsmenu.setup("ddtopmenubar", "topbar") //ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
				</script>
			</div>
			
		</div>
		
		
			
		<noscript>
			<div class="alert alert-block span12">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have JavaScript enabled to use this site.</p>
			</div>
		</noscript>
		
		
			<?php
			if($page_type=='home'){
				echo $content;
			}else{
				?>
				<style>
					.kip-left-content{
						width: 680px;
						float:left;
						background-color:white;
						margin-top:10px;
						margin-left:10px;
						border-radius:3px;
					}
					
					.kip-left-content div{
						margin-top: 0px !important;
					}
					
					.kip-right-content{
						margin-top: 10px;
						margin-right:10px;
						margin-left:10px;
						width: 250px;
						float:left;
					}
				</style>
				<div class="row-fluid" style="background-color:white; border-radius:3px; margin-top:10px;">
					<div class="kip-left-content">
						<?php
						echo $content;
						?>
					</div>
					<div class="kip-right-content">
						<?php
						include_once('layanan.php');
						?>
					</div>
				</div>
				<?php
			}
			?>
		
	</div>
	<div class="footer">
		<div class="center" style="max-width: 960px; margin:0px auto; font-size:11px; color:#777;">
		<hr class="horlines"/>
		Copyright 2013 &copy; Pemerintah Kota Indonesia
		</div>
	 </div>
	 <br/>
	 <br/>
	 <br/>
	
	<div class="footerbox" style="background-color:#fff;">
		<marquee>
		Marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee marquee
		</marquee>
	</div>
	
	<script src="<?php echo $theme; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $theme; ?>js/bootbox.min.js"></script>
	<script src="<?php echo $theme; ?>js/jquery-ui.min.js"></script>
	<script src="<?php echo $theme; ?>js/jquery.cleditor.min.js"></script>
	<script src="<?php echo $theme; ?>js/kip.js"></script>
	<script src="<?php echo $theme; ?>js/pagination.js"></script>
	
	<script src="<?php echo $root_path; ?>js/highcharts.js"></script>
	<script src="<?php echo $root_path; ?>js/exporting.js"></script>
	
	<script>
		$('.bt-home').click(function(x){
			var btn = $(this);
			btn.parent().children('.btn').removeClass('active');
			btn.addClass('active');
			
			//var url = 'inline/'+this.name;
			//var get = $.get(url);
			//get.done(function(data){
				//$('#content').html(data);
			//});
		});
	</script>
</body>
</html>