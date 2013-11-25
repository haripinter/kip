<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form>
	<input type="hidden" name="action" value="change_status">
	<input type="hidden" name="id" value="<?php echo @$complain['complain_id']; ?>">
	<table width="100%">
				<tbody class="tbody-ganti-status">
					<tr>
						<td>Status Permohonan:</td>
					</tr>
					<tr>
						<td>
							<select name="status">
								<?php
								foreach($status as $stat){
									$select = '';
									if(@$complain['complain_status']==$stat)
										$select = 'selected="selected"';
									echo '<option value="'.$stat.'" '.$select.'>'.$stat.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Alasan:</td>
					</tr>
					<tr>
						<td>
							<textarea name="alasan" class="span12"><?php echo @$complain['complain_status_reason']; ?></textarea>
						</td>
					</tr>
				</tbody>
			</table>
</form>