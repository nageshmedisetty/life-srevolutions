<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposits extends MY_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('deposits_model');
		$this->upload_path = 'uploads/categorys/';
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
	
			$this->data['screen'] = 'deposits';
			$this->data['headtitle'] = 'deposits List';	
			$this->page_construct('masters/deposits/list',$this->data);
		}
		//$this->load->view('welcome_message');
	}

	

	public function ajax_list(){
		$list = $this->deposits_model->get_datatables();
		// $this->varaha->print_arrays($list);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $loc) {
			$no++;
			$action ='';
			$row = array();
			$row[] = $no;
			$row[] = $loc->memberId;
			$row[] = $loc->amount;
			$row[] = $loc->description;			
			$row[] = date('d-m-Y h:i:a', strtotime($loc->created_on));
			
			$action .='<a  tabindex="0" aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#modals-slide-in" onclick="add('.$loc->id.')" style="cursor:pointer;">
						<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
					</a>';		
			$action .=' <a class="danger" href="javascript:deleter('.$loc->id.')">
						<i class="fa fa-trash"></i>
					</a>';
			
			$row[] ='<div class="text-right">'.$action.'</div>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->deposits_model->count_all(),
						"recordsFiltered" => $this->deposits_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	
	
	public function add(){
		
		if($this->session->userdata('userid')==''){
			$this->data['headtitle'] = "LogIn";
			$this->load->view('login/signin',$this->data);
		}else{
			$id = $this->input->get('id');
			$this->data['id']=$id;
			$this->data['screen'] = 'deposits';
			$this->data['admin'] = 'admin';
			$this->data['members'] = $this->deposits_model->getAllMembers();
			if($id){
				$this->data['model_title'] = "Deposits Details Edit";
				$this->data['row'] = $this->deposits_model->getSingleRow($id);
				// $this->data['code'] = $this->data['row']->code;
			}else{
				$this->data['row'] = Null;
				$this->data['model_title'] = "Deposits Details Add";
				// $this->data['code'] = $this->varaha_model->getCode('deposits','CAT');
			}
			
			$html = $this->load->view('masters/deposits/add', $this->data, true);
			echo $html;
		}
	}

	public function update(){
		$id =  $this->input->post('id');		
		$this->data['admin'] = 'admin';
		$this->form_validation->set_rules('amount', $this->lang->line("name"), 'required');
		 if ($this->form_validation->run('deposits/update') == true) {
			
			 	$data=array(
					'memberId' => $this->input->post('memberId'),
					'amount' => $this->input->post('amount'),
					'description' => $this->input->post('description'),
				);
				if($id){
					$data['updated_by'] = $this->session->userdata('userid');
					$data['updated_on'] = date('Y-m-d h:m:i',time());
				}else{
					$data['created_by'] = $this->session->userdata('userid');
				}
				
			// $this->varaha->print_arrays($data);
			$result = $this->deposits_model->insert($data,$id);
			 if($result){
				 if($id){
					 $this->session->set_flashdata('message', "Deposits Updated Successfully."); 
				 }else{
					$this->session->set_flashdata('message', "Deposits Created Successfully"); 
				 }
				
				redirect('admin/deposits/');
			 }else{
				$this->session->set_flashdata('error', "Sorry! There is problem with Client M	aster Updation. Code Unique.");
				redirect('admin/deposits/');
			 }
		 }else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/deposits/');
		 }
	}
	
	function delete(){		
		$id = $_POST['id'];	
		$this->data['admin'] = 'admin';	
		if($this->deposits_model->getDelete($id)){			
			echo '1-!-deposits Master Deleted Successfully';
		}			
	
	}	
}
