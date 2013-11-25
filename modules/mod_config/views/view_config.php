<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
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
			<table class="table-form">
				<tbody>
					<tr>
						<td colspan="3"><h3>Konfigurasi Dasar</h3></td>
					</tr>
					<tr>
						<td>Alamat Website</td>
						<td>:</td>
						<td><input type="text" class="span12"></td>
					</tr>
					<tr>
						<td colspan="3"><h3>Informasi Instansi</h3></td>
					</tr>
					<tr>
						<td width="100px">Nama Instansi</td>
						<td width="5px">:</td>
						<td><textarea name="" class="span12"></textarea></td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td><textarea name="" class="span12"></textarea></td>
					</tr>
					<tr>
						<td>Telp & Fax</td>
						<td>:</td>
						<td><input type="text" class="span12"></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" class="span12"></td>
					</tr>
					<tr>
						<td><span class="pull-left span-result"></span></td>
						<td>&nbsp;</td>
						<td><a class="btn bt-save-web">Simpan</a></td>
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
						<td width="150px">Tema Halaman Utama</td>
						<td width="5px">:</td>
						<td><input type="text" class="span12"></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$('.bt-save-web').click(function(){
		var btn = $(this);
		var frm = btn.parents('form.basic-form');
	});
</script>