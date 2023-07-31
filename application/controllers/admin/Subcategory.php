<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubCategory extends MY_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('subcategory_model');
		$this->load->model('category_model');
		$this->upload_path = 'uploads/subcategorys/';
		$this->image_types = 'gif|jpg|jpeg|png|tif|JGP';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|JPG|jpeg|png|tif|txt';
        $this->allowed_file_size = '1024';
    }

	
	public function index()
	{
		
		$this->data['stock'] = false;
			$this->data['screen'] = 'Sub Category Master';
			$this->data['headtitle'] = 'Sub Category List';			
			
			
			$this->page_construct('masters/subcategory/list',$this->data);
		
		//$this->load->view('welcome_message');
	}

	

	public function ajax_list(){
		$list = $this->subcategory_model->get_datatables();
		// $this->varaha->print_arrays($list);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $loc) {
			$no++;
			$action ='';
			$row = array();
			$row[] = $no;
			$row[] = $loc->code;
			$row[] = $loc->category;
			$row[] = $loc->name;
			$row[] = '<img src="'.base_url($loc->image).'" alt="'.$loc->name.'" class="imgClass" style="border-radius: 7px;">';
			
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
						"recordsTotal" => $this->subcategory_model->count_all(),
						"recordsFiltered" => $this->subcategory_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	
	
	public function add(){
		
		$id = $this->input->get('id');
		$this->data['id']=$id;
		$this->data['screen'] = 'Sub Category';
		$this->data['categorys'] = $this->category_model->getAllRows($id);
		
		if($id){
			$this->data['model_title'] = "Sub Category Details Edit";
			$this->data['row'] = $this->subcategory_model->getSingleRow($id);
			$this->data['code'] = $this->data['row']->code;
		}else{
			$this->data['row'] = Null;
			$this->data['model_title'] = "Sub Category Details Add";
			$this->data['code'] = $this->varaha_model->getCode('subcategory','SCAT');
		}
		
		$html = $this->load->view('masters/subcategory/add', $this->data, true);
		echo $html;
	}

	public function update(){
		$id =  $this->input->post('id');		
		if(!$id){
			$this->form_validation->set_rules('name', 'name', 'is_unique[clientmaster.name]');
		}
		$this->form_validation->set_rules('name', $this->lang->line("name"), 'required');
		 if ($this->form_validation->run('subcategory/update') == true) {
			$url = $this->upload_path;
			$psname4="";
			if (isset($_FILES['files']) && !empty($_FILES['files'])) {
				$no_files = count(array($_FILES["files"]['name']));
				
				for ($i = 0; $i < $no_files; $i++) {
					if ($_FILES["files"]["error"][$i] > 0) {
						echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
					} else {
						$name = $_FILES['files']['name'][$i].time();
						//$psname4 = $url.md5($name).".jpg";	
						$sname = md5($name);
						
						$rand = substr(md5($sname),rand(0,26),5);
						$psname4 = $url.$rand.".jpg";	
						$psname = $rand.".jpg";
						if (file_exists($psname4)) {
							echo 'File already exists : ' . $psname4;
						} else {
							if (move_uploaded_file($_FILES["files"]["tmp_name"], $psname4)) {
								echo "The file ". htmlspecialchars( basename( $_FILES["files"]["name"])). " has been uploaded.";
							  } else {
								echo "Sorry, there was an error uploading your file.";
							  }
							
						}
					}
				}
			}
			 $data=array(
					'code' => $this->input->post('code'),
					'category' => $this->input->post('category'),
					'name' => $this->input->post('name'),
					// 'per' => $this->input->post('per'),
					'image' => $psname4,
				);
				
			
			$result = $this->subcategory_model->insert($data,$id);
			 if($result){
				 if($id){
					 $this->session->set_flashdata('message', "Sub Category Updated Successfully."); 
				 }else{
					$this->session->set_flashdata('message', "Sub Category Created Successfully"); 
				 }
				
				redirect('subcategory/');
			 }else{
				$this->session->set_flashdata('error', "Sorry! There is problem with Client M	aster Updation. Code Unique.");
				redirect('subcategory/');
			 }
		 }else{
			$this->session->set_flashdata('error', validation_errors());
            redirect('subcategory/');
		 }
	}
	
	function delete(){		
		$id = $_POST['id'];		
		if($this->subcategory_model->getDelete($id)){			
			echo '1-!-Sub Category Master Deleted Successfully';
		}			
	
	}	
}
