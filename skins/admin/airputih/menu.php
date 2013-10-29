<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function menu_admin($menu=null,$opt=array()){
	$opt['site'] = $opt['site'];
	$opt['rel'] = isset($opt['rel'])? $opt['rel'] : '';
	$opt['level'] = isset($opt['level'])? $opt['level'] : 0;
	
	$class = 'kip-menu-child display-none';
	if($opt['level']==0){
		$class='kip-menu-main';
		$disp = '';
	}
	
	$opt['level']++;
	$tmp = '<ul class="'.$class.'">';
	foreach($menu as $child){
		$hasChild = (isset($child['menu']) && count($child['menu'])>0)? true : false;
		
		$hasC = ($hasChild)? 'kip-menu-haschild' : '';
		$tmp .= '<li>';
		$icon = ($child['menu_icon']!='')? '<i class="'.$child['menu_icon'].'"></i> ' : '';
		if($child['menu_link']!=''){
			$tmp .= '<a class="'.$hasC.'" href="'.$opt['site'].$child['menu_link'].'">'.$icon.$child['menu_title'].'</a>';
		}else{
			$tmp .= '<a class="'.$hasC.'" href="#">'.$child['menu_title'].'</a>';
		}
		if($hasChild){
			$tmp .= menu_admin($child['menu'],$opt);
		}
		$tmp .= '</li>';
	}
	$tmp .= '</ul>';
	
	return $tmp;
}

$opt['site'] = base_url();
echo menu_admin(config_item('admin_menu'),$opt);
?>
	