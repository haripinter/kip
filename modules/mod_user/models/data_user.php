<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class data_user extends CI_Model{

	function get($user_id){
		$sql = "SELECT * FROM dinamic_users,dinamic_userslevel WHERE CAST(level_id AS CHAR(10))=user_level AND user_id=".$user_id;
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	function get_all($order='',$request_order='ASC',$limit=0){
		$sql = "SELECT * FROM dinamic_users,dinamic_userslevel WHERE CAST(level_id AS CHAR(10))=user_level AND user_id!=1 ";
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
		$data = $this->mysql->get_datas($sql,'clean');
		return $data;
	}
	
	function insert($user){
		$res = array();
		if($user['user_id']>0){
			//mysql_query("UPDATE dinamic_users SET user_pass='".$user['start']."', user_fullname=NOW(), user_address='".$user['stop']."', user_phone='".$user['judul']."', user_ktp='".$user['isi']."',post_marquee='".$user['marquee']."' WHERE post_id=".$user['post_id']);
			
		}else{
			$maxid = $this->mysql->get_maxid('user_id','dinamic_users');
			$this->mysql->query("INSERT INTO dinamic_users(user_id,user_email,user_level,user_pass,user_fullname,user_address,user_phone,user_ktp,user_scanktp,user_registered,user_activationkey,user_status,user_expired_key) VALUES(".$maxid.",'".$user['email']."','0','".$user['pass']."','".$user['fullname']."','".$user['address']."','".$user['phone']."','".$user['ktp']."','".$user['scan']."',NOW(),'".$user['keys']."',0,(NOW()+INTERVAL 1 DAY))");
			$data = $this->get($maxid);
			/*
			user_status = 0 -> pending, 1 -> active, 2->banned;
			*/
		}
		return $data;
	}
	
	function delete($user_id){
		$this->mysql->query("DELETE FROM dinamic_users WHERE user_id=".$user_id);
		return $this->get($user_id);
	}
	
	function isdouble($email){
		$sql = "SELECT * FROM dinamic_users WHERE user_email='".$email."'";
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	function activate($keys){
		$sql = "SELECT * FROM dinamic_users WHERE user_activationkey='".$keys."' AND user_expired_key>NOW()";
		$data = $this->mysql->get_data($sql);
		if(@$data['user_id']>0){
			$this->mysql->query("UPDATE dinamic_users SET user_status=1 WHERE user_id=".@$data['user_id']);
			$data['result'] = 'success';
		}else{
			$data['result'] = 'expired';
		}
		return $data;
	}
	
	function renew_activation($email){
		$keys = randkey(33);
		$data = $this->isdouble($email);
		if(@$data['user_id']>0){
			$this->mysql->query("UPDATE dinamic_users SET user_activationkey='".$keys."', user_expired_key=(NOW()+INTERVAL 1 DAY) WHERE user_email='".$email."'");
			$data['status'] = 'success';
		}
		return $data;
	}
	
	function cek_login($user){
		$sql  = "SELECT * FROM dinamic_users WHERE user_pass='".$user['pass']."' AND user_status=1 AND user_email='".$user['mail']."'";
		$data = $this->mysql->get_data($sql,'clean');
		return $data;
	}
	
	function change_status($user){
		$sql  = "UPDATE dinamic_users SET user_status=".$user['status']." WHERE user_id=".$user['id'];
		$data = $this->mysql->query($sql);
		return $this->get($user['id']);
	}
	
	function change_level($user){
		$sql  = "UPDATE dinamic_users SET user_level=".$user['level']." WHERE user_id=".$user['id'];
		$data = $this->mysql->query($sql);
		return $this->get($user['id']);
	}
}
?>