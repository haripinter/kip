<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div style="padding:10px; width:100%; float:left">
<?php
switch(@$result['err']){
	case 'activation_expired':
		?>
			<p>Mohon maaf, kode aktivasi Anda tidak cocok atau sudah kadaluarsa.</p>
			<p>Jika Anda belum mendaftar, Anda harus Registrasi dulu di <a href="<?php echo site_url(); ?>registrasi">Form Registrasi</a>.</p>
			<p>Atau jika sudah mendaftar, silakan <a href="<?php echo site_url(); ?>aktivasi/baru">Perbarui Kode Aktivasi</a>.</p>
			<br/>
			<form method="POST" action="<?php echo site_url(); ?>aktivasi">
				<input type="text" name="kode" style="margin-bottom:0px" placeholder="Kode Aktivasi">
				<button type="submit" class="btn btn-success" name="aktivasi" value="aktifkan">Aktifkan</button>
			</form>
		<?php
		break;
		
	case 'activation_success':
		?>
		<p>Terima kasih. Akun Anda sudah aktif. Klik link di bawah ini untuk login.</p>
		<br/>
		<a class="btn btn-success" href="<?php echo site_url(); ?>login">Login</a>
		<?php
		break;
		
	case 'renew_activation':
		$tit = 'Mohon maaf. Email Anda tidak cocok dengan akun manapun. Silakan masukkan email Anda dengan benar.';
		if($key=='baru'){
			$tit = 'Silakan masukkan email Anda dengan benar.';
		}
		?>
		<p><?php echo $tit; ?></p>
		<br/>
		<form method="POST" action="<?php echo site_url(); ?>aktivasi">
			<input type="text" name="email" value="<?php echo @$result['user_email'];?>" placeholder="Masukkan email Anda" style="margin-bottom:0px">
			<button type="submit" class="btn btn-success" name="aktivasi" value="renew_activation_key">Perbarui Kode Aktivasi</button>
		</form>
		<?php
		break;
		
	default:
		?>
			<p>Masukkan Kode Aktivasi pada kotak isian di bawah ini, kemudian klik Aktifkan.</p>
			<br/>
			<form method="POST" action="<?php echo site_url(); ?>aktivasi">
				<input type="text" name="kode" style="margin-bottom:0px" placeholder="Kode Aktivasi">
				<button type="submit" class="btn btn-success" name="aktivasi" value="aktifkan">Aktifkan</button>
			</form>
		<?php
}
?>
</div>