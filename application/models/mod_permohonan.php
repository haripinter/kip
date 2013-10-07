<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_permohonan extends CI_Model{

	function get($id_request){
		$res = array();
		$sql = "SELECT * FROM dinamic_users,dinamic_requests WHERE request_userid=user_id AND request_id=".intval($id_request);
		$res = $this->mysql->get_data($sql);
		return $res;
	}
	
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_users,dinamic_requests WHERE request_userid=user_id";
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY request_id '.$request_order;
		}else if($order=='date'){
			$sql .= ' ORDER BY request_datetime '.$request_order;
		}
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$res = $this->mysql->get_datas($sql,'clean');
		return $res;
	}
	
	function insert($request){
		$res = array();
		$status = $this->status('default');
		if($request['request_id']>0){
			$filez = '';
			if($request['authfile']!=''){
				$filez = "request_authfile='".$request['authfile']."', ";
			}
			
			$this->mysql->query("UPDATE dinamic_requests SET request_information='".$request['information']."', request_reason='".$request['reason']."', request_user='".$request['user']."', request_ktp='".$request['ktp']."', request_address='".$request['address']."', request_phone='".$request['phone']."', request_email='".$request['email']."', request_usage='".$request['usage']."', request_authname='".$request['authname']."', request_authaddress='".$request['authaddress']."', request_authphone='".$request['authphone']."', ".$filez."request_how='".$request['how']."', request_format='".$request['format']."', request_delivery='".$request['delivery']."' WHERE request_status='".$status['status']."' AND request_id=".$request['request_id']);
			$res = $this->get($request['request_id']);
		}else{
			$maxid = $this->mysql->get_maxid('request_id','dinamic_requests');
			$this->mysql->query("INSERT INTO dinamic_requests(request_id,request_userid,request_information,request_reason,request_user,request_ktp,request_address,request_phone,request_email,request_usage,request_authname,request_authaddress,request_authphone,request_authfile,request_how,request_format,request_delivery,request_datetime,request_status) VALUES(".$maxid.",".$request['userid'].",'".$request['information']."','".$request['reason']."','".$request['user']."','".$request['ktp']."','".$request['address']."','".$request['phone']."','".$request['email']."','".$request['usage']."','".$request['authname']."','".$request['authaddress']."','".$request['authphone']."','".$request['authfile']."','".$request['how']."','".$request['format']."','".$request['delivery']."',NOW(),'".$status['status']."')");
			$res = $this->get($maxid);
		}
		return $res;
	}
	
	function delete($id_request){
		$this->mysql->query("DELETE FROM dinamic_requests WHERE request_id=".$id_request);
	}
	
	/*
		default : status
	*/
	function statistic($request=null){
		if($request=='bulanan'){
			$sql = "SELECT YEAR(request_datetime) AS tahun,MONTH(request_datetime) AS bulan,COUNT(request_id) jumlah FROM dinamic_requests GROUP BY MONTH(request_datetime)";
		}else{
			$sql = "SELECT request_status AS status, COUNT(DISTINCT request_id) AS jumlah FROM dinamic_requests GROUP BY request_status UNION ALL SELECT 'total' AS status,COUNT(DISTINCT request_id) FROM dinamic_requests";
		}
		return $this->mysql->get_datas($sql,'clean');
	}
	
	function status($request=null){
		$tmp = array();
		$sql = "SELECT setting_value as status FROM dinamic_settings WHERE setting_key='status_permohonan'";
		if($request=='default'){
			$sql .= " AND setting_status='default'";
			echo "<br/><br/>".$sql;
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
	
	function get_status($request_id=0){
		$tmp = '';
		if(intval($request_id)>0){
			$sql = "SELECT request_status AS status FROM dinamic_requests WHERE request_id=".$request_id;
			$tmp = $this->mysql->get_data($sql);
			return $tmp['status'];
		}
		return $tmp;
	}
	
	function set_status($data){
		$this->mysql->query("UPDATE dinamic_requests SET request_status='".$data['status']."', request_status_reason='".$data['reason']."', request_nomor='".$data['nomor']."' WHERE request_id=".$data['request']);
		return $this->get_status($data['request']);
	}
}
?>