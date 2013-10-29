<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form class="form-popup">
	<input type="hidden" name="action" value="save">
	<input type="hidden" name="type" value="<?php echo $type; ?>">
	<input type="hidden" name="menu_id" value="<?php echo $menu; ?>">
	<input type="hidden" name="menu_type" value="<?php echo $type; ?>">
	<table class="table">
		<tr>
			<td width="100px">Sub Menu Dari</td>
			<td width="1px">:</td>
			<td>
				<select name="menu_parent">
					<?php
					$pilih[@$data['menu_parent']] = 'selected="selected"';
					?>
					<option value="0" <?php echo @$pilih[0];?>>Menu Utama</option>
					<?php
					foreach($list as $detail){
						$pad = '';
						for($a=0; $a<=($detail['menu_level']*3); $a++) $pad .= '&nbsp;';
						$pad .= ($detail['menu_level']>0)? '- ' : '';
						echo '<option value="'.$detail['menu_id'].'" '.@$pilih[$detail['menu_id']].'>'.$pad.$detail['menu_title'].'</option>';
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="100px">Icon</td>
			<td width="1px">:</td>
			<td>
				<span name="ico-view" class="<?php echo @$data['menu_icon']; ?>"></span>
				<input class="ico-target" type="hidden" name="menu_icon" value="<?php echo @$data['menu_icon']; ?>">
				<ul class="pilih-icon" style="display:none; list-style:none; margin: 0;">
					<li>
					<?php
					foreach($icox as $ico){
						echo '<span class="'.$ico.' iam-active" name="'.$ico.'"></span>';
					}
					?>
					<br/>
					<a class="btn btn-info btn-small pull-left bt-tutup-icon">Tutup Icon</a>
					</li>
				</ul>
				<div class="btn-group pull-right">
					<button type="button" class="btn dropdown-toggle span12" data-toggle="dropdown">
					Menu&nbsp;<span class="caret"></span>
					</button>
					<ul class="dropdown-menu pull-right">
						<li>
							<a class="bt bt-edit-icon" style="cursor:pointer"><span class="icon-edit"></span> Ganti Icon</a>
						</li>
						<li>
							<a class="bt bt-delete-icon" ><span class="icon-remove"></span> Hapus Icon</a>
						</li>
					</ul>
				</div>
			</td>
		</tr>
		<tr>
			<td width="100px">Menu</td>
			<td width="1px">:</td>
			<td><input class="span12" type="text" name="menu_title" value="<?php echo @$data['menu_title'];?>"></td>
		</tr>
		<tr>
			<td width="100px">Link</td>
			<td width="1px">:</td>
			<td><input class="span12" type="text" name="menu_link" value="<?php echo @$data['menu_link'];?>"></td>
		</tr>
	</table>
</form>
<script>
	$('.bt-edit-icon').click(function(){
		var form = $('.form-popup');
		var icos = form.find('.pilih-icon');
		icos.slideDown(500);
	});
	
	$('.bt-tutup-icon').click(function(){
		var form = $('.form-popup');
		var icos = form.find('.pilih-icon');
		icos.slideUp(500);
	});
	
	$('.iam-active').click(function(){
		var guwe = $(this);
		var icon = guwe.attr('name');
		var form = $('.form-popup');
		var view = form.find('span[name="ico-view"]');
		var targ = form.find('.ico-target');
		targ.val(icon);
		view.removeClass().addClass(icon);
		icos.slideUp(500);
	});
	
	$('.bt-delete-icon').click(function(){
		var guwe = $(this);
		var form = $('.form-popup');
		var view = form.find('span[name="ico-view"]');
		var targ = form.find('.ico-target');
		targ.val('');
		view.removeClass();
		icos.slideUp(500);
	});
</script>