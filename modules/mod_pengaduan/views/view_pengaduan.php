<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$total = $statistik_status[count($statistik_status)-1]['jumlah'];

$popup_action = site_url().'shot-pengaduan';

function Bottons($id){
	return '<div class="btn-group dropup">
		<button type="button" class="btn dropdown-toggle span12" data-toggle="dropdown">
		Menu&nbsp;<span class="caret"></span>
		</button>
		<ul class="dropdown-menu pull-right">
			<li>
				<a class="bt bt-view-data" name="'.$id.'"><span class="icon-remove"></span> View</a>
			</li>
			<li>
				<a class="bt bt-edit-data" name="'.$id.'"><span class="icon-edit"></span> Ganti Status</a>
			</li>
			<li>
				<a class="bt bt-delete-data" name="'.$id.'"><span class="icon-remove"></span> Delete</a>
			</li>
		</ul>
	</div>';
}
?>
		
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> DAFTAR PENGADUAN</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table bootstrap-datatable datatable">
				<thead>
					<th width="2px">No</th>
					<th>Pengadu</th>
					<th width="80px">Tanggal</th>
					<th>Hal yang Diadukan</th>
					<th>Status</th>
					<th width="70px">&nbsp;</th>
				</thead>
				<tbody>
				<?php
				$n = 1;
				foreach($complain as $c){
					$id = $c['complain_id'];
					$reason = json_decode($c['complain_reason']);
					
					$case = '';
					if($c['complain_case']!='') $case = "<br/><b>Kasus</b><br/><ul><li>".$c['complain_case']."</li></ul>";
					?>
					<tr>
						<td><center><?php echo $n++; ?></center><span class="rowstbl<?php echo $id; ?>"></span></td>
						<td><?php echo $c['user_fullname']; ?></td>
						<td><center><?php echo datetime_tgl($c['complain_datetime']); ?></center></td>
						<td><?php
							echo '<ul>';
								foreach($reason as $reas){
								  echo '<li>';
									echo $alasan_pengaduan[$reas];
								  echo '</li>';
								}
							echo '</ul>';
							echo $case; 
							?>
						</td>
						<td><?php echo $c['complain_status']; ?></td>
						<td><?php echo Bottons($id); ?></td>
					</tr>
					<?php
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
$(document).ready(function(){

	action_view($('.bt-view-data'));
	action_edit($('.bt-edit-data'));
	action_delete($('.bt-delete-data'));
	
	function action_view(dom){
		dom.click(function(){
			location.href = '<?php echo site_url(); ?>admin/pengaduan/view/'+this.name;
		});
	}
	
	function action_edit(dom){
		dom.click(function(){
			var btn = $(this);
			var tbl = btn.parents('.datatable');
			var tr  = btn.parents('.datatable tbody tr');
			var td  = btn.parents('.datatable tbody td');
			var box = tbl.parent();
			var pop = box.find('.modalzWindow');
			var mug = pop.find('.modal-body');
			
			// edit this
			mug.html('Tunggu...');
			pop.find('h4').html('Edit Status Pengaduan');
			var idid = btn.attr('name');
			var urls = '<?php echo $popup_action; ?>';
			var data = {action: 'popup_status', id: idid};
			
			var post = $.post(urls,data);
			post.done(function(data){
				pop.modal('show');
				mug.html(data);
			});
		});
	}
	
	function action_delete(dom){
		dom.click(function(){
			var btn = $(this);
			var tbl = btn.parents('.datatable');
			var tr  = btn.parents('.datatable tbody tr');
			var box = tbl.parent();
			
			// edit this
			var request_id = this.name;
			var urls  = '<?php echo $popup_action; ?>';
			var data = {action:'delete', id:request_id};
			bootbox.confirm("Anda yakin akan menghapus Pengaduan ini?", function(result) {
				if(result==true){
					var post = $.post(urls,data);
					post.done(function(data){
						data = $.parseJSON(data);
						if(data['status']=='success'){
							tbl = tbl.dataTable();
							tbl.fnDeleteRow(tbl.fnGetPosition(tr[0]));
							sort_tabel(tbl);
						}
					});
				}
			});
		});
	}
	
	$('.datatable').dataTable({
		"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid bawah-datatabel'<'span8'i><'span4 bt-datatable-add'><'span12 center'p><'modalZ'>>",
		"sPaginationType": "bootstrap",
		"aoColumnDefs": [ { "sType": "numeric", "aTargets": [ 0 ] } ],
		"oLanguage": {
			"sLengthMenu": "_MENU_ Tampilan Perhalaman"
		}
	});
	
	var modalz = '<div class="modalzWindow modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
					<header class="modal-header">\
						<a class="close modal-tutup">&times;</a>\
						<h4></h4>\
					</header>\
					<div class="modal-body"></div>\
					<footer class="modal-footer">\
						<span class="pull-left modal-result"></span>\
						<a class="btn modal-tutup">Tutup</a>\
						<a class="btn btn-success bt-zimpan">Simpan</a>\
					</footer>\
				  </div>';
	$(".modalZ").html(modalz);
	
	$(".modalzWindow .modal-tutup").click(function(){
		var btn = $(this);
		var pop = btn.parents('.modalzWindow');
		var res = pop.find('.modal-result');
		var mug = pop.find('.modal-body');
		mug.html('');
		res.html('');
		pop.modal('hide');
	});
	
	$(".modalzWindow .bt-zimpan").click(function(){
		var btn = $(this);
		var pop = btn.parents('.modalzWindow');
		var box = pop.parents('.bawah-datatabel').parent();
		var tbl = box.find('.datatable');
		var res = pop.find('.modal-result');
		var mug = pop.find('.modal-body');
		var frm = mug.find('form');
		
		// edit this
		res.html('Sedang menyimpan...');
		var data = frm.serializeArray();
		var urls = '<?php echo $popup_action; ?>';
		var post = $.post(urls,data);
		post.done(function(data){
			data = $.parseJSON(data);
			tbl  = tbl.dataTable();
			var tr = tbl.find('.rowstbl'+data['complain_id']).parent().parent();
			var trpos = tbl.fnGetPosition(tr[0]);
			tbl.fnUpdate(data['complain_status'],trpos,4);
			
			res.html('<font color="green">Tersimpan.</font>');
		});
	});
	
	function sort_tabel(tbl){
		var trs = tbl.fnGetNodes();
		var num = 1;
		$(trs).each(function(){
			var tds = $(this).find('td');
			var spa = $(tds[0]).children('span');
			var cen = $(tds[0]).children('center');
			cen.html(num);
			
			var isi = $('<div>').append(cen).append(spa);
			tbl.fnUpdate(isi.html(),tbl.fnGetPosition(this),0);
			isi.remove();
			num++;
		});
	}
	
	function sort_tabel_biasa(tbody){
		var trs = $(tbody).children('tr');
		var nnn = 1;
		$(trs).each(function(){
			var tds = $(this).children('td');
			$(tds[0]).children('center').html(nnn);
			nnn++;
		});
	}
});
</script>


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
					echo "'".namabulan($bu['bulan'])."'";
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
});
    

		</script>