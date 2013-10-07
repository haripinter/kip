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
					var post = $.post(url,{complain:<?php echo $complain_id; ?>, status:$('#status').val(), reason:$('#reason').val()});
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
			if($tmp['complain']!='' && $tmp['status']!=''){
				$res = $this->mod_pengaduan->set_status($tmp);
				if($res==$tmp['status']){
					echo 'OK';
				}
			}
		}
	}
}
?>