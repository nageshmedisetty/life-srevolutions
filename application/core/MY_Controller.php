<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->library('varaha');
		$this->load->library('form_validation');
		
    }

    function page_construct($page, $data = array()) {

		$Date =  $this->varaha->demo_date();
		$mdate =  date('Y-m-d', strtotime($Date. ' + 15 days'));
		if(date('Y-m-d',time()) > $mdate){
			// echo "Your Demo time is up. Please Contact Nagesh Medisetty";
			$this->load->view('demo');
		}else{
			
			// $this->data['user_data'] = $this->varaha_model->getUserData($this->session->userdata('userid'));
			
			$this->data['data'] = $data;	
			if($data['admin']){
				$this->load->view('admin/common/header',$this->data);
				$this->load->view('admin/common/menu',$this->data);
				$this->load->view($page);
				$this->load->view('admin/common/footer',$this->data);
			}else{	
				$this->load->view('user_temp/common/header',$this->data);
				$this->load->view($page);
				$this->load->view('user_temp/common/footer');
			}
		}
    }
	
	function page_view($page, $data = array()) {
       $this->load->view($page,$this->data);
    }
	
	
	public function logout(){
		$this->mwelcome->logout();
		redirect(base_url(),'refresh');
	}
	
	

}
