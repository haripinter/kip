<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form>
	<input type="hidden" name="action" value="save_references">
	<table class="table">
		<tbody>
		<?php
			foreach($request as $req){
				$informasi = $req['request_information'];
				$tgl = datetime_tgl($req['request_datetime']);
				$id = $req['request_id'];
			?>
			<tr>
				<td width="70px"><?php echo $tgl; ?></td>
				<td><?php echo $informasi; ?></td>
				<td width="2px">
					<input type="checkbox" name="reqid[]" value="<?php echo $id; ?>">
				</td>
			</tr>
			<?php
			}
		?>
		</tbody>
	</table>
</form>