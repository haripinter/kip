<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$popup_action = site_url().'shot-config';
?>
<style>
	.table-form{
		margin-bottom:25px;
		width:100%;
	}
	.table-form td{
		vertical-align:top;
		padding:5px !important;
	}
	.text-form{
		--background-color: #FFF !important;
		--border: none !important;
		border-radius: 0px !important;
		border-bottom: 1px dotted #888 !important;
	}
	.table-form h3{
		font-weight: normal;
	}
</style>
<div class="row-fluid sortable">
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> KONFIGURASI WEB</h2>
		</div>
		<div class="box-berita" style="padding:10px">
		  <form class="basic-form">
			<input type="hidden" name="action" value="save">
			<table class="table-form">
				<tbody>
					<tr>
						<td colspan="3"><h3>Informasi Instansi</h3></td>
					</tr>
					<tr>
						<td width="100px">Nama Instansi</td>
						<td width="5px">:</td>
						<td><textarea name="instansi" class="span12"><?php echo $config['instansi']; ?></textarea></td>
					</tr>
					<tr>
						<td width="100px">Deskripsi</td>
						<td width="5px">:</td>
						<td><textarea name="deskripsi" class="span12"><?php echo $config['deskripsi']; ?></textarea></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><textarea name="alamat" class="span12"><?php echo $config['alamat']; ?></textarea></td>
					</tr>
					<tr>
						<td>Telp & Fax</td>
						<td>:</td>
						<td><input name="telp" type="text" class="span12" value="<?php echo $config['telp']; ?>"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input name="email" type="text" class="span12" value="<?php echo $config['email']; ?>"></td>
					</tr>
					<tr>
						<td colspan="3"><h3>Konfigurasi Dasar</h3></td>
					</tr>
					<tr>
						<td>Alamat Website</td>
						<td>:</td>
						<td><input name="situs" type="text" class="span12" value="<?php echo $config['situs']; ?>"></td>
					</tr>
					<tr>
						<td>Email Aktivasi</td>
						<td>:</td>
						<td><input name="mail_sender" type="text" class="span12" value="<?php echo $config['mail_sender']; ?>"></td>
					</tr>
					<tr>
						<td>Nama Aplikasi</td>
						<td>:</td>
						<td><?php echo $config['app_name']; ?></td>
					</tr>
					<tr>
						<td>Versi Aplikasi</td>
						<td>:</td>
						<td><?php echo $config['app_version']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><a class="btn bt-save-web pull-left">Simpan</a><span class="span-result pull-left"></span></td>
					</tr>
					
				</tbody>
			</table>
		  </form>
		</div>
	</div>
	<div class="box span6">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> TEMA & TAMPILAN</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table-form">
				<tbody>
					<tr>
						<td width="150px">Tema Web Utama</td>
						<td width="5px">:</td>
						<td>
							<div class="btn-group bt-change-theme">
								<button class="btn bt-label-theme"><?php echo $public_theme_active; ?></button>
								<button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php
									foreach($public_themes as $thm){
										?>
										<li><a href="#" mode="public" name="<?php echo $thm; ?>"><?php echo $thm; ?></a></li>
										<?php
									}
									?>
								</ul>
							</div>
						</td>
					</tr>
					<tr>
						<td width="150px">Tema Web Admin</td>
						<td width="5px">:</td>
						<td>
							<div class="btn-group bt-change-theme">
								<button class="btn bt-label-theme"><?php echo $admin_theme_active; ?></button>
								<button data-toggle="dropdown" class="btn dropdown-toggle"><span class="caret"></span></button>
								<ul class="dropdown-menu">
									<?php
									foreach($admin_themes as $thm){
										?>
										<li><a href="#" mode="admin" name="<?php echo $thm; ?>"><?php echo $thm; ?></a></li>
										<?php
									}
									?>
								</ul>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="load"></div>
<script>
	$('.bt-save-web').click(function(){
		var btn = $(this);
		var frm = btn.parents('form.basic-form');
		var res = frm.find('.span-result');
		var dat = frm.serializeArray();
		var too = '<?php echo $popup_action; ?>';
		res.html('Sedang menyimpan...');
		var pos = $.post(too,dat);
		pos.done(function(data){
			data = $.parseJSON(data);
			if(data['status']=='success'){
				res.html('<font color="green">Tersimpan.</font>');
				setTimeout(function(){
					res.html('');
				},
				1000);
			}
		});
	});
	
	$('.bt-change-theme .dropdown-menu li a').click(function(){
		var buttn = $(this);
		var label = buttn.parents('.bt-change-theme').find('.bt-label-theme');
		var dfaul = label.html();
		label.html('-');
		
		var theme = buttn.attr('name');
		var modes = buttn.attr('mode');
		var datas = {action:'change_theme', mode: modes, tema:theme};
		var act = '<?php echo $popup_action; ?>';
		var pos = $.post(act,datas);
		pos.done(function(data){
			data = $.parseJSON(data);
			if(data['status']=='success'){
				label.html(data['theme']);
			}else{
				label.html(dfaul);
			}
		});
	});
</script>