<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form class="form-popup">
	<input type="hidden" name="action" value="save">
	<input type="hidden" name="tautan_id" value="<?php echo @$tautan['tautan_id']; ?>">
	<table width="100%">
		<tbody>
			<tr>
				<td>Judul Tautan</td>
				<td>:</td>
				<td><input type="text" name="title" class="tautan_title span12" value="<?php echo @$tautan['tautan_title']; ?>"></td>
			</tr>
			<tr>
				<td>Tautan</td>
				<td>:</td>
				<td><input type="text" name="link" class="tautan_link span12" value="<?php echo @$tautan['tautan_link']; ?>"></td>
			</tr>
			<tr>
				<td>Jenis Tautan</td>
				<td>:</td>
				<td>
					<?php
					$select[@$tautan['tautan_option']] = 'selected="selected"';
					?>
					<select name="option" class="tautan_option">
						<option <?php echo @$select['Teks']; ?> value="Teks">Teks</option>
						<option <?php echo @$select['Gambar']; ?> value="Gambar">Gambar</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Gambar</td>
				<td>:</td>
				<td>
					<input type="hidden" name="mediaid" value="<?php echo @$tautan['tautan_mediaid']; ?>">
					<span class="tautan_thumbnail">
					<?php
						if(@$tautan['media_thumbnail']!='')
							echo '<img src="'.site_url().$tautan['media_thumbnail'].'" height="30px"></img>';
					?>
					</span>
					
					<span class="btn btn-success fileinput-button">
						<i class="glyphicon glyphicon-plus"></i>
						<span>Pilih Gambar...</span>
						<input class="fileupload" type="file" name="files[]" multiple>
					</span>
					<span class="txt_filename"></span>
					<br/>
					
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td>
					<?php
					$select[@$tautan['tautan_status']] = 'selected="selected"';
					?>
					<select name="status" style="margin-top:10px">
						<option <?php echo @$select['on']; ?> value="on">Aktif</option>
						<option <?php echo @$select['off']; ?> value="off">Tidak Aktif</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>
					<div class="progress progress-striped progress-success hide">
						<div class="bar"></div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</form>