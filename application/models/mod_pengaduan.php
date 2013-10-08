<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_pengaduan extends CI_Model{

	function get($id_complain){
		$res = array();
		if(is_numeric($id_complain)){
			$sql = "SELECT * FROM dinamic_complains,dinamic_requests,dinamic_users WHERE complain_requestid=request_id AND request_userid=user_id AND complain_id=".$id_complain;
			$res = $this->mysql->get_data($sql,'clean');
		}
		return $res;
	}
	
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_complains,dinamic_requests,dinamic_users WHERE complain_requestid=request_id AND request_userid=user_id";
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
		$res = $this->mysql->get_datas($sql,'clean');
		return $res;
	}
	
	function insert($complain){
		$res = array();
		$status = $this->status('default');
		if($complain['complain_id']>0){
			$this->mysql->query("UPDATE dinamic_complains SET complain_reason='".$complain['reason']."', complain_case='".$complain['case']."', complain_date='".$complain['date']."' WHERE complain_status='".$status['status']."' AND complain_id=".$complain['complain_id']);
			$res = $this->get($complain['complain_id']);
		}else{
			$maxid = $this->mysql->get_maxid('complain_id','dinamic_complains');
			$this->mysql->query("INSERT INTO dinamic_complains(complain_id,complain_requestid,complain_reason,complain_case,complain_date,complain_datetime,complain_status) VALUES(".$maxid.",'".$complain['requestid']."','".$complain['reason']."','".$complain['case']."','".$complain['date']."',NOW(),'".$status['status']."')");
			$res = $this->get($maxid);
		}
		return $res;
	}
	
	function delete($id_complain){
		$this->mysql->query("DELETE FROM dinamic_complains WHERE complain_id=".$id_complain);
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
		$sql = "SELECT setting_vars AS alasan_key,setting_value AS alasan_value FROM dinamic_settings WHERE setting_key='alasan_pengaduan' ORDER BY setting_vars";
		$res = $this->mysql->get_datas($sql,'clean');
		return $res;
	}
	
	function get_alasan(){
		$tmp = array();
		$sql = "SELECT setting_vars AS alasan_key,setting_value AS alasan_value FROM dinamic_settings WHERE setting_key='alasan_pengaduan'";
		$res = $this->mysql->get_datas($sql,'clean');
		foreach($res as $r){
			$tmp[$r['alasan_key']] = $r['alasan_value'];
		}
		return $tmp;
	}
	
	function status($complain=null){
		$tmp = array();
		$sql = "SELECT setting_value as status FROM dinamic_settings WHERE setting_key='status_pengaduan'";
		if($complain=='default'){
			$sql .= " AND setting_status='default'";
			$tmp = $this->mysql->get_data($sql,'clean');
		}else{
			$sql .= " ORDER BY setting_id";
			$top = $this->mysql->get_datas($sql,'clean');
			foreach($top as $tip){
				$tmp[] = $tip['status'];
			}
		}
		return $tmp;
	}
	
	function get_status($complain_id=0){
		$tmp = '';
		if(intval($complain_id)>0){
			$sql = "SELECT complain_status AS status FROM dinamic_complains WHERE complain_id=".$complain_id;
			$tmp = $this->mysql->get_data($sql);
			return $tmp['status'];
		}
		return $tmp;
	}
	
	function set_status($data){
		$this->mysql->query("UPDATE dinamic_complains SET complain_nomor='".$data['nomor']."', complain_status='".$data['status']."', complain_status_reason='".$data['reason']."' WHERE complain_id=".$data['complain']);
		return $this->get_status($data['complain']);
	}
}
?>