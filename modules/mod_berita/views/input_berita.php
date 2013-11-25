<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$id = intval(@$berita['post_id']);
$title = @$berita['post_title'];
$content = to_content(@$berita['post_content']);
$start = datetime_tgl(@$berita['post_start']);
$stop = datetime_tgl(@$berita['post_stop']);
$marquee = @$berita['post_marquee'];

$action = site_url().'shot-berita';
?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> BERITA / INFORMASI</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<form id="frm_berita">
				<div class="span9" style="margin-bottom:50px">
					<input type="hidden" name="action" value="save">
					<input type="hidden" name="id" value="<?php echo intval($id); ?>">
					<div style="margin-bottom:10px;">
						<input type="text" class="span12" name="title" value="<?php echo $title; ?>" placeholder="Judul Berita"/>
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
				<div class="span3">
					<div class="box span12" style="margin-top:0px">
						<div class="box-header well">
							<h2><i class="icon-picture"></i> Pengaturan</h2>
						</div>
						<div class="box-content" style="padding:10px">
							<table>
								<tr>
									<td colspan="2"><b>Masa Aktif Berita :</b></td>
								</tr>
								<tr>
									<td colspan="2">
										<input type="text" class="tanggalan" name="start" value="<?php echo $start; ?>" style="width:90px"> - 
										<input type="text" class="tanggalan" name="stop" value="<?php echo $stop; ?>" style="width:90px">
										<br/>
										<br/>
									</td>
								</tr>
								<tr>
									<td><input type="checkbox" name="marquee" style="vertical-align: bottom;"> <span style="margin-bottom:0px"><b>Jadikan Teks Berjalan* :</b></span></td>
								</tr>
								<tr>
									<td></td>
								</tr>
							</table>
							
						</div>
						
					</div>
					<div>
							* Yang jadi teks berjalan hanya judulnya.
							</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	$( ".tanggalan" ).datepicker({
		changeMonth: true,
		changeYear: true,
		/*yearRange: "-100:+0",*/
		dateFormat:"dd/mm/yy"
	});
	
	$('.bt-simpan').click(function(){
		var res = $('#frm_berita').find('span.result');
		res.html('Sedang menyimpan...');
		
		var frm = $('#frm_berita');
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
		window.location='<?php echo site_url(); ?>admin/berita';
	});
	
	$('.bt-new').click(function(){
		var frm = $('#frm_berita');
		var tid = frm.find('input[name="id"]');
		var ttl = frm.find('input[name="title"]');
		var cnt = frm.find('textarea[name="content"]');
		var sta = frm.find('input[name="start"]');
		var sto = frm.find('input[name="stop"]');
		var mrq = frm.find('input[name="marquee"]');
		
		tid.val(0);
		ttl.val('');
		cnt.val('');
		sta.val('');
		sto.val('');
		mrq.removeAttr('checked');
		
		var con = cnt.cleditor()[0];
		con.updateFrame();
	});
});
</script>