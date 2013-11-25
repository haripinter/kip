<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$id = $berita['post_id'];
$title = $berita['post_title'];
$content = $berita['post_content'];
$start = timestamp_toid($berita['post_start']);
?>

<div style="padding:10px;">
	<h2 style="font-weight:normal;"><?php echo $title; ?></h2>
	<hr style="margin-top:0px; margin-bottom:0px"/>
	<span class="pull-right">Dipublikasikan: <?php echo $start; ?></span>
	<br/>
	<br/>
	<?php
	echo to_content($content);
	?>
	<div>
		Berita Lainnya :<br/>
		<ul>
			<?php
			foreach($map as $brt){
				$judul = $brt['post_title'];
				$brt_id= $brt['post_id'];
				$url = site_url().'berita/'.$brt_id.'/'.to_alnum_dash($judul).'.html';
				if($id==$brt_id) $judul = "<b>$judul</b>";
				echo "<li><a href='$url'>$judul</a></li>";
			}
			?>
		</ul>
	</div>
</div>