<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('users_model');
    }

	public function index()
	{
		if($this->session->userdata('userid')==''){
			$this->data['header_title'] = "LogIn";
			redirect("userjourney/welcome/register");
		}else{
			$this->data['header_title'] = 'Dashboard';
			$this->data['admin'] = 'admin';
			$this->data['refuserChain3'] = $this->users_model->getRefUsersChain(3);
			$this->data['refuserChain2'] = $this->users_model->getRefUsersChain(2);
			// $this->varaha->print_arrays($this->data['refuserChain']);
			$this->page_construct('admin/dashboard',$this->data);
		}
	}

	
}
