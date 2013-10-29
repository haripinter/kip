<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$theme = config_item('admin_theme');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>KIP v1.0 ~ Backend</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="E-Cermat Admin">
	<meta name="author" content="haripinter">

	<link href="<?php echo $theme; ?>css/bootstrap-classic.css" id="bs-css" rel="stylesheet">
	<link href="<?php echo $theme; ?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo $theme; ?>css/ui/jquery-ui.min.css" rel="stylesheet">
	<link href='<?php echo $theme; ?>css/jquery.cleditor.css' rel='stylesheet'>
	
	<link href="<?php echo $theme; ?>css/back-style.css" rel="stylesheet">
	<link href="<?php echo $theme; ?>css/jquery.fileupload-ui.css" rel="stylesheet" >
	<!--link href='<?php echo $theme; ?>css/style.css' rel="stylesheet"-->
	<link href="<?php echo $theme; ?>css/kip.css" rel="stylesheet">
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="<?php echo $theme; ?>js/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<!--link rel="shortcut icon" href="img/favicon.ico"-->
		
	<script src="<?php echo $theme; ?>js/jquery-1.10.1.min.js"></script>
	<script src="<?php echo $theme; ?>js/jquery.knob.js"></script>

	<!-- jQuery File Upload Dependencies -->
	
	<script src="<?php echo $theme; ?>js/jquery.iframe-transport.js"></script>
	<!--script src="js/jquery.fileupload-ui.js"></script-->
	<script src="<?php echo $theme; ?>js/jquery.ui.widget.js"></script>
	<script src="<?php echo $theme; ?>js/jquery-ui.min.js"></script>
	<script src="<?php echo $theme; ?>js/jquery.fileupload.js"></script>
	<script src="<?php echo $theme; ?>js/jquery.dataTables.min.js"></script>
</head>
<body>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<div class="top-nav">
					<a class="brand" href="#">KIP v1.0</a>
				</div><!--/.nav-collapse -->
				
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown">
						<i class="icon-user"></i><span class="hidden-phone"> User</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<!--li><a href="#">Profile</a></li>
						<li class="divider"></li-->
						<!--li><a href="login.html">Change Password</a></li-->
						<li><a href="login_exec.php?what=logout">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
			</div>
		</div>
	</div>
	
	<div class="container-fluid padding-left-0">
		<div class="row-fluid">
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<?php
					include_once('menu.php');
					?>
				</div>
			</div>
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			<div id="content" class="span10">
			<?php
				echo $content;
			?>
			</div>
		</div>
	</div>
	
	
	<script src="<?php echo $theme; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $theme; ?>js/bootbox.min.js"></script>
	
	<script src="<?php echo $theme; ?>js/highcharts.js"></script>
	<script src="<?php echo $theme; ?>js/exporting.js"></script>
	
	<script src="<?php echo $theme; ?>js/jquery.cleditor.min.js"></script>
	<script src="<?php echo $theme; ?>js/simpeg.js"></script>
	<script src="<?php echo $theme; ?>js/pagination.js"></script>
	
</html>
