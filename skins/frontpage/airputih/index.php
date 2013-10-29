<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>KIP v0.0 ~ Pemerintah Kota Indonesia</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sistem Keterbukaan Informasi Pemerintahan">
	<meta name="author" content="haripinter">

	<!--link href="<?php echo $skin; ?>css/bootstrap.min.css" id="bs-css" rel="stylesheet"-->
	<link href="<?php echo $skin; ?>css/bootstrap-classic.css" id="bs-css" rel="stylesheet">
	<link href="<?php echo $skin; ?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo $skin; ?>css/kip.css" rel="stylesheet">
	<link href="<?php echo $skin; ?>css/style.css" rel="stylesheet">
	<!--link href="<?php echo $skin; ?>css/menu.css" rel="stylesheet"-->
	
	<link rel="stylesheet" type="text/css" href="<?php echo $skin; ?>css/ddlevelsmenu-base.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $skin; ?>css/ddlevelsmenu-topbar.css" />

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
		
	<script src="<?php echo $skin; ?>js/jquery-1.10.1.min.js"></script>
	<script src="<?php echo $skin; ?>js/ddlevelsmenu.js"></script>
<?php
	$nama_bulan = array('','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	
	//yyyy-mm-dd hh:mm:ss -> Dayname, dd/mm/yy
	function timestamp_toid($date){
		$nama_hari = array('Ahad','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
		
		$tmp = strtotime($date);
		$day = $nama_hari[date('w',$tmp)];
		return $day.", ".date('d/m/Y - h:i:s');
	}
?>

</head>
<body>
	<div class="kip-background background-blue">
	</div>
		<!-- topbar starts -->
	<div class="navbar navbar-fixed-top" style="background-color:#fff;">
		<div class="navbar-inner home-pad-header">
			<div class="container-fluid">
				<div class="top-nav">
				</div><!--/ nav-collapse -->
				
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>	
					<span class="icon-bar"></span>
				</a>
				
				<div class="pull-left" style="margin-top:5px; font-size:11px">
				<b>Alamat :</b> <span style="color:green">Jl. Kota Indonesia</span> 
				| <b>Telp & Fax :</b> <span style="color:green">1708 1945</span> 
				| <b>Email :</b> <span style="color:green">email@indonesia.go.id</span>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid home-width" style="margin-top:20px">
		<div class="row-fluid" style="margin-top:40px;">
			<div class="span6">
				<div style="float:left;"><img src="<?php echo $skin; ?>img/lambang.png" style="height:50px; margin-top:-8px"></img></div>
				<div style="float:left; margin-left:5px; font-size:1.9em; margin-top:0px; font-weight:bold; min-width:60%">PEMERINTAH KOTA INDONESIA</div>
				<div style="float:left; margin-left:5px; font-size:0.89em; margin-top:3px; color:green;">Sistem Keterbukaan Informasi Pemerintah</div>
			</div>
			<div class="span6">	
				<!--div class="btn-group pull-right dropdown" style="margin-top:0px" id="toprightmenu">
					
					<input type="button" class="btn btn-large bt-home active" name="front_home.php" value="Home">
					<input type="button" class="btn btn-large bt-home" name="front_profil.php" value="Profil">
					<input type="button" class="btn btn-large bt-home" name="front_informasi.php" value="Informasi">
					<input type="button" class="btn btn-large bt-home bt-login" name="front_login.php" value="Login">
				</div-->
				

			<div id="ddtopmenubar" class="mattblackmenu btn-group pull-right" style="margin-top:0px">
			<?php
			echo $menu;
			?>
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
		
		<div id="content" class="row-fluid">
			<div class="row-fluid">
				<div class="span12 box" style="padding:10px">
					<div id="myCarousel" class="carousel slide">
						<div class="carousel-inner">
							<?php
							$n = 0;
							foreach($slideshow as $slide){
								$active = '';
								if($n==0) $active = 'active';
							?>
							<div class="row-fluid item <?php echo $active; ?>">
								<img src="<?php echo $site_url.'/media/slideshow/'.$slide['media_realname']; ?>" style="height:350px; width:100%"/>
								<div class="carousel-caption">
									<h4><?php echo $slide['media_title']; ?></h4>
								</div>
							</div>
							<?php
								$n++;
							}
							?>
						</div>
						<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span8">
						<img src="<?php echo $site_url; ?>/media/mekanisme.jpg">
				</div>
				<div class="span4">
				Peta Situs
				


				</div>
			</div>
		</div>
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
	
	<script src="<?php echo $skin; ?>js/bootstrap.min.js"></script>
	<script src="<?php echo $skin; ?>js/bootbox.min.js"></script>
	<script src="<?php echo $skin; ?>js/jquery-ui.min.js"></script>
	<script src="<?php echo $skin; ?>js/jquery.cleditor.min.js"></script>
	<script src="<?php echo $skin; ?>js/kip.js"></script>
	<script src="<?php echo $skin; ?>js/pagination.js"></script>
	
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