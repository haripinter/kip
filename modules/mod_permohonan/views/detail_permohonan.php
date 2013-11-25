<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$popup_action = site_url().'shot-permohonan';
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
<input type="hidden" id="request_id" value="<?php echo @$request['request_id']; ?>">
<div class="row-fluid sortable">
	<div class="box span8">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> DETAIL PERMOHONAN</h2>
		</div>
		<div class="box-berita" style="padding:10px">
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
							echo "<a href='".site_url()."/media/lampiran/".@$request['request_authfile']."'>";
							echo "<img style='height:50px' src='".site_url()."/media/lampiran/".@$request['request_authfile']."'>";
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
					<td><?php echo ucfirst(@$request['request_how']); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Format Bahan Informasi</td>
					<td>:</td>
					<td><?php echo ucfirst(@$request['request_format']); ?></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Cara Pengiriman Bahan Informasi</td>
					<td>:</td>
					<td><?php echo ucfirst(@$request['request_delivery']); ?></td>
				</tr>
			</tbody>
		</table>
		</div>
	</div>
	
	<div class="box span4">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-picture"></i> STATUS</h2>
		</div>
		<div class="box-berita" style="padding:10px">
			<table width="100%">
				<tbody class="tbody-ganti-status">
					<tr>
						<td>Status Permohonan:</td>
					</tr>
					<tr>
						<td>
							<select name="status">
								<?php
								foreach($status as $stat){
									$select = '';
									if(@$request['request_status']==$stat)
										$select = 'selected="selected"';
									echo '<option value="'.$stat.'" '.$select.'>'.$stat.'</option>';
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Alasan:</td>
					</tr>
					<tr>
						<td>
							<textarea name="alasan" class="span12"><?php echo @$request['request_status_reason']; ?></textarea>
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
		var alas = tbod.find('textarea[name="alasan"]').val();
		var idid = $('#request_id').val();
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