<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$popup_action = site_url().'shot-pengaduan';
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
		.modalzWindow{
			top: 15% !important;
		}
		.kip-label-remove{
			cursor: pointer;
		}
		.kip-lampiran-delete{
			cursor: pointer;
		}
		.kip-referensi-delete{
			cursor: pointer;
		}
	</style>
<div class="modalzWindow modal hide fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<header class="modal-header">
		<a class="close modal-tutup">&times;</a>
		<h4></h4>
	</header>
	<div class="modal-body"></div>
	<footer class="modal-footer">
		<span class="pull-left">
			<span class="modal-result"></span>
		</span>
		<a class="btn modal-tutup">Tutup</a>
		<a class="btn btn-success modal-simpan">Simpan</a>
	</footer>
</div>
<div style="padding:10px">
	<center><h4>FORMULIR<br/>PENGADUAN ATAS PERMOHONAN INFORMASI</h4></center>
	<br/>
	<br/>
	<form method="POST" action="<?php echo site_url(); ?>pengaduan" enctype="multipart/form-data">
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
									if(in_array(@$ap['alasan_key'],@$alasan)) $checked = 'checked="checked"';
									echo "<tr>
										<td>".chr(97+$n).".</td>
										<td><input type='checkbox' name='alasan[]' value='".$ap['alasan_key']."' ".$checked."></td>
										<td>".$ap['alasan_value']."</td>
										</tr>";
									$n++;
								}
								?>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td><b>B.</b></td>
					<td colspan="3"><b>FAKTA / KASUS POSISI*</b></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="3">
						<textarea class="text-form span12" name="kasus"><?php echo @$complain['complain_case']; ?></textarea>
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
												$request = array();
												if(count(@$complain['request'])>0) 
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
									<td width="110px">
										<a class="btn pilih-refs">Pilih Referensi</a>
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
												$lampiran = array();
												if(count(@$complain['lampiran'])>0) 
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
									<td width="110px">
										<a class="btn tambah-lampiran">Tambah</a>
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>*</td>
					<td colspan="2" style="color:#666">
						Uraian secara lengkap dan objektif tentang alasan dan fakta-fakta hukum yang berkaitan dengan permohonan informasi yang dimaksud.
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<?php
					$btntxt = 'Ajukan Pengaduan';
					if(@$complain['complain_id']>0){
						$btntxt = 'Simpan Perubahan';
					}
					?>
					<td align="right"><button type="submit" class="btn btn-info" name="pengaduan" value="simpan"><?php echo $btntxt; ?></button></td>
				</tr>
			</tbody>
		</table>
	</form>
</div>
<script>
$(document).ready(function(){
	$(".kip-referensi-delete").click(function(){
		var btn = $(this);
		var trs = btn.parent().parent();
		
		bootbox.confirm("Anda yakin akan menghapus ini?", function(result) {
			if(result==true){
				trs.remove();
			}
		});
	});
	
	$(".kip-lampiran-delete").click(function(){
		var btn = $(this);
		var idc = $('#id_komplain').val();
		var idf = btn.attr('name');
		var trs = btn.parent().parent();
		
		var urls = '<?php echo $popup_action; ?>';
		var data = {action: 'delete_file', id: idc, fname: idf};
		bootbox.confirm("Anda yakin akan menghapus Lampiran ini?", function(result) {
			if(result==true){
				var post = $.post(urls,data);
				post.done(function(data){
					data = $.parseJSON(data);
					if(data['status']=='success'){
						trs.remove();
					}
				});
			}
		});
	});
	
	$(".modalzWindow .modal-tutup").click(function(){
		var btn = $(this);
		var pop = btn.parents('.modalzWindow');
		var mug = pop.find('.modal-body');
		mug.html('');
		pop.modal('hide');
	});
	
	$('.modal-simpan').click(function(){
		var btn = $(this);
		var tbl = $('#act_reference')
		var pop = $('.modalzWindow');
		var mug = pop.find('.modal-body');
		var res = pop.find('.modal-result');
		
		var frm = mug.find('form');
		
		// edit this
		mug.html('Tunggu...');
		pop.find('h4').html('Pilih Referensi Permohonan Informasi');
		var urls = '<?php echo $popup_action; ?>';
		var data = frm.serializeArray();
		
		var post = $.post(urls,data);
		post.done(function(data){
			data = $.parseJSON(data);
			var tbody = tbl.find('tbody');
			$(data).each(function(){
				var cur = this;
				var tr = $('<tr>');
				tr.append('	<td width="1px">-</td>\
							<td width="1px">'+cur['request_datetime']+'<input type="hidden" name="reqid[]" value="'+cur['request_id']+'"></td>\
							<td>'+cur['request_information']+'</td>\
							<td width="1px"><span class="label label-important kip-label-remove">&times;</span></td>');
				var btr = $(tr).find('.kip-label-remove');
				rem_reference(btr);
				tbody.append(tr);
			});
			pop.modal('hide');
			mug.html(data);
			res.html('');
		});
	});
	
	function rem_reference(btr){
		btr = $(btr);
		btr.click(function(){
			tr = btr.parent().parent();
			tr.remove();
		});
	}
	
	$('.pilih-refs').click(function(){
		var btn = $(this);
		var pop = $('.modalzWindow');
		var mug = pop.find('.modal-body');
		var res = pop.find('.modal-result');
		
		// edit this
		mug.html('Tunggu...');
		pop.find('h4').html('Pilih Referensi Permohonan Informasi');
		var urls = '<?php echo $popup_action; ?>';
		var data = {action:'get_references'};
		
		var post = $.post(urls,data);
		post.done(function(data){
			pop.modal('show');
			mug.html(data);
			res.html('');
		});
	});
	
	$('.tambah-lampiran').click(function(){
		var btn = $(this);
		var tbl = $('#act_lampiran');
		var tbody = tbl.find('tbody');
		var tr = $('<tr>');
		tr.append('	<td width="1px">-</td>\
					<td><input type="file" name="lampiran[]"></td>\
					<td width="1px"><span class="label label-important kip-label-remove">&times;</span></td>');
		var btr = $(tr).find('.kip-label-remove');
		rem_reference(btr);
		tbody.append(tr);
	});
});
</script>