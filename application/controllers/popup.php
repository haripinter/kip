<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class popup extends CI_Controller {
	function status_permohonan($request_id=0){
		$this->load->model('mod_setting');
		$data['site_url'] = $this->mod_setting->site_url();
		if(intval($request_id)>0){
			$this->load->model('mod_permohonan');
			$request = $this->mod_permohonan->get($request_id);
			$status = $this->mod_permohonan->status();
			?>
			<table style="padding:5px" width="100%">
				<tr>
					<td>Status</td>
					<td>:</td>
					<td>
						<select name="status" id="status">
							<?php
							foreach($status as $stat){
								$select = '';
								if($stat==$request['request_status']) $select = 'selected="selected"';
								echo "<option value='".$stat."' ".$select.">".$stat."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td valign="top">Alasan</td>
					<td valign="top">:</td>
					<td>
						<textarea class="span11" style="height:160px" name="reason" id="reason"><?php echo $request['request_status_reason']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td valign="top">No.SK/Surat *</td>
					<td valign="top">:</td>
					<td>
						<input type="text" name="nomor" id="nomor" value="<?php echo $request['request_nomor']; ?>"><br/>
						* : Diisi denngan Nomor SK / Surat sesuai buku besar.<br/><br/>
					</td>
				</tr>
				<tr>
					<td><label id="result"></label></td>
					<td valign="top">&nbsp;</td>
					<td>
						<a class="btn btn-success bt-simpan">Simpan</a>
					</td>
				</tr>
			</table>
			<script>
				$('.bt-simpan').click(function(){
					$('#result').html('Wait...');
					var url = '<?php echo $data['site_url']; ?>/index.php/popup/permohonan_save';
					var post = $.post(url,{request:<?php echo $request_id; ?>, status:$('#status').val(), reason:$('#reason').val(), nomor:$('#nomor').val()});
					post.done(function(data){
						if(data=='OK'){
							$('#result').html('tersimpan.');
							var loc = $('.linked'+<?php echo $request_id; ?>).parent().parent().find("td.status");
							loc.html($('#status').val());
						}
					});
				});
			</script>
			<?php
		}
	}
	
	function permohonan_save(){
		if(isset($_POST['request'])){
			$this->load->model('mod_permohonan');
			$status = $this->mod_permohonan->status();
			
			$tmp['request'] = (isset($_POST['request']) && intval($_POST['request'])>0) ? $_POST['request'] : '';
			$tmp['status'] = (isset($_POST['status']) && in_array($_POST['status'],$status)) ? $_POST['status'] : '';
			$tmp['reason'] = (isset($_POST['reason']) && $_POST['reason']!=null) ? $_POST['reason'] : '';
			$tmp['nomor'] = (isset($_POST['nomor']) && $_POST['nomor']!=null) ? $_POST['nomor'] : '';
			if($tmp['request']!='' && $tmp['status']!=''){
				$res = $this->mod_permohonan->set_status($tmp);
				if($res==$tmp['status']){
					echo 'OK';
				}
			}
		}
	}
	
	function status_pengaduan($complain_id=0){
		$this->load->model('mod_setting');
		$data['site_url'] = $this->mod_setting->site_url();
		if(intval($complain_id)>0){
			$this->load->model('mod_pengaduan');
			$complain = $this->mod_pengaduan->get($complain_id);
			$status = $this->mod_pengaduan->status();
			?>
			<table style="padding:5px" width="100%">
				<tr>
					<td valign="top">No. Registrasi</td>
					<td valign="top">:</td>
					<td>
						<input type="text" name="nomor" id="nomor" value="<?php echo @$complain['complain_nomor']; ?>">
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>:</td>
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
					<td valign="top">Alasan</td>
					<td valign="top">:</td>
					<td>
						<textarea class="span11" style="height:160px" name="reason" id="reason"><?php echo $complain['complain_status_reason']; ?></textarea>
					</td>
				</tr>
				<tr>
					<td><label id="result"></label></td>
					<td valign="top">&nbsp;</td>
					<td>
						<a class="btn btn-success bt-simpan">Simpan</a>
					</td>
				</tr>
			</table>
			<script>
				$('.bt-simpan').click(function(){
					$('#result').html('Wait...');
					var url = '<?php echo $data['site_url']; ?>/index.php/popup/pengaduan_save';
					var post = $.post(url,{complain:<?php echo $complain_id; ?>, status:$('#status').val(), reason:$('#reason').val(), nomor:$('#nomor').val()});
					post.done(function(data){
						if(data=='OK'){
							$('#result').html('tersimpan.');
							var loc = $('.linked'+<?php echo $complain_id; ?>).parent().parent().find("td.status");
							loc.html($('#status').val());
						}
					});
				});
			</script>
			<?php
		}
	}
	
	function pengaduan_save(){
		if(isset($_POST['complain'])){
			$this->load->model('mod_pengaduan');
			$status = $this->mod_pengaduan->status();
			
			$tmp['complain'] = (isset($_POST['complain']) && intval($_POST['complain'])>0) ? $_POST['complain'] : '';
			$tmp['status'] = (isset($_POST['status']) && in_array($_POST['status'],$status)) ? $_POST['status'] : '';
			$tmp['reason'] = (isset($_POST['reason']) && $_POST['reason']!=null) ? $_POST['reason'] : '';
			$tmp['nomor'] = (isset($_POST['nomor']) && $_POST['nomor']!=null) ? $_POST['nomor'] : '';
			if($tmp['complain']!='' && $tmp['status']!=''){
				$res = $this->mod_pengaduan->set_status($tmp);
				if($res==$tmp['status']){
					echo 'OK';
				}
			}
		}
	}
	
	function upload_ui(){
		$this->load->model('mod_setting');
		$data['site_url'] = $this->mod_setting->site_url();
		?>
		<div class="container span12">
			<span class="btn btn-success fileinput-button">
				<i class="glyphicon glyphicon-plus"></i>
				<span>Select files...</span>
				<input id="fileupload" type="file" name="files[]" multiple>
			</span>
			<table class="table" style="margin-top:10px; width:100%;">
				<tbody id="fbody">
				</tbody>
			</table>
			<!--div id="progress" class="progress">
				<div class="progress-haha progress-striped progress-success active"><div class="bar" width="20%"></div>
			</div-->
			
			<div class="progress progress-striped progress-success hide">
				<div class="bar"></div>
			</div>
		</div>
		<script>
			/*jslint unparam: true */
			/*global window, $ */
			$(function () {
				'use strict';
				// Change this to the location of your server-side upload handler:
				var url = '<?php echo $data['site_url']; ?>/index.php/popup/upload_exec';
				var btn = '';
				$('#fileupload').fileupload({
					url: url,
					dataType: 'json',
					add: function (e, data) {
						var piring = $('#fbody');
						
						var index = (piring.children()).length;
						var btupload = $('<input type="button" class="btn btn-info" value="upload" name="btupload">');
						var filename = $('<span name="filename">'+data.files[0].name+'</span>');
						var tr = $('<tr></tr>');
						var td = [];
						td[0] = $('<td></td>').append(filename);
						td[1] = $('<td width="40px"></td>').append(btupload);
						tr.append(td);
						$('#fbody').append(tr);
						
						btupload.click(function(){
							$('.progress').addClass('active').removeClass('hide');
							data.submit();
						});
					},
					//formData: {'dom':'hahaha'},
					done: function (e, data) {
						//console.log('dnoe');
						//console.log(data.jqXHR.responseText);
						//$.each(data.result.files, function (index, file) {
						//    $('<p/>').text(file.name).appendTo('#files');
						//});
						//$('#progress').addClass('hide');
						$('.progress .bar').css('');
						$('.progress').removeClass('active');
					},
					progress: function (e, data) {
						//$('#progress').removeClass('hide');
						var progress = parseInt(data.loaded / data.total * 100, 10);
						//console.log(progress);
						$('.progress .bar').css('width', progress + '%');
					}
				}).prop('disabled', !$.support.fileInput)
					.parent().addClass($.support.fileInput ? undefined : 'disabled');
			});
			</script>
		<?php
	}
	
	function upload_exec(){
		require('UploadHandler.php');
		$upload_handler = new UploadHandler(array(
			'upload_dir' => 'media/berkas/',
			'upload_url' => 'media/berkas/',
			'accept_file_types' => '/\.(gif|jpe?g|png|bmp|doc|docx|xls|xlsx|ppt|pptx|txt|rtf|odt|odp|odf|svg|csv|pps|pdf|zip|rar|tar|bz|gz|7z)$/i'
		));
		
		$this->load->model('mod_download');
		$id_user = 1;
		
		$response = $upload_handler->response;
		$get_response = json_decode($response);
		$file = get_object_vars($get_response->files[0]);
		if($file['size']>0){
			$tmp['key'] = 'download';
			$tmp['link'] = '';
			$tmp['title'] = '';
			$tmp['realname'] = $file['name'];
			$tmp['thumbnail'] = $file['name'];
			$tmp['userid'] = $id_user;
			$tmp['media_id'] = 0;
			$res = $this->mod_download->insert($tmp);
			if(isset($res['media_id']) && $res['media_id']>0){
				$get_response->files[0]->media_id = $res['media_id'];
				$get_response->files[0]->key = $res['media_key'];
				$get_response->files[0]->datetime = $res['media_datetime'];
				$get_response->files[0]->thumbnail = $res['media_thumbnail'];
			}
			$response = json_encode($get_response); 
		}
		echo $response;
	}
	
	function media_del(){
		$this->load->model('mod_download');
		$tmp = array();
		if(isset($_POST['media'])) $tmp['media_id'] = intval($_POST['media']);
		$data = $this->mod_download->get($tmp['media_id']);
		$stat = true;
		if(isset($data['media_key'])){
			$folder = 'media/';
			if($data['media_key']=='download'){
				$folder .= 'berkas/';
			}
			
			if($data['media_realname']!='' && file_exists($folder.$data['media_realname'])){
				unlink($folder.$data['media_realname']);
			}
			
			if($data['media_thumbnail']!='' && file_exists($folder.'thumbnail/'.$data['media_thumbnail'])){
				unlink($folder.'thumbnail/'.$data['media_thumbnail']);
			}
			
			$this->mod_download->delete($data['media_key'],$data['media_id']);
			echo "OK";
		}
	}
}
?>