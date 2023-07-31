<?php
class Users_model extends CI_Model
{
	var $table = 'view_register';	
	var $column_order = array(null, 'refcode','name','username', 'memtype','member'); //set column field database for datatable orderable
	var $column_search = array('refcode','name','username','memtype','member'); //set column field database for datatable searchable 
	var $order = array('id' => 'desc'); // default order 
	
	public function __construct()
	{
		
		$this->load->database();
		
	}

	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		if($_POST['search']['value']){
			$i = 0;
			foreach ($this->column_search as $item){
				if($i===0){	
					$this->db->like('status',1);
					$this->db->like($item, $_POST['search']['value']);
					if($this->session->userdata('userid')!=1){
						// $this->db->where('id',$this->session->userdata('userid'));
						$this->db->where('referenceId',$this->session->userdata('userid'));
					}
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
					$this->db->like('status',1);
					if($this->session->userdata('userid')!=1){
						// $this->db->where('id',$this->session->userdata('userid'));
						$this->db->where('referenceId',$this->session->userdata('userid'));
					}
				}	
			$i++;
			}
		}
		if($this->session->userdata('userid')!=1){
			// $this->db->where('id',$this->session->userdata('userid'));
			$this->db->where('referenceId',$this->session->userdata('userid'));
		}
		$this->db->where('status',1);
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($this->session->userdata('userid')!=1){
			// $this->db->where('id',$this->session->userdata('userid'));
			$this->db->where('referenceId',$this->session->userdata('userid'));
		}
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		if($this->session->userdata('userid')!=1){
			// $this->db->where('id',$this->session->userdata('userid'));
			$this->db->where('referenceId',$this->session->userdata('userid'));
		}
		$this->db->where('status',1);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{	
		if($this->session->userdata('userid')!=1){
			// $this->db->where('id',$this->session->userdata('userid'));
			$this->db->where('referenceId',$this->session->userdata('userid'));
		}
		$this->db->from($this->table);		
		return $this->db->count_all_results();
	}

	public function getProfileRow($id){
		$data = array();
		if($id!=0){
			$this->db->where('id',$id);
			$q = $this->db->get('register');
			if($q->num_rows()>0){
				return $q->row();
			}else{
				return $data;
			}
		}else{
			return $data;
		}
	}

	public function getCheckReferenceActive($refcode){
		$this->db->where('refcode',$refcode);
		$this->db->where('payment_status',1);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			return $q->row()->name;
		}else{
			return false;
		}
	}
	
	public function login($username,$password){
		if($username=='admin'){
			$this->db->where('username',$username);
		}else{
			$this->db->where('refcode',$username);
		}
		
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			//if($q->row()->active==1){
				$pass = md5($password);
				if($username=='admin'){
					$this->db->where('username',$username);
				}else{
					$this->db->where('refcode',$username);
				}
				$this->db->where('password',$pass);
				$q = $this->db->get('register');
				if($q->num_rows()>0){
					$row = $q->row();
					$data = array('userid'=> $row->id,
						'user'=> $row->name,
						'username'=> $row->username,
						'upwd'=> $row->password,
						'email'=> $row->email,
						'phone'=> $row->phone,
						'active_status'=> $row->active_status,
						'payment_status'=> $row->payment_status,
						'plan'=> $row->plan,
						'memtype'=> $row->memtype,
						'refcode'=> $row->refcode,
					);
					$this->session->set_userdata($data);
					return 1;
				}else{
					return 3;
				}
			//}else{
			//	return 4;
			//}
		}
		return 2;
	}

	public function register($data){
		/*Sample Testing Code For Three */
		// $insertId = 1045;
		// $this->db->where('id',$insertId);
		// $q = $this->db->get('register');
		// if($q->num_rows()>0){
		// 	$row = $q->row();
		// 	$this->set3Trees($row);
		// 	$this->set3Trees($row);
		// 	$this->set2Trees($row);
		// 	// $this->set2Trees($row);
		// }
		// $this->varaha->print_arrays("End");
		/********************************** */



		
		if($data){
			$this->db->where('phone', $data['phone']);
			$q= $this->db->get('register');
			if($q->num_rows()>0){
				return 4;
			}else{
				try{
					if($this->db->insert('register',$data)){
						$insertId = $this->db->insert_id();
						$this->db->where('id',$insertId);
						$q = $this->db->get('register');
						if($q->num_rows()>0){
							$row = $q->row();
							$this->set3Trees($row);
							$this->set3Trees($row);
							$this->set2Trees($row);
							$this->set2Trees($row);
							$data = array('userid'=> $row->id,
								'user'=> $row->name,
								'username'=> $row->username,
								'upwd'=> $row->password,
								'email'=> $row->email,
								'phone'=> $row->phone,
								'active_status'=> $row->active_status,
								'payment_status'=> $row->payment_status,
								'plan'=> $row->plan,
								'memtype'=> $row->memtype,
								'refcode'=> $row->refcode,
							);
						$this->session->set_userdata($data);
						return 1;
						}
						
					}else{
						return 2;
					}
				}catch(Exception $e) {
					return 3;
				}	
			}					
		}
	}
	public function set3Trees($row){
		$this->db->where('refId3',$row->referenceId);
		$q = $this->db->get('register');				
		if($q->num_rows()<=3){
			$this->db->where('id',$row->id);
			$this->db->update('register',array('refId3'=>$row->referenceId));
		}else{			
			foreach($q->result() as $rows){
				$response = $this->checkWith3Tree($rows, $row->id);	
				if($response){
					return true;
				}
				// $this->varaha->print_arrays($response,'Nagesh');
			}
			// $this->varaha->print_arrays($q->result());
			if(isset($response)){
				if(!$response){
					foreach($q->result() as $rows){
						$response = $this->checkWith3TreeDown($rows, $row->id);	
					}
				}
			}
			
		}
	}

	public function checkWith3Tree($row,$id){
		$this->db->where('refId3',$row->id);
		$q = $this->db->get('register');
		// $this->varaha->print_arrays($q->num_rows(),'Nagesh',$row->id,'mmm',$id);				
		if($q->num_rows()<=3){			
			$this->db->where('id',$id);
			$this->db->update('register',array('refId3'=>$row->id));
			// $this->varaha->print_arrays($q->num_rows(),'Nagesh',$id,$row->id);		
			return 1;
		}
		return false;
	}

	public function checkWith3TreeDown($row,$id){
		$this->db->where('refId3',$row->id);
		$q = $this->db->get('register');		
		if($q->num_rows()<=3){
			$this->db->where('id',$id);
			$this->db->update('register',array('refId3'=>$row->id));
			return true;
		}else{
			foreach($q->result() as $rows){
				$response = $this->checkWith3Tree($rows, $row->id);	
				if($response){
					break;
				}	
			}
		}
		return false;
	}

	public function set2Trees($row){
		$response = false;
		$this->db->where('refId2',$row->referenceId);
		$q = $this->db->get('register');			
		if($q->num_rows()<=2){
			$this->db->where('id',$row->id);
			$this->db->update('register',array('refId2'=>$row->referenceId));
		}else{
			foreach($q->result() as $rows){
				$response = $this->checkWith2Tree($rows, $row->id);	
				if($response){
					break;
				}	
			}
			if(!$response){
				foreach($q->result() as $rows){
					$response = $this->checkWith3TreeDown($rows, $row->id);	
				}
			}
		}
	}

	public function checkWith2Tree($row,$id){
		$this->db->where('refId2',$row->id);
		$q = $this->db->get('register');	
		// $this->varaha->print_arrays($q->num_rows(),'Nagesh',$row, 'mmm',$id);		
		if($q->num_rows()<=2){
			$this->db->where('id',$id);
			$this->db->update('register',array('refId2'=>$row->id));
			return true;
		}
		return false;
	}

	public function checkWith2TreeDown($row,$id){
		$this->db->where('refId2',$row->id);
		$q = $this->db->get('register');		
		if($q->num_rows()<=2){
			$this->db->where('id',$id);
			$this->db->update('register',array('refId2'=>$row->id));
			return true;
		}else{
			foreach($q->result() as $rows){
				$response = $this->checkWith2Tree($rows, $row->id);	
				if($response){
					break;
				}	
			}
		}
		return false;
	}
	








	public function updatenewpassword($email,$password){
		$this->db->where('email',$email);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			//if($q->row()->active==1){
				$pass = md5($password);
				$this->db->where('id',$q->row()->id);
				if($this->db->update('register',array('password'=>$pass))){
					return true;
				}
		}
		return FALSE;
	}

	public function logout(){
		
		
		$data = array('userId'=> '',
					  'user'=> '',
					  'username'=> '',
					  'email'=> '',
					  'phone'=> '',
					  'active_status'=> '',
					  'payment_status'=> '',
					  'memtype'=> '',
					  'plan'=> '',
					  'stockpointId' => '',
					  'refcode'=> '',
					  'upwd'=> '');
		$this->session->set_userdata($data);
		$this->session->sess_destroy();	
		session_start();
		session_destroy();
		return true;
	}

	public function getRefUserDataData($id){
		$this->db->where('id',$id);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			return $q->row();
		}
		return 0;
	}

	public function getRefUserData($reff){
		$this->db->where('refcode',$reff);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			return $q->row();
		}
		return 0;
	}

	public function getRefId($reff){
		$this->db->where('refcode',$reff);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			return $q->row()->id;
		}
		return 0;
	}

	public function getRefUsers1($userId){
		$refUserChain="";
		$this->db->where('referenceId',$userId);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				// $row->refUserChain .=  $this->getRefUsers($row->id);
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}

	public function getCommissionByUser($userId){

		// $this->db->select("SUM(commission) As amount");
		$amount=0;
		$this->db->where('userId', $userId);
		$q = $this->db->get('commissions');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$payment_status = $this->getUserPaymentStatus($row->comm_userId);
				if($payment_status==1){
					$amount = $amount + $row->commission;
				}
			}
			
			
		}
		return $amount;
	}

	public function getRefUsers($userId,$i,$type){
		
		$refUserChain="";
		if($type==2){
			$this->db->where('refId2',$userId);
		}else if($type==3){
			$this->db->where('refId3',$userId);
		}
		
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			$refUserChain .= '<ul class="active">';
			foreach($q->result() as $row){
				if($row->payment_status==1){
					$icon = '<i class="fa fa-check-circle" style="color:green" title="Active"></i>';
					$txtcolor = 'style="color:black"';
				}else{
					$icon = '<i class="fa fa-times-circle" style="color:red" title="In-Active"></i>';
					$txtcolor = 'style="color:black"';
				}
				$commission = $this->getCommissionByUser($row->id);
				$valumepoints = $this->users_model->getValumepointsDits($row->id);
				$refUserChain .= '<li>';
                $refUserChain .= '<a href="javascript:void(0);">';
                $refUserChain .= '<div class="member-view-box">';
                $refUserChain .= '<div class="member-image">';
				if($row->path){
					$refUserChain .= '<img src="'.base_url($row->path).'" alt="Member" title="'.$row->name.'"  width="18"> '; 
				}else{
					$refUserChain .= '<img src="'.base_url('public/admin/').'app-assets/images/portrait/small/avatar.png" alt="Member" title="'.$row->name.'" width="18"> '; 
				}                                                
				$refUserChain .= '<div class="member-details" style="font-weight: bold;">';	
				if(($row->memtype==1) || ($row->memtype==0)){
				$refUserChain .= '<span '.$txtcolor.'>'.$row->refcode.'-'.strtoupper($row->name).'</span>&nbsp;'.$icon.'<div style="font-size:10px;">Joing Date :'.date('d-M-Y',strtotime($row->jdate)).'</div>';
				}else{
					$refUserChain .= '<span '.$txtcolor.'>'.$row->refcode.'-'.strtoupper($row->name).'</span>&nbsp;'.$icon.'<div style="font-size:10px;">Joing Date :'.date('d-M-Y',strtotime($row->jdate)).'</div>';
				}
				$refUserChain .= '</div>';
				$refUserChain .= '</div>';
				$refUserChain .= '</div>';
                $refUserChain .= '</a>';				
				$refUserChain .= $this->getRefUsers($row->id, $i,$type);			
				
                $refUserChain .= '</li>';		
				
			}
			$refUserChain .= '</ul>';
			return $refUserChain;
		}
		return FALSE;
	}

	public function getRefUsersChain($type){
		$refUserChain="";
		$this->db->where('id',$this->session->userdata('userid'));
		$q = $this->db->get('register');
		if($q->num_rows()>0){			
			foreach($q->result() as $row){
				$commission = $this->getCommissionByUser($row->id);
				$valumepoints = $this->users_model->getValumepointsDits($row->id);
				if($row->payment_status==1){
					$icon = '<i class="fa fa-check-circle" style="color:green" title="Active"></i>';
					$txtcolor = 'style="color:black"';
				}else{
					$icon = '<i class="fa fa-times-circle" style="color:red" title="In-Active"></i>';
					$txtcolor = 'style="color:black"';
				}
				$refUserChain .= '<li>';
				$refUserChain .= '<a href="javascript:void(0);">';
				$refUserChain .= '<div class="member-view-box">';
				$refUserChain .= '<div class="member-image">';
				if($row->path){
					$refUserChain .= '<img src="'.base_url($row->path).'" alt="Member" title="'.$row->name.'" width="18"> '; 
				}else{
					$refUserChain .= '<img src="'.base_url('public/admin/').'app-assets/images/portrait/small/avatar.png" alt="Member" title="'.$row->name.'" width="18"> '; 
				}
				                                                 
				$refUserChain .= '<div class="member-details" style="font-weight: bold;">';		
				if(($row->memtype==1) || ($row->memtype==0)){
					$refUserChain .= '<span '.$txtcolor.'>'.$row->refcode.'-'.strtoupper($row->name).'</span>&nbsp;'.$icon.'<div style="font-size:10px;">Joing Date :'.date('d-M-Y',strtotime($row->jdate)).'</div>';
				}else{
					$refUserChain .= '<span '.$txtcolor.'>'.$row->refcode.'-'.strtoupper($row->name).'</span>&nbsp;'.$icon.'<div style="font-size:10px;">Joing Date :'.date('d-M-Y',strtotime($row->jdate)).'</div>';
				}	
				
				// $refUserChain .= $row->refcode.'-'.$row->name;
				// $refUserChain .= ($row->plan==1 ? "1000 Plan" : "3000 Plan");
				// $refUserChain .= ($commission ? $commission : "0.00");				
				$refUserChain .= '</div>';
				$refUserChain .= '</div>';
				$refUserChain .= '</div>';
				$refUserChain .= '</a>';
				$refUserChain .= $this->getRefUsers($row->id,1, $type);			
			}
			$refUserChain .= '</li>';
			return $refUserChain;
		}
		return FALSE;

	}

	public function getRefLevels($userId){
		$levels= array();
		$levelcount = $this->getRefUsers11($userId);
		$levelname = 'Brand Partner';
		for($i=1;$i<=5;$i++){	
		    if($levelcount){				
				// if(($levelcount['count'] >= 10) && ($levelcount['count'] <100)){
				// 	$levelname = 'Bronz Director';
				// }
				// if(($levelcount['count'] >= 100) && ($levelcount['count'] <1000)){
				// 	$levelname = 'Gold Director';
				// }
				// if(($levelcount['count'] >= 1000) && ($levelcount['count'] <10000)){
				// 	$levelname = 'Star Director';
				// }
				// if(($levelcount['count'] >= 10000) && ($levelcount['count'] <100000)){
				// 	$levelname = 'Diamond Director';
				// }
				// if($levelcount['count'] >= 100000){
				// 	$levelname = 'Crown Director';
				// }
				if($i==1){
					if($levelcount['count'] >= 10){
						$levelname = 'Bronze Director';
					}
				}
				if($i==2){
					if($levelcount['count'] >= 100){
						$levelname = 'Gold Director';
					}
				}
				if($i==3){
					if($levelcount['count'] >= 1000){
						$levelname = 'Star Director';
					}
				}
				if($i==4){
					if($levelcount['count'] >= 10000){
						$levelname = 'Diamond Director';
					}
				}
				if($i==5){
					if($levelcount['count'] >= 100000){
						$levelname = 'Crown Director';
					}
				}
				$commissionrate = $this->varaha_model->getCommissionRate($i);
    			$level = array(
    				'level' => 'Level '.$i,
    				'count' => ($levelcount['count'] ? $levelcount['count'] : 0),
    				// 'amount' => ($i == 1 ? (500* $levelcount['count']) : (100* $levelcount['count'])),
					'amount' => $commissionrate * $levelcount['count'],
					'levelname' => $levelname,
    			);
		    }else{
		        $level = array(
    				'level' => 'Level '.$i,
    				'count' => 0,
    				'amount' => 0,
					'levelname' => $levelname,
    			);
		    }
			array_push($levels, $level);
			if($levelcount){
			if($levelcount['users']){
				$levelcount = $this->getNextLevel($levelcount['users']);
			}
			}else{
			    $levelcount = 0;
			}
		}
		return $levels;
	}
	// 


	public function getRefUsers11($userId){
		$count=0;
		$userIds = array();
		$users = array();
		$this->db->where('payment_status',1);
		$this->db->where('memtype',1);
		$this->db->where('referenceId',$userId);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$count = $count +1;
				array_push($users, $row->id);
			}
			return array(
				'count' => $count,
				'users' => $users,
			);
		}
		return array(
			'count' => $count,
			'users' => $users,
		);
	}

	public function getRefUsers122($userId){
		$count=0;
		$userIds = array();
		$users = array();
		$this->db->where('payment_status',1);
		$this->db->where_in('memtype',array(1,2));
		$this->db->where('referenceId',$userId);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$count = $count +1;
				array_push($users, $row->id);
			}
			return array(
				'count' => $count,
				'users' => $users,
			);
		}
		return array(
			'count' => $count,
			'users' => $users,
		);
	}

	public function getNextLevel($userIds){
		
		$count=0;
		$users = array();
		$this->db->where('payment_status',1);
		$this->db->where('memtype',1);
		$this->db->where_in('referenceId',$userIds);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$count = $count +1;
				array_push($users, $row->id);
			}
			return array(
				'count' => $count,
				'users' => $users,
			);
		}
		return FALSE;
	}
	public function getNextLevel122($userIds){
		
		$count=0;
		$users = array();
		$this->db->where('payment_status',1);
		$this->db->where_in('memtype',array(1,2));
		$this->db->where_in('referenceId',$userIds);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$count = $count +1;
				array_push($users, $row->id);
			}
			return array(
				'count' => $count,
				'users' => $users,
			);
		}
		return FALSE;
	}
	


	public function getWalletDits($id){
		$wallet_amt=0;
		// $this->db->where('userId',$id);		
		// $this->db->where('payment_active',1);		
		// $q = $this->db->get('wallet');
		// if($q->num_rows()>0){
		// 	foreach($q->result() as $row){
		// 		$wallet_amt = $wallet_amt +$row->wallet_amt;
		// 	}
		// 	return $wallet_amt;
		// }
		// return $wallet_amt;
		$this->db->where('vendorId',$id);			
		$q = $this->db->get('view_lifetimebouns');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$wallet_amt = $wallet_amt +$row->totals;
			}
			return $wallet_amt;
		}

	}

	public function getUserPaymentStatus($userId){
		// return 1;
		$this->db->where('id',$userId);	
		$q = $this->db->get('register');
		if($q->num_rows()>0){			
			if($q->row()->payment_status==1){
				return $q->row()->payment_status;
			}			
		}	
		return 0;		
	}

	public function getCommissionDits($id){
		$commission=0;
		$commission100=0;
		$valumepointamt=0;
		$date = date('Y-m-d',time());
		$fdate = date('Y-m-01', strtotime($date));
		$ldate= date('Y-m-t', strtotime($date));
		
		$this->db->where('userId',$id);		
		$this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		$q = $this->db->get('commissions');
		$mdata[] = $this->db->last_query();
		// $this->varaha->print_arrays($this->db->last_query());
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$payment_status = $this->getUserPaymentStatus($row->comm_userId);
				// $this->varaha->print_arrays($payment_status);
				if($payment_status==1){
					if($row->commission == 500){
						$commission = $commission + $row->commission;
					}else if($row->commission == 100){				
						$commission100 = $commission100 + $row->commission;
					}else if($row->type==5){
						$selfvp = $this->users_model->getValumepointsDits($row->userId); 
						if($selfvp>=30){
							$valumepointamt = $valumepointamt + $row->commission;
						}
					}
				}				
			}
			$valpints=array();
			$userId = $id;
				$valp=0;
				$levelcount = $this->getRefUsers122($userId);
				$levelname = 'Brand Partner';
				for($i=1;$i<=5;$i++){
					$valp=0;		
					if($levelcount){
						$mdata[] = $levelcount['users'];
						if($levelcount['users']){
							$this->db->where('type', 5);
							$this->db->where('userId', $this->session->userdata('userid'));
							$this->db->where_in('comm_userId',$levelcount['users']);		
							$this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");	
							$q = $this->db->get('commissions');
							$mdata[] = $this->db->last_query();
							// $this->varaha->print_arrays($this->db->last_query());
							$levelcountdata[] = $levelcount;
							if($q->num_rows()>0){
								foreach($q->result() as $row){
									$selfvp = $this->users_model->getValumepointsDits($row->userId); 
									if($selfvp>=30){
										if($row->type==5){
											$valp = $valp + $row->commission;
										}
									}
								}
								
							}
							$levelcount = $this->getNextLevel122($levelcount['users']);
						}
					}
					array_push($valpints, $valp);
				}
		

			$mcomm = array("comm500" => $commission, "comm100" => $commission100, "valumepoints" => $valumepointamt, "rempoints" => $valpints);
			return $mcomm ;
		}
		return array();
	}

	

	public function getCommissionDitsSummary($id){
		$commission=0;
		$commission100=0;
		$valumepointamt=0;
		$date = date('Y-m-d',time());
		$fdate = date('Y-m-01', strtotime($date));
		$ldate= date('Y-m-t', strtotime($date));
		
		$this->db->where('userId',$id);		
		// $this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		$q = $this->db->get('commissions');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$payment_status = $this->getUserPaymentStatus($row->comm_userId);
				if($payment_status==1){
					if($row->commission == 500){
						$commission = $commission +$row->commission;
					}else if($row->commission == 100){				
						$commission100 = $commission100 +$row->commission;
					}else if($row->type==5){
						$valumepointamt = $valumepointamt + $row->commission;
					}
				}
			}
			$valpints=array();
			$userId = $id;
			for($i=0;$i<5;$i++){
				$userId = $this->getRefUser($userId);
				if($userId){		
					$valp=0;		
					$this->db->where('userId',$userId);		
					$this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
					$q = $this->db->get('commissions');
					if($q->num_rows()>0){
						foreach($q->result() as $row){
							$payment_status = $this->getUserPaymentStatus($row->comm_userId);
							if($payment_status==1){
								if($row->type==5){
									$valp = $valp + $row->commission;
								}
							}
						}	
						// if($valp!=0)					
						array_push($valpints, $valp);
					}		
				}			
				
			}

			$mcomm = array("comm500" => $commission, "comm100" => $commission100, "valumepoints" => $valumepointamt, "rempoints" => $valpints);
			return $mcomm ;
		}
		return array();
	}
	
	public function getValumepointsDits($id){
		$value=0;
		$date = date('Y-m-d',time());
		$fdate = date('Y-m-01', strtotime($date));
		$ldate= date('Y-m-t', strtotime($date));
		
		$this->db->where('pvtype',1);		
		$this->db->where('userId',$id);		
		$this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		$q = $this->db->get('valumepoints');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				// $payment_status = $this->getUserPaymentStatus($id);
				// if($payment_status==1){
					$value = $value +$row->value;
				// }				
			}			
			return $value ;
		}
		return 0;
	}
	public function getValumepointsDitsGroup($userId){
		$value=0;
		// for($i=0;$i<5;$i++){
		// 	$userId = $this->getRefUser($userId);
		// 	if($userId){		
		// 		$this->db->where('userId',$userId);		
		// 		// $this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		// 		$q = $this->db->get('valumepoints');
		// 		if($q->num_rows()>0){
		// 			foreach($q->result() as $row){
		// 				$payment_status = $this->getUserPaymentStatus($userId);
		// 				if($payment_status==1){
		// 					$value = $value + $row->value;	
		// 				}			
		// 			}	
		// 		}		
		// 	}			
			
		// }
		// return $value ;

		// $this->db->where('referenceId',$userId);
		// $qa = $this->db->get('register');
		// if($qa->num_rows()>0){
		// 	foreach($qa->result() as $row){
				$newDate = date('Y-m-d', time());
				$from_date = date("Y-m-01", strtotime($newDate));
				$to_date = date("Y-m-t", strtotime($newDate));
				$this->db->where("DATE(date) BETWEEN '".$from_date."' AND '".$to_date."'");
				$this->db->where('userId',$this->session->userdata('userid'));
				$this->db->where('pvtype',0);	
				$q = $this->db->get('valumepoints');
				if($q->num_rows()>0){
					foreach($q->result() as $row){
						$payment_status = $this->getUserPaymentStatus($userId);
						if($payment_status==1){
							$value = $value + $row->grppv;	
						}			
					}	
				}	
		// 	}
		// }
		return $value ;

	}
	// public function getItemPurchased($id){
	// 	$value=0;
	// 	$date = date('Y-m-d',time());
	// 	$fdate = date('Y-m-01', strtotime($date));
	// 	$ldate= date('Y-m-t', strtotime($date));
		
	// 	$this->db->where('user',$id);		
	// 	$this->db->where("DATE(created_at) BETWEEN '".$fdate."' AND '".$ldate."'");		
	// 	$q = $this->db->get('order_items');
	// 	if($q->num_rows()>0){
	// 		foreach($q->result() as $row){
	// 			$value = $value +$row->qty;				
	// 		}			
	// 		return $value ;
	// 	}
	// 	return 0;
	// }

	public function getItemPurchased($id){
		$amount = 0;
		$this->db->where('userId',$id);
		$q = $this->db->get('stockpoint');
		if($q->num_rows()>0){
			// $stockrow = $q->row();
			// $this->db->where('stockpointId',$stockrow->id);
			// $qs = $this->db->get('stockpointitems');
			// if($qs->num_rows()>0){
			// 	foreach($qs->result() as $row){
			// 		$product = $row->product;
			// 		$this->db->where('id',$product);
			// 		$qsv = $this->db->get('items');
			// 		if($qsv->num_rows()>0){
			// 			$amount = $amount + ($qsv->row()->rate * $row->qty);
			// 		}
			// 	}
			// }
			$amount = $q->row()->walletbal;
		}

		return $amount;
	}
	public function getStockWalletbalance($id){
		$amount = 0;
		
			
			$this->db->where('userId',$id);
			$qs = $this->db->get('view_orders');
			if($qs->num_rows()>0){
				foreach($qs->result() as $row){
					if($row->refcode){
						$amount = $amount + $row->amount;
					}
					
				}
			}

		return $amount;
	}

	
	

	public function getRefUser($user){
		$this->db->where('id',$user);		
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			$this->db->where('id',$q->row()->referenceId);
			$qs = $this->db->get('register');
			if($qs->num_rows()>0){
				return $qs->row()->id;
			}
		}
		return FALSE;
	}

	public function getRefUserPaymentPosting($user){
		// $this->db->where('active_status',1);		
		$this->db->where('id',$user);		
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			$this->db->where('id',$q->row()->referenceId);
			$qs = $this->db->get('register');
			if($qs->num_rows()>0){
				return $qs->row()->id;
			}
		}
		return FALSE;
	}
	public function getRefUserCommissions($plan, $cash=null){
		$comm_users= array();
		$userId = $this->session->userdata('userid');
		for($i=0;$i<5;$i++){
			$userId = $this->getRefUserPaymentPosting($userId);
			// if($userId){				
				$mdata = array(
					'userId' => $userId,
					'date' => date('Y-m-d h:i:s',time()),
					'commission' => ($i==0 ? 500 : 100),
					'type' => ($cash ? 2 : 1),
					'comm_userId' => $this->session->userdata('userid')
				);				
			// }			
			$comm_users[] = $mdata;
		}
		if($comm_users){
			foreach($comm_users as $cuser){
				if($cuser['userId']){
					// $this->db->insert('commissions',$cuser);
				}
			}

			if($plan==1){
				$wallet = 3000;
			}
			if($plan==2){
				$wallet = 3500;
			}
			if($plan==3){
				$wallet = 3000;
			}

			$wallet = array(
				'userId' => $this->session->userdata('userid'),
				'wallet_amt' => $wallet,
				'date' => date('Y-m-d h:i:s',time()),
				'type' => ($cash ? 2 : 1),
				'payment_active' => 1
			);
			$this->db->where('userId', $this->session->userdata('userid'));
			$sws=$this->db->get('wallet');
			if($sws->num_rows()==0){
				$this->db->insert('wallet',$wallet);
			}
			$this->db->where('id', $this->session->userdata('userid'));
			$cash = true;
			// $this->db->update('register',array('active_status' => 1, 'payment_status' => ($cash ? 0 : 1), 'plan' => $plan));
			$this->db->update('register',array('active_status' => 1, 'payment_status' => 1, 'plan' => $plan));
			$data = array(
				'active_status'=> 1,
				'payment_status'=> ($cash ? 0 : 1),
				'plan'=> $plan,
			);
			$this->session->set_userdata($data);
		}
		

		return $comm_users;
	}


	public function insert($data,$id){
		if($data){
			if($id){
				$this->db->where('id',$id);
				if($this->db->update('register',$data)){
					return true;
				}
			}else{
				if($this->db->insert('register',$data)){
					return true;
				}
			}
			
		}
		return false;
	}



	public function getUserDetails($id){
		$this->db->where('id',$id);		
		$q = $this->db->get('register');
		if($q->num_rows()>0){			
			return $q->row();			
		}
		return FALSE;
	}


	public function getStockPointerId($id){
		$this->db->where('userId',$id);		
		$q = $this->db->get('stockpoint');
		if($q->num_rows()>0){			
			return $q->row()->id;			
		}
		return FALSE;
	}







	public function getAllUsers(){
		$this->db->where('status',1);
		$this->db->where('id!=',1);
		$this->db->order_by('id','DESC');
		$q = $this->db->get('members');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}


	public function updateActive($type,$id){

		$this->db->where('id',$id);
		$qs = $this->db->get('register');
		if($qs->num_rows()>0){
			if($qs->row()->memtype==1){
					$comm_users= array();
					$userId = $id;
					for($i=0;$i<5;$i++){
						$userId = $this->getRefUserPaymentPosting($userId);
						// if($userId){	
							$commission = $this->varaha_model->getCommissionRate($i+1);	
								
							$mdata = array(
								'userId' => $userId,
								'date' => date('Y-m-d h:i:s',time()),
								'commission' => $commission,
								'type' => ($cash ? 2 : 1),
								'comm_userId' => $id
							);				
						// }			
						$comm_users[] = $mdata;
					}
					if($comm_users){
						foreach($comm_users as $cuser){
							if($cuser['userId']){
								$this->db->insert('commissions',$cuser);
							}
						}			
					}
					$this->db->where('id',$id);
					if($this->db->update('register', array('active_status'=>$type, 'payment_status' => $type))){
						return $type;
					}
					return $type;
				}else{
					$this->db->where('id',$id);
					if($this->db->update('register', array('active_status'=>$type, 'payment_status' => $type))){
						return $type;
					}
					return $type;
				}
			}
			

		

		
	}



	public function getInvoicePrintData($id){
		$data=array();
		$this->db->where('order_id',$id);
		$q = $this->db->get('main_orders');
		if($q->num_rows()>0){
			$this->db->where('order_id',$id);
			$qs = $this->db->get('order_items');
			if($qs->num_rows()>0){
				foreach($qs->result() as $row){
					$data[] = $row;
				}
			}
			$q->row()->customer = ($q->row()->refcode ? $this->getRefUserData($q->row()->refcode) :  $this->getRefUserDataData($q->row()->userId));
			$q->row()->products = $data;
			$row = $q->row();

			return $row;
		}
		return false;
	}


















	
	public function getLocationName($locId){
		$this->db->where('id',$locId);
		$q = $this->db->get('locations');
		if($q->num_rows()>0){
			return $q->row()->name;
		}
		return FALSE;
	}
	
	public function getEditData($id,$table){
	
		$this->db->where('id',$id);
		$q = $this->db->get($table);
		if($q->num_rows()>0){			
			return $q->row();
		}
		return FALSE;
	}
	
	
	public function updateUser($id,$mdata){
		if($id){
			$this->db->where('id',$id);
			if($this->db->update('members',$mdata)){
				return true;
			}
		}else{
			if($this->db->insert('members',$mdata)){
				return true;
			}
		}
		
		return FALSE;
	}
	
	
	public function getDelete($id){
		
		$this->db->where('id',$id);
		if($this->db->delete('members')){
			return true;
		}
		return FALSE;
		
	}
	public function getAllUsersRequest(){
		
		$this->db->order_by('id','DESC');
		$q = $this->db->get('view_user_req');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		return FALSE;
	}
	
	
	public function getUsersTotals($userId){
		
		$tot_users=0;
		$tot_active=0;
		$tot_inactive=0;
		$tot_vendors=0;
		$tot_customers=0;
		$tot_stockpoints=0;
		$users_data = array(
			'tot_users' => $tot_users,
			'tot_active' => $tot_active,
			'tot_inactive' => $tot_inactive,
			'tot_vendors' => $tot_vendors,
			'tot_customers' => $tot_customers,
			'tot_stockpoints' => $tot_stockpoints,
		);
		if($userId==1){
		    $this->db->where('id !=', $userId);
			$q = $this->db->get('register');
			if($q->num_rows()>0){
				foreach($q->result() as $row){
					if($row->payment_status==1){
						$tot_active=$tot_active + 1;
				// 		$tot_active = $tot_active + $this->getNextLevelUsers('payment_status',1,$row->id);
					}else{
						$tot_inactive=$tot_inactive + 1;
				// 		$tot_inactive = $tot_inactive + $this->getNextLevelUsers('payment_status',0,$row->id);
					}
					$tot_users= $tot_users + 1;
				// 	$tot_users = $tot_users + $this->getNextLevelUsers(null,null,$row->id);
					if($row->memtype==1){
						$tot_vendors= $tot_vendors + 1;
				// 		$tot_vendors = $tot_vendors + $this->getNextLevelUsers('memtype',1,$row->id);
					}
					if($row->memtype==2){
						$tot_customers= $tot_customers + 1;
				// 		$tot_customers = $tot_customers + $this->getNextLevelUsers('memtype',2,$row->id);
					}
					if($row->memtype==3){
						$tot_stockpoints= $tot_stockpoints + 1;
				// 		$tot_stockpoints = $tot_stockpoints + $this->getNextLevelUsers('memtype',3,$row->id);
					}
					
				}
				$users_data = array(
					'tot_users' => $tot_users,
					'tot_active' => $tot_active,
					'tot_inactive' => $tot_inactive,
					'tot_vendors' => $tot_vendors,
					'tot_customers' => $tot_customers,
					'tot_stockpoints' => $tot_stockpoints,
				);
				
			}
			
		}else{
			$this->db->where('referenceId', $userId);
			$q = $this->db->get('register');
			if($q->num_rows()>0){
				foreach($q->result() as $row){
					if($row->payment_status==1){
						$tot_active=$tot_active + 1;
						$tot_active = $tot_active + $this->getNextLevelUsers('payment_status',1,$row->id);
					}else{
						$tot_inactive=$tot_inactive + 1;
						$tot_inactive = $tot_inactive + $this->getNextLevelUsers('payment_status',0,$row->id);
					}
					$tot_users= $tot_users + 1;
					$tot_users = $tot_users + $this->getNextLevelUsers(null,null,$row->id);
					if($row->memtype==1){
						$tot_vendors= $tot_vendors + 1;
						$tot_vendors = $tot_vendors + $this->getNextLevelUsers('memtype',1,$row->id);
					}
					if($row->memtype==2){
						$tot_customers= $tot_customers + 1;
						$tot_customers = $tot_customers + $this->getNextLevelUsers('memtype',2,$row->id);
					}
					if($row->memtype==3){
						$tot_stockpoints= $tot_stockpoints + 1;
						$tot_stockpoints = $tot_stockpoints + $this->getNextLevelUsers('memtype',3,$row->id);
					}
					
				}
				$users_data = array(
					'tot_users' => $tot_users,
					'tot_active' => $tot_active,
					'tot_inactive' => $tot_inactive,
					'tot_vendors' => $tot_vendors,
					'tot_customers' => $tot_customers,
					'tot_stockpoints' => $tot_stockpoints,
				);

			}
		}
		return $users_data;
	}

	public function getNextLevelUsers($column=null, $type=null, $userId){
		$result = 0;
		$this->db->where('referenceId', $userId);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				if($column && $type){
					if($row->$column==$type){
						$result = $result + 1;
						$result = $result + $this->getNextLevelUsers($column,$type,$row->id);
					}
				}else{
					$result = $result + 1;
					$result = $result + $this->getNextLevelUsers(null,null,$row->id);
				}
				
			}
		}
		return $result;
	}
	
	public function getTestUserChain($userId){
		for($i=0;$i<5;$i++){
			$userId = $this->getTestUserChainRef($userId);

			$data[] = $userId;
		}
		return $data;
		
	}

	public function getTestUserChainRef($userId){
		$refUserChain="";
		$this->db->where('id',$userId);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			return $q->row()->referenceId;
		}
		return FALSE;

	}

	public function reDeleteInactiveUsers(){
		$tomorrow = date("Y-m-d", strtotime("- 30 day"));

		$this->db->where('refcode',1);
		$this->db->where('payment_status',0);
		$this->db->where('Date(jdate) <=',$tomorrow);
		if($this->db->delete('register')){
			return true;
		}

	}

	public function deleteUser($id){
		// $this->db->select('id,name');
		$this->db->where('id',$id);
		$q = $this->db->get('register');
		if($q->num_rows()>0){		
			foreach($q->result() as $row){
				$commission = $this->getCommissionByUserDelete($row->id);
				$valumepoints = $this->users_model->getValumepointsDitsDelete($row->id);
				$row->commission = $commission;
				$row->valumepoints = $valumepoints;
				$row->wallet = $this->users_model->getWalletDitsDelete($row->id);
				$row->refferdusers = $this->getRefUsersDelete($row->id);
				$data[] = $row;
			}			

			
			return $data;
			
		}
		return FALSE;
	}

	public function getRefUsersDelete($userId){
		// $this->db->select('id,name');
		$this->db->where('referenceId',$userId);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				
				$commission = $this->getCommissionByUserDelete($row->id);
				$valumepoints = $this->users_model->getValumepointsDitsDelete($row->id);
				$row->commission = $commission;
				$row->valumepoints = $valumepoints;
				$row->wallet = $this->users_model->getWalletDitsDelete($row->id);
				$row->refferdusers = $this->getRefUsersDelete($row->id);
				$data[] = $row;			
                
			}
			return $data;
		}
		return FALSE;
	}

	public function deleteLastRefUser($data){
		$mds=array();
		if($data){
			foreach($data as $row){
				if($row->refferdusers){
					$mds[] = $this->deleteLastRefUserLs($row->refferdusers);					
				}else{
					$mds[] = $this->deleteLastRefUserLs($data);
				}		
			}
		}
		return $mds;
	}

	public function checkPinNumber($pin,$refcode){
		$this->db->where('status',1);
		$this->db->where('pin',$pin);
		$q = $this->db->get('pin_numbers');
		if($q->num_rows()>0){
			$this->db->where('id',$q->row()->id);
			$this->db->update('pin_numbers',array('status'=>3, 'refcode'=> $refcode));
			return true;
		}else{
			return false;
		}
	}
	public function deleteLastRefUserLs($data){
		$mds=array();
		if($data){
			foreach($data as $row){
				if($row->refferdusers){
					$mds[] = $this->deleteLastRefUserLs($row->refferdusers);
				}else{
					/*USER DELETE*/
					$delete_data= array(
						'date_time' => date('Y-m-d h:i:s',time()),
						'query' => json_encode($row),
						'deleted_user' => $this->session->userdata('userid'),
					);
					$this->db->insert('deleted_users',$delete_data);
					$commission = $row->commission;					
					$valumepoints = $row->valumepoints;					
					$wallet = $row->wallet;					
					if($commission){
						foreach($commission as $com){
							$this->db->where('id',$com->id);
							$this->db->delete('commissions');
						}
					}	
					if($valumepoints){
						foreach($valumepoints as $val){
							$this->db->where('id',$val->id);
							$this->db->delete('valumepoints');
						}
					}		
					if($wallet){
						foreach($wallet as $wal){
							$this->db->where('id',$wal->id);
							$this->db->delete('wallet');
						}
					}	
					$this->db->where('id', $row->id);
					$this->db->delete('register');	
					if(sizeof($data)==1){
						return $mds;
					}else{
						$mds[] = $row;
					}
					
				}					
			}
		}
		return $mds;
	}
	
	

	public function getWalletDitsDelete($id){
		$this->db->where('userId',$id);			
		$q = $this->db->get('wallet');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function getCommissionByUserDelete($userId){

		// $this->db->select("SUM(commission) As amount");
		
		$this->db->where('userId', $userId);
		$q = $this->db->get('commissions');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;			
		}
		return FALSE;
	}

	public function getValumepointsDitsDelete($id){
		$value=0;
		$date = date('Y-m-d',time());
		$fdate = date('Y-m-01', strtotime($date));
		$ldate= date('Y-m-t', strtotime($date));
		
		$this->db->where('pvtype',1);		
		$this->db->where('userId',$id);		
		$this->db->where("DATE(date) BETWEEN '".$fdate."' AND '".$ldate."'");		
		$q = $this->db->get('valumepoints');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;			
			}			
			return $data ;
		}
		return false;
	}
	public function getCouponData($userId){
		$this->db->where('userId',$userId);
		$this->db->order_by('status','ASC');		
		$q = $this->db->get('coupons');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;			
			}			
			return $data ;
		}
		return false;
	}

	
}

?>