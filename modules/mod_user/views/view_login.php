<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$popup_action = site_url().'shot-user';
$next = @$_SERVER['HTTP_REFERER'];
if($next=='') $next = 'login';

if(!config_item('IS_LOGIN')){
?>
	<div class="row-fluid" style="border-radius:3px; background-color:#fff; padding-top:10px; margin-top:8px;">
		<div class="box-content" style="padding:20px; margin-top:">
			<div class="box center" style="width:250px; margin-bottom:80px; margin-top:70px">
				<div class="box-content">
					<div class="row-fluid">
					<form class="kip-form-login" name="<?php echo $next; ?>">
						<span style="font-size:1.2em; font-weight:bold;">LOGIN KIP v1.0</span>
						<hr style="margin:5px auto 15px auto;"/>
						<div id="alert"></div>
						<input name="action" type="hidden" value="login">
						<input name="email" type="text" placeholder="Email">
						<input name="password" type="password" placeholder="Password">
						<a class="btn bt-login">Login</a>
					</form>
					</div>                   
				</div>
			</div>
		</div>
	</div>
	<script>
		$('.bt-login').click(function(){
			var form = $('.kip-form-login');
			var alerto = $("#alert");
			alerto.removeClass().addClass('alert');
			alerto.html('<div><div class="spinner pull-left"></div><span class="pull-left">&nbsp;Tunggu...</span>.</div>');
			
			var url = '<?php echo $popup_action; ?>';
			var dat = form.serializeArray();
			var posting = $.post( url, dat );
			posting.done(function(data){
				data = $.parseJSON(data);
				if(data['status']=='success'){
					alerto.removeClass().addClass('alert alert-success');
					alerto.html('<div class="spinner pull-left"></div>Pengalihan Halaman...');
					setTimeout(function () {
						if(data['next']=='admin'){
							location.href = 'admin';
						}else{
							location.href = form.attr('name');
						}
					}, 1000);
				}else if(data['status']=='failed'){
					alerto.removeClass().addClass('alert alert-error');
					alerto.html('Maaf, email dan atau password Anda tidak sesuai.');
					alerto.attr('id')
				}else{
					alerto.removeClass().addClass('alert');
					alerto.html("Terjadi kesalahan pada sistem, hubungi Admin.");
				}
			});
		});
	</script>
<?php
}else{
?>
	<div class="row-fluid" style="border-radius:3px; background-color:#fff; padding-top:10px; margin-top:8px;">
		<div class="box-content" style="padding:20px; margin-top:">
			<div class="box center" style="width:450px; margin-bottom:80px; margin-top:70px">
				<div class="box-content">
					<div class="row-fluid" style="text-align:left">
						<h3>Informasi User :</h3>
						<hr style="margin:2px"/>
						<table>
							<tbody>
							  <tr>
								<td valign="top" width="70px">IP Adress</td>
								<td valign="top">:</td>
								<td valign="top"><?php echo $userdata['ip_address']; ?></td>
							  </tr>
							  <tr>
								<td valign="top">Browser</td>
								<td valign="top">:</td>
								<td valign="top"><?php echo $userdata['user_agent']; ?></td>
							  </tr>
							  <tr>
								<td valign="top">Nama</td>
								<td valign="top">:</td>
								<td valign="top"><?php echo $userdata['nama']; ?></td>
							  </tr><tr>
								<td valign="top">Alamat</td>
								<td valign="top">:</td>
								<td valign="top"><?php echo $userdata['alamat']; ?></td>
							  </tr>
							</tbody>
						</table>
					</div>                   
				</div>
			</div>
		</div>
	</div>
<?php
}
?>