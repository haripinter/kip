<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';
$total = $statistik_status[count($statistik_status)-1]['jumlah'];

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
			foreach($statistik_status as $s){
				if($s['status']!='total'){
					if($n%4==1){
						echo "{name:'".ucwords($s['status'])."', y:".$s['jumlah'].", sliced:true, selected:true}";
					}else{
						echo "['".ucwords($s['status'])."', ".$s['jumlah']."]";
					}
				}
				$n++;
				if((count($statistik_status)-2)>=$n){
					echo ',';
				}
			}
			?>
            ];
    $('#container').highcharts({
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
                        return '<b>'+ this.point.name +'</b>: '+ new Number(this.percentage).toPrecision(4) +' %';
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
		
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> DAFTAR PERMOHONAN</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="modalwin" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<header class="modal-header">
					<a href="#" class="close" data-dismiss="modal">x</a>
					<h4>Ubah Status</h4>
				</header>
				<div class="modal-body permohonan-body">
					Wait...
				</div>
			</div>
			<table class="table table-bordered bootstrap-datatable datatable">
				<thead>
					<th width="2px">No</th>
					<th>Pemohon</th>
					<th width="80px">Tanggal</th>
					<th>Informasi yang Diminta</th>
					<th>Status</th>
					<th width="120px">&nbsp;</th>
				</thead>
				<tbody>
					<?php
					$n = 1;
					foreach($request as $r){
						$nomor = '';
						if($r['request_nomor']!='') $nomor = "<br/>Nomor : <b>".$r['request_nomor']."</b>";
						echo "<tr>";
							echo "<td><center>".$n++."</center></td>";
							echo "<td>".$r['user_fullname']."</td>";
							echo "<td><center>".datetime_tgl($r['request_datetime'])."</center></td>";
							echo "<td>".$r['request_information']."</td>";
							echo "<td class='status'>".$r['request_status'].$nomor."</td>";
							echo "<td>
									<a class='btn btn-info bt-edit linked".$r['request_id']."' name='".$r['request_id']."' href='#modalwin' data-toggle='modal' title='Edit'>
										<i class='icon-edit icon-white'></i>          
									</a>
									<a class='btn btn-success bt-view' name='".$r['request_id']."' title='View'>
										<i class='icon-search icon-white'></i>          
									</a>
									<a class='btn btn-danger bt-remove' name='".$r['request_id']."' title='Delete'>
										<i class='icon-trash icon-white'></i>
									</a></td>";
						echo "</tr>";
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row-fluid sortable">
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATISTIK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="containerx" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
		</div>
	</div>
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATUS SK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
		</div>
	</div>
</div>
<script>
	$('.bt-edit').click(function(){
		$('.permohonan-body').html('Wait...');
		var url = '<?php echo $site_url; ?>/index.php/popup/status_permohonan/'+this.name;
		var get = $.get(url);
		get.done(function(data){
			$('.permohonan-body').html(data);
		});
	});
	
	$('.bt-view').click(function(){
		location.href = '<?php echo $site_url; ?>/index.php/root/permohonan/view/'+this.name;
	});
</script>
