<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$parent = $polling['parent'];

?>
<form>
	<input type="hidden" name="action" value="save">
	<input type="hidden" name="section" value="parent">
	<input type="hidden" name="polling_id" value="<?php echo @$parent['polling_id']; ?>">
	<table width="100%">
		<tbody>
			<tr>
				<td valign="top" width="100px">Polling</td>
				<td valign="top" width="1px">:</td>
				<td><textarea name="name" class="span12"><?php echo @$parent['polling_name']; ?></textarea></td>
			</tr>
			<tr>
				<td>Masa Aktif</td>
				<td>:</td>
				<td>
					<span><input type="text" name="start" value="<?php echo datetime_tgl(@$parent['polling_start']); ?>" class="tanggalan" style="width:100px"></span> - 
					<span><input type="text" name="stop" value="<?php echo datetime_tgl(@$parent['polling_stop']); ?>" class="tanggalan" style="width:100px"></span>
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>:</td>
				<td>
					<select name="status">
						<?php $selec[@$parent['polling_status']] = 'selected="selected"'; ?>
						<option value="on" <?php echo @$selec['on']; ?>>Aktif</option>
						<option value="off" <?php echo @$selec['off']; ?>>Tidak Aktif</option>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</form>
<script>
	$('.tanggalan').datepicker({
		changeMonth: true,
		changeYear: true,
		/*yearRange: "-100:+0",*/
		dateFormat:"dd/mm/yy"
	});
</script>