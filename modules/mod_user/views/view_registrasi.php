<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$err   = null;
if(@$result['err']=='password'){
	$result['pass1'] = '';
	$result['pass2'] = '';
	$err = "Password harus diisi dan harus sama.";
}else if(@$result['err']=='kosong' || @$result['err']=='image_error'){
	$err = "Semua data harus dilengkapi, scan KTP harus disertakan dan tidak boleh lebih besar dari 100kB.";
}

?>
<div style="padding:10px; width:100%; float:left">
<?php
switch(@$result['err']){
	case 'registration_success':
		?>
			<p>Untuk menyelesaikan registrasi, kami telah mengirim kode aktivasi ke alamat email Anda (<b><?php echo @$result['user_email']; ?></b>). Jika tidak ada email masuk, periksa di bagian Bulk atau Spam.</p>
			<p>Kode aktivasi ini hanya berlaku 1x24 jam. Jika selama 1x24 jam akun Anda tidak diaktifkan, Anda harus mendaftar ulang dari awal. Silakan klik tautan aktivasi yang dikirim ke email Anda, atau bisa melakukan aktivasi secara manual dengan memasukkan kode aktivasi pada kotak di bawah ini.</p>
			<br/>
			<form method="POST" action="<?php echo site_url(); ?>aktivasi">
				<input type="text" name="kode" style="margin-bottom:0px" placeholder="Kode Aktivasi">
				<button type="submit" class="btn btn-success" name="aktivasi" value="aktivasi">Aktifkan</button>
			</form>
		<?php
		break;
	
	case 'double_inactive':
		?>
			<p>Mohon maaf, email yang Anda masukkan sudah terdaftar dan belum diaktifkan. Masukkan Kode Aktivasi pada form di bawah ini untuk mengaktifkan.</p>
			<br/>
			<form method="POST" action="<?php echo site_url(); ?>aktivasi">
				<input type="text" name="kode" style="margin-bottom:0px" placeholder="Kode Aktivasi">
				<button type="submit" class="btn btn-success" name="aktivasi" value="aktifkan">Aktifkan</button>
			</form>
			<!--br/>
			Atau Anda bisa minta kode aktivasi baru di <a>SINI</a!-->
		</form>
		<?php
		break;
	
	case 'double_active':
		?>
			Mohon maaf, email yang Anda daftarkan sudah pernah didaftarkan sebelumnya. Silakan gunakan email yang lain.
		<?php
		break;
		
	case 'double_banned':
		?>
			Mohon maaf, user dari email yang Anda masukkan telah dibekukan. Mohon hubungi Administrator untuk mengaktifkan kembali user Anda.
		<?php
		break;
		
	default:
		?>
			<style>
				.tbl_registrasi td{
					vertical-align:top;
					padding:2px;
				}
			</style>
			<form method="POST" action="<?php echo site_url(); ?>registrasi" enctype="multipart/form-data">
				<?php
				if(!is_null($err)){
					echo "<div class='alert alert-error'>".$err."</div>";
				}
				?>
				
				<table class="tbl_registrasi">
					<tbody>
						<tr>
							<td width="120px">Nama Lengkap</td>
							<td width="1px">:</td>
							<td align="left"><input type="text" name="nama" value="<?php echo @$result['fullname']; ?>"></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td>:</td>
							<td><input type="text" name="alamat" value="<?php echo @$result['address']; ?>"></td>
						</tr>
						<tr>
							<td>Nomor Telepon</td>
							<td>:</td>
							<td><input type="text" name="telepon" value="<?php echo @$result['phone']; ?>"></td>
						</tr>
						<tr>
							<td>Nomor KTP</td>
							<td>:</td>
							<td><input type="text" name="ktp" value="<?php echo @$result['ktp']; ?>"></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><input type="text" name="email" value="<?php echo @$result['email']; ?>"></td>
						</tr>
						<tr>
							<td>Password</td>
							<td>:</td>
							<td><input type="text" name="pass1" value="<?php echo @$result['pass1']; ?>"></td>
						</tr>
						<tr>
							<td>Password (lagi)</td>
							<td>:</td>
							<td><input type="text" name="pass2" value="<?php echo @$result['pass2']; ?>"></td>
						</tr>
						<tr>
							<td>Lampirkan KTP</td>
							<td>:</td>
							<td><input type="file" name="lampiran"></td>
						</tr>
						<!--tr>
							<td>Validasi</td>
							<td>catctha</td>
						</tr-->
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td align="right"><button type="submit" class="btn btn-success" name="registrasi" value="simpan">Simpan</button></td>
						</tr>
					</tbody>
				</table> 
			</form>
		<?php
}
?>
	</div>