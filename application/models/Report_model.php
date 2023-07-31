<?php
class Report_model extends CI_Model
{
	
	
	public function __construct()
	{
		
		$this->load->database();
		
	}

	
	public function getReport($fromdt,$todt){

		if($this->session->userdata('userid')!=1){
			$this->db->where('id',$this->session->userdata('userid'));
		}
		$q = $this->db->get('view_register');
		if($q->num_rows()>0){			
			foreach($q->result() as $row){
				$commissionTot=0;
				$levels = $this->users_model->getRefLevels($row->id);
				if($levels){
					$tot_amt=0;
					foreach($levels as $level){
						$tot_amt = $tot_amt + $level['amount'];
					}
					$commissionTot = $commissionTot + $tot_amt;
				}		
				$row->valumepoints = $this->getValumepointsDits($row->id,$fromdt,$todt);
				$row->valumepointsSelf = $this->getValumepointsSelfDits($row->id,$fromdt,$todt);
				$row->commissions = $this->users_model->getCommissionDits($row->id,$fromdt,$todt);
				// $row->commissions = $this->getCommissionDits($row->id,$fromdt,$todt);
				$row->commission = 0;
				$row->brandComm = $commissionTot;
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}


	public function getStockpointReport($fromdt,$todt){

		if($this->session->userdata('userid')!=1){
			$this->db->where('userId',$this->session->userdata('userid'));
		}
		$q = $this->db->get('stockpoint');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$row->products = $this->getStockPointProducts($row->id, $fromdt,$todt);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function getStockPointProducts($id,$fromdt,$todt){
		
		$this->db->where('stockpointId',$id);
		$q = $this->db->get('view_stockpoint_items');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$row->saledata = $this->getSaleData($fromdt,$todt,$row->product);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function getSaleData($fromdt,$todt,$product){
		if($this->session->userdata('userid')!=1){
			$this->db->where('user',$this->session->userdata('userid'));
		}
		$this->db->where('product_id',$product);
		$this->db->where("DATE(created_at) BETWEEN '".date('Y-m-d',strtotime($fromdt))."' AND '".date('Y-m-d',strtotime($todt))."'");
		$this->db->select('*,(SELECT invno FROM main_orders where main_orders.order_id = order_items.order_id) AS invno,(SELECT refcode from main_orders where main_orders.order_id = order_items.order_id) AS refno');
		$q = $this->db->get('order_items');
		if($q->num_rows()>0){
			foreach($q->result() as $row){				
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function getValumepointsDits($id,$fromdt, $todt){
		$value=0;
		$date = date('Y-m-d',time());
		$fdate = date('Y-m-d', strtotime($fromdt));
		$ldate= date('Y-m-t', strtotime($todt));
		
		$this->db->where('userId',$id);		
		$this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		$q = $this->db->get('valumepoints');
		if($q->num_rows()>0){
			foreach($q->result() as $row){				
				$value = $value +$row->value;					
			}			
			return $value ;
		}
		return 0;
	}

	public function getValumepointsSelfDits($id,$fromdt, $todt){
		$value=0;
		$date = date('Y-m-d',time());
		$fdate = date('Y-m-d', strtotime($fromdt));
		$ldate= date('Y-m-t', strtotime($todt));
		
		$this->db->where('userId',$id);		
		$this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		$q = $this->db->get('valumepoints');
		if($q->num_rows()>0){
			foreach($q->result() as $row){	
				if($row->pvtype==1){
					$value = $value +$row->value;
				}			
									
			}			
			return $value ;
		}
		return 0;
	}

	public function getCommissionDits($id,$fromdt, $todt){
		$selfvp = $this->getValumepointsDits($id); 
		return $selfvp;

	}

	// public function getCommissionDits($id,$fromdt, $todt){
		// $commission=0;
		// $commission100=0;
		// $commissionTot=0;
		// $valumepointamt=0;
		// $date = date('Y-m-d',time());
		// $fdate = date('Y-m-d', strtotime($fromdt));
		// $ldate= date('Y-m-t', strtotime($todt));
		
		// $this->db->where('userId',$id);		
		// $this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		// $q = $this->db->get('commissions');
		// if($q->num_rows()>0){
		// 	foreach($q->result() as $row){
		// 		$payment_status = $this->getUserPaymentStatus($row->comm_userId);
		// 		// $this->varaha->print_arrays($payment_status);
		// 		if($payment_status==1){
		// 			if($row->commission == 500){
		// 				$commission = $commission + $row->commission;
		// 			}else if($row->commission == 100){				
		// 				$commission100 = $commission100 + $row->commission;
		// 			}else if($row->type==5){
		// 				$valumepointamt = $valumepointamt + $row->commission;
		// 			}
		// 		}	
				
		// 	}
		// 	$valpints=array();
		// 	$userId = $id;
		// 	for($i=0;$i<5;$i++){
		// 		$userId = $this->getRefUser($userId);
		// 		if($userId){		
		// 			$valp=0;		
		// 			$this->db->where('userId',$userId);		
		// 			$this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		// 			$q = $this->db->get('commissions');
		// 			if($q->num_rows()>0){
		// 				foreach($q->result() as $row){
		// 					// $payment_status = $this->getUserPaymentStatus($row->comm_userId);
		// 					// if($payment_status==1){
		// 						$selfvp = $this->getValumepointsDits($id); 
		// 						if($selfvp>=30){
		// 							if($row->type==5){
		// 								$valp = $valp + $row->commission;
		// 							}
		// 						}
		// 					// }
		// 				}	
		// 				// if($valp!=0)					
		// 				array_push($valpints, $valp);
		// 			}		
		// 		}			
				
		// 	}

			
			
		// 	$mcomm = array("valumepoints" => $valumepointamt, "rempoints" => $valpints);
		// 	return $mcomm ;
		// }
		// return array();
	// }
	
}
?>