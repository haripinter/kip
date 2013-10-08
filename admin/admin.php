<?php
$_app = $site_url.'/index.php/root/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>KIP v1.0 ~ Backend</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="E-Cermat Admin">
	<meta name="author" content="haripinter">

	<link href="<?php echo $root_path; ?>css/bootstrap-classic.css" id="bs-css" rel="stylesheet">
	<link href="<?php echo $root_path; ?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo $root_path; ?>css/ui/jquery-ui.min.css" rel="stylesheet">
	<link href='<?php echo $root_path; ?>css/jquery.cleditor.css' rel='stylesheet'>
	
	<link href="<?php echo $root_path; ?>css/back-style.css" rel="stylesheet">
	<link href="<?php echo $root_path; ?>css/kip.css" rel="stylesheet">
	
	<link href='<?php echo $root_path; ?>css/style.css' rel='stylesheet'>
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="<?php echo $root_path; ?>js/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<!--link rel="shortcut icon" href="img/favicon.ico"-->
		
	<script src="<?php echo $root_path; ?>js/jquery-1.10.1.min.js"></script>
	<script src="<?php echo $root_path; ?>js/jquery.knob.js"></script>

	<!-- jQuery File Upload Dependencies -->
	
	<script src="<?php echo $root_path; ?>js/jquery.iframe-transport.js"></script>
	<!--script src="js/jquery.fileupload-ui.js"></script-->
	<script src="<?php echo $root_path; ?>js/jquery.ui.widget.js"></script>
	<script src="<?php echo $root_path; ?>js/jquery-ui.min.js"></script>
	<script src="<?php echo $root_path; ?>js/jquery.fileupload.js"></script>
	<script src="<?php echo $root_path; ?>js/jquery.dataTables.min.js"></script>
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
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li><a href="<?php echo $_app; ?>"><i class="icon-home"></i><span class="hidden-tablet"> Dashboard</span></a></li>
						<li><a href="<?php echo $_app; ?>profil"><i class="icon-folder-open"></i><span class="hidden-tablet"> Profil</span></a></li>
						<li><a href="<?php echo $_app; ?>permohonan"><i class="icon-picture"></i><span class="hidden-tablet"> Permohonan IP</span></a></li>
						<li><a href="<?php echo $_app; ?>pengaduan"><i class="icon-picture"></i><span class="hidden-tablet"> Pengaduan</span></a></li>
						<!--li><a href="<?php echo $_app; ?>"><i class="icon-random"></i><span class="hidden-tablet"> Pesan</span></a></li-->
						
						<li class="nav-header hidden-tablet">Menu Website</li>
						<li><a href="<?php echo $_app; ?>informasi"><i class="icon-picture"></i><span class="hidden-tablet"> Informasi Statis</span></a></li>
						<li><a href="<?php echo $_app; ?>berita"><i class="icon-picture"></i><span class="hidden-tablet"> Berita</span></a></li>
						<li><a href="<?php echo $_app; ?>komentar"><i class="icon-random"></i><span class="hidden-tablet"> Komentar</span></a></li>
						<!--li><a href="<?php echo $_app; ?>gambar"><i class="icon-list-alt"></i><span class="hidden-tablet"> Galeri Foto</span></a></li>
						<li><a href="<?php echo $_app; ?>"><i class="icon-bullhorn"></i><span class="hidden-tablet"> Galeri Video</span></a></li-->
						<li><a href="<?php echo $_app; ?>"><i class="icon-bullhorn"></i><span class="hidden-tablet"> Berkas</span></a></li>
						
						<li class="nav-header hidden-tablet">Pengaturan Aplikasi</li>
						<li><a href="<?php echo $_app; ?>"><i class="icon-th-list"></i><span class="hidden-tablet"> Pengguna</span></a></li>
						<li><a href="<?php echo $_app; ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Modul Aplikasi</span></a></li>
						<li><a href="<?php echo $_app; ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Tampilan</span></a></li>
						<li><a href="<?php echo $_app; ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Pengaturan Diskusi</span></a></li>
						<li><a href="<?php echo $_app; ?>"><i class="icon-lock"></i><span class="hidden-tablet"> Jajak Pendapat</span></a></li>
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
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
	
	
	<script src="<?php echo $root_path; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $root_path; ?>js/bootbox.min.js"></script>
	
	<script src="<?php echo $root_path; ?>js/highcharts.js"></script>
	<script src="<?php echo $root_path; ?>js/exporting.js"></script>
	
	<script src="<?php echo $root_path; ?>js/jquery.cleditor.min.js"></script>
	<script src="<?php echo $root_path; ?>js/simpeg.js"></script>
	<script src="<?php echo $root_path; ?>js/pagination.js"></script>
	
</html>
