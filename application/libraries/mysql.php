<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mysql{
	function query($query){
		$q  = mysql_query($query) or die('Invalid Syntax');
		return $q;
	}
	
	/*
		$query = Query SQL
		$opt = option, if null - hasilnya seperti hasil Query normal, jika $opt = clean, maka hasilnya hanya berdasarkan key pada kolom
		contoh : hasil Query normal array('0'=>'data1', 'nama_kolom1'='data1', '1'=>'data2', 'nama_kolom2'='data2')
		contoh : hasil option clean array('nama_kolom1'='data1', 'nama_kolom2'='data2')
	*/
	function get_datas($query,$opt=''){
		$r  = array();
		$q  = mysql_query($query) or die('Can\'t Retrieve Data');
		while($s = mysql_fetch_array($q)){
			if($opt=='clean'){
				$col = $this->get_column($s);
				$tmp = array();
				foreach($col as $c){
					$tmp[$c] = $s[$c];
				}
				array_push($r,$tmp);
			}else{
				array_push($r,$s);
			}
		}
		return (count($r)>0) ? $r: array();
	}
	
	function get_data($query){
		$r  = array();
		$q  = mysql_query($query) or die('Can\'t Retrieve Data');
		if(mysql_num_rows($q)==1){
			$s = mysql_fetch_object($q);
			$r = get_object_vars($s);
		}
		return (count($r)>0) ? $r: array();
	}
	
	function get_maxid($column,$table){
		$res = $this->get_data("SELECT MAX(".$column.") as max FROM ".$table."");
		$rex = $res['max']+1;
		return $rex;
	}
	
	function get_column($result){
		$tmp = array();
		//foreach($result as $e){
			$ee = array_keys($result);
			foreach($ee as $f){
				if(!is_numeric($f)){
					$tmp[] = $f;
				}
			}
			//break;
		//}
		return $tmp;
	}
}
?>