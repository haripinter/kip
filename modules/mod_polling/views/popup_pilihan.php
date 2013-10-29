<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$parent = $polling['parent'];
$children = $polling['children'];

function Bottons($id){
	return '<a class="btn btn-small bt-edit-data" name="'.$id.'"><span class="icon-edit"></span></a>
				<a class="btn btn-small bt-delete-data" name="'.$id.'"><span class="icon-remove"></span></a>';
}
?>
<form>
	<?php echo '<h4>'.@$parent['polling_name'].'</h4>'; ?>
	<table class="table" width="100%">
		<thead>
			<th width="1px">No.</th>
			<th>Pilihan</th>
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
				<td><?php echo $n++; ?></td>
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
	
	
	$('.bt-tambah').click(function(){
		$('.polling-body').html('Wait...');
		var url = '<?php echo $site_url; ?>/index.php/popup/polling_ui';
		var get = $.get(url);
		get.done(function(data){
			$('.polling-body').html(data);
		});
	});
	
	$('.dropdown').attr('style', 'cursor:pointer');
    $('.dropdown').click(function() {
        $(this).removeAttr('href');
        var parent = $(this).parent().parent();
        var parentIni = $(this).parent();
        parentIni.addClass('clicked');
        if (parentIni.hasClass('open')) {
            parentIni.removeClass('open');
        } else {
            parentIni.addClass('open');
        }
        parent.children().each(function() {
            if ($(this).hasClass('clicked') && $(this).hasClass('open')) {
                var d = $(this).children('ul.submenu').slideDown(300);
                $(this).removeClass('clicked');
            } else {
                $(this).removeClass('open');
                $(this).removeClass('clicked');
                $(this).children('ul.submenu').slideUp(300);
            }
        });
    });
</script>