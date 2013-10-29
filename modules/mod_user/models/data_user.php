<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_user extends CI_Model{

	function get($id_user){
		$res = array();
		if(is_numeric($id_user)){
			$sql = "SELECT * FROM dinamic_users WHERE user_id=".$id_user;
			$res = $this->mysql->get_data($sql);
		}
		return $res;
	}
	
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_users";
		if($request_order=='DESC'){
			$request_order = 'DESC';
		}else{
			$request_order = 'ASC';
		}
		
		if($order=='id'){
			$sql .= ' ORDER BY user_id '.$request_order;
		}else if($order=='registered'){
			$sql .= ' ORDER BY user_registered '.$request_order;
		}
		
		if(is_numeric($limit) && $limit>0){
			$sql .= 'LIMIT '.$limit;
		}
		$res = $this->mysql->get_datas($sql);
		return $res;
	}
	
	function insert($user){
		$res = array();
		if($user['user_id']>0){
			//mysql_query("UPDATE dinamic_users SET user_pass='".$user['start']."', user_fullname=NOW(), user_address='".$user['stop']."', user_phone='".$user['judul']."', user_ktp='".$user['isi']."',post_marquee='".$user['marquee']."' WHERE post_id=".$user['post_id']);
			
		}else{
			$maxid = $this->mysql->get_maxid('user_id','dinamic_users');
			$pass = md5($user['pass1']);
			$keys = $this->kip->randkey(33);
			$scan = $user['scan_name'];
			$this->mysql->query("INSERT INTO dinamic_users(user_id,user_email,user_pass,user_fullname,user_address,user_phone,user_ktp,user_scanktp,user_registered,user_activationkey,user_status,user_expired_key) VALUES(".$maxid.",'".$user['email']."','".$pass."','".$user['fullname']."','".$user['address']."','".$user['phone']."','".$user['ktp']."','".$scan."',NOW(),'".$keys."',0,(NOW()+INTERVAL 1 DAY))");
			$res = $this->get($maxid);
			//echo "INSERT INTO dinamic_users(user_id,user_email,user_pass,user_fullname,user_address,user_phone,user_ktp,user_scanktp,user_registered,user_activationkey,user_status) VALUES(".$maxid.",'".$user['email']."','".$pass."','".$user['fullname']."','".$user['address']."','".$user['phone']."','".$user['ktp']."','".$scan."',NOW(),'".."',0)";
			/*
			user_status = 0 -> pending, 1 -> active, 2->banned;
			*/
		}
		return $res;
	}
	
	function delete($id_user){
		$this->mysql->query("DELETE FROM dinamic_users WHERE user_id=".$id_user);
	}
	
	function isdouble($email){
		$res = array();
		$sql = "SELECT * FROM dinamic_users WHERE user_email='".$email."'";
		$res = $this->mysql->get_data($sql);
		return $res;
	}
	
	function activate($keys){
		$res = array();
		$sql = "SELECT * FROM dinamic_users WHERE user_activationkey='".$keys."' AND user_expired_key>NOW()";
		$res = $this->mysql->get_data($sql);
		if(@$res['user_id']>0){
			$this->mysql->query("UPDATE dinamic_users SET user_status=1 WHERE user_id=".@$res['user_id']);
			$res['result'] = 'success';
		}else{
			$res['result'] = 'expired';
		}
		return $res;
	}
	
	function renew_activation($email){
		$keys = $this->kip->randkey(33);
		$res = $this->isdouble($email);
		if(@$res['user_id']>0){
			$this->mysql->query("UPDATE dinamic_users SET user_activationkey='".$keys."', user_expired_key=(NOW()+INTERVAL 1 DAY) WHERE user_email='".$email."'");
		}
		return $res;
	}
}
?>