<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<form>
	<div class="container span12">
		<span class="btn btn-success fileinput-button">
			<i class="glyphicon glyphicon-plus"></i>
			<span>Pilih File...</span>
			<input class="fileupload" type="file" name="files[]" multiple>
		</span>
		<table class="table" style="margin-top:10px; width:100%;">
			<tbody id="fbody">
			</tbody>
		</table>
		
		<div class="progress progress-striped progress-success hide">
			<div class="bar"></div>
		</div>
	</div>
</form>