<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$popup_action = site_url().'shot-dokumen';
?>
<div style="padding:10px; width:100%">
	<h2 style="font-weight:normal;">Dokumen Publik</h2>
	<table class="table bootstrap-datatable datatable">
		<thead>
			<th width="1px">No</th>
			<th>Nama File</th>
			<th width="1px">Preview</th>
			<th width="20px">Tanggal</th>
			<th width="20px">Didownload</th>
			<th width="70px">&nbsp;</th>
		</thead>
		<tbody>
			<?php
			$n = 1;
			foreach($dokumen as $doc){
				$id = $doc['media_id'];
				$berkas = 'media/dokumen/'.$doc['media_realname'];
				$ext = pathinfo($berkas, PATHINFO_EXTENSION);
				
				$prev = '';
				if(@$doc['media_thumbnail']!='' && file_exists(urldecode(@$doc['media_thumbnail']))){
					$prev = '<img src="'.site_url().$doc['media_thumbnail'].'" height="30px">';
				}
				
				if($prev==''){
					
				}
				?>
				<tr>
					<td><center><?php echo $n; ?></center><span class="rowstbl<?php echo $doc['media_id']; ?>"></span></td>
					<td><?php echo $doc['media_title']; ?></td>
					<td><?php echo $prev; ?></td>
					<td><?php echo datetime_tgl($doc['media_datetime']); ?></td>
					<td><?php echo intval($doc['media_viewed']); ?> kali</td>
					<td>
						<a class="btn bt-view-data" name="<?php echo $id; ?>">Unduh</a>
					</td>
				</tr>
				<?php
				$n++;
			}
			?>
		</tbody>
	</table>
</div>
<iframe id="frame_download" src="" style="visibility:hidden"></iframe>
<script>
$(document).ready(function(){
	action_view($('.datatable .bt-view-data'));
	function action_view(btn){
		btn.click(function(){
			var id = this.name
			var url = '<?php echo $popup_action; ?>/download/'+id;
			var get = $('#frame_download').attr('src',url);
		});
	}
	
	$('.datatable').dataTable({
		"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid bawah-datatabel'<'span8'i><'span4 bt-datatable-add'><'span12 center'p><'modalZ'>>",
		"sPaginationType": "bootstrap",
		"aoColumnDefs": [ { "sType": "numeric", "aTargets": [ 0 ] } ],
		"oLanguage": {
			"sLengthMenu": "_MENU_ Tampilan Perhalaman"
		}
	});
});
</script>