<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>KIP v0.0 ~ Pemerintah Kota Indonesia</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Sistem Keterbukaan Informasi Pemerintahan">
	<meta name="author" content="haripinter">

	<link href="<?php echo $skin; ?>css/bootstrap-classic.css" id="bs-css" rel="stylesheet">
	<link href="<?php echo $skin; ?>css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="<?php echo $skin; ?>css/kip.css" rel="stylesheet">
	<link href="<?php echo $skin; ?>css/style.css" rel="stylesheet">

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="js/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<!--link rel="shortcut icon" href="img/favicon.ico"-->
		
	<script src="<?php echo $skin; ?>js/jquery-1.10.1.min.js"></script>
<?php
	$nama_bulan = array('','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
?>
<script type="text/javascript">
$(function () {
	// Radialize the colors
	Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
	    return {
	        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
	        stops: [
	            [0, color],
	            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
	        ]
	    };
	});		
		
	var data_status = [
			<?php
			$n = 0;
			foreach($stat_status_permohonan as $s){
				if($s['status']!='total'){
					if($n%4==1){
						echo "{name:'".ucwords($s['status'])."', y:".$s['jumlah'].", sliced:true, selected:true}";
					}else{
						echo "['".ucwords($s['status'])."', ".$s['jumlah']."]";
					}
				}
				$n++;
				if((count($stat_status_permohonan)-2)>=$n){
					echo ',';
				}
			}
			?>
            ];
    $('#chart_status_permohonan').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'STATUS PERMOHONAN INFORMASI PUBLIK'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.y}</b>',
        	percentageDecimals: 1
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b><br/>('+ new Number(this.percentage).toPrecision(4) +' %)';
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total',
            data: data_status
        }]
    });
	
	var bulan = [
			<?php
				$n = 0;
				foreach($stat_bulanan_permohonan as $bu){
					echo "'".$nama_bulan[$bu['bulan']]."'";
					if(count($stat_bulanan_permohonan)>($n++)+1) echo ',';
				}
			?>
			];
	var jumlah_bulanan = [
			<?php
				$n = 0;
				foreach($stat_bulanan_permohonan as $bu){
					echo $bu['jumlah'];
					if(count($stat_bulanan_permohonan)>($n++)+1) echo ',';
				}
			?>
			];
	var total_bulanan = [
			<?php
				$n = $c = 0;
				foreach($stat_bulanan_permohonan as $bu){
					$c += $bu['jumlah'];
					echo $c;
					if(count($stat_bulanan_permohonan)>($n++)+1) echo ',';
				}
			?>
			];
	
	$('#chart_bulanan_permohonan').highcharts({
        chart: {
        },
        title: {
            text: 'PERMOHONAN INFORMASI PUBLIK'
        },
        xAxis: {
            categories: bulan
        },
		yAxis: {
			title: {
                    text: 'Jumlah'
            }
        },
        tooltip: {
            formatter: function() {
                var s;
                if (this.point.name) { // the pie chart
                    s = ''+
                        this.point.name +': '+ this.y +' fruits';
                } else {
                    s = ''+
                        this.x  +': '+ this.y;
                }
                return s;
            }
        },
        labels: {
            items: [{
                html: 'Statistik Bulanan',
                style: {
                    left: '40px',
                    top: '8px',
                    color: 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Jumlah Perbulan',
            data: jumlah_bulanan
        }, {
            type: 'column',
            name: 'Total',
            data: total_bulanan
        }]
    });
});
		</script>
		
		
<script type="text/javascript">
$(function () {
		
	var data_status = [
			<?php
			$n = 0;
			foreach($stat_status_pengaduan as $s){
				if($s['status']!='total'){
					if($n%4==1){
						echo "{name:'".ucwords($s['status'])."', y:".$s['jumlah'].", sliced:true, selected:true}";
					}else{
						echo "['".ucwords($s['status'])."', ".$s['jumlah']."]";
					}
				}
				$n++;
				if((count($stat_status_pengaduan)-2)>=$n){
					echo ',';
				}
			}
			?>
            ];
    $('#chart_status_pengaduan').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'STATUS PENGADUAN INFORMASI PUBLIK'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.y}</b>',
        	percentageDecimals: 1
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    formatter: function() {
                        return '<b>'+ this.point.name +'</b><br/>('+ new Number(this.percentage).toPrecision(4) +' %)';
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Total',
            data: data_status
        }]
    });
	/*
	var bulan = [
			<?php
				$n = 0;
				foreach($statistik_bulanan as $bu){
					echo "'".$nama_bulan[$bu['bulan']]."'";
					if(count($statistik_bulanan)>$n++) echo ',';
				}
			?>
			];
	var jumlah_bulanan = [
			<?php
				$n = 0;
				foreach($statistik_bulanan as $bu){
					echo $bu['jumlah'];
					if(count($statistik_bulanan)>$n++) echo ',';
				}
			?>
			];
	var total_bulanan = [
			<?php
				$n = $c = 0;
				foreach($statistik_bulanan as $bu){
					$c += $bu['jumlah'];
					echo $c;
					if(count($statistik_bulanan)>$n++) echo ',';
				}
			?>
			];
	
	$('#containerx').highcharts({
        chart: {
        },
        title: {
            text: 'PENGADUAN INFORMASI PUBLIK'
        },
        xAxis: {
            categories: bulan
        },
		yAxis: {
			title: {
                    text: 'Jumlah'
            }
        },
        tooltip: {
            formatter: function() {
                var s;
                if (this.point.name) { // the pie chart
                    s = ''+
                        this.point.name +': '+ this.y +' fruits';
                } else {
                    s = ''+
                        this.x  +': '+ this.y;
                }
                return s;
            }
        },
        labels: {
            items: [{
                html: 'Statistik Bulanan',
                style: {
                    left: '40px',
                    top: '8px',
                    color: 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Jumlah Perbulan',
            data: jumlah_bulanan
        }, {
            type: 'column',
            name: 'Total',
            data: total_bulanan
        }]
    });
	*/
});
    

		</script>


</head>
<body>
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
				<div class="btn-group pull-right" style="margin-top:0px" id="toprightmenu">
					<input type="button" class="btn btn-large bt-home active" name="front_home.php" value="Home">
					<input type="button" class="btn btn-large bt-home" name="front_profil.php" value="Profil">
					<input type="button" class="btn btn-large bt-home" name="front_informasi.php" value="Informasi">
					<input type="button" class="btn btn-large bt-home bt-login" name="front_login.php" value="Login">
				</div>
			</div>
		</div>
			
		<noscript>
			<div class="alert alert-block span12">
				<h4 class="alert-heading">Warning!</h4>
				<p>You need to have JavaScript enabled to use this site.</p>
			</div>
		</noscript>
		<div id="content" class="row-fluid">
			<div class="span8 row-fluid">
				<?php
				if($stage=='home'){
				?>
				<div class="row-fluid">
					<div class="row-fluid">
						<div class="span12 box" style="padding:10px">
								<div id="myCarousel" class="carousel slide">
									<div class="carousel-inner">
										<div class="row-fluid item active">
											<img src="<?php echo $site_url; ?>/media/images/img1.jpg" style="height:350px; width:100%"/>
											<div class="carousel-caption">
																				<h4>Hari Kedua Ramadhan, Walikota Pariaman Tinjau Sejumlah Proyek</h4>
																			<p>Hari kedua Ramadhan, Walikota Pariaman, Mukhlis Rahman didampingi Kepala Dinas Pekerjaan Umum Kota Pariaman, Joni Rinaldi melakukan peninjauan pada sejumlah proyek pembangunan fisik di Kota Pariaman, Kamis (11/7/2013). Peninjauan proyek ini juga turut mendampingi Kepala Dinas Kelautan dan Perikanan Kota Pariaman, Yandri Leza dan sejumlah Staf Dinas Pekerjaan Umum Kota Pariaman.  <!--(<a href="?core=news&nid=">Read More</a>)--></p>
																		</div>
										</div>
										<div class="row-fluid item ">
											<img src="<?php echo $site_url; ?>/media/images/img2.jpg" style="height:350px; width:100%"/>
											<div class="carousel-caption">
																				<h4>Tim Safari Ramadhan Propinsi Sumbar Kunjungi Masjid Raya Kota Pariaman</h4>
																			<p>&#34;Persatuan dan kesatuan merupakan modal utama dalam membangun daerah ini. Untuk itu masukan dan saran dari masyarakat dalam membangun sangat diharapkan. Melalui kunjungan ini sekaligus kita mendengarkan aspirasi masyarakat,&#34; kata mantan Bupati Padang Pariaman dua kali periode ini. <!--(<a href="?core=news&nid=">Read More</a>)--></p>
											</div>
										</div>
									</div>
									<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
									<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
								</div>
						</div>
					</div>
					<div class="row-fluid">
					<div class="span12 box" style="padding:10px">
						<div class="row-fluid" style="margin-bottom:10px">
							<div>
								<h3>Judul Pemerintah Indonesia Pemerintah Indonesia <i class="icon-ok-sign"></i></h3>
								<span>Oleh Admin | Pada 12/12/2013 - 12.00 WIB | Dilihat 400 kali | Dilihat 400 kali |<a>23 komentar</a></span>
							</div>
							<div style="margin-top:8px">
								Pemerintah Indonesia adalah cabang utama pada pemerintahan Indonesia yang menganut sistem presidensial. Pemerintah Indonesia dikepalai oleh seorang presiden yang dibantu beberapa menteri yang tergabung dalam suatu kabinet. 
								<span><a>Selengkapnya...</a></span>
							</div>
						</div>
						<div class="row-fluid" style="margin-bottom:10px">
							<div>
								<h3>Judul Pemerintah Indonesia <i class="icon-ok-sign"></i></h3>
								<span>Oleh Admin | Pada 12/12/2013 - 12.00 WIB | Dilihat 400 kali | <a>23 komentar</a></span>
							</div>
							<div style="margin-top:8px">
								Pemerintah Indonesia adalah cabang utama pada pemerintahan Indonesia yang menganut sistem presidensial. Pemerintah Indonesia dikepalai oleh seorang presiden yang dibantu beberapa menteri yang tergabung dalam suatu kabinet. 
								<span><a>Selengkapnya...</a></span>
							</div>
						</div>
						<div class="row-fluid" style="margin-bottom:10px">
							<div>
								<h3>Judul Pemerintah Judul Pemerintah Indonesia <i class="icon-ok-sign"></i></h3>
								<span>Oleh Admin | Pada 12/12/2013 - 12.00 WIB | Dilihat 400 kali | <a>23 komentar</a></span>
							</div>
							<div style="margin-top:8px">
								Pemerintah Indonesia adalah cabang utama pada pemerintahan Indonesia yang menganut sistem presidensial. Pemerintah Indonesia dikepalai oleh seorang presiden yang dibantu beberapa menteri yang tergabung dalam suatu kabinet. Sebelum tahun 2004, sesuai dengan UUD 1945, 
								<span><a>Selengkapnya...</a></span>
							</div>
						</div>
					</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4 box" style="padding:5px">
						<div style="width:40px; height:50px; float:left; border:1px solid #AAA; padding:5px; border-radius:4px; margin-right:5px">
							<div style="width:100%; height:100%; background-color:yellow">
							</div>
						</div>
						<label>Judul Pemerintah Judul Pemerintah Indonesia Empat</label>
					</div>
					<div class="span4 box" style="padding:5px">
						<div style="width:40px; height:50px; float:left; border:1px solid #AAA; padding:5px; border-radius:4px; margin-right:5px">
							<div style="width:100%; height:100%; background-color:yellow">
							</div>
						</div>
						<label>Judul Pemerintah Judul Pemerintah Indonesia Empat</label>
					</div>
					<div class="span4 box" style="padding:5px">
						<div style="width:40px; height:50px; float:left; border:1px solid #AAA; padding:5px; border-radius:4px; margin-right:5px">
							<div style="width:100%; height:100%; background-color:yellow">
							</div>
						</div>
						<label>Judul Pemerintah Judul Pemerintah Indonesia Empat</label>
					</div>
				</div>
				<?php
				}
				
				if($stage=='important'){
				?>
				<div class="row-fluid">
					<div class="span12 box">
						<div data-original-title="" class="box-header well" style="padding-left:10px">
							<h2><i class="icon-tasks"></i> Form Registrasi</h2>
						</div>
						<div class="box-content" style="padding:10px">
							<?php
							echo $content;
							?>
						</div>
					</div>
				</div>
				<?php
				}
				?>
			</div>
			<div class="span4">
				<div class="box">
					<div data-original-title="" class="box-header well" style="padding-left:10px">
						<h2><i class="icon-tasks"></i> Jajak Pendapat</h2>
					</div>
					<div class="box-content" style="padding:10px">
						Apakah Anda setuju jika kami melakukan operasi open source massal seluruh Indonesia?
						<div style="windth:90%; background-color:green; height:200px">
						</div>
						<div style="text-align:center"><span class="btn" style="margin-top:10px;"><a>Sampaikan suara Anda! Klik di ini.</a></span></div>
					</div>
				</div>
				<div class="box">
					<div data-original-title="" class="box-header well" style="padding-left:10px">
						<h2><i class="icon-globe"></i> Jaringan Komunikasi</h2>
					</div>
					<div class="box-content" style="padding:10px">
						<ul>
							<li><a>Indonesia.go.id</a></li>
							<li><a>LInk-another.go.id</a></li>
							<li><a>Pancasila.go.id</a></li>
							<li><a>Pemerintahan-kita.go.id</a></li>
							<li><a>jakarta.go.id</a></li>
							<li><a>Seluk-beluk.go.id</a></li>
							<li><a>Nusantara.go.id</a></li>
						</ul>
					</div>
				</div>
				<div class="box">
					<div data-original-title="" class="box-header well" style="padding-left:10px">
						<h2><i class="icon-globe"></i> Peta Situs</h2>
					</div>
					<div class="box-content" style="padding:10px">
						
						
					</div>
				</div>
			</div>
		</div>
		<?php
		if($stage!='important'){
		?>
		<div class="row-fluid">
			<div class="row-fluid">
			</div>
			<div class="row-fluid">
				<div class="span4  box"><div id="chart_bulanan_permohonan" style="margin: 0 auto"></div></div>
				<div class="span4 box"><div id="chart_status_permohonan" style="margin: 0 auto"></div></div>
				<div class="span4 box"><div id="chart_status_pengaduan" style="margin: 0 auto"></div></div>
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