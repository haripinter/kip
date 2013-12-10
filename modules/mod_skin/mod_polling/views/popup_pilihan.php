<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$parent = $polling['parent'];
$children = $polling['children'];

function Bottons($id){
	return '<a class="btn btn-small bt-delete-data" name="'.$id.'"><span class="icon-remove"></span></a>
				<a class="btn btn-small bt-edit-data" name="'.$id.'"><span class="icon-edit"></span></a>';
}
?>
<form class="fpolling">
	<?php echo '<h4>'.@$parent['polling_name'].'</h4>'; ?>
	<input type="hidden" name="action" value="save">
	<input type="hidden" name="section" value="children">
	<input type="hidden" name="key" value="<?php echo intval(@$parent['polling_id']); ?>">
	<table class="table" width="100%">
		<thead>
			<th width="1px">No.</th>
			<th>Pertanyaan</th>
			<th width="20px">Skor</th>
			<th width="20px">Persentase</th>
			<th width="80px">&nbsp;</th>
		</thead>
		<tbody>
			<?php
			$n = 1;
			foreach($children as $child){
			?>
			<tr>
				<td><center><?php echo $n++; ?></center></td>
				<td><?php echo $child['polling_name']; ?></td>
				<td><?php echo $child['polling_value']; ?></td>
				<td><?php echo $child['polling_value']; ?></td>
				<td><?php echo Bottons($child['polling_id']); ?></td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</form>
<script>
</script>