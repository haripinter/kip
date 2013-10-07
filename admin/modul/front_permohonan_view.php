<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';
//print_r($user);
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
	<div align="right">
		<form action="<?php echo $site_url; ?>/index.php/permohonan/edit/<?php echo intval(@$request['request_id']); ?>">
			<button type="submit" class="btn btn-success">Edit</button>
		</form>
	</div>
	
	<div style="padding:10px">
	<center><?php echo $kop_surat; ?></center>
	<hr style="margin-bottom:5px"/>
	<div class="pull-right" >
		No. .................................
	</div>
	<br/>
	<br/>
	<center><h4>FORMULIR<br/>PERMOHONAN INFORMASI PUBLIK</h4></center>
	<br/>.
	<form method="POST" action="<?php echo $site_url; ?>/index.php/permohonan" enctype="multipart/form-data">
		<p>Yang bertanda tangan di bawah ini, mengajukan permohonan informasi :</p><br/>
		<input type="hidden" name="id_permohonan" value="<?php echo intval(@$request['request_id']); ?>">
		<table class="table-form" cellpadding="0" cellspacing="0" width="100%">
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
				<tr>
					<td colspan="4"><br/>Data dan informasi yang kami peroleh, akan kami gunakan sesuai dengan ketentuan perundang-undangan yang berlaku.<br/><br/><br/></td>
				</tr>
			</tbody>
		</table>
		<div style="color:#999">
			Keterangan :<br/>
			<table>
				<tbody>
					<tr>
						<td valign="top">*</td>
						<td>Identitas kuasa pemohon diisi jika ada kuasa pemohonnya dan melampirkan Surat Kuasa</td>
					</tr>
					<tr>
						<td valign="top">**</td>
						<td>Lampiran surat kuasa berupa gambar dengan format jpg, png, atau gif.</td>
					</tr>
				</tbody>
			</table>
		</div>
	</form>
	</div>