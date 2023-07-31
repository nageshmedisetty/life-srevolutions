<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		$this->load->model('report_model');
		$this->load->model('users_model');
    }

	public function index()
	{
		
		if($this->session->userdata('userid')==''){
			$this->data['headtitle'] = "Reporst";
			$this->load->view('login/forgot',$this->data);
		}else{
			$this->data['headtitle'] = "Reporst";
			$this->data['reports'] = true;
			$this->data['stock'] = false;
			// $this->varaha->print_arrays($this->data);
			$this->page_construct('reports/report');
		}
	}

	public function reportdata(){

		$this->data['stock'] = false;
		$fromdt = $_POST['fromdt'];
		$todt = $_POST['todt'];
		$type = $_POST['print_type'];
		$this->data['headtitle'] = "REPORT FOR ".$fromdt. " TO ".$todt;
		$this->data['res'] = $this->report_model->getReport($fromdt,$todt);
		
		$filename  ="casmolife_report_".date('ymdhis');
		if($type==1){
			// $this->varaha->print_arrays($this->data['res']);
			$this -> load -> view('reports/reportdata',$this->data);

		}
		if($type==2){
			$html = $this -> load -> view('reports/reportdata',$this->data, true);
			$this->pdfland($html,$filename);
		}
		if($type==3){
			$html = $this -> load -> view('reports/reportdata',$this->data, true);
			$this->excel($html,$filename);
		}

	}

	public function stockpoint(){
		$this->data['stock'] = true;
		if($this->session->userdata('userid')==''){
			$this->data['headtitle'] = "Stock Point Reporst";
			$this->load->view('login/forgot',$this->data);
		}else{
			$this->data['headtitle'] = "Stock Point Reporst";
			$this->data['reports'] = true;

			$this->page_construct('reports/stockpointreport');
		}
	}
	public function stockpointreportdata(){
		$this->data['stock'] = true;
		$fromdt = $_POST['fromdt'];
		$todt = $_POST['todt'];
		$type = $_POST['print_type'];
		$this->data['headtitle'] = "STOCK POINT REPORT FOR ".$fromdt. " TO ".$todt;
		$this->data['res'] = $this->report_model->getStockpointReport($fromdt,$todt);
		// $this->varaha->print_arrays($this->data['res']);
		$filename  ="casmolife_stockpoint_report_".date('ymdhis');
		if($type==1){
			// $this->varaha->print_arrays($this->data['res']);
			$this -> load -> view('reports/stockpointreportdata',$this->data);

		}
		if($type==2){
			$html = $this -> load -> view('reports/stockpointreportdata',$this->data, true);
			$this->pdfland($html,$filename);
		}
		if($type==3){
			$html = $this -> load -> view('reports/stockpointreportdata',$this->data, true);
			$this->excel($html,$filename);
		}

	}
	

	function excel($result,$filename){
		
		$data = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">
				   <head>
					   <!--[if gte mso 9]>
					   <xml>
						   <x:ExcelWorkbook>
							   <x:ExcelWorksheets>
								   <x:ExcelWorksheet>
									   <x:Name>Sheet 1</x:Name>
									   <x:WorksheetOptions>
										   <x:Print>
											   <x:ValidPrinterInfo/>
										   </x:Print>
									   </x:WorksheetOptions>
								   </x:ExcelWorksheet>
							   </x:ExcelWorksheets>
						   </x:ExcelWorkbook>
					   </xml>
					   <![endif]-->
				   </head>
				   <body>'.$result.'</body></html>';
				   
	   
	   
	   header('Content-Encoding: UTF-8');
	   header('Content-Type: application/vnd.ms-excel');
	   header('Content-Type: UTF-8');
	   header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
	   header('Cache-Control: max-age=0');		
	   mb_convert_encoding($data, 'UCS-2LE', 'UTF-8');
	   echo $data;
   }

   function pdfland($result,$filename){
		
	/*
	include("application/third_party/MPDF/mpdf.php");
	$mpdf=new mPDF('en-GB-x','A4-L','','',10,10,10,10,6,3);
	$mpdf->list_indent_first_level = 0;
	$mpdf->shrink_tables_to_fit = 1;
	$mpdf->WriteHTML($result);
	$filename = $filename.date('d-m-Y h:m:i',time());
	$mpdf->Output($filename.'.pdf','I');
	*/
	
	require_once 'vendor/autoload.php';
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
									'format' => 'A4-L',
									'margin_top' => 10,
									'margin_left' => 10,
									'margin_right' => 10,
									'margin_bottom' => 10,
									'mirrorMargins' => true]); 
	$mpdf->list_indent_first_level = 0;
	$mpdf->shrink_tables_to_fit = 1;
	$mpdf->WriteHTML($result);
	$filename = $filename.date('d-m-Y h:m:i',time());
	$mpdf->Output($filename.'.pdf','I');
	
}
	
	
}
