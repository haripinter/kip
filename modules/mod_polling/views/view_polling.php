<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function Bottons($id){
	return '<div class="btn-group dropup">
		<button type="button" class="btn dropdown-toggle span12" data-toggle="dropdown">
		Menu&nbsp;<span class="caret"></span>
		</button>
		<ul class="dropdown-menu pull-right">
			<li>
				<a class="bt bt-edit-data-inline" name="'.$id.'"><span class="icon-edit"></span> Edit</a>
			</li>
			<li>
				<a class="bt bt-edit-data" name="'.$id.'"><span class="icon-edit"></span> Edit Pilihan</a>
			</li>
			<li>
				<a class="bt bt-delete-data" name="'.$id.'"><span class="icon-remove"></span> Delete</a>
			</li>
		</ul>
	</div>';
}

$popup_action = site_url().'shot-polling';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> JAJAK PENDAPAT</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<div>
				<a class="btn bt-add">TAMBAH</a>
			</div>
			<br/>
			<table class="table bootstrap-datatable datatable">
				<thead>
					<th width="1px">No.</th>
					<th>Polling</th>
					<th width="100px">Mulai</th>
					<th width="100px">Sampai</th>
					<th width="30px">Status</th>
					<th width="70px">&nbsp;</th>
				</thead>
				<tbody>
					<?php
					$n = 1;
					foreach($polling as $poll){
						$parent = $poll['parent'];
						
						$id = $parent['polling_id'];
						$name = @$parent['polling_name'];
						$start = @$parent['polling_start'];
						$stop = @$parent['polling_stop'];
						$status = @$parent['polling_status'];
						
					?>
						<tr>
							<td><?php echo $n; ?><span class="rowstbl<?php echo $id; ?>"></span></td>
							<td><?php echo $name; ?></td>
							<td><center><?php echo $start; ?></center></td>
							<td><center><?php echo $stop; ?></center></td>
							<td><center><?php echo $status; ?></center></td>
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
<script>
$(document).ready(function(){
	
	action_edit($('.datatable .bt-edit-data'));
	action_delete($('.datatable .bt-delete-data'));
	action_edit_inline($('.datatable .bt-edit-data-inline'));
	
	function action_edit_inline(dom){
		dom.click(function(){
			var btn = $(this);
			var tbl = btn.parents('.datatable');
			var tr  = btn.parents('.datatable tbody tr');
			var td  = btn.parents('.datatable tbody td');
			
			// edit this
			pop.find('h4').html('Edit Polling');
			var urls = '<?php echo $popup_action; ?>';
			var data = {action:'view',id:this.name};
			
			var post = $.post(urls,data);
			post.done(function(data){
				pop.modal('show');
				res.html('');
				mug.html(data);
			});
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
			pop.find('h4').html('Edit Pilihan');
			var urls = '<?php echo $popup_action; ?>';
			var data = {action:'edit',id:this.name};
			
			var post = $.post(urls,data);
			post.done(function(data){
				pop.modal('show');
				res.html('');
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
			var urls = '<?php echo $popup_action; ?>';
			var tipe = box.parent().attr('id');
			var data = {action:'delete',type:tipe,menu:this.name};
			bootbox.confirm("Anda yakin akan menghapus Menu ini?", function(result) {
				if(result==true){
					var post = $.post(urls,data);
					post.done(function(data){
						if(data=='ok'){
							tbl = tbl.dataTable();
							tbl.fnDeleteRow(tbl.fnGetPosition(tr[0]));
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
						<span class="pull-left modal-result"></span>\
						<a class="btn modal-tutup">Cancel</a>\
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
		
		// edit this
		mug.html('Tunggu...');
		pop.find('h4').html('Tambah Menu');
		var urls = '<?php echo $popup_action; ?>';
		var tipe = box.parent().attr('id');
		var data = {action:'view',type:tipe,menu:this.name};
		
		var post = $.post(urls,data);
		post.done(function(data){
			pop.modal('show');
			mug.html(data);
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
		
		// edit this
		res.html('Sedang menyimpan...');
		var urls = '<?php echo $popup_action; ?>';
		var data = frm.serializeArray();
		var menu = frm.find('input[name="polling_id"]');
		console.log(data)
		return
		var post = $.post(urls,data);
		post.done(function(data){
			data = $.parseJSON(data);
			tbl  = tbl.dataTable();
			if(data['status']=='insert'){
				var buttons = $('.Bottons').val();
			
				var tds = [];
				tds[0] = '<center>'+(tbl.fnGetData().length+1)+'</center><span class="rowstbl'+data['menu_id']+'"></span>';
				tds[1] = '<span class="'+data['menu_icon']+'"></span> '+data['menu_title'];
				tds[2] = data['menu_link'];
				tds[3] = buttons;
				
				var last = tbl.fnAddData(tds);
				var node = tbl.fnGetNodes(last[0]);
				var edit = $(node).find('a.bt-edit-data');
				var remv = $(node).find('a.bt-delete-data');
				
				menu.val(data['menu_id']);
				action_edit(edit);
				action_delete(remv);
				
				res.html('<font color="green">Tersimpan.</font>');
			}else if(data['status']=='update'){
				var tr = tbl.find('.rowstbl'+data['menu_id']).parent().parent();
				var trpos = tbl.fnGetPosition(tr[0]);
				tbl.fnUpdate('<span class="'+data['menu_icon']+'"></span> '+data['menu_title'],trpos,1);
				tbl.fnUpdate(data['menu_link'],trpos,2);
				
				res.html('<font color="green">Tersimpan.</font>');
			}
		});
	});
	
});
</script>

<script>
/*
	$('.bt-add').click(function(){
		var btn = $(this);
		//var parent_id = btn.attr('name');
		//var tbd = btn.parent().find('tbody.tbody-child');
		var tabel = $('.datatable').dataTable();
		
		var txSave = '<a class="btn btn-success bt-edit-parent" mode="save" name="0" title="Edit"><i class="icon-hdd icon-white"></i></a>';
		var txView = ' <a class="btn btn-info bt-view-parent" name="0" title="View"><i class="icon-search icon-white"></i></a>';
		var txRemove = ' <a class="btn btn-danger bt-remove-parent" name="0" title="Delete"><i class="icon-trash icon-white"></i></a>';
		
		var tds = [];
		tds[0] = tabel.fnGetData().length+1;
		tds[1] = '<h3><span class="polling"><input type="text" class="span12"></span></h3>';
		tds[1] += '<ul class="submenu polling-ul-submenu">\
					<li>\
						<table class="table">\
							<thead>\
								<tr>\
									<th>Pilihan</th>\
									<th>Skor</th>\
									<th>Persentase</th>\
									<th width="80px">&nbsp;</th>\
								</tr>\
							</thead>\
							<tbody class="tbody-child">\
							</tbody>\
						</table>\
						<a class="btn btn-info bt-add-child" name="0"><i class="icon icon-plus icon-white"></i> Tambah</a>\
					</li>\
				</ul>';
		
		tds[2] = '&nbsp;';
		tds[3] = txSave + txView + txRemove;
		
		var last = tabel.fnAddData(tds);
		var nod = tabel.fnGetNodes(last[0]);
						
		var edit = $(nod).find('a.bt-edit-parent');
		var view = $(nod).find('a.bt-view-parent');
		var remove = $(nod).find('a.bt-remove-parent');
		var add = $(nod).find('a.bt-add-child');
		
		edit.click(function(){
			var btn = $(this);
			var polling_id = btn.attr('name');
			var ico = btn.html();
			var title = btn.parent().parent().find('span.polling');
			if(btn.attr('mode')=='edit'){
				title.html('<input type="text" value="'+title.html()+'" class="span12">');
				btn.attr('mode','save');
				btn.removeClass('btn-info').addClass('btn-success');
				btn.children().removeClass('icon-edit').addClass('icon-hdd');
			}else{
				var url  = '<?php echo $site_url; ?>/index.php/popup/polling_exec';
				var post = $.post(url,{parent: 'parent', polling: polling_id, title: title.children().val()});
				post.done(function(data){
					data = $.parseJSON(data);
					title.html(data['name']);
					btn.attr('mode','edit');
					edit.attr('name',data['id']);
					remove.attr('name',data['id']);
					add.attr('name',data['id']);
					btn.removeClass('btn-success').addClass('btn-info');
					btn.children().removeClass('icon-hdd').addClass('icon-edit');
				});
			}
		});
		
		view.click(function(){
			var btn = $(this);
			var subs = btn.parent().parent().parent().children().find('ul.submenu');
			subs.each(function(){
				$(this).slideUp(500);
			});
			var sub = btn.parent().parent().find('ul.submenu');
			sub.slideDown(500);
		});
		
		remove.click(function(){
			var btn = $(this);
			var polling_id = btn.attr('name');
			bootbox.confirm("Anda yakin akan mengedit konten ini?", function(result) {
				if(result==true){
					var url  = '<?php echo $site_url; ?>/index.php/popup/polling_del';
					var post = $.post(url,{polling: polling_id});
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
		
		add.click(function(){
			var btn = $(this);
			var parent_id = btn.attr('name');
			var tbd = btn.parent().find('tbody.tbody-child');
			
			if(parent_id<1) return;
			
			var btsave = $('<a class="btn btn-success" mode="save" name="0" title="Edit"><i class="icon-hdd icon-white"></i></a>');
			var btremove = $('<a class="btn btn-danger" name="0" title="Delete"><i class="icon-trash icon-white"></i></a>');
			var tr = $('<tr/>');
			var td1 = $('<td><span class="polling-child"><input type="text" class="span12"></span></td>');
			var td2 = $('<td>&nbsp;</td>');
			var td3 = $('<td>&nbsp;</td>');
			var td4 = $('<td/>');
			td4.append(btsave).append('&nbsp;').append(btremove);
			tr.append(td1).append(td2).append(td3).append(td4);
			tbd.append(tr);
			
			btsave.click(function(){
				var sbt = $(this);
				var polling_id = sbt.attr('name');
				var ico = sbt.html();
				var title = sbt.parent().parent().find('span.polling-child');
				if(sbt.attr('mode')=='edit'){
					title.html('<input type="text" value="'+title.html()+'" class="span12">');
					sbt.attr('mode','save');
					sbt.removeClass('btn-info').addClass('btn-success');
					sbt.children().removeClass('icon-edit').addClass('icon-hdd');
				}else{
					var url  = '<?php echo $site_url; ?>/index.php/popup/polling_exec';
					var post = $.post(url,{parent: parent_id,polling: polling_id, title: title.children().val()});
					post.done(function(data){
						data = $.parseJSON(data);
						title.html(data['name']);
						sbt.attr('mode','edit');
						btsave.attr('name',data['id']);
						btremove.attr('name',data['id']);
						sbt.removeClass('btn-success').addClass('btn-info');
						sbt.children().removeClass('icon-hdd').addClass('icon-edit');
					});
				}
			});
			
			btremove.click(function(){
				var sbt = $(this);
				var polling_id = sbt.attr('name');
				bootbox.confirm("Anda yakin akan mengedit konten ini?", function(result) {
					if(result==true){
						var url  = '<?php echo $site_url; ?>/index.php/popup/polling_del';
						var post = $.post(url,{polling: polling_id});
						post.done(function(data){
							if(data=='OK'){
								sbt.parent().parent().remove();
							}
						});
					}
				});
			});
		});
	});
	
	$('.bt-edit').click(function(){
		var btn = $(this);
		var polling_id = btn.attr('name');
		var ico = btn.html();
		var title = btn.parent().parent().find('span.polling');
		if(btn.attr('mode')=='edit'){
			title.html('<input type="text" value="'+title.html()+'" class="span12">');
			btn.attr('mode','save');
			btn.removeClass('btn-info').addClass('btn-success');
			btn.children().removeClass('icon-edit').addClass('icon-hdd');
		}else{
			var url  = '<?php echo $site_url; ?>/index.php/popup/polling_exec';
			var post = $.post(url,{polling: polling_id, title: title.children().val()});
			post.done(function(data){
				data = $.parseJSON(data);
				title.html(data['name']);
				btn.attr('mode','edit');
				btn.removeClass('btn-success').addClass('btn-info');
				btn.children().removeClass('icon-hdd').addClass('icon-edit');
			});
		}
	});
	
    $('.bt-view').click(function() {
		var btn = $(this);
		var subs = btn.parent().parent().parent().children().find('ul.submenu');
		subs.each(function(){
			$(this).slideUp(500);
		});
		var sub = btn.parent().parent().find('ul.submenu');
		sub.slideDown(500);
    });
	
	$('.bt-remove').click(function() {
		var btn = $(this);
		var polling_id = btn.attr('name');
		bootbox.confirm("Anda yakin akan mengedit konten ini?", function(result) {
			if(result==true){
				var url  = '<?php echo $site_url; ?>/index.php/popup/polling_del';
				var post = $.post(url,{polling: polling_id});
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
	
	// for child action
	
	$('.bt-edit-child').click(function(){
		var btn = $(this);
		var polling_id = btn.attr('name');
		var ico = btn.html();
		var title = btn.parent().parent().find('span.polling-child');
		if(btn.attr('mode')=='edit'){
			title.html('<input type="text" value="'+title.html()+'" class="span12">');
			btn.attr('mode','save');
			btn.removeClass('btn-info').addClass('btn-success');
			btn.children().removeClass('icon-edit').addClass('icon-hdd');
		}else{
			var url  = '<?php echo $site_url; ?>/index.php/popup/polling_exec';
			var post = $.post(url,{polling: polling_id, title: title.children().val()});
			post.done(function(data){
				data = $.parseJSON(data);
				title.html(data['name']);
				btn.attr('mode','edit');
				btn.removeClass('btn-success').addClass('btn-info');
				btn.children().removeClass('icon-hdd').addClass('icon-edit');
			});
		}
	});
	
	$('.bt-remove-child').click(function() {
		var btn = $(this);
		var polling_id = btn.attr('name');
		bootbox.confirm("Anda yakin akan mengedit konten ini?", function(result) {
			if(result==true){
				var url  = '<?php echo $site_url; ?>/index.php/popup/polling_del';
				var post = $.post(url,{polling: polling_id});
				post.done(function(data){
					if(data=='OK'){
						btn.parent().parent().remove();
					}
				});
			}
		});
    });
	
	$('.bt-add-child').click(function(){
		var btn = $(this);
		var parent_id = btn.attr('name');
		var tbd = btn.parent().find('tbody.tbody-child');
		
		var btsave = $('<a class="btn btn-success" mode="save" name="0" title="Edit"><i class="icon-hdd icon-white"></i></a>');
		var btremove = $('<a class="btn btn-danger" name="0" title="Delete"><i class="icon-trash icon-white"></i></a>');
		var tr = $('<tr/>');
		var td1 = $('<td><span class="polling-child"><input type="text" class="span12"></span></td>');
		var td2 = $('<td>&nbsp;</td>');
		var td3 = $('<td>&nbsp;</td>');
		var td4 = $('<td/>');
		td4.append(btsave).append('&nbsp;').append(btremove);
		tr.append(td1).append(td2).append(td3).append(td4);
		tbd.append(tr);
		
		btsave.click(function(){
			var sbt = $(this);
			var polling_id = sbt.attr('name');
			var ico = sbt.html();
			var title = sbt.parent().parent().find('span.polling-child');
			if(sbt.attr('mode')=='edit'){
				title.html('<input type="text" value="'+title.html()+'" class="span12">');
				sbt.attr('mode','save');
				sbt.removeClass('btn-info').addClass('btn-success');
				sbt.children().removeClass('icon-edit').addClass('icon-hdd');
			}else{
				var url  = '<?php echo $site_url; ?>/index.php/popup/polling_exec';
				var post = $.post(url,{parent: parent_id,polling: polling_id, title: title.children().val()});
				post.done(function(data){
					data = $.parseJSON(data);
					title.html(data['name']);
					sbt.attr('mode','edit');
					btsave.attr('name',data['id']);
					btremove.attr('name',data['id']);
					sbt.removeClass('btn-success').addClass('btn-info');
					sbt.children().removeClass('icon-hdd').addClass('icon-edit');
				});
			}
		});
		
		btremove.click(function(){
			var sbt = $(this);
			var polling_id = sbt.attr('name');
			bootbox.confirm("Anda yakin akan mengedit konten ini?", function(result) {
				if(result==true){
					var url  = '<?php echo $site_url; ?>/index.php/popup/polling_del';
					var post = $.post(url,{polling: polling_id});
					post.done(function(data){
						if(data=='OK'){
							sbt.parent().parent().remove();
						}
					});
				}
			});
		});
	});
*/
</script>