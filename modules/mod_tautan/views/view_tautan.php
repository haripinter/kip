<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

function Bottons($id){
	return '<div class="btn-group dropup">
		<button type="button" class="btn dropdown-toggle span12" data-toggle="dropdown">
		Menu&nbsp;<span class="caret"></span>
		</button>
		<ul class="dropdown-menu pull-right">
			<li>
				<a class="bt bt-edit-data" name="'.$id.'"><span class="icon-edit"></span> Edit</a>
			</li>
			<li>
				<a class="bt bt-delete-data" name="'.$id.'"><span class="icon-remove"></span> Delete</a>
			</li>
		</ul>
	</div>';
}

$popup_action = site_url().'shot-tautan';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> TAUTAN</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table bootstrap-datatable datatable">
				<thead>
					<th width="1px">No.</th>
					<th>Judul</th>
					<th width="31px">Gambar</th>
					<th>Tautan</th>
					<th width="70px">Jenis</th>
					<th width="10px">Status</th>
					<th width="70px">&nbsp;</th>
				</thead>
				<tbody>
					<?php
					$n = 1;
					foreach($link as $l){
						$preview = '';
						if(isset($l['media_thumbnail']) && file_exists(urldecode($l['media_thumbnail']))){
							$preview = '<img src="'.site_url().'/'.$l['media_thumbnail'].'" height="30px">';
						}
						
						$id = $l['tautan_id'];
						$link = $l['tautan_link'];
						$title = $l['tautan_title'];
						$option = $l['tautan_option'];
						$status = $l['tautan_status'];
						?>
						<tr>
							<td><center><?php echo $n; ?></center><span class="rowstbl<?php echo $id; ?>"></span></td>
							<td><?php echo $title; ?></td>
							<td><?php echo $preview; ?></td>
							<td><?php echo $link; ?></td>
							<td><?php echo $option; ?></td>
							<td><?php echo $status; ?></td>
							<td><?php echo Bottons($id); ?></td>
						</tr>
						<?php
						$n++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<iframe id="frame_download" src="" style="visibility:hidden"></iframe>
<input type="hidden" class="Bottons" value="<?php echo htmlspecialchars(Bottons(0));?>">
<script>
$(document).ready(function(){
	$('.box-berita .nav-tabs li a').click(function(){
		var sect = $($(this).attr('href'));
		sect.addClass('active');
		var tabs = sect.find('.datatable');
		tabs.dataTable().fnAdjustColumnSizing();
	});
	
	action_edit($('.datatable .bt-edit-data'));
	action_delete($('.datatable .bt-delete-data'));
	
	function action_edit(dom){
		dom.click(function(){
			var btn = $(this);
			var tbl = btn.parents('.datatable');
			var tr  = btn.parents('.datatable tbody tr');
			var td  = btn.parents('.datatable tbody td');
			var box = tbl.parent();
			var pop = box.find('.modalzWindow');
			var mug = pop.find('.modal-body');
			var res = pop.find('.modal-result');
			
			// edit this
			mug.html('Tunggu...');
			pop.find('h4').html('Edit Tautan');
			var urls = '<?php echo $popup_action; ?>';
			//var tipe = box.parent().attr('id');
			var data = {action:'edit',id:this.name};
			
			var post = $.post(urls,data);
			post.done(function(data){
				pop.modal('show');
				mug.html(data);
				action_upload(mug);
				res.html('');
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
			var urls = '<?php echo $popup_action; ?>';
			var tipe = box.parent().attr('id');
			var data = {action:'delete',id:this.name};
			bootbox.confirm("Anda yakin akan menghapus Tautan ini?", function(result) {
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
	$("div.bt-datatable-add").html('<a class="btn btn-info pull-right bt-add-data" name="0"><span class="icon-plus icon-white"></span> Tambah Data</a>');
	
	var modalz = '<div class="modalzWindow modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
					<header class="modal-header">\
						<a class="close modal-tutup">&times;</a>\
						<h4></h4>\
					</header>\
					<div class="modal-body"></div>\
					<footer class="modal-footer">\
						<span class="pull-left">\
							<span class="modal-result"></span>\
						</span>\
						<a class="btn modal-tutup">Tutup</a>\
						<a class="btn btn-success bt-zimpan">Simpan</a>\
					</footer>\
				  </div>';
	$(".modalZ").html(modalz);
	
	$(".modalzWindow .modal-tutup").click(function(){
		var btn = $(this);
		var pop = btn.parents('.modalzWindow');
		var mug = pop.find('.modal-body');
		mug.html('');
		pop.modal('hide');
	});
	
	/*
	$(".modalzWindow .bt-modal-baru").click(function(){
		var btn = $(this);
		var box = btn.parents('.bawah-datatabel').parent();
		var inp = box.find('input');
		box.find('input[name="tautan_id"]').val(0);
		box.find('input[name="title"]').val('');
		box.find('input[name="link"]').val('');
		box.find('select[name="tautan_option"]').val(0);
		box.find('input[name="mediaid"]').val('');
		box.find('span[name="txt_filename"]').html('');
		box.find('select[name="status"]').val('on');
		box.find('file[name="files[]"]').MultiFile('reset');
	});*/
	
	$('.bt-datatable-add .bt-add-data').click(function(){
		var btn = $(this);
		var box = btn.parents('.bawah-datatabel').parent();
		var tbl = box.find('.datatable');
		var pop = box.find('.modalzWindow');
		var mug = pop.find('.modal-body');
		var res = pop.find('.modal-result');
		
		// edit this
		mug.html('Tunggu...');
		pop.find('h4').html('Tambah Tautan');
		var urls = '<?php echo $popup_action; ?>';
		var data = {action:'edit',id:this.name};
		
		var post = $.post(urls,data);
		post.done(function(data){
			pop.modal('show');
			mug.html(data);
			action_upload(mug);
			res.html('');
		});
	});
	
	$(".modalzWindow .bt-zimpan").click(function(){
		var btn = $(this);
		var pop = btn.parents('.modalzWindow');
		var box = pop.parents('.bawah-datatabel').parent();
		var tbl = box.find('.datatable');
		var res = pop.find('.modal-result');
		var mug = pop.find('.modal-body');
		var frm = mug.find('form');
		var prv = frm.find('.tautan_thumbnail');
		
		// edit this
		res.html('Sedang menyimpan...');
		var urls = '<?php echo $popup_action; ?>';
		var tipe = box.parent().attr('id');
		var data = frm.serializeArray();
		var taut = frm.find('input[name="tautan_id"]');
		
		var post = $.post(urls,data);
		post.done(function(data){
			data = $.parseJSON(data);
			tbl  = tbl.dataTable();
			
			var preview = '';
			if(typeof(data['media_thumbnail']) != "undefined" && data['media_thumbnail'] !== null){
				preview = data['media_thumbnail']+'?'+(Number(new Date()));
				preview = '<img src="<?php echo site_url(); ?>'+preview+'" height="30px"></img>';
			}
			prv.html(preview);
			
			if(data['status']=='insert'){
				var buttons = $('.Bottons').val();
				
				var tds = [];
				tds[0] = '<center>'+(tbl.fnGetData().length+1)+'</center><span class="rowstbl'+data['tautan_id']+'"></span>';
				tds[1] = data['tautan_title'];
				tds[2] = preview;
				tds[3] = data['tautan_link'];
				tds[4] = data['tautan_option'];
				tds[5] = data['tautan_status'];
				tds[6] = buttons;
				
				var last = tbl.fnAddData(tds);
				var node = tbl.fnGetNodes(last[0]);
				var edit = $(node).find('a.bt-edit-data');
				var remv = $(node).find('a.bt-delete-data');
				
				taut.val(data['tautan_id']);
				edit.attr('name',data['tautan_id']);
				remv.attr('name',data['tautan_id']);
				action_edit(edit);
				action_delete(remv);
				
				res.html('<font color="green">Tersimpan.</font>');
			}else if(data['status']=='update'){	
				// change this
				var fi = '.rowstbl'+data['tautan_id'];
				
				var tr  = '';
				var tx = tbl.fnGetNodes();
				$(tx).each(function(){
					var dm = $(this).find(fi);
					if(dm.length>0) tr = dm.parent().parent();
				});
				var trpos = tbl.fnGetPosition(tr[0]);
					
				tbl.fnUpdate(data['tautan_title'],trpos,1);
				tbl.fnUpdate(preview,trpos,2);
				tbl.fnUpdate(data['tautan_link'],trpos,3);
				tbl.fnUpdate(data['tautan_option'],trpos,4);
				tbl.fnUpdate(data['tautan_status'],trpos,5);
				
				res.html('<font color="green">Tersimpan.</font>');
			}
			
		});
	});
	
	function action_upload(dom){
		'use strict';
		var pop = dom.parents('.modalzWindow');
		var res = pop.find('.modal-result');
		var tar = dom.find('.fileupload');
		var frm = dom.find('form');
		var prv = frm.find('.tautan_thumbnail');
		var tbl = $('.datatable');
		tar.fileupload({
			url: '<?php echo $popup_action; ?>',
			dataType: 'json',
			add: function (e, data) {
				if($('.progress').hasClass('progress-danger')){
					$('.progress').removeClass('progress-danger').addClass('progress-success');
				}
				
				$('.txt_filename').html(data.files[0].name);
				var btupload = $('.modalzWindow .bt-zimpan');
				btupload.unbind('click');
				btupload.click(function(){
					if(btupload.hasClass('disabled')) return;
					$('.progress').addClass('active').removeClass('hide');
					data.submit();
				});
			},
			submit: function (e, data){
				data.formData = frm.serializeArray();
			},
			done: function (e, data) {
				$('.progress .bar').css('');
				$('.progress').removeClass('active');
				var dota = data.result.files[0];
				tbl  = tbl.dataTable();
				
				var preview = '';
				if(typeof(dota.media_thumbnail) != "undefined" && dota.media_thumbnail !== null){
					preview = dota.media_thumbnail+'?'+(Number(new Date()));
					preview = '<img src="<?php echo site_url(); ?>'+preview+'" height="30px"></img>';
				}
				if(dota.thumbnailUrl!=''){
					console.log(dota.thumbnailUrl)
					preview = '<img src="<?php echo site_url(); ?>'+dota.thumbnailUrl+'?'+(Number(new Date()))+'" height="30px"></img>';
				}
				prv.html(preview);
				
				if(dota.status=='insert'){
					var buttons = $('.Bottons').val();
					
					var tds = [];
					tds[0] = '<center>'+(tbl.fnGetData().length+1)+'</center><span class="rowstbl'+dota.tautan_id+'"></span>';
					tds[1] = dota.tautan_title;
					tds[2] = preview;
					tds[3] = dota.tautan_link;
					tds[4] = dota.tautan_option;
					tds[5] = dota.tautan_status;
					tds[6] = buttons;
					
					var last = tbl.fnAddData(tds);
					var node = tbl.fnGetNodes(last[0]);
					var edit = $(node).find('a.bt-edit-data');
					var remv = $(node).find('a.bt-delete-data');
					
					taut.val(dota.tautan_id);
					edit.attr('name',dota.tautan_id);
					remv.attr('name',dota.tautan_id);
					action_edit(edit);
					action_delete(remv);
					
					res.html('<font color="green">Tersimpan.</font>');
				}else if(dota.status=='update'){	
					// change this
					var fi = '.rowstbl'+dota.tautan_id;
					
					var tr  = '';
					var tx = tbl.fnGetNodes();
					$(tx).each(function(){
						var dm = $(this).find(fi);
						if(dm.length>0) tr = dm.parent().parent();
					});
					var trpos = tbl.fnGetPosition(tr[0]);
					
					tbl.fnUpdate(dota.tautan_title,trpos,1);
					tbl.fnUpdate(preview,trpos,2);
					tbl.fnUpdate(dota.tautan_link,trpos,3);
					tbl.fnUpdate(dota.tautan_option,trpos,4);
					tbl.fnUpdate(dota.tautan_status,trpos,5);
					
					res.html('<font color="green">Tersimpan.</font>');
				}
				
			},
			progress: function (e, data) {
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('.progress .bar').css('width', progress + '%');
			}
		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');
	}
	
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