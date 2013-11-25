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
			border-bottom: 1px dotted #888 !important;
		}
	</style>
<div style="padding:10px">
	<center><h4>PENGADUAN ATAS PERMOHONAN INFORMASI</h4></center>
	<br/>
	<br/>
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
															<td width="1px"><span class="label label-important kip-referensi-delete">&times;</span></td>
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
															<td width="1px"><span class="label label-important kip-lampiran-delete" name="'.$lam['name'].'">&times;</span></td>
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
	<?php
	if(@$status_default['status']==@$complain['complain_status']){
	?>
	<div align="right">
		<form action="<?php echo site_url(); ?>pengaduan/edit/<?php echo intval(@$complain['complain_id']); ?>">
			<button type="submit" class="btn btn-info">Edit</button>
		</form>
	</div>
	<?php
	}
	?>
</div>