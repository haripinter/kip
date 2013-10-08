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
			padding: 3px;
		}
	</style>
<div class="row-fluid sortable">
	<div class="box span7">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> INFORMASI PENGADUAN</h2>
		</div>
		<div class="box-berita" style="padding:10px">
		
		
	<form method="POST" action="<?php echo $site_url; ?>/index.php/pengaduan" enctype="multipart/form-data">
		<input type="hidden" name="id_komplain" value="<?php echo @$complain['complain_id']; ?>">
		<table class="table-form" cellpadding="0" cellspacing="0" width="100%">
			<tbody>	
				<tr>
					<td><b>A.</b></td>
					<td colspan="3"><b>INFORMASI PENGAJU PENGADUAN</b></td>
				</tr>
				<!--tr>
					<td width="3px">&nbsp;</td>
					<td width="30%">Nomor Registrasi Pengaduan *</td>
					<td width="3px">:</td>
					<td><label style="color:#ddd"><i>(diisi petugas)</i></label></td>
				</tr-->
				<tr>
					<td width="3px">&nbsp;</td>
					<td width="30%">Nomor Pendaftaran Pengajuan Informasi</td>
					<td width="3px">:</td>
					<td><?php echo @$complain['user_ktp']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Tujuan Penggunaan Informasi</td>
					<td>:</td>
					<td><?php echo @$complain['user_address']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Identitas Pemohon</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Nama</i></i></td>
					<td>:</td>
					<td><?php echo @$complain['user_address']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Alamat</i></td>
					<td>:</td>
					<td><?php echo @$complain['user_address']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Pekerjaan</i></td>
					<td>:</td>
					<td><?php echo @$complain['user_address']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Nomor Telepon/HP</i></td>
					<td>:</td>
					<td><?php echo @$complain['user_address']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Email</i></td>
					<td>:</td>
					<td><?php echo @$complain['user_email']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Identitas Kuasa Pemohon **</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Nama</i></td>
					<td>:</td>
					<td><?php echo @$complain['user_address']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Alamat</i></td>
					<td>:</td>
					<td><?php echo @$complain['user_address']; ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Nomor Telepon/HP</i></td>
					<td>:</td>
					<td><?php echo @$complain['user_address']; ?></td>
				</tr>
				
				<tr>
					<td><b>B.</b></td>
					<td colspan="3"><b>ALASAN PENGADUAN ***</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3" style="padding-left:30px">
						<table>
							<tbody>
								<?php
								$n = 0;
								$alasan = array();
								if(@$complain['complain_reason']!='')
									$alasan = json_decode(@$complain['complain_reason']);
								foreach(@$alasan_pengaduan as $ap){
									$checked = '';
									if(in_array(@$ap['alasan_key'],@$alasan)){
										echo "<tr>
											<td>".chr(97+$n).".</td>
											<td>".$ap['alasan_value']."</td>
											</tr>";
										$n++;
									}
								}
								?>
							</tbody>
						</table>
					</td>
				</tr>
				
				<tr>
					<td><b>C.</b></td>
					<td colspan="3"><b>KASUS POSISI</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3"><?php echo @$complain['complain_case']; ?></td>
				</tr>
				
				<!--tr>
					<td><b>D.</b></td>
					<td colspan="3"><b>HARI/TANGGAL TANGGAPAN ATAS PENGADUAN AKAN DIBERIKAN ****</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3"><?php echo datetime_tgl(@$complain['complain_date']); ?></td>
				</tr-->
			</tbody>
		</table>
	</form>

	
	</div>
	</div>
	<div class="box span5">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> RESPON</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table style="padding:5px" width="100%">
				<tr>
					<td valign="top">No. Registrasi</td>
					<td valign="top">:</td>
					<td>
						<input type="text" name="nomor" id="nomor" value="<?php echo @$complain['complain_nomor']; ?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>:</td>
					<td>
						<select name="status" id="status">
							<?php
							foreach($status as $stat){
								$select = '';
								if($stat==$complain['complain_status']) $select = 'selected="selected"';
								echo "<option value='".$stat."' ".$select.">".$stat."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<!--tr>
					<td valign="top">Tanggal Tanggapan</td>
					<td valign="top">:</td>
					<td>
						<input type="text" name="nomor" id="nomor" value="<?php echo datetime_tgl(@$complain['complain_date']); ?>"><br/>
					</td>
				</tr-->
				<tr>
					<td valign="top">Alasan</td>
					<td valign="top">:</td>
					<td>
						<textarea class="span11" style="height:160px" name="reason" id="reason"><?php echo @$complain['complain_status_reason']; ?></textarea>
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
		var url = '<?php echo $site_url; ?>/index.php/popup/pengaduan_save';
		var post = $.post(url,{complain:<?php echo @$complain['complain_id']; ?>, status:$('#status').val(), reason:$('#reason').val(), nomor:$('#nomor').val()});
		post.done(function(data){
			if(data=='OK'){
				$('#result').html('tersimpan.');
			}
		});
	});
</script>