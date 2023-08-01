<?php
class Withdraw_model extends CI_Model
{
	var $table = 'withdraw';	
	var $column_order = array(null, 'memberId','amount','description','created_on'); //set column field database for datatable orderable
	var $column_search = array('memberId','amount','description','created_on'); //set column field database for datatable searchable 
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
					// $this->db->like('status',1);
					$this->db->like($item, $_POST['search']['value']);
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
					// $this->db->like('status',1);
				}	
			$i++;
			}
		}
		// $this->db->where('status',1);
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
		if($this->session->userdata('userid')!='1'){
			$this->db->where('memberId',$this->session->userdata('userid'));
		}
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		// $this->db->where('status',1);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{	
		$this->db->from($this->table);		
		return $this->db->count_all_results();
	}

	

	
	public function getSingleRow($id){
		$this->db->where('id',$id);
		$q = $this->db->get($this->table);
		if($q->num_rows() > 0){
			return $q->row();
		}
	}

	public function insert($data, $id){
		
		if($id){			
			$this->db->where('id',$id);
			if($this->db->update($this->table,$data)){
				return $id;
			}
			
		}else{			
			if($this->db->insert($this->table,$data)){
				return $this->db->insert_id();		
			}
		}
		return false;
	}
	public function getAllRows(){
		$this->db->where('status',1);
		$q = $this->db->get($this->table);
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function getDelete($id){
		$this->db->where('id',$id);
		if($this->db->update($this->table,array('status' => 3))){
			return true;
		}
		return false;
	}

	public function getAllMembers(){

		
		$this->db->where('active_status',1);
		$this->db->where('status',1);
		$q = $this->db->get('register');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
	
}
?>