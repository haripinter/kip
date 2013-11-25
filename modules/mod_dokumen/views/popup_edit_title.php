<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form>
	<input type="hidden" name="action" value="save">
	<input type="hidden" name="id" value="<?php echo $media['media_id']; ?>">
	<input type="text" class="span12" name="title" value="<?php echo $media['media_title']; ?>">
</form>