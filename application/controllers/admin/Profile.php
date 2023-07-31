<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('users_model');
		$this->load->model('profile_model');
		$this->load->library('session');
		$this->upload_path = 'uploads/items/';
		$this->image_types = 'gif|jpg|jpeg|png|tif|JGP';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|JPG|jpeg|png|tif|txt';
        $this->allowed_file_size = '1024';
    }

	
	public function index()
	{
		$this->data['admin'] = 'admin';
		if($this->session->userdata('userid')==''){
			$this->data['headtitle'] = "LogIn";
			$this->load->view('login/signin',$this->data);
		}else{
			$this->data['headtitle'] = "Profile";			
			if($this->session->userdata('active_status')==0){
				$this->page_construct('userdashbord');
			}else{
				if($this->session->userdata('userid')==1){
					$this->data['button'] = '<a href="'.base_url('admin/profile/add/0').'"><button class="btn btn-primary mb-sm-0 mb-3 print-invoice"> Add User</button></a>';
				}
				
				$this->page_construct('admin/profile/list',$this->data);
			}
		
			
		}
		
	}	
	public function ajax_list(){
		$list = $this->profile_model->get_datatables();
		// $this->varaha->print_arrays($list);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $loc) {
			$no++;
			$action ='';
			
			$row = array();
			$row[] = $no;
			$row[] = $loc->refcode;
			$row[] = '<div style="width:100%;text-align:left;color:#e36c05;font-weight:bold;">'.$loc->member.'</div>';//($loc->memtype==1 ? 'Vendor' : 'Customer');
			$row[] = $loc->name;
			$row[] = '<div style="width:100%;text-align:left;color:#f500db;font-weight:bold;">'.$loc->refcode.'</div>';
			
			$action .='<a href="'.base_url('admin/profile/add/'.$loc->id).'" style="cursor:pointer;">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
					</a>';		
					if($this->session->userdata('userid')==1){
						$action .=' <a class="danger" href="javascript:deleter('.$loc->id.')">
						<i class="fa fa-trash"></i>
					</a>';
					}
			
			
			$row[] ='<div class="text-right">'.$action.'</div>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->profile_model->count_all(),
						"recordsFiltered" => $this->profile_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function add($id)
	{
		$this->data['admin'] = 'admin';
		if($this->session->userdata('userid')==''){
			$this->data['headtitle'] = "LogIn";
			$this->load->view('login/signin',$this->data);
		}else{

			$this->data['headtitle'] = "Profile";
			if($this->session->userdata('memtype')=='3'){
				$this->data['refcode'] = $this->session->userdata('refcode');
				$this->data['row'] = $this->users_model->getProfileRow($id);
				$this->page_construct('admin/profile/add',$this->data);
			}else{
				if($this->session->userdata('active_status')==0){
					$this->page_construct('userdashbord');
				}else{
					$this->data['row'] = $this->users_model->getProfileRow($id);
					$this->data['refcode'] = "";
					$this->page_construct('admin/profile/add',$this->data);
				}
			}
			
		}
		
	}	

	public function update(){
		if($this->session->userdata('userid')==''){
			$this->data['headtitle'] = "LogIn";
			$this->load->view('login/signin',$this->data);
		}else{
			$id =  $this->input->post('id');		
		if(!$id){
			$this->form_validation->set_rules('username', 'username', 'is_unique[register.username]');
		}
		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required');
		 if ($this->form_validation->run('admin/profile/update') == true) {
			 $images=array();
			 $data=array(
					'refcode' => $this->input->post('refcode'),
					'name' => $this->input->post('name'),
				// 	'memtype' => $this->input->post('memtype'),
					'email' => $this->input->post('email'),
					'username' => $this->input->post('username'),
					// 'password' => $this->input->post('password'),
					'phone' => $this->input->post('phone'),
					'address' => $this->input->post('address'),
					'pan' => $this->input->post('pan'),
					'aadhar' => $this->input->post('aadhar'),
					'accno' => $this->input->post('accno'),
					'bankname' => $this->input->post('bankname'),
					'ifsc' => $this->input->post('ifsc'),
					'bankbranch' => $this->input->post('bankbranch'),
					// 'active_status' => 1,
					// // 'payment_status' => 1,
					// 'jdate' => date('Y-m-d',time()),
				);

				if($this->session->userdata('memtype')=='3'){
					if($this->input->post('memtype')==1){
						$refcode = 'BP'.rand(100001,9999999);
					}else if($this->input->post('memtype')==2){
						$refcode = 'PC'.rand(100001,9999999);
					}else{
						$refcode = 'SP'.rand(100001,9999999);
					}
					$data['refcode'] = $refcode;					
					$data['referenceId'] = $this->users_model->getRefId($this->input->post('refcode'));
					$data['password'] = $this->input->post('password');
					$data['active_status'] =  0;
					$data['payment_status'] =  0;
					$data['jdate'] =  date('Y-m-d',time());
				}

				$url = $this->upload_path;
				$psname4="";
				if (isset($_FILES['files']) && !empty($_FILES['files'])) {					
					
					// if ($_FILES["files"]["error"][0] > 0) {
					// 	echo "Error: " . $_FILES["files"]["error"][0] . "<br>";
					// } else {
						$name = $_FILES['files']['name'].time();
						//$psname4 = $url.md5($name).".jpg";	
						$sname = md5($name);
						
						$rand = substr(md5($sname),rand(0,26),5);
						$psname4 = $url.$rand.".jpg";	
						$psname = $rand.".jpg";
						if (file_exists($psname4)) {
							echo 'File already exists : ' . $psname4;
						} else {
							if (move_uploaded_file($_FILES["files"]["tmp_name"], $psname4)) {
								$data['image'] = $psname;
								$data['path'] = $psname4;

							} else {
								echo "Sorry, there was an error uploading your file.";
							}
							
						}
					// }
					
				}
				if (isset($_FILES['panfront']) && !empty($_FILES['panfront'])) {
						$name = $_FILES['panfront']['name'].time();
						$sname = md5($name);						
						$rand = substr(md5($sname),rand(0,26),5);
						$psname4 = $url.$rand.".jpg";	
						$psname = $rand.".jpg";
						if (file_exists($psname4)) {
							echo 'File already exists : ' . $psname4;
						} else {
							if (move_uploaded_file($_FILES["panfront"]["tmp_name"], $psname4)) {								
								$data['panfront'] = $psname4;
							} else {
								echo "Sorry, there was an error uploading your file.";
							}
							
						}
				}
				if (isset($_FILES['panback']) && !empty($_FILES['panback'])) {
					$name = $_FILES['panback']['name'].time();
					$sname = md5($name);						
					$rand = substr(md5($sname),rand(0,26),5);
					$psname4 = $url.$rand.".jpg";	
					$psname = $rand.".jpg";
					if (file_exists($psname4)) {
						echo 'File already exists : ' . $psname4;
					} else {
						if (move_uploaded_file($_FILES["panback"]["tmp_name"], $psname4)) {								
							$data['panback'] = $psname4;
						} else {
							echo "Sorry, there was an error uploading your file.";
						}
						
					}
				}
				if (isset($_FILES['aadharfront']) && !empty($_FILES['aadharfront'])) {
					$name = $_FILES['aadharfront']['name'].time();
					$sname = md5($name);						
					$rand = substr(md5($sname),rand(0,26),5);
					$psname4 = $url.$rand.".jpg";	
					$psname = $rand.".jpg";
					if (file_exists($psname4)) {
						echo 'File already exists : ' . $psname4;
					} else {
						if (move_uploaded_file($_FILES["aadharfront"]["tmp_name"], $psname4)) {								
							$data['aadharfront'] = $psname4;
						} else {
							echo "Sorry, there was an error uploading your file.";
						}
						
					}
				}
				if (isset($_FILES['aadharback']) && !empty($_FILES['aadharback'])) {
					$name = $_FILES['aadharback']['name'].time();
					$sname = md5($name);						
					$rand = substr(md5($sname),rand(0,26),5);
					$psname4 = $url.$rand.".jpg";	
					$psname = $rand.".jpg";
					if (file_exists($psname4)) {
						echo 'File already exists : ' . $psname4;
					} else {
						if (move_uploaded_file($_FILES["aadharback"]["tmp_name"], $psname4)) {								
							$data['aadharback'] = $psname4;
						} else {
							echo "Sorry, there was an error uploading your file.";
						}
						
					}
				}

				
			// $this->varaha->print_arrays($data,$id);
			$result = $this->users_model->insert($data,$id);
			 if($result){
				 if($id){
					 $this->session->set_flashdata('message', "profile Updated Successfully."); 
				 }else{
					$this->session->set_flashdata('message', "profile Created Successfully"); 
				 }
				
				 if($this->session->userdata('memtype')=='3'){
					redirect('admin/profile/add/0');
				}else{
					redirect('admin/profile/');
				}
			 }else{
				$this->session->set_flashdata('error', "Sorry! There is problem with Client M	aster Updation. Code Unique.");
				if($this->session->userdata('memtype')=='3'){
					redirect('admin/profile/add/0');
				}else{
					redirect('admin/profile/');
				}
			 }
		 }else{
			$this->session->set_flashdata('error', validation_errors());
			if($this->session->userdata('memtype')=='3'){
				redirect('admin/profile/add/0');
			}else{
				redirect('admin/profile/');
			}
            
		 }
			
		}
	}

	public function mystockpoint(){
		$this->data['levelname'] = "Bronz Director";
		$this->data['refuser'] = $this->users_model->getRefUsers1($this->session->userdata('userid'));
		$this->data['refuserChain'] = $this->users_model->getRefUsersChain();
		$this->data['user'] = $this->users_model->getProfileRow($this->session->userdata('userid'));
		if($this->data['user']->plan==0){
			$this->data['user_wallet'] = 'Wallet Balance';
		}
		if($this->data['user']->plan==1){
			$this->data['user_wallet'] = 'Fitness & Diet';
		}
		if($this->data['user']->plan==2){
			$this->data['user_wallet'] = 'Helth & Wealth';
		}
		if($this->data['user']->plan==3){
			$this->data['user_wallet'] = 'Health & Wellness';
		}
		if($this->session->userdata('userid')!=1){
			if($this->data['user'] ->payment_status==0){
				$this->data['payment_status_my'] = "Your Account Activated.";
			}else{
				$this->data['payment_status_my'] = "Your Account Activated.";
			}
		}else{
			$this->data['payment_status_my'] = '';
		}	
		
		$this->data['wallet'] = $this->users_model->getWalletDits($this->session->userdata('userid'));
		$this->data['commissions'] = $this->users_model->getCommissionDits($this->session->userdata('userid'));		
			
			
		$this->data['commissionssummary'] = $this->users_model->getCommissionDitsSummary($this->session->userdata('userid'));
		$this->data['valumepoints'] = $this->users_model->getValumepointsDits($this->session->userdata('userid'));
		$this->data['valumepoints_group'] = $this->users_model->getValumepointsDitsGroup($this->session->userdata('userid'));
		$this->data['refusercount'] = ($this->data['refuser'] ? sizeof($this->data['refuser']) : 0);
		$this->data['itempurchased'] = $this->users_model->getItemPurchased($this->session->userdata('userid'));
		$this->data['levels'] = $this->users_model->getRefLevels($this->session->userdata('userid'));
		$this->data['stockpointId'] = $this->users_model->getStockPointerId($this->session->userdata('userid'));
		$this->data['usersdata'] = $this->users_model->getUsersTotals($this->session->userdata('userid'));
		$data = array(
			'stockpointId'=> $this->data['stockpointId'],
			'direct_memtype' => 3,
		);

		$this->session->set_userdata($data);
		$this->data['redeleteinactiveusers'] = $this->users_model->reDeleteInactiveUsers();
		// $this->varaha->print_arrays($this->data['levels']);
		
		$this->page_construct('stockpointdashboard',$this->data);
	}
}
