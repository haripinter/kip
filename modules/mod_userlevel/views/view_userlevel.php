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
			<h2><i class="icon-picture"></i> LEVEL ADMIN</h2>
		</div>
		<div class="box-berita" style="padding:10px">
		  <form class="form-level">
		    <input type="hidden" name="action" value="save_level">
			<table class="table">
				<thead>
					<tr>
						<th width="1px">No.</th>
						<th>Level</th>
						<th width="70px">&nbsp;</th>
					</tr>
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
		  </form>
			<div class=" pull-right">
				<a class="btn btn-info bt-add-data" name="0"><span class="icon-plus icon-white"></span></a> 
				<a class="btn btn-success bt-save-data" name="0"><label class="icon-hdd icon-white"></label>&nbsp;Simpan</a> 
			</div><br/><br/>
		</div>
	</div>
	
	<div class="box span7">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> HAK AKSES LEVEL</h2>
		</div>
		<div class="box-berita" style="padding:10px">
		  <form class="form-permission">
		    <input type="hidden" name="action" value="save_permission">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="2" width="1px">No.</th>
						<th rowspan="2">Menu</th>
						<th colspan="<?php echo count($levels); ?>"><center>Level</center></th>
					</tr>
					<tr>
						<?php
						foreach($levels as $level){
							echo '<th><center>'.$level['level_name'].'</center></th>';
						}
						?>
					</tr>
				</thead>
				<tbody>
				<?php
				$n = 1;
				foreach($permission as $perm){
					$id = $perm['menu_id'];
					$title = $perm['menu_title'];
					$status = $perm['permission'];
					?>
					<tr>
						<td><center><?php echo $n++; ?></center><span class="rowstbl<?php echo $id; ?>"></span></td>
						<td><span name="menu_title"><?php echo $title; ?></span></td>
						<?php
						foreach($status as $stat){
							$p = $stat['level_id'];
							$c = ($stat[$p]==1)? 'checked="checked"' : '';
							$hidde  = '<input type="hidden" name="menuid[]" value="'.$id.'">';
							$hidde .= '<input type="hidden" name="levelid[]" value="'.$p.'">';
							$check  = '<input type="checkbox" name="pilih['.$id.']['.$p.']" value="1" '.$c.'>';
							echo '<td>'.$hidde.'<center>'.$check.'</center></td>';
						}
						?>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
		  </form>
			<div class=" pull-right">
				<a class="btn btn-success bt-save-perm" name="0"><label class="icon-hdd icon-white"></label>&nbsp;Simpan</a> 
			</div><br/><br/>
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
			var txt = '<input type="hidden" name="lid[]" value="'+lid+'"><input type="text" class="span12" name="level[]" value="'+dat+'">';
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
							location.href='userlevel';
						}
					});
				}
			});
		});
	}
	
	$('.bt-save-data').click(function(){
		var btn = $(this);
		var ico = btn.children('label');
		ico.removeClass('icon-hdd icon-white').addClass('spinner pull-left');
		
		var frm = $('.form-level');
		var tbd = frm.find('table tbody');
		var data = frm.serializeArray();
		var urls = '<?php echo $popup_action; ?>';
		var post = $.post(urls,data);
		post.done(function(data){
			data = $.parseJSON(data);
			if(data['status']=='success'){
				var buttons = $('.Bottons').val();
				tbd.html('');
				var levels = $(data['levels']);
				levels.each(function(index,value){
					var level = value;
					var tr = $('<tr>\
							<td><center>'+(index+1)+'</center><span class="rowstbl'+level['level_id']+'"></span></td>\
							<td><span class="level_name">'+level['level_name']+'</span></td>\
							<td class="bt-action">'+buttons+'</td>\
						</tr>');
					var edit = tr.find('a.bt-edit-data');
					var remv = tr.find('a.bt-delete-data');
					edit.attr('name',level['level_id']);
					remv.attr('name',level['level_id']);
					action_edit(edit);
					action_delete(remv);
					tbd.append(tr);
					
					ico.removeClass('spinner pull-left').addClass('icon-hdd icon-white');
					location.href='userlevel';
				});
			}
		});
 	});
	
	$('.bt-add-data').click(function(){
		var tbd = $('.form-level table tbody');
		var trs = tbd.children();
		var len = trs.length;
		var txt = '<input type="hidden" name="lid[]" value="0"><input type="text" class="span12" name="level[]" value="">';
		var tr = $('<tr>\
						<td><center>'+(len+1)+'</center><span class="rowstbl0"></span></td>\
						<td><span class="level_name">'+txt+'</span></td>\
						<td class="bt-action">&nbsp;</td>\
					</tr>');
		tbd.append(tr);
	});
	
	$('.bt-save-perm').click(function(){
		var btn = $(this);
		var ico = btn.children('label');
		ico.removeClass('icon-hdd icon-white').addClass('spinner pull-left');
		
		var frm = $('.form-permission');
		var data = frm.serializeArray();
		
		var urls = '<?php echo $popup_action; ?>';
		var post = $.post(urls,data);
		post.done(function(data){
			data = $.parseJSON(data);
			if(data['status']=='success'){		
				ico.removeClass('spinner pull-left').addClass('icon-hdd icon-white');
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