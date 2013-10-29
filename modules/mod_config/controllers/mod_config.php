<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mod_config extends KIP_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('data_config');
	}
}