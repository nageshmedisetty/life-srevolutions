<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinmanage extends MY_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('pinmanage_model');
		$this->upload_path = 'uploads/categorys/';
		$this->image_types = 'gif|jpg|jpeg|png|tif|JGP';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|JPG|jpeg|png|tif|txt';
        $this->allowed_file_size = '1024';
    }

	
	public function index()
	{
		$this->data['stock'] = false;
	
			$this->data['screen'] = 'Pinmanage';
			$this->data['headtitle'] = 'Pinmanage List';			
			$this->data['admin'] = 'admin';
			
			$this->page_construct('masters/pinmanage/list',$this->data);
		
		//$this->load->view('welcome_message');
	}

	

	public function ajax_list(){
		$list = $this->pinmanage_model->get_datatables();
		// $this->varaha->print_arrays($list);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $loc) {
			$no++;
			$action ='';
			$row = array();
			$row[] = $no;
			$row[] = date('d-m-Y h:i:a', strtotime($loc->date));
			$row[] = $loc->refcode;
			$row[] = $loc->pin;
			$row[] = ($loc->status==1 ? '<span class="badge bg-primary" style="color:#FFF">Active</span>' : '<span class="badge bg-danger" style="color:#FFF">In-active</span>');
			
			$action .='<a data-target=".bd-example-modal-lg" data-toggle="modal"  data-backdrop="static" data-keyboard="false" onclick="add('.$loc->id.')" style="cursor:pointer;">
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
						"recordsTotal" => $this->pinmanage_model->count_all(),
						"recordsFiltered" => $this->pinmanage_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	
	
	public function add(){
		
		$id = $this->input->get('id');
		$this->data['id']=$id;
		$this->data['screen'] = 'pinmanage';
		$this->data['admin'] = 'admin';
		if($id){
			$this->data['model_title'] = "pinmanage Details Edit";
			$this->data['row'] = $this->pinmanage_model->getSingleRow($id);
			// $this->data['code'] = $this->data['row']->code;
		}else{
			$this->data['row'] = Null;
			$this->data['model_title'] = "pinmanage Details Add";
			// $this->data['code'] = $this->varaha_model->getCode('pinmanage','CAT');
		}
		
		$html = $this->load->view('masters/pinmanage/add', $this->data, true);
		echo $html;
	}

	public function update(){
		$id =  $this->input->post('id');		
		$this->data['admin'] = 'admin';
		$this->form_validation->set_rules('pin', $this->lang->line("name"), 'required');
		 if ($this->form_validation->run('pinmanage/update') == true) {
			
			 $data=array(
					'pin' => $this->input->post('pin'),
				);
				
			// $this->varaha->print_arrays($data);
			$result = $this->pinmanage_model->insert($data,$id);
			 if($result){
				 if($id){
					 $this->session->set_flashdata('message', "pinmanage Updated Successfully."); 
				 }else{
					$this->session->set_flashdata('message', "pinmanage Created Successfully"); 
				 }
				
				redirect('admin/pinmanage/');
			 }else{
				$this->session->set_flashdata('error', "Sorry! There is problem with Client M	aster Updation. Code Unique.");
				redirect('admin/pinmanage/');
			 }
		 }else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('admin/pinmanage/');
		 }
	}
	
	function delete(){		
		$id = $_POST['id'];	
		$this->data['admin'] = 'admin';	
		if($this->pinmanage_model->getDelete($id)){			
			echo '1-!-pinmanage Master Deleted Successfully';
		}			
	
	}	
}
