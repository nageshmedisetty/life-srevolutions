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
		if($this->session->userdata('userid')==''){
			$this->data['header_title'] = "LogIn";
			redirect("userjourney/welcome/register");
		}else{
			$this->data['header_title'] = 'Home';
			$this->data['admin'] = null;
			$this->page_construct('user_temp/welcome_message',$this->data);
		}
	}

	public function login(){
		$this->data['header_title'] = 'Login/SignUp';
		$this->data['admin'] = null;
		$this->page_construct('user_temp/login/login',$this->data);
	}

	public function register(){
		
			$this->data['header_title'] = 'Register';
			$this->data['admin'] = null;
			$this->page_construct('user_temp/login/registration',$this->data);
		
		
	}
	public function signup(){
		$this->data['stock'] = false;
		$enotp = $this->input->post('otp_1');
		$refcode = 'BP'.rand(100001,9999999);
		$checkPin = true;//$this->users_model->checkPinNumber($enotp,$refcode);
		if($checkPin){

		}else{
			$this->session->set_flashdata('error', "Sorry! Unable to register your Entered PIN is Incorrect Or Expired. Please try again");
			redirect('userjourney/welcome/register');
		}
		if($this->input->post('memtype')!=0){
			if($this->input->post('reff')){
				$refId = $this->users_model->getRefId($this->input->post('reff'));
			}else{
				$refId = 0;
			}
	
			$data = array(
				'refcode' => $refcode,
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'username' => $refcode,
				'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'memtype' => $this->input->post('memtype'),
				'referenceId' => $refId,
				'jdate' => date('Y-m-d',time()),
			);
	
			if($data){
				$res = $this->users_model->register($data);
				if($res==1){
					redirect('userjourney/welcome');
				}else if($res == 2){
					$this->session->set_flashdata('error', "Sorry! Unable to register your account. Please try again");
					redirect('userjourney/welcome/register');
				}else if($res == 4){
					$this->session->set_flashdata('error', "Sorry! Unable to register your account. This Mobile Number already used.");
					redirect("userjourney/welcome/register");
				}
			}
		}else{
			$this->session->set_flashdata('error', "Sorry! Unable to register your Entered Select User Type. Please try again");
			redirect('userjourney/welcome/register');
		}

	}

	public function checkReferenceActive(){
		$refcode = $_POST['src'];
		$res = $this->users_model->getCheckReferenceActive($refcode);

		echo $res;
	}

	public function signin()
	{
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password', "Password", 'required');
		
		 if ($this->form_validation->run('userjourney/welcome/signin') == true) {
			$res = $this->users_model->login($this->input->post('username'),$this->input->post('password'));

			if($res==1){
				$this->session->set_flashdata('message', "Login Successfully.");
				redirect('userjourney/welcome');
			}else if($res==2){
				$this->session->set_flashdata('error', "Sorry! Username incorrect.");
				redirect('userjourney/welcome/login');  
			}else if($res==3){
				$this->session->set_flashdata('error', "Sorry! Password incorrect.");
				redirect('userjourney/welcome/login');  
			}else if($res==4){
				$this->session->set_flashdata('error', "Sorry! User Not Active. Plz. Contact Admin");
				redirect('userjourney/welcome/login');
			}
		 }else{
			$this->session->set_flashdata('error', validation_errors());
			redirect('userjourney/welcome/login'); 
		 }	
		
	}

	public function logout()
    {

        $data = array('userid' => NULL,
            'user' => NULL,
            'mobile' => NULL,
            'user_type' => NULL,
        );        
        $this->session->set_userdata($data);
        $this->session->set_flashdata('message', "Logout Successfully.");
        redirect('');

    }
}
