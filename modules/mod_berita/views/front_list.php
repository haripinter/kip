<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>
<div style="padding:10px; width:100%">
	<h2 style="font-weight:normal;">Daftar Berita</h2>
	<table class="table">
		<tbody>
		<?php
		$jumlah = count($berita);
		$n = 1;
		foreach($berita as $brt){
			$id = $brt['post_id'];
			$title = $brt['post_title'];
			$posting = datetime_tgl($brt['post_start']);
			$url = site_url().'berita/'.$id.'/'.to_alnum_dash($title).'.html';
			?>
			<tr>
				<td width="2px"><center><?php echo variative_number($n,$jumlah); ?>.</center></td>         
				<td width="80px"><a href="<?php echo $url; ?>">[ <?php echo $posting; ?> ]</a></td>
				<td><a href="<?php echo $url; ?>"><?php echo $title; ?></a></td>
			</tr>       
			<?php
			$n++;
		}
		?>
		</tbody>
	</table>
</div>