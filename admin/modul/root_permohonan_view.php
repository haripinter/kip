<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';
?>
	<style>
		.text-form{
			background-color: #FFF !important;
			border: none !important;
			border-radius: 0px !important;
			border-bottom: 1px dotted #888 !important;
		}
		.table-form td{
			padding: 7px;
		}
	</style>
<div class="row-fluid sortable">
	<div class="box span7">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> KETERANGAN PERMOHONAN INFORMASI</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table class="table-form table" width="100%">
				<tbody>
					<tr>
						<td><b>A.</b></td>
						<td colspan="3"><b>IDENTITAS PEMOHON INFORMASI</b></td>
					</tr>
					<tr>
						<td width="3px">&nbsp;</td>
						<td style="width:25%">Nama Pemohon Informasi</td>
						<td width="2px">:</td>
						<td><?php echo @$request['user_fullname']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Nomor KTP</td>
						<td>:</td>
						<td><?php echo @$request['user_ktp']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Pekerjaan</td>
						<td>:</td>
						<td><?php echo @$request['user_work']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Alamat</td>
						<td>:</td>
						<td><?php echo @$request['user_address']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Nomor Telepon/HP</td>
						<td>:</td>
						<td><?php echo @$request['user_phone']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Email</td>
						<td>:</td>
						<td><?php echo @$request['user_email']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td valign="top">Informasi yang Dibutuhkan</td>
						<td valign="top">:</td>
						<td><?php echo @$request['request_information']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td valign="top">Alasan Permohonan Informasi</td>
						<td valign="top">:</td>
						<td><?php echo @$request['request_reason']; ?></td>
					</tr>
					
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td><b>B.</b></td>
						<td colspan="3"><b>IDENTITAS PENGGUNA INFORMASI</b></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Nama Pengguna Informasi</td>
						<td>:</td>
						<td><?php echo @$request['request_user']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Nomor KTP</td>
						<td>:</td>
						<td><?php echo @$request['request_ktp']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Alamat</td>
						<td>:</td>
						<td><?php echo @$request['request_address']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Nomor Telepon/HP</td>
						<td>:</td>
						<td><?php echo @$request['request_phone']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Email</td>
						<td>:</td>
						<td><?php echo @$request['request_email']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td valign="top">Alasan Penggunaan Informasi</td>
						<td valign="top">:</td>
						<td><?php echo @$request['request_usage']; ?></td>
					</tr>
					
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					<tr>
						<td><b>C.</b></td>
						<td colspan="3"><b>IDENTITAS KUASA PEMOHON *</b></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Nama</td>
						<td>:</td>
						<td><?php echo @$request['request_authname']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Alamat</td>
						<td>:</td>
						<td><?php echo @$request['request_authaddress']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Nomor Telepon</td>
						<td>:</td>
						<td><?php echo @$request['request_authphone']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Lampiran Surat Kuasa **</td>
						<td>:</td>
						<td>
							<?php
							if(@$request['request_authfile']!='' && file_exists('media/lampiran/'.@$request['request_authfile'])){
								echo "<a href='".$site_url."/media/lampiran/".@$request['request_authfile']."'>";
								echo "<img style='height:50px' src='".$site_url."/media/lampiran/".@$request['request_authfile']."'>";
								echo "</a>";
							}
							?>
						</td>
					</tr>
					<tr>
						<td colspan="4">&nbsp;</td>
					</tr>
					
					<tr>
						<td><b>E.</b></td>
						<td colspan="3"><b>KETERANGAN INFORMASI</b></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Cara Memperoleh Informasi</td>
						<td>:</td>
						<td><?php echo @$request['request_how']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Format Bahan Informasi</td>
						<td>:</td>
						<td><?php echo @$request['request_format']; ?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Cara Pengiriman Bahan Informasi</td>
						<td>:</td>
						<td><?php echo @$request['request_delivery']; ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
	<div class="box span5">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> RESPON</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table style="padding:5px" width="100%">
				<tr>
					<td>Status</td>
					<td>:</td>
					<td>
						<select name="status" id="status">
							<?php
							foreach($status as $stat){
								$select = '';
								if($stat==$request['request_status']) $select = 'selected="selected"';
								echo "<option value='".$stat."' ".$select.">".$stat."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td valign="top">Alasan</td>
					<td valign="top">:</td>
					<td>
						<textarea class="span11" style="height:160px" name="reason" id="reason"><?php echo @$request['request_status_reason']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td valign="top">No.SK/Surat *</td>
					<td valign="top">:</td>
					<td>
						<input type="text" name="nomor" id="nomor" value="<?php echo $request['request_nomor']; ?>"><br/>
						* : Diisi denngan Nomor SK / Surat sesuai buku besar.<br/><br/>
					</td>
				</tr>
				<tr>
					<td><label id="result"></label></td>
					<td valign="top">&nbsp;</td>
					<td>
						<a class="btn btn-success bt-simpan">Simpan</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<script>
	$('.bt-simpan').click(function(){
		$('#result').html('Wait...');
		var url = '<?php echo $site_url; ?>/index.php/popup/permohonan_save';
		var post = $.post(url,{request:<?php echo @$request['request_id']; ?>, status:$('#status').val(), reason:$('#reason').val(), nomor:$('#nomor').val()});
		post.done(function(data){
			if(data=='OK'){
				$('#result').html('tersimpan.');
			}
		});
	});
</script>