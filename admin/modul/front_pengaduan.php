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
	<div style="padding:10px">
	<center><?php echo $kop_surat; ?></center>
	<hr/>
	
	<center><h4>PENGADUAN ATAS PERMOHONAN INFORMASI</h4></center>
	<br/>.
	<form method="POST" action="<?php echo $site_url; ?>/index.php/pengaduan" enctype="multipart/form-data">
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
					<td><label style="color:#ddd"><i>(diisi petugas)</i></label></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Nomor Pendaftaran Pengajuan Informasi</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_ktp']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Tujuan Penggunaan Informasi</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_address']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Identitas Pemohon</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Nama</i></i></td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_address']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Alamat</i></td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_address']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Pekerjaan</i></td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_address']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Nomor Telepon/HP</i></td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_address']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Email</i></td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_email']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">Identitas Kuasa Pemohon **</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Nama</i></td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_address']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Alamat</i></td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_address']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td style="padding-left:30px"><i>Nomor Telepon/HP</i></td>
					<td>:</td>
					<td><input type="text" class="text-form span12" disabled="disabled" value="<?php echo @$complain['user_address']; ?>"></td>
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
									if(in_array(@$ap['alasan_key'],@$alasan)) $checked = 'checked="checked"';
									echo "<tr>
										<td>".chr(97+$n).".</td>
										<td><input type='checkbox' name='alasan[]' value='".$ap['alasan_key']."' ".$checked."></td>
										<td>".$ap['alasan_value']."</td>
										</tr>";
									$n++;
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
					<td colspan="3">
						<textarea class="text-form span12" name="kasus"><?php echo @$complain['complain_case']; ?></textarea>
					</td>
				</tr>
				
				<tr>
					<td><b>D.</b></td>
					<td colspan="3"><b>HARI/TANGGAL TANGGAPAN ATAS PENGADUAN AKAN DIBERIKAN ****</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">
						<input type="text" class="text-form span12 tanggalan" name="tanggal" value="<?php echo datetime_tgl(@$complain['complain_date']); ?>">
					</td>
				</tr>
				
				
				<tr>
					<td colspan="4"><br/>Demikian pengaduan saya sampaikan, atas perhatian dan tanggapannya, saya ucapkan terima kasih.<br/><br/><br/></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="right"><button type="submit" class="btn btn-success" name="pengaduan" value="simpan">Ajukan Pengaduan</button></td>
				</tr>
			</tbody>
		</table>
		<div style="color:#999">
			Keterangan :<br/>
			<table>
				<tbody>
					<tr>
						<td valign="top">*</td>
						<td>Nomor register pengajuan keberatan diisi berdasarkan buku register pengajuan keberatan</td>
					</tr>
					<tr>
						<td valign="top">**</td>
						<td>Identitas kuasa pemohon diisi jika ada kuasa pemohonnya dan melampirkan Surat Kuasa</td>
					</tr>
					<tr>
						<td valign="top">***</td>
						<td>Sesuai dengan Pasal 35 UU KIP, dipilih oleh pengaju keberatan sesuai dengan alasan keberatan yang diajukan</td>
					</tr>
					<tr>
						<td valign="top">****</td>
						<td>Diisi sesuai dengan ketentuan jangka waktu dalam UU KIP</td>
					</tr>
					<tr>
						<td valign="top">*****</td>
						<td>Tanggal diisi dengan tanggal diterimanya pengajuan keberatan yaitu sejak keberatan dinyatakan lengkap sesuai dengan buku register pengajuan keberatan</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>
	</div>