<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$popup_action = site_url().'shot-pengaduan';
?>
	<style>
		.table-form{
			margin-bottom:25px;
		}
		.table-form td{
			vertical-align:top;
			padding:5px !important;
		}
		.text-form{
			--background-color: #FFF !important;
			--border: none !important;
			border-radius: 0px !important;
			border-bottom: 1px dotted #888 !important;
		}
	</style>
<div class="row-fluid sortable">
	<div class="box span8">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> INFORMASI PENGADUAN</h2>
		</div>
		<div class="box-berita" style="padding:10px">
		
		<input type="hidden" name="id_komplain" id="id_komplain" value="<?php echo @$complain['complain_id']; ?>">
		<table class="table-form" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr>
				<td><b>A.</b></td>
				<td colspan="3"><b>ALASAN PENGADUAN</b></td>
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
					<td><b>B.</b></td>
					<td colspan="3"><b>FAKTA / KASUS POSISI*</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">
						<?php echo @$complain['complain_case']; ?>
					</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td><b>C.</b></td>
					<td colspan="3"><b>REFERENSI PERMOHONAN YANG BERKAITAN DENGAN PENGADUAN</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">
						<table width="100%">
							<tbody>
								<tr>
									<td>
										<table class="table" id="act_reference" width="100%">
											<tbody>
												<?php
												$request = @$complain['request'];
												foreach($request as $req){
													echo '<tr>
															<td width="1px">-</td>
															<td width="1px">'.$req['request_datetime'].'<input type="hidden" name="reqid[]" value="'.$req['request_id'].'"></td>
															<td>'.$req['request_information'].'</td>
															<!--td width="1px"><span class="label label-important kip-referensi-delete">&times;</span></td-->
														  </tr>';
												}
												?>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td><b>D.</b></td>
					<td colspan="3"><b>LAMPIRAN LAINNYA</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">
						<table width="100%">
							<tbody>
								<tr>
									<td>
										<table class="table" id="act_lampiran" width="100%">
											<tbody>
												<?php
												$lampiran = @$complain['lampiran'];
												foreach($lampiran as $lam){
													echo '<tr>
															<td width="1px">-</td>
															<td>'.$lam['name'].'</td>
															<!--td width="1px"><span class="label label-important kip-lampiran-delete" name="'.$lam['name'].'">&times;</span></td-->
														  </tr>';
												}
												?>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
		</tbody>
	</table>
	
	</div>
	</div>
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> RESPON</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table style="padding:5px" width="100%">
			  <tbody class="tbody-ganti-status">
				<!--tr>
					<td valign="top">No. Registrasi</td>
					<td valign="top">:</td>
					<td>
						<input type="text" name="nomor" id="nomor" value="<?php echo @$complain['complain_nomor']; ?>">
					</td>
				</tr-->
				<tr>
					<td>Status : </td>
				</tr>
				<tr>
					<td>
						<select name="status" id="status">
							<?php
							foreach($status as $stat){
								$select = '';
								if($stat==$complain['complain_status']) $select = 'selected="selected"';
								echo "<option value='".$stat."' ".$select.">".$stat."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td valign="top">Alasan : </td>
				</tr>
				<tr>
					<td>
						<textarea class="span12" name="reason" id="reason"><?php echo @$complain['complain_status_reason']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<a class="btn btn-success bt-ganti-status">Simpan</a>
					</td>
				</tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$('.bt-ganti-status').click(function(){
		var btn  = $(this);
		btn.removeClass('btn-success');
		
		var tbod = btn.parents('.tbody-ganti-status');
		var stat = tbod.find('select[name="status"]').val();
		var alas = tbod.find('textarea[name="reason"]').val();
		var idid = $('#id_komplain').val();
		var data = {action: 'change_status', id: idid, status: stat, alasan: alas};
		var urls = '<?php echo $popup_action; ?>';
		var post = $.post(urls,data);
		
		post.done(function(data){
			data = $.parseJSON(data);
			if(data['status']=='success'){
				btn.addClass('btn-success');
			}
		});
	});
</script>