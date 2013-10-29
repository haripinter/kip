<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

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
					echo "'".namabulan($bu['bulan'])."'";
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
	
	var bulan = [
			<?php
				$n = 0;
				foreach($stat_bulanan_pengaduan as $bu){
					echo "'".namabulan($bu['bulan'])."'";
					if(count($stat_bulanan_pengaduan)>$n++) echo ',';
				}
			?>
			];
	var jumlah_bulanan = [
			<?php
				$n = 0;
				foreach($stat_bulanan_pengaduan as $bu){
					echo $bu['jumlah'];
					if(count($stat_bulanan_pengaduan)>$n++) echo ',';
				}
			?>
			];
	var total_bulanan = [
			<?php
				$n = $c = 0;
				foreach($stat_bulanan_pengaduan as $bu){
					$c += $bu['jumlah'];
					echo $c;
					if(count($stat_bulanan_pengaduan)>$n++) echo ',';
				}
			?>
			];
	
	$('#chart_bulanan_pengaduan').highcharts({
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
});
    

		</script>
<div class="row-fluid sortable">
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATISTIK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="chart_status_permohonan" style="margin: 0 auto"></div>
		</div>
	</div>
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATUS SK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="chart_bulanan_permohonan" style="margin: 0 auto"></div>
		</div>
	</div>
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATUS SK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="chart_bulanan_permohonan" style="margin: 0 auto"></div>
		</div>
	</div>
</div>
<div class="row-fluid sortable">
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATISTIK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="chart_status_pengaduan" style="margin: 0 auto"></div>
		</div>
	</div>
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATUS SK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="chart_bulanan_pengaduan" style="margin: 0 auto"></div>
		</div>
	</div>
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATUS SK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="chart_bulanan_pengaduan" style="margin: 0 auto"></div>
		</div>
	</div>
</div>