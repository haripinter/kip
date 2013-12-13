<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$theme = config_item('public_theme');

$title = config_item('app_name').' '.config_item('app_version').' ~ '.config_item('instansi');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sistem Keterbukaan Informasi Pemerintahan">
	<meta name="author" content="haripinter">

	<link href="<?php echo $theme; ?>css/kip.css" rel="stylesheet">
	<link href="<?php echo $theme; ?>css/style.css" rel="stylesheet">
	
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
	<link rel="shortcut icon" href="<?php echo $theme; ?>img/favicon.ico">
		
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
				<b>Alamat :</b> <span style="color:green"><?php echo config_item('alamat'); ?></span> 
				| <b>Telp & Fax :</b> <span style="color:green"><?php echo config_item('telp'); ?></span> 
				| <b>Email :</b> <span style="color:green"><?php echo config_item('email'); ?></span>
				</div>
				
				<div class="pull-right" style="margin-top:5px; font-size:11px">
					<?php
					if(!config_item('IS_LOGIN')){
						echo '<a href="'.site_url().'login">Login <span class="icon-off"></span></a>';
					}else{
						echo '<a href="'.site_url().'logout" style="text-decoration:blink; color:red;">Logout <span class="icon-off"></span></a>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid home-width" style="margin-top:20px">
		<div class="row-fluid" style="margin-top:40px;">
			<div class="span6">
				<div style="float:left;"><img src="<?php echo $theme; ?>img/lambang.png" style="height:50px; margin-top:-8px"></img></div>
				<div style="float:left; margin-left:5px; font-size:1.9em; margin-top:0px; font-weight:bold; min-width:60%"><?php echo config_item('instansi'); ?></div>
				<div style="float:left; margin-left:5px; font-size:0.89em; margin-top:3px; color:green;"><?php echo config_item('deskripsi'); ?></div>
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
			echo $content;
			?>
	</div>
	
	<div class="footer" style="margin-bottom:50px">
		<div class="center" style="max-width: 960px; margin:0px auto; font-size:11px; color:#777;">
		<hr class="horlines"/>
		Copyright 2013 &copy; <?php echo config_item('instansi'); ?>
		</div>
	</div>
	
	<div class="footerbox" style="background-color:#fff;">
		<marquee>
		<?php
			$marquee = config_item('marquee');
			echo '>>';
			foreach($marquee as $marq){
				echo " ".$marq['title']." | ";
			}
		?>
		</marquee>
	</div>
	
	
	
	<script src="<?php echo $theme; ?>js/jquery-ui.min.js"></script>
	<script src="<?php echo $theme; ?>js/jquery.cleditor.min.js"></script>
	<script src="<?php echo $theme; ?>js/kip.js"></script>
	
	<script>
		$('.bt-home').click(function(x){
			var btn = $(this);
			btn.parent().children('.btn').removeClass('active');
			btn.addClass('active');
		});
	</script>
</body>
</html>