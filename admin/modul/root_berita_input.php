<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once('root_local_function.php');

$post_id = (isset($berita['post_id']))? $berita['post_id'] : 0;
$post_title = (isset($berita['post_title']))? $berita['post_title'] : '';
$post_content = (isset($berita['post_content']))? $berita['post_content'] : '';
$post_created = (isset($berita['post_created']))? $berita['post_created'] : '';
$post_expired = (isset($berita['post_expired']))? $berita['post_expired'] : '';

?>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> BERITA / INFORMASI</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<form class="form-horizontal" method="post" action="<?php echo $site_url; ?>/index.php/root/berita/1/insert">
				<div class="span9" style="margin-bottom:50px">
					<input type="hidden" name="post_id" value="<?php echo intval($post_id); ?>">
					<div style="margin-bottom:10px;">
						<input type="text" class="span12" name="judul" value="<?php echo $post_title; ?>" placeholder="Judul Berita"/>
					</div>
					<div class="control-group">
							<textarea class="cleditor" name="isi"><?php echo $post_content; ?></textarea>
					</div>
					<div class="pull-right">
						<button type="reset" class="btn btn">Batal</button>
						<button type="submit" class="btn btn-success" name="berita" value="Zimpan">Simpan</button>
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
									<td>Tanggal Terbit</td>
									<td>:</td>
									<td><input type="text" class="tanggalan" name="start" value="<?php echo datetime_tgl($post_created); ?>" style="width:100px"></td>
								</tr>
								<tr>
									<td>Kadaluarsa</td>
									<td>:</td>
									<td><input type="text" class="tanggalan" name="stop" value="<?php echo datetime_tgl($post_expired); ?>" style="width:100px"></td>
								</tr>
								<tr>
									<td>Teks Berjalan*</td>
									<td>:</td>
									<td><input type="checkbox" name="marquee"></td>
								</tr>
								<tr>
									<td>Kategori</td>
									<td>:</td>
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
$( ".tanggalan" ).datepicker({
	changeMonth: true,
	changeYear: true,
	/*yearRange: "-100:+0",*/
	dateFormat:"dd/mm/yy"
});
</script>