<?php
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