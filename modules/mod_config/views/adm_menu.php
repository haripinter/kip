<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';

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
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> MENU</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#public">Menu Publik</a></li>
				<li><a data-toggle="tab" href="#admin">Menu Admin</a></li>
			</ul>
			
			<div class="tab-content">
				<div id="public" class="tab-pane active">
					<table class="table bootstrap-datatable datatable">
						<thead>
							<th width="1px">No.</th>
							<th>Menu</th>
							<th>Link</th>
							<th width="70px">&nbsp;</th>
						</thead>
						<tbody>
						<?php
						$n = 1;
						foreach($menu_public as $menu){
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
				<div id="admin" class="tab-pane">
					<table class="table bootstrap-datatable datatable">
						<thead>
							<th width="1px">No.</th>
							<th>Menu</th>
							<th>Link</th>
							<th width="70px">&nbsp;</th>
						</thead>
						<tbody>
						<?php
						$n = 1;
						foreach($menu_admin as $menu){
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
								<td width="70px"><?php echo Bottons($id); ?></td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
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
			
			// edit this
			mug.html('Tunggu...');
			pop.find('h4').html('Edit Menu');
			var urls = '<?php echo $site_url; ?>/index.php/popup/menu';
			var tipe = box.parent().attr('id');
			var data = {action:'view',type:tipe,menu:this.name};
			
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
			var urls = '<?php echo $site_url; ?>/index.php/popup/menu';
			var tipe = box.parent().attr('id');
			var data = {action:'delete',type:tipe,menu:this.name};
			bootbox.confirm("Anda yakin akan menghapus SKPD ini?", function(result) {
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
		var urls = '<?php echo $site_url; ?>/index.php/popup/menu';
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
		var urls = '<?php echo $site_url; ?>/index.php/popup/menu';
		var tipe = box.parent().attr('id');
		var data = frm.serializeArray();
		
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