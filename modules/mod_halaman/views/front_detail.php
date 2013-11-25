<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$id = @$halaman['post_id'];
$title = @$halaman['post_title'];
$content = @$halaman['post_content'];
?>

<div style="padding:10px">
	<h2 style="font-weight:normal;"><?php echo $title; ?></h2>
	<hr style="margin-top:0px;"/>
	<?php
	echo to_content($content);
	?>
</div>