<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_menu extends CI_Model{
	// Ambil menu tertentu
	function get($menu_id){
		$res = array();
		if(is_numeric($menu_id)){
			$sql = "SELECT * FROM dinamic_menus WHERE menu_id=".$menu_id;
			$res = $this->mysql->get_data($sql);
		}
		return $res;
	}
	
	// Ambil daftar menu
	// parent pada menu
	// jika kolom menu_parent = -1, brarti tidak punya anak?
	// jika kolom menu_parent = 0, brarti punya anak
	// jika kolom menu_parent >0, brarti itu adalah id parentnya
	// untuk sementara menu hanya bisa tiga tingkat
	function get_all($order='',$request_order='ASC',$limit=0){
		$res = array();
		$sql = "SELECT * FROM dinamic_menus WHERE menu_parent=0 ORDER BY menu_order ASC";
		$tmp = $this->mysql->get_datas($sql);
		foreach($tmp as $ch1){
			array_push($res,$ch1);
			$sq2 = "SELECT * FROM dinamic_menus WHERE menu_parent=".$ch1['menu_id']." ORDER BY menu_order ASC";
			$tm2 = $this->mysql->get_datas($sq2);
			foreach($tm2 as $ch2){
				array_push($res,$ch2);
				$sq3 = "SELECT * FROM dinamic_menus WHERE menu_parent=".$ch1['menu_id']." ORDER BY menu_order ASC";
				$tm3 = $this->mysql->get_datas($sq3);
				foreach($tm3 as $ch3){
					array_push($res,$ch3);
				}
			}
		}
		return $res;
	}
	
	// Input berita
	function insert($menu_id){
	}
	
	// Delete berita
	function delete($menu_id){
	}

/*
	// explore jabatan
	//  global $explv,$explc;
	//  $explc = -1;
	//  $db = openDB();
	//  pre_explore($uk,0,1);
	//  closeDB($db);
	//  for($a=0; $a<$explc; $a++){
	//    echo $explv[$a][0]." ".$explv[$a][1]."<br/>";
	//  }
	//  unset($explc);
	//  unset($explv);
	function pre_explore($parent,$base){
		global $explc;
		global $explv;
		
		$query = array();
		$sql = $sql = "SELECT * FROM dinamic_menus WHERE menu_parent=".$parent." ORDER BY menu_order ASC";
		$query = $this->mysql->get_datas($sql);
		
		$explc++;
		foreach($query as $jabatan){
			$explv[$explc]['idjab'] = $jabatan['idjab'];
			$explv[$explc]['parent'] = $jabatan['parent'];
			$explv[$explc]['kode_jabatan'] = $jabatan['kode_jabatan'];
			$explv[$explc]['nama_jabatan'] = $jabatan['nama_jabatan'];
			$explv[$explc]['jabatan'] = $jabatan['jabatan'];
	
			$explv[$explc]['base'] = $base;
			
			$base++;
			
			pre_explore($uk,$jabatan['idjab'],$base);
			$base--;
		}
	}
	
	function explore($parent){
		$result = array();
		global $explv,$explc;
		$explc = -1;
		pre_explore($parent,1);
		$result = $explv;
		unset($explc);
		unset($explv);
		return (count($result)>0) ? $result: array();
	}
*/
}
?>