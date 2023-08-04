<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('users_model');
    }

	public function index()
	{
		$this->data['header_title'] = 'Home';
		$this->data['admin'] = null;
		$this->page_construct('user_temp/welcome_message',$this->data);
	}

	
}
