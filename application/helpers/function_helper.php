<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* 
 * fungsi untuk convert content (script, css, javascript, dan semua karakter) ke data
 * agar aman ketika disimpan di database
 */
function to_data($data){
	return (isset($data))? htmlspecialchars($data,ENT_QUOTES) : '';
}

/*
 * Fungsi untuk menjadikan data sebagai content (teks, css, html, javascript).
 * kebalikan dari fungsi to_data()
 */
function to_content($data){
	return (isset($data))? htmlspecialchars_decode($data) : '';
}

function admin_skin($skin){
	return 'admin-'.$skin.'/';
}

function home_skin($skin){
	return 'home-'.$skin.'/';
}

function namabulan($n){
	$nmbl = array('','Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
	return ($nmbl[$n]!='')? $nmbl[$n] : '';
}

function tgl_datetime($tgl){
	if(strlen($tgl)==10){
		$tmp = explode('/',$tgl);
		if(checkdate($tmp[1],$tmp[0],$tmp[2])){
			$jam = date('H:i:s');
			return $tmp[2].'-'.$tmp[1].'-'.$tmp[0].' '.$jam;
		}else{
			return date('Y-m-d H:i:s');
		}
	}else{
		return date('Y-m-d H:i:s');
	}
}

function datetime_tgl($datetime){
	if($datetime=='0000-00-00 00:00:00'){
		return '';
	}if(strlen($datetime)==19){
		$tmp = explode('-',substr($datetime,0,10));
		return $tmp[2].'/'.$tmp[1].'/'.$tmp[0];
	}else{
		return $datetime;
	}
}


?>