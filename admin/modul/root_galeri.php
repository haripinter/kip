<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> GALERI</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div id="modalwin" class="modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<header class="modal-header">
					<a href="#" class="close" data-dismiss="modal">x</a>
					<h4>UNGGAH FOTO GALERI</h4>
				</header>
				<div class="modal-body download-body">
					Tunggu...
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
					<!--th >Nama File</th-->
					<th width="80px"><center>Tanggal</center></th>
					<th width="80px">Diakses</th>
					<th width="120px">&nbsp;</th>
				</thead>
				<tbody>
					<?php
					$n = 1;
					foreach($galeri as $d){
						$preview = '';
						if(isset($d['media_thumbnail']) && file_exists($d['media_thumbnail'])){
							$preview = '<img src="'.$site_url.'/'.$d['media_thumbnail'].'" height="30px">';
						}
						
						echo "<tr>";
							echo "<td>".$preview."</td>";
							echo "<td class='media-title'>".$d['media_title']."</td>";
							//echo "<td>".$d['media_realname']."</td>";
							echo "<td><center>".datetime_tgl($d['media_datetime'])."</center></td>";
							echo "<td>".intval($d['media_viewed'])." kali</td>";
							echo "<td>
									<a class='btn btn-info bt-edit' mode='edit' name='".$d['media_id']."' title='Edit'>
										<i class='icon-edit icon-white'></i>          
									</a>
									<a class='btn btn-info bt-view' name='".$d['media_id']."' title='View'>
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
<iframe id="frame_download" src="" style="visibility:hidden"></iframe>
<script>
	$('.bt-tambah').click(function(){
		$('.download-body').html('Wait...');
		var url = '<?php echo $site_url; ?>/index.php/popup/galeri_ui';
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
						var tr = (btn.parent().parent())[0];
						var tabel = $('.datatable').dataTable();
						tabel.fnDeleteRow(tabel.fnGetPosition(tr));
					}
				});
			}
		});
	});
	
	$('.bt-edit').click(function(){
		var media_id = this.name;
		var btn = $(this);
		var ico = btn.html();
		var title = btn.parent().parent().find('td.media-title');
		if(btn.attr('mode')=='edit'){
			title.html('<input type="text" name="media_title" value="'+title.html()+'" class="span12">');
			btn.attr('mode','save');
			btn.removeClass('btn-info').addClass('btn-success');
			btn.children().removeClass('icon-edit').addClass('icon-hdd');
		}else{
			var url  = '<?php echo $site_url; ?>/index.php/popup/media_title';
			var post = $.post(url,{media: media_id, title: title.children().val()});
			post.done(function(data){
				title.html(data);
				btn.attr('mode','edit');
				btn.removeClass('btn-success').addClass('btn-info');
				btn.children().removeClass('icon-hdd').addClass('icon-edit');
			});
		}
	});
	
	$('.bt-view').click(function(){
		var url = '<?php echo $site_url; ?>/index.php/popup/download/'+this.name;
		var get = $('#frame_download').attr('src',url);
	});
</script>