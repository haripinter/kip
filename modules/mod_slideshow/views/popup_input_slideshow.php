<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form class="form-popup">
	<input type="hidden" name="action" value="save">
	<input type="hidden" name="id" value="<?php echo @$media['media_id']; ?>">
	<table width="100%">
		<tbody>
			<tr>
				<td>Judul</td>
				<td>:</td>
				<td><input type="text" name="title" class="media_title span12" value="<?php echo @$media['media_title']; ?>"></td>
			</tr>
			<tr>
				<td valign="top">Deskripsi</td>
				<td valign="top">:</td>
				<td><textarea name="description" class="media_description span12"><?php echo @$media['media_description']; ?></textarea></td>
			</tr>
			<tr>
				<td>Gambar</td>
				<td>:</td>
				<td>
					<span class="media_thumbnail">
					<?php
						if(@$media['media_thumbnail']!='')
							echo '<img src="'.site_url().$media['media_thumbnail'].'" height="30px"></img>';
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
					$select[@$media['media_status']] = 'selected="selected"';
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