<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_pengaduan extends CI_Model{

	function get($id_complain){
		$this->load->model('mod_permohonan/data_permohonan');
		
		$sql = "SELECT * FROM dinamic_complains WHERE complain_id=".$id_complain;
		$data = $this->mysql->get_data($sql,'clean');
		
		$reqs = array();
		if(is_json(@$data['complain_requestid']))
			$reqs = json_decode($data['complain_requestid']);
		$tmps = array();
		foreach($reqs as $reqid){
			$tmp = $this->data_permohonan->get($reqid);
			$tmp['request_datetime'] = datetime_tgl($tmp['request_datetime']);
			array_push($tmps,$tmp);
		}
		
		$lams = array();
		if(is_json(@$data['complain_lampiran']))
			$lams = json_decode(@$data['complain_lampiran']);
		$lamp = array();
		foreach($lams as $lam){
			$tmp['name'] = $lam;
			$tmp['url'] = 'media/lampiran/'.$lam;
			array_push($lamp,$tmp);
		}
		$data['lampiran'] = $lamp;
		$data['request'] = $tmps;
		return $data;
	}
	
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_complains,dinamic_users where complain_userid=user_id ";
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY user_id '.$request_order;
		}else if($order=='date'){
			$sql .= ' ORDER BY complain_datetime '.$request_order;
		}
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
	
	function insert($complain){
		$data = array();
		$status = $this->status('active');
		if($complain['complain_id']>0){
			$this->mysql->query("UPDATE dinamic_complains SET complain_requestid='".$complain['requestid']."', complain_reason='".$complain['reason']."', complain_case='".$complain['case']."', complain_lampiran='".$complain['lampiran']."' WHERE complain_status='".$status['status']."' AND complain_id=".$complain['complain_id']);
			$data = $this->get($complain['complain_id']);
		}else{
			$maxid = $this->mysql->get_maxid('complain_id','dinamic_complains');
			$this->mysql->query("INSERT INTO dinamic_complains(complain_id,complain_requestid,complain_reason,complain_case,complain_datetime,complain_status,complain_lampiran) VALUES(".$maxid.",'".$complain['requestid']."','".$complain['reason']."','".$complain['case']."',NOW(),'".$status['status']."','".$complain['lampiran']."')");
			$data = $this->get($maxid);
		}
		return $data;
	}
	
	function delete($id_complain){
		$this->mysql->query("DELETE FROM dinamic_complains WHERE complain_id=".$id_complain);
		$data = $this->get($id_complain);
		return $data;
	}
	
	/*
		default : status
	*/
	function statistic($complain=null){
		if($complain=='bulanan'){
			$sql = "SELECT YEAR(complain_datetime) AS tahun,MONTH(complain_datetime) AS bulan,COUNT(complain_id) jumlah FROM dinamic_complains GROUP BY MONTH(complain_datetime)";
		}else{
			$sql = "SELECT complain_status AS status, COUNT(DISTINCT complain_id) AS jumlah FROM dinamic_complains GROUP BY complain_status UNION ALL SELECT 'total' AS status,COUNT(DISTINCT complain_id) FROM dinamic_complains";
		}
		return $this->mysql->get_datas($sql,'clean');
	}
	
	function alasan_pengaduan(){
		$sql = "SELECT var_keyid AS alasan_key,var_value AS alasan_value FROM dinamic_vars WHERE var_key='alasan_pengaduan' ORDER BY var_keyid";
		$res = $this->mysql->get_datas($sql,'clean');
		return $res;
	}
	
	function get_alasan(){
		$tmp = array();
		$sql = "SELECT var_keyid AS alasan_key,var_value AS alasan_value FROM dinamic_vars WHERE var_key='alasan_pengaduan'";
		$res = $this->mysql->get_datas($sql,'clean');
		foreach($res as $r){
			$tmp[$r['alasan_key']] = $r['alasan_value'];
		}
		return $tmp;
	}
	
	function status($complain=null){
		$tmp = array();
		$sql = "SELECT var_value as status FROM dinamic_vars WHERE var_key='status_pengaduan'";
		if($complain=='active'){
			$sql .= " AND var_opt='active'";
			$tmp = $this->mysql->get_data($sql,'clean');
		}else{
			$sql .= " ORDER BY var_keyid";
			$top = $this->mysql->get_datas($sql,'clean');
			foreach($top as $tip){
				$tmp[] = $tip['status'];
			}
		}
		return $tmp;
	}
	
	function get_status($complain_id=0){
		$sql = "SELECT complain_status AS status FROM dinamic_complains WHERE complain_id=".$complain_id;
		$data = $this->mysql->get_data($sql,'clean');
		return @$data['status'];
	}
	
	function set_status($data){
		$this->mysql->query("UPDATE dinamic_complains SET complain_status='".$data['status']."', complain_status_reason='".$data['reason']."' WHERE complain_id=".$data['id']);
		$data = $this->get($data['id']);
		$data['status'] = 'success'; 
		return $data;
	}
	
	function remove_file($complain_id,$fname){
		$data = $this->get($complain_id);
		$lams = json_decode($data['complain_lampiran']);
		$lamp = array();
		foreach($lams as $lam){
			if($lam!=$fname){
				array_push($lamp,$lam);
			}
		}
		$news = json_encode($lamp);
		$this->mysql->query("UPDATE dinamic_complains SET complain_lampiran='".$news."' WHERE complain_id=".$complain_id);
		return $this->get($complain_id);
	}
}
?>