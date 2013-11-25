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

$popup_action = site_url().'shot-slideshow';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> SLIDESHOW</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table bootstrap-datatable datatable">
				<thead>
					<th width="1px">No.</th>
					<th width="1px">Gambar</th>
					<th>Judul</th>
					<th>Deskripsi</th>
					<th width="60px"><center>Status</center></th>
					<th width="70px">&nbsp;</th>
				</thead>
				<tbody>
					<?php
					$n = 1;
					foreach($slideshow as $d){
						$preview = '';
						if(isset($d['media_thumbnail']) && file_exists(urldecode($d['media_thumbnail']))){
							$preview = '<img src="'.site_url().'/'.$d['media_thumbnail'].'" height="30px">';
						}
						
						$id = $d['media_id'];
						$title = $d['media_title'];
						$description = $d['media_description'];
						$status = $d['media_status'];
						
						?>
						<tr>
							<td><center><?php echo $n; ?></center><span class="rowstbl<?php echo $id; ?>"></span></td>
							<td><?php echo $preview; ?></td>
							<td><?php echo $title; ?></td>
							<td><?php echo $description; ?></td>
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
<input type="hidden" class="Bottons" value="<?php echo htmlspecialchars(Bottons(0));?>">
<script>
$(document).ready(function(){

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
			
			pop.find('h4').html('Edit Slideshow');
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
			bootbox.confirm("Anda yakin akan menghapus Slideshow ini?", function(result) {
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
	
	$('.bt-datatable-add .bt-add-data').click(function(){
		var btn = $(this);
		var box = btn.parents('.bawah-datatabel').parent();
		var tbl = box.find('.datatable');
		var pop = box.find('.modalzWindow');
		var mug = pop.find('.modal-body');
		var res = pop.find('.modal-result');
		
		// edit this
		mug.html('Tunggu...');
		pop.find('h4').html('Tambah Slideshow');
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
		var prv = frm.find('.media_thumbnail');
		
		// edit this
		res.html('Sedang menyimpan...');
		var urls = '<?php echo $popup_action; ?>';
		
		var tipe = box.parent().attr('id');
		var data = frm.serializeArray();
		var slid = frm.find('input[name="id"]');
		
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
				tds[0] = '<center>'+(tbl.fnGetData().length+1)+'</center><span class="rowstbl'+data['media_id']+'"></span>';
				tds[1] = preview;
				tds[2] = data['media_title'];
				tds[3] = data['media_description'];
				tds[4] = data['media_status'];
				tds[5] = buttons;
				
				var last = tbl.fnAddData(tds);
				var node = tbl.fnGetNodes(last[0]);
				var edit = $(node).find('a.bt-edit-data');
				var remv = $(node).find('a.bt-delete-data');
				
				slid.val(data['media_id']);
				edit.attr('name',data['media_id']);
				remv.attr('name',data['media_id']);
				action_edit(edit);
				action_delete(remv);
				
				res.html('<font color="green">Tersimpan.</font>');
			}else if(data['status']=='update'){	
				// change this
				var fi = '.rowstbl'+data['media_id'];
				
				var tr  = '';
				var tx = tbl.fnGetNodes();
				$(tx).each(function(){
					var dm = $(this).find(fi);
					if(dm.length>0) tr = dm.parent().parent();
				});
				var trpos = tbl.fnGetPosition(tr[0]);
					
				tbl.fnUpdate(preview,trpos,1);
				tbl.fnUpdate(data['media_title'],trpos,2);
				tbl.fnUpdate(data['media_description'],trpos,3);
				tbl.fnUpdate(data['media_status'],trpos,4);
				
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
		var prv = frm.find('.media_thumbnail');
		var tbl = $('.datatable');
		
		var slid = frm.find('input[name="id"]');
		
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
					if(typeof(dota.thumbnailUrl) != "undefined" && dota.media_thumbnail !== null){
					preview = dota.media_thumbnail+'?'+(Number(new Date()));
					preview = '<img src="<?php echo site_url(); ?>'+preview+'" height="30px"></img>';
				}
				prv.html(preview);
				
				if(dota.status=='insert'){
					var buttons = $('.Bottons').val();
					
					var tds = [];
					tds[0] = '<center>'+(tbl.fnGetData().length+1)+'</center><span class="rowstbl'+dota.media_id+'"></span>';
					tds[1] = preview;
					tds[2] = dota.media_title;
					tds[3] = dota.media_description;
					tds[4] = dota.media_status;
					tds[5] = buttons;
					
					var last = tbl.fnAddData(tds);
					var node = tbl.fnGetNodes(last[0]);
					var edit = $(node).find('a.bt-edit-data');
					var remv = $(node).find('a.bt-delete-data');
					
					slid.val(dota.media_id);
					edit.attr('name',dota.media_id);
					remv.attr('name',dota.media_id);
					action_edit(edit);
					action_delete(remv);
					
					res.html('<font color="green">Tersimpan.</font>');
				}else if(dota.status=='update'){	
					// change this
					var fi = '.rowstbl'+dota.media_id;
					
					var tr  = '';
					var tx = tbl.fnGetNodes();
					$(tx).each(function(){
						var dm = $(this).find(fi);
						if(dm.length>0) tr = dm.parent().parent();
					});
					var trpos = tbl.fnGetPosition(tr[0]);
					
					tbl.fnUpdate(preview,trpos,1);
					tbl.fnUpdate(dota.media_title,trpos,2);
					tbl.fnUpdate(dota.media_description,trpos,3);
					tbl.fnUpdate(dota.media_status,trpos,4);
					
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