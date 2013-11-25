<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$id = intval(@$halaman['post_id']);
$title = @$halaman['post_title'];
$content = to_content(@$halaman['post_content']);
$link = to_content(@$halaman['post_staticlink']);

$action = site_url().'shot-halaman';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> INFORMASI STATIS</h2>
		</div>
		<div class="box-halaman" style="padding:10px">
			<form id="frm_halaman">
				<div class="span12" style="margin-bottom:50px">
					<input type="hidden" name="action" value="save">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div>
						<div class="pull-left" style="margin-top: 2px;"><b>Link : </b><?php echo site_url(); ?>page/</div><input type="text" name="link" value="<?php echo $link; ?>" style="border-radius:0px; height:15px"/>
					</div>
					<div style="margin-bottom:10px;">
						<input type="text" class="span12" name="title" value="<?php echo $title; ?>" placeholder="Judul Informasi"/>
					</div>
					<div class="control-group">
							<textarea class="cleditor" name="content"><?php echo $content; ?></textarea>
					</div>
					<div class="pull-left">
						<input type="button" class="btn bt-back"  value="Kembali"/>
						<span class="result"></span>
					</div>
					<div class="pull-right">
						<input type="button" class="btn bt-new"  value="Baru"/>
						<input type="button" class="btn btn-success bt-simpan" value="Simpan"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$('.bt-simpan').click(function(){
		var res = $('#frm_halaman').find('span.result');
		res.html('Sedang menyimpan...');
		
		var frm = $('#frm_halaman');
		var data = frm.serializeArray();
		var urls = '<?php echo $action; ?>';
		var post = $.post(urls,data);
		post.done(function(data){
			data = $.parseJSON(data);
			if(data['status']=='insert'){
				res.html('<font color="green">Data Tersimpan.</font>');
			}else if(data['status']=='update'){
				res.html('<font color="green">Data Terupdate.</font>');
			}else{
			}
		});
	});
	
	$('.bt-back').click(function(){
		window.location='<?php echo site_url(); ?>admin/halaman';
	});
	
	$('.bt-new').click(function(){
		var frm = $('#frm_halaman');
		var tid = frm.find('input[name="id"]');
		var ttl = frm.find('input[name="title"]');
		var cnt = frm.find('textarea[name="content"]');
		var lnk = frm.find('input[name="link"]');
		
		tid.val(0);
		ttl.val('');
		cnt.val('');
		lnk.val('');
		
		var con = cnt.cleditor()[0];
		con.updateFrame();
	});
});
</script>