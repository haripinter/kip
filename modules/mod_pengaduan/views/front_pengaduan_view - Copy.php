<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
print_r($complain);
?>
	<style>
		.table-form{
			margin-bottom:25px;
		}
		.table-form td{
			vertical-align:top;
			padding:3px !important;
		}
		.text-form{
			--background-color: #FFF !important;
			--border: none !important;
			border-radius: 0px !important;
			border-bottom: 1px dotted #888 !important;
		}
	</style>
<div style="padding:10px">
	<center><h4>PENGADUAN ATAS PERMOHONAN INFORMASI</h4></center>
	<br/>
	<form method="POST" action="<?php echo site_url(); ?>pengaduan" enctype="multipart/form-data">
		<input type="hidden" name="id_komplain" value="<?php echo @$complain['complain_id']; ?>">
		<table class="table-form" cellpadding="0" cellspacing="0" width="100%">
			<tbody>	
				<tr>
					<td><b>A.</b></td>
					<td colspan="3"><b>INFORMASI PENGAJU PENGADUAN</b></td>
				</tr>
				<tr>
					<td width="3px">&nbsp;</td>
					<td width="30%">Nomor Registrasi Pengaduan *</td>
					<td width="3px">:</td>
					<td><?php echo @$complain['complain_nomor']; ?> <span style="color:#ddd"><i>(diisi petugas)</i></span></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Nomor Pendaftaran Pengajuan Informasi</td>
					<td>:</td>
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
				
				<tr>
					<td><b>D.</b></td>
					<td colspan="3"><b>STATUS</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">
						<?php echo @$complain['complain_status']; ?><br/><br/>
						<b>Keterangan :</b><br/>
						<?php echo @$complain['complain_status_reason']; ?><br/>
					</td>
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
	<?php
	if(@$status_default['status']==@$complain['complain_status']){
	?>
	<div align="right">
		<form action="<?php echo site_url(); ?>pengaduan/edit/<?php echo intval(@$complain['complain_id']); ?>">
			<button type="submit" class="btn btn-success">Edit</button>
		</form>
	</div>
	<?php
	}
	?>
</div>