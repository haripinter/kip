<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function Bottons($id){
	return '<div class="btn-group dropup">
		<button type="button" class="btn dropdown-toggle span12" data-toggle="dropdown">
		Menu&nbsp;<span class="caret"></span>
		</button>
		<ul class="dropdown-menu pull-right">
			<li>
				<a class="bt bt-edit-data" name="'.$id.'"><span class="icon-edit"></span> Edit Nama File</a>
			</li>
			<li>
				<a class="bt bt-view-data" name="'.$id.'"><span class="icon-edit"></span> Download</a>
			</li>
			<li>
				<a class="bt bt-delete-data" name="'.$id.'"><span class="icon-remove"></span> Delete</a>
			</li>
		</ul>
	</div>';
}

$popup_action = site_url().'shot-dokumen';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> DOKUMEN PUBLIK</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table bootstrap-datatable datatable">
				<thead>
					<th width="1px">No</th>
					<th>Nama File</th>
					<th width="1px">Preview</th>
					<th width="20px">Tanggal</th>
					<th width="20px">Didownload</th>
					<th width="70px">&nbsp;</th>
				</thead>
				<tbody>
					<?php
					$n = 1;
					foreach($dokumen as $doc){
						$berkas = 'media/dokumen/'.$doc['media_realname'];
						$ext = pathinfo($berkas, PATHINFO_EXTENSION);
						
						$prev = '';
						if(@$doc['media_thumbnail']!='' && file_exists(urldecode(@$doc['media_thumbnail']))){
							$prev = '<img src="'.site_url().$doc['media_thumbnail'].'" height="30px">';
						}
						
						if($prev==''){
							
						}
						?>
						<tr>
							<td><center><?php echo $n; ?></center><span class="rowstbl<?php echo $doc['media_id']; ?>"></span></td>
							<td><?php echo $doc['media_title']; ?></td>
							<td><?php echo $prev; ?></td>
							<td><?php echo datetime_tgl($doc['media_datetime']); ?></td>
							<td><?php echo intval($doc['media_viewed']); ?> kali</td>
							<td><?php echo Bottons($doc['media_id']); ?></td>
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
	
	action_edit($('.datatable .bt-edit-data'));
	action_view($('.datatable .bt-view-data'));
	action_delete($('.datatable .bt-delete-data'));
	
	function action_view(btn){
		btn.click(function(){
			var id = this.name
			var url = '<?php echo $popup_action; ?>/download/'+id;
			var get = $('#frame_download').attr('src',url);
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
			var res = pop.find('.modal-result');
			
			// edit this
			mug.html('Tunggu...');
			pop.find('h4').html('Edit Nama Dokumen');
			var urls = '<?php echo $popup_action; ?>';
			var aidi = this.name;
			var data = {action:'rename',id:aidi};
			
			var post = $.post(urls,data);
			post.done(function(data){
				pop.find('.modal-footer .bt-zimpan-ID').remove();
				var betn = $('<a class="btn btn-success bt-zimpan bt-zimpan-ID" name="'+aidi+'">Simpan</a>');
				var dbei = pop.find('.modal-footer');
				dbei.append(betn);
				action_save(betn);
				
				pop.modal('show');
				mug.html(data);
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
			var data = {action:'delete',id:this.name};
			bootbox.confirm("Anda yakin akan menghapus Dokumen ini?", function(result) {
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
	
	function action_save(btn){
		btn.click(function(){
			var btn = $(this);
			var box = btn.parents('.bawah-datatabel').parent();
			var tbl = box.find('.datatable');
			var pop = box.find('.modalzWindow');
			var mug = pop.find('.modal-body');
			var res = pop.find('.modal-result');
			var frm = mug.children('form');
			
			var urls = '<?php echo $popup_action; ?>';
			var data = frm.serializeArray();
			
			var post = $.post(urls,data);
			post.done(function(data){
				data = $.parseJSON(data);
				var fi = '.rowstbl'+data['media_id'];
					
				var tr  = '';
				tbl = tbl.dataTable();
				var tx = tbl.fnGetNodes();
				$(tx).each(function(){
					var dm = $(this).find(fi);
					if(dm.length>0) tr = dm.parent().parent();
				});
				var trpos = tbl.fnGetPosition(tr[0]);
				
				tbl.fnUpdate(data['media_title'],trpos,1);
				
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
		pop.find('h4').html('Tambah Tautan');
		var urls = '<?php echo $popup_action; ?>';
		var data = {action:'edit',id:this.name};
		
		var post = $.post(urls,data);
		post.done(function(data){
			pop.find('.modal-footer .bt-zimpan-ID').remove();
			pop.modal('show');
			mug.html(data);
			action_upload(mug);
			res.html('');
		});
	});
	
	function action_upload(dom){
		'use strict';
		var pop = dom.parents('.modalzWindow');
		var res = pop.find('.modal-result');
		var tar = dom.find('.fileupload');
		var frm = dom.find('form');
		var prg = dom.find('.progress');
		
		tar.fileupload({
			url: '<?php echo $popup_action; ?>',
			dataType: 'json',
			add: function (e, data) {
				if(prg.hasClass('progress-danger')){
					prg.removeClass('progress-danger').addClass('progress-success');
				}
				
				var piring = $('#fbody');
				var index = (piring.children()).length;
				var btupload = $('<input type="button" class="btn btn-info" value="upload" name="btupload">');
				var filename = $('<span name="filename">'+data.files[0].name+'</span>');
				var tr = $('<tr></tr>');
				var td = [];
				td[0] = $('<td></td>').append(filename);
				td[1] = $('<td width="40px"></td>').append(btupload);
				tr.append(td);
				$('#fbody').append(tr);
				data['button'] = btupload;
				
				btupload.click(function(){
					if(btupload.hasClass('disabled')) return;
					$('.progress').addClass('active').removeClass('hide');
					data.submit();
				});
			},
			submit: function (e, data){
				data.formData = {action:'upload'};
			},
			done: function (e, data) {
				$(data.button).removeClass('btn-info').addClass('disabled');
				$(data.button).val('Sukses');
				$('.progress .bar').css('');
				$('.progress').removeClass('active');
				
				var buttons = $('.Bottons').val();
				
				var tabel = $('.datatable').dataTable();
				var value = data.result.files[0];
				var preview = '';
				if(value.media_thumbnail!='') preview = '<img src="<?php echo site_url(); ?>'+value.media_thumbnail+'" height="30px">'
				var xploi = [];
				xploi[0] = '<center>'+(tabel.fnGetData().length+1)+'</center><span class="rowstbl'+value.media_id+'"></span>';
				xploi[1] = value.media_title;
				xploi[2] = preview;
				xploi[3] = value.media_datetime;
				xploi[4] = '0 kali';
				xploi[5] = buttons;
				
				var last = tabel.fnAddData(xploi);
				var nod = tabel.fnGetNodes(last[0]);
				
				var edit = $(nod).find('a.bt-edit-data');
				var view = $(nod).find('a.bt-view-data');
				var remv = $(nod).find('a.bt-delete-data');
				
				edit.attr('name',value.media_id);
				view.attr('name',value.media_id);
				remv.attr('name',value.media_id);
				
				action_edit(edit);
				action_view(view);
				action_delete(remv);
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