<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('root_local_function.php');
$_app = $site_url.'/index.php/root/';

?>
<style>
	.table-form{
		
	}
	.table-form td{
		padding: 5px;
		vertical-align: middle;
	}
</style>
<div class="row-fluid sortable">
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> PROFIL</h2>
		</div>
		<div style="padding:10px">
			<div>
				<table class="table-form" cellpadding="0" cellspacing="0">
					<tbody>
						<tr>
							<td>Nama Lengkap</td>
							<td><?php echo $user['user_fullname']; ?></td>
						</tr>
						<tr>
							<td>Alamat</td>
							<td><?php echo $user['user_address']; ?></td>
						</tr>
						<tr>
							<td>Nomor Telepon</td>
							<td><?php echo $user['user_phone']; ?></td>
						</tr>
						<tr>
							<td>Nomor KTP</td>
							<td><?php echo $user['user_ktp']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $user['user_email']; ?></td>
						</tr>
						<tr>
							<td>Lampirkan KTP</td>
							<td><?php echo $user['user_scanktp']; ?></td>
						</tr>
					</tbody>
				</table> 
			</div>
		</div>
	</div>
</div>