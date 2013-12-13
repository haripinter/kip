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

$popup_action = site_url().'shot-userlevel';

?>
<div class="row-fluid sortable">
	<div class="box span5">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> LEVEL PENGGUNA</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table">
				<thead>
					<th width="1px">No.</th>
					<th>Level</th>
					<th width="70px">&nbsp;</th>
				</thead>
				<tbody>
				<?php
				$n = 1;
				foreach($levels as $level){
					$id = $level['level_id'];
					$name = $level['level_name'];
					?>
					<tr>
						<td><center><?php echo $n++; ?></center><span class="rowstbl<?php echo $id; ?>"></span></td>
						<td><span class="level_name"><?php echo $name; ?></span></td>
						<td class="bt-action"><?php echo Bottons($id); ?></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<div class=" pull-right">
				<a class="btn btn-info bt-add-data" name="0"><span class="icon-plus icon-white"></span></a> 
				<a class="btn btn-success bt-save-data" name="0"><span class="icon-hdd icon-white"></span> Simpan</a> 
			</div><br/><br/>
		</div>
	</div>
	
	<div class="box span7">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> HAK AKSES LEVEL</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table">
				<thead>
					<th width="1px">No.</th>
					<th>Menu</th>
					<th>Link</th>
					<th width="70px">&nbsp;</th>
				</thead>
				<tbody>
				<?php
				$n = 1;
				foreach($levels as $menu){
					$id = $menu['menu_id'];
					$icon = $menu['menu_icon'];
					$link = $menu['menu_link'];
					$level = $menu['menu_level'];
					$title = '<span class="'.$icon.'" style="margin-left:'.($level*18).'px;"></span> '.$menu['menu_title'];
					?>
					<tr>
						<td><center><?php echo $n++; ?></center><span class="rowstbl<?php echo $id; ?>"></span></td>
						<td><span name="menu_title"><?php echo $title; ?></span></td>
						<td><span name="menu_link"><?php echo $link; ?></span></td>
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
<input type="hidden" class="Bottons" value="<?php echo htmlspecialchars(Bottons(0));?>">
<script>
$(document).ready(function(){
	
	action_edit($('.bt-edit-data'));
	action_delete($('.bt-delete-data'));
	
	function action_edit(dom){
		dom.click(function(){
			var btn = $(this);
			var lid = btn.attr('name');
			var tdn = btn.parents('.bt-action');
			var trn = tdn.parent();
			var tar = trn.find('.level_name');
			
			if(tar.hasClass('is-txt')){
				return;
			}else{
				tar.addClass('is-txt');
			}
			
			var dat = tar.html();
			var txt = '<input type="hidden" name="lid" value="'+lid+'"><input type="text" class="span12" name="level" value="'+dat+'">';
			tar.html(txt);
		});
	}
	
	function action_delete(dom){
		dom.click(function(){
			var btn = $(this);
			var lid = btn.attr('name');
			var tdn = btn.parents('.bt-action');
			var trn = tdn.parent();
			var tbd = trn.parent();
			
			// edit this
			var urls = '<?php echo $popup_action; ?>';
			var data = {action:'delete', id:lid};
			bootbox.confirm("Anda yakin akan menghapus Level ini?", function(result) {
				if(result==true){
					var post = $.post(urls,data);
					post.done(function(data){
						data = $.parseJSON(data);
						if(data['status']=='success'){
							trn.remove();
							sort_tabel_biasa(tbd);
						}
					});
				}
			});
		});
	}
	
	//$('.bt-add-data').click(function());
	
	
	
	var modalz = '<div class="modalzWindow modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">\
					<header class="modal-header">\
						<a class="close modal-tutup">&times;</a>\
						<h4></h4>\
					</header>\
					<div class="modal-body"></div>\
					<footer class="modal-footer">\
						<span class="pull-left">\
							<a class="btn bt-modal-baru">Input Baru</a>\
							<span class="modal-result"></span>\
						</span>\
						<a class="btn modal-tutup">Tutup</a>\
						<a class="btn btn-success bt-zimpan">Simpan</a>\
					</footer>\
				  </div>';
	$(".modalZ").html(modalz);
	
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
		var tipe = box.parent().attr('id');
		var data = frm.serializeArray();
		var menu = frm.find('input[name="menu_id"]');
		
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
				edit.attr('name',data['menu_id']);
				remv.attr('name',data['menu_id']);
				action_edit(edit);
				action_delete(remv);
				
				res.html('<font color="green">Tersimpan.</font>');
			}else if(data['status']=='update'){
				// change this
				var fi = '.rowstbl'+data['menu_id'];
				
				var tr  = '';
				var tx = tbl.fnGetNodes();
				$(tx).each(function(){
					var dm = $(this).find(fi);
					if(dm.length>0) tr = dm.parent().parent();
				});
				var trpos = tbl.fnGetPosition(tr[0]);
					
				tbl.fnUpdate('<span class="'+data['menu_icon']+'"></span> '+data['menu_title'],trpos,1);
				tbl.fnUpdate(data['menu_link'],trpos,2);
				
				res.html('<font color="green">Tersimpan.</font>');
			}
		});
	});
	
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