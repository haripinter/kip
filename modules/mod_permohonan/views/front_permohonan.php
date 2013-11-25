<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
			--border-bottom: 1px dotted #888 !important;
		}
	</style>
	<div style="padding:10px">
	<center><h4>FORMULIR<br/>PERMOHONAN INFORMASI PUBLIK</h4></center>
	<br/>
	<form method="POST" action="<?php echo site_url(); ?>permohonan" enctype="multipart/form-data">
		<?php
		if(!is_null(@$err)){
			echo "<div class='alert alert-error'>".@$err."</div>";
		}
		?>
		<input type="hidden" name="id_permohonan" value="<?php echo intval(@$request['request_id']); ?>">
		<table class="table-form" width="100%">
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
					<td>
						<textarea class="text-form span12" name="informasi"><?php echo @$request['request_information']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td valign="top">Alasan Permohonan Informasi</td>
					<td valign="top">:</td>
					<td>
						<textarea class="text-form span12" name="alasan"><?php echo @$request['request_reason']; ?></textarea>
					</td>
				</tr>
				
				<tr>
					<td><b>B.</b></td>
					<td colspan="3"><b>IDENTITAS PENGGUNA INFORMASI</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Nama Pengguna Informasi</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" name="user_name" value="<?php echo @$request['request_user']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Nomor KTP</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" name="user_ktp" value="<?php echo @$request['request_ktp']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Alamat</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" name="user_address" value="<?php echo @$request['request_address']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Nomor Telepon/HP</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" name="user_phone" value="<?php echo @$request['request_phone']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Email</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" name="user_email" value="<?php echo @$request['request_email']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td valign="top">Alasan Penggunaan Informasi</td>
					<td valign="top">:</td>
					<td>
						<textarea class="text-form span12" name="user_usage"><?php echo @$request['request_usage']; ?></textarea>
					</td>
				</tr>
				
				<tr>
					<td><b>C.</b></td>
					<td colspan="3"><b>IDENTITAS KUASA PEMOHON *</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Nama</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" name="auth_name" value="<?php echo @$request['request_authname']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Alamat</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" name="auth_address" value="<?php echo @$request['request_authaddress']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Nomor Telepon</td>
					<td>:</td>
					<td><input type="text" class="text-form span12" name="auth_phone" value="<?php echo @$request['request_authphone']; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Lampiran Surat Kuasa **</td>
					<td>:</td>
					<td>
						<?php
						if(@$request['request_authfile']!='' && file_exists('media/lampiran/'.@$request['request_authfile'])){
							echo "<a href='".site_url()."/media/lampiran/".@$request['request_authfile']."'>";
							echo "<img style='height:50px' src='".site_url()."/media/lampiran/".@$request['request_authfile']."'>";
							echo "</a>";
						}
						?>
						<input type="file" name="auth_file">
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
					<td>
						<select name="info_how">
							<?php
								$show = array();
								$show[@$request['request_how']] = 'selected="selected"';
								if(@$request['request_how']==''){
									$show['website'] = 'selected="selected"';
								}
							?>
							<option <?php echo @$show['langsung']; ?> value="langsung">Langsung</option>
							<option <?php echo @$show['website']; ?> value="website">Website</option>
							<option <?php echo @$show['email']; ?> value="email">Email</option>
							<option <?php echo @$show['fax']; ?> value="fax">Fax</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Format Bahan Informasi</td>
					<td>:</td>
					<td>
						<select name="info_format">
							<?php
								$sformat = array();
								$sformat[@$request['request_format']] = 'selected="selected"';
								if(@$request['request_format']==''){
									$sformat['terekam'] = 'selected="selected"';
								}
							?>
							<option <?php echo @$sformat['tercetak']; ?> value="tercetak">Tercetak</option>
							<option <?php echo @$sformat['terekam']; ?> value="terekam">Terekam</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Cara Pengiriman Bahan Informasi</td>
					<td>:</td>
					<td>
						<select name="info_delivery">
							<?php
								$sdelivery = array();
								$sdelivery[@$request['request_delivery']] = 'selected="selected"';
								if(@$request['request_delivery']==''){
									$sdelivery['email'] = 'selected="selected"';
								}
							?>
							<option <?php echo @$sdelivery['langsung']; ?> value="langsung">Langsung</option>
							<option <?php echo @$sdelivery['pos']; ?> value="pos">Via Pos</option>
							<option <?php echo @$sdelivery['email']; ?> value="email">Email</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="4"><br/>Data dan informasi yang kami peroleh, akan kami gunakan sesuai dengan ketentuan perundang-undangan yang berlaku.<br/><br/>
				</tr>
				<tr>
					<td colspan="4" style="color:#666">Keterangan :
						<table>
						<tbody>
							<tr>
								<td valign="top">*</td>
								<td>Identitas kuasa pemohon diisi jika ada kuasa pemohonnya dan melampirkan Surat Kuasa</td>
							</tr>
							<tr>
								<td valign="top">**</td>
								<td>Lampiran surat kuasa berupa file pdf atau gambar dengan format jpg, jpeg, atau png.</td>
							</tr>
						</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<?php
					$btntxt = 'Ajukan Permohonan';
					if(@$request['request_id']>0){
						$btntxt = 'Simpan Perubahan';
					}
					?>
					<td align="right"><button type="submit" class="btn btn-info" name="permohonan" value="simpan"><?php echo $btntxt; ?></button></td>
				</tr>
			</tbody>
		</table>
	</form>
	</div>