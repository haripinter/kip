<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';
?>
<style>
	.dataTables_filter{
		float: right;
	}
	.table thead{
		background-color: #eee;
	}
</style>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> DOKUMEN PUBLIK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="modalwin" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<header class="modal-header">
					<a href="#" class="close" data-dismiss="modal">x</a>
					<h4>UNGGAH DOKUMEN PUBLIK</h4>
				</header>
				<div class="modal-body download-body">
					Wait...
				</div>
			</div>
			<div>
				<a class="btn bt-tambah"  href='#modalwin' data-toggle='modal'>TAMBAH</a>
			</div>
			<br/>
			<table class="table bootstrap-datatable datatable">
				<thead>
					<th width="1px">Preview</th>
					<th>Judul</th>
					<th>Nama File</th>
					<th width="80px"><center>Tanggal</center></th>
					<th width="80px">Diakses</th>
					<th width="120px">&nbsp;</th>
				</thead>
				<tbody>
					<?php
					$n = 1;
					foreach($download as $d){
						$preview = '';
						$foldr = 'media/berkas/';
						$thumb = $foldr.'/thumbnail/';
						if(isset($d['media_thumbnail']) && file_exists($thumb.$d['media_thumbnail'])){
							$preview = '<img src="'.$site_url.'/'.$thumb.$d['media_thumbnail'].'" height="30px">';
						}
						
						echo "<tr>";
							echo "<td>".$preview."</td>";
							echo "<td>".$d['media_title']."</td>";
							echo "<td>".$d['media_realname']."</td>";
							echo "<td><center>".datetime_tgl($d['media_datetime'])."</center></td>";
							echo "<td>".intval($d['media_viewed'])." kali</td>";
							echo "<td>
									<a class='btn btn-info bt-edit' name='".$d['media_id']."' href='#modalwin' data-toggle='modal' title='Edit'>
										<i class='icon-edit icon-white'></i>          
									</a>
									<a class='btn btn-success bt-view' name='".$d['media_realname']."' title='View'>
										<i class='icon-search icon-white'></i>          
									</a>
									<a class='btn btn-danger bt-remove' name='".$d['media_id']."' title='Delete'>
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
<script>
	$('.bt-tambah').click(function(){
		$('.download-body').html('Wait...');
		var url = '<?php echo $site_url; ?>/index.php/popup/upload_ui';
		var get = $.get(url);
		get.done(function(data){
			$('.download-body').html(data);
		});
	});
	
	$('.bt-remove').click(function(){
		var btn = $(this);
		var media_id = this.name;
		bootbox.confirm("Anda yakin akan menghapus konten ini?", function(result) {
			if(result==true){
				var url  = '<?php echo $site_url; ?>/index.php/popup/media_del';
				var post = $.post(url,{media: media_id});
				post.done(function(data){
					if(data=='OK'){
						var tr = btn.parent().parent();
						var tabel = $('.datatable').dataTable();
						tabel.fnDeleteRow(tr.index());
					}
				});
			}
		});
	});
	
	$('.bt-view').click(function(){
		
		//var tabel = $('.datatable').dataTable();
		//tabel.fnAddData();
	});
</script>