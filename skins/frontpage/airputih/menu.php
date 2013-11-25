<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function generate_menu($menu=null,$opt=array()){
	$opt['rel'] = isset($opt['rel'])? $opt['rel'] : '';
	$opt['level'] = isset($opt['level'])? $opt['level'] : 0;
	if($opt['level']==0){
		$opt['level'] += 1;
		$tmp = '<ul>';
		$n = 0;
		foreach($menu as $child){
			$icon = isset($child['menu_icon'])? '<span class="'.$child['menu_icon'].'"></span> ':'';
			$tmp .= "<li>";
			$hasChild = (isset($child['menu']) && count($child['menu'])>0)? true : false;
			if($hasChild){
				$caret = ' <span class="icon-chevron-down"></span>';
				$link = ($child['menu_link']!='')? $opt['site'].$child['menu_link'] : '#';
				$opt['rel'] = 'menu_rel'.$n;
				$tmp .= '<a class="btn btn-large" rel="'.$opt['rel'].'" href="'.$link.'">'.$icon.$child['menu_title'].$caret.'</a>';
				$tmp .= generate_menu($child['menu'],$opt);
			}else{
				$link = ($child['menu_link']!='')? $opt['site'].$child['menu_link'] : '#';
				$tmp .= '<a class="btn btn-large" href="'.$link.'">'.$icon.$child['menu_title'].'</a>';
			}
			$tmp .= "</li>";
			$n++;
		}
		$tmp .= '</ul>';
	}else{
		$tmp = '<ul id="'.$opt['rel'].'" class="ddsubmenustyle">';
		$n = 0;
		foreach($menu as $child){
			$icon = isset($child['menu_icon'])? '<span class="'.$child['menu_icon'].'"></span> ':'';
			$tmp .= "<li>";
			$hasChild = (isset($child['menu']) && count($child['menu'])>0)? true : false;
			if($hasChild){
				$caret = ' <span class="icon-chevron-right pull-right"></span>';
				$link = ($child['menu_link']!='')? $opt['site'].$child['menu_link'] : '#';
				$tmp .= '<a href="'.$link.'">'.$icon.$child['menu_title'].$caret.'</a>';
				$tmp .= generate_menu($child['menu'],$opt);
			}else{
				$link = ($child['menu_link']!='')? $opt['site'].$child['menu_link'] : '#';
				$tmp .= '<a href="'.$link.'">'.$icon.$child['menu_title'].'</a>';
			}
			$tmp .= '</li>';
			$n++;
		}
		$tmp .= '</ul>';
	}
	return $tmp;
}

$opt['site'] = site_url();
echo generate_menu(config_item('public_menu'),$opt);
?>