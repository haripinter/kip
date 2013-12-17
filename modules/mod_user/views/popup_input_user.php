<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>
<style>
	.tbl_registrasi td{
		vertical-align:top;
		padding:2px;
	}
</style>
<form method="POST" action="<?php echo site_url(); ?>registrasi" enctype="multipart/form-data">
	<?php
	if(!is_null(@$err)){
		echo "<div class='alert alert-error'>".$err."</div>";
	}
	?>
	<table class="tbl_registrasi" width="100%">
		<tbody>
			<tr>
				<td width="120px">Nama Lengkap</td>
				<td width="1px">:</td>
				<td align="left"><input type="text" name="nama" value="<?php echo @$user['user_fullname']; ?>"></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><input type="text" name="alamat" value="<?php echo @$user['user_address']; ?>"></td>
			</tr>
			<tr>
				<td>Nomor Telepon</td>
				<td>:</td>
				<td><input type="text" name="telepon" value="<?php echo @$user['user_phone']; ?>"></td>
			</tr>
			<tr>
				<td>Nomor KTP</td>
				<td>:</td>
				<td><input type="text" name="ktp" value="<?php echo @$user['user_ktp']; ?>"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td>:</td>
				<td><input type="text" name="email" value="<?php echo @$user['user_email']; ?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td>:</td>
				<td><input type="text" name="pass1" value="<?php echo @$user['pass1']; ?>"></td>
			</tr>
			<tr>
				<td>Password (lagi)</td>
				<td>:</td>
				<td><input type="text" name="pass2" value="<?php echo @$user['pass2']; ?>"></td>
			</tr>
		</tbody>
	</table> 
</form>