<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';

$err   = null;
if(@$result['err']=='password'){
	$result['pass1'] = '';
	$result['pass2'] = '';
	$err = "Password harus diisi dan harus sama.";
}else if(@$result['err']=='kosong'){
	$err = "Semua data harus dilengkapi, termasuk scan KTP.";
}

if(@$result['err']=='registration_success'){
?>
	<div>
		Untuk menyelesaikan registrasi, kami telah mengirim kode aktivasi ke alamat email Anda (<b><?php echo @$result['user_email']; ?></b>). Jika tidak ada email masuk, periksa di bagian Bulk atau Spam.
		<br/>
		Kode aktivasi ini hanya berlaku 1x24 jam. Jika selama 1x24 jam akun Anda tidak diaktifkan, Anda harus mendaftar ulang dari awal. Silakan klik tautan aktivasi yang dikirim ke email Anda, atau bisa melakukan aktivasi secara manual dengan memasukkan kode aktivasi pada kotak di bawah ini :
		<br/>
		<br/>
		<form method="POST" action="<?php echo $site_url; ?>/index.php/registrasi">
			<input type="text" name="kode">
			<button type="submit" class="btn btn-success" name="registrasi" value="aktivasi">Aktifkan</button>
		</form>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
<?php
}else if(@$result['err']=='none'){
?>
	<div>
		Mohon maaf. Email Anda tidak cocok dengan akun manapun. Silakan masukkan email Anda dengan benar.
		<br/>
		<form method="POST" action="<?php echo $site_url; ?>/index.php/registrasi">
			<input type="text" name="email" value="<?php echo @$result['user_email'];?>">
			<button type="submit" class="btn btn-success" name="registrasi" value="renew_activation_key">Minta Kode Aktivasi Baru</button>
		</form>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
<?php
}else if(@$result['err']=='double_inactive'){
?>
	<div>
		Mohon maaf, email yang Anda masukkan sudah terdaftar dan belum diaktifkan. Klik tombol di bawah untuk mendapatkan kode aktivasi yang baru.
		<br/>
		<form method="POST" action="<?php echo $site_url; ?>/index.php/registrasi">
			<input type="text" name="email" value="<?php echo @$result['email'];?>">
			<button type="submit" class="btn btn-success" name="registrasi" value="renew_activation_key">Minta Kode Aktivasi Baru</button>
		</form>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
<?php
}else if(@$result['err']=='double_active'){
?>
	<div>
		Mohon maaf, email yang Anda daftarkan sudah pernah didaftarkan sebelumnya. Silakan gunakan email yang lain.
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
<?php
}else if(@$result['err']=='double_banned'){
?>
	<div>
		Mohon maaf, user dari email yang Anda masukkan telah di-banned. Mohon hubungi Administrator untuk mengaktifkan kembali user Anda.
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
<?php
}else if(@$result['err']=='activation_expired'){
?>
	<div>
		Mohon maaf, kode aktivasi Anda sudah kadaluarsa. Masukkan email kemudian klik tombol di bawah untuk mendapatkan kode aktivasi yang baru.
		<br/>
		<form method="POST" action="<?php echo $site_url; ?>/index.php/registrasi">
			<input type="text" name="email" value="<?php echo @$result['email'];?>" placeholder="Masukkan email Anda">
			<button type="submit" class="btn btn-success" name="registrasi" value="renew_activation_key">Minta Kode Aktivasi Baru</button>
		</form>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
<?php
}else if(@$result['err']=='activation_success'){
?>
	<div>
		Terima kasih. Akun Anda sudah aktif. Klik link di bawah ini untuk login.
		<br/>
		<a>Login</a>
		<br/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
<?php
}else{
?>

	<div>
	<form method="POST" action="<?php echo $site_url; ?>/index.php/registrasi" enctype="multipart/form-data">
		<?php
		if(!is_null($err)){
			echo "<div class='alert alert-error'>".$err."</div>";
		}
		?>
		
		<table class="table-form" cellpadding="0" cellspacing="0">
			<tbody>
				<tr>
					<td>Nama Lengkap</td>
					<td><input type="text" name="nama" value="<?php echo @$result['fullname']; ?>"></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><input type="text" name="alamat" value="<?php echo @$result['address']; ?>"></td>
				</tr>
				<tr>
					<td>Nomor Telepon</td>
					<td><input type="text" name="telepon" value="<?php echo @$result['phone']; ?>"></td>
				</tr>
				<tr>
					<td>Nomor KTP</td>
					<td><input type="text" name="ktp" value="<?php echo @$result['ktp']; ?>"></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email" value="<?php echo @$result['email']; ?>"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="text" name="pass1" value="<?php echo @$result['pass1']; ?>"></td>
				</tr>
				<tr>
					<td>Password (lagi)</td>
					<td><input type="text" name="pass2" value="<?php echo @$result['pass2']; ?>"></td>
				</tr>
				<tr>
					<td>Lampirkan KTP</td>
					<td><input type="file" name="lampiran"></td>
				</tr>
				<!--tr>
					<td>Validasi</td>
					<td>catctha</td>
				</tr-->
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="registrasi" value="simpan">Simpan</button></td>
				</tr>
			</tbody>
		</table> 
	</form>
	</div>
<?php
}
?>