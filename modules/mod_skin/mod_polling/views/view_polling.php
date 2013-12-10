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
				<a class="bt bt-view-data" name="'.$id.'"><span class="icon-edit"></span> Pertanyaan & Hasil</a>
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
							<td><center><?php echo $n; ?></center><span class="rowstbl<?php echo $id; ?>"></span></td>
							<td><?php echo $name; ?></td>
							<td><?php echo datetime_tgl($start); ?></td>
							<td><?php echo datetime_tgl($stop); ?></td>
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
<input type="hidden" class="Bottons" value="<?php echo htmlspecialchars(Bottons(0));?>">
<script>
$(document).ready(function(){
	
	action_edit($('.datatable .bt-edit-data'));
	action_view($('.datatable .bt-view-data'));
	action_delete($('.datatable .bt-delete-data'));
	
	
	function action_view(dom){
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
			pop.find('h4').html('Pertanyaan & Hasil Polling');
			var urls = '<?php echo $popup_action; ?>';
			var data = {action:'view',id:this.name};
			
			var post = $.post(urls,data);
			post.done(function(data){
				pop.modal('show');
				res.html('');
				mug.html(data);
				
				var editx = $('.fpolling .bt-edit-data');
				editx.each(function(){
					edit_pop_unit(this);
				});
				
				var remvx = $('.fpolling .bt-delete-data');
				remvx.each(function(){
					edit_pop_delete(this);
				});
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
			pop.find('h4').html('Edit Polling');
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
			var data = {action:'delete_all',id:this.name};
			bootbox.confirm("Anda yakin akan menghapus Polling ini?<br/>Pertanyaan dan Hasil Polling akan terhapus juga.", function(result) {
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
			
	function edit_pop_unit(btn){
		btn = $(btn);
		var tr  = btn.parent().parent();
		var tds = tr.children('td');
		var tblbody = tr.parent();
		btn.click(function(){
			if($(tds[1]).children('input').length>0) return;
			var jml_input = tblbody.find('input[name="name"]').length;
			$(tds[0]).append('<input type="hidden" name="id[]" value="'+btn.attr('name')+'">');
			$(tds[1]).html('<input type="text" class="span12" name="name[]" value="'+$(tds[1]).html()+'"><input type="hidden" name="param[]" value="param'+jml_input+'">');
		});
	}
	
	function edit_pop_delete(btn){
		btn = $(btn);
		var tr  = btn.parent().parent();
		var tds = tr.children('td');
		var idx = btn.attr('name');
		$(btn).click(function(){
			// edit this
			var urls = '<?php echo $popup_action; ?>';
			var data = {action:'delete',id:idx};
			bootbox.confirm("Anda yakin akan menghapus Pertanyaan ini?", function(result) {
				if(result==true){
					var post = $.post(urls,data);
					post.done(function(data){
						data = $.parseJSON(data);
						if(data['status']=='success'){
							var body = tr.parent();
							tr.remove();
							sort_tabel_biasa(body);
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
							<a class="btn bt-baru">Tambah Baru</a>\
							<span class="modal-result"></span>\
						</span>\
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
		var data = {action:'edit',id:this.name};
		
		var post = $.post(urls,data);
		post.done(function(data){
			pop.modal('show');
			mug.html(data);
		});
	});
	
	$(".modalzWindow .bt-baru").click(function(){
		var btn = $(this);
		var box = btn.parents('.bawah-datatabel').parent();
		var inp = box.find('input');
		var inp = box.find('input');
		var sec = box.find('input[name="section"]');
		
		// if new in pilihan
		if(sec.val()=='children'){
			var tblunit = box.find('.fpolling');
			var tblbody = tblunit.find('tbody');
			var tbltrs  = tblbody.children('tr');
			var nrow = tbltrs.length;
			
			var jml_input = tblbody.find('input[name="name"]').length;
			
			var btnn = $('<a class="btn btn-small bt-edit-pop" name="0"><span class="icon-edit"></span></a>');
			var btnx = $('<a class="btn btn-small bt-remove-pop" name="0"><span class="icon-remove"></span></a>');
			var tdbt = $('<td>').append(btnx).append('&nbsp;').append(btnn);
			
			var trow = $('<tr>');
			trow.append('<td><center>'+(nrow+1)+'</center><input type="hidden" name="id[]" value="0"></td>');
			trow.append('<td><input type="text" class="span12" name="name[]"><input type="hidden" name="param[]" value="param'+jml_input+'"></td>');
			trow.append('<td>&nbsp;</td>');
			trow.append('<td>&nbsp;</td>');
			trow.append(tdbt);
			tblbody.append(trow);
			
			edit_pop_unit(btnn);
			edit_pop_delete(btnx);
		}else{
			/*
			inp.each(function(){
				if(this.name!='action') $(this).val('');
				if(this.name=='id') $(this).val(0);
			});
			
			var inp = box.find('select');
			inp.each(function(){
				$(this).val(0);
			});
			*/
		}
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
		var poll = frm.find('input[name="id"]');
		var post = $.post(urls,data);
		post.done(function(data){
			console.log(data)
			data = $.parseJSON(data);
			if(data['polling_key']=='parent'){
				tbl  = tbl.dataTable();
				
				if(data['status']=='insert'){
					var buttons = $('.Bottons').val();
				
					var tds = [];
					tds[0] = '<center>'+(tbl.fnGetData().length+1)+'</center><span class="rowstbl'+data['polling_id']+'"></span>';
					tds[1] = data['polling_name'];
					tds[2] = data['polling_start'];
					tds[3] = data['polling_stop'];
					tds[4] = data['polling_status'];
					tds[5] = buttons;
					
					var last = tbl.fnAddData(tds);
					var node = tbl.fnGetNodes(last[0]);
					var edit = $(node).find('a.bt-edit-data');
					var view = $(node).find('a.bt-view-data');
					var remv = $(node).find('a.bt-delete-data');
					edit.attr('name',data['polling_id']);
					view.attr('name',data['polling_id']);
					remv.attr('name',data['polling_id']);
					
					poll.val(data['polling_id']);
					action_edit(edit);
					action_view(view);
					action_delete(remv);
					
					res.html('<font color="green">Tersimpan.</font>');
				}else if(data['status']=='update'){
				
					// change this
					var fi = '.rowstbl'+data['polling_id'];
					
					var tr  = '';
					var tx = tbl.fnGetNodes();
					$(tx).each(function(){
						var dm = $(this).find(fi);
						if(dm.length>0) tr = dm.parent().parent();
					});
					var trpos = tbl.fnGetPosition(tr[0]);
				
					tbl.fnUpdate(data['polling_name'],trpos,1);
					tbl.fnUpdate(data['polling_start'],trpos,2);
					tbl.fnUpdate(data['polling_stop'],trpos,3);
					tbl.fnUpdate(data['polling_status'],trpos,4);
					
					res.html('<font color="green">Tersimpan.</font>');
				}
			}else{
				var tbd = frm.find('tbody');
				var trs = tbd.children('tr');
				$(trs).each(function(){
					var tr = $(this);
					var tds = tr.children('td');
					var inp = $(tds[1]).find('input[name="name[]"]');
					var par = $(tds[1]).find('input[name="param[]"]');
					if(inp.length>0){
						var par = par.val();
						$(tds[0]).html($(tds[0]).children('center')[0]);
						$(tds[1]).html(data[par+'_name']);
						$(tds[4]).children('.btn').attr('name',data[par+'_id']);
					}
				});
				res.html('<font color="green">Data Tersimpan.</font>');
			}
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