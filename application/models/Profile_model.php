<?php
class Profile_model extends CI_Model
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
						$this->db->where('id',$this->session->userdata('userid'));
					}
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
					$this->db->like('status',1);
					if($this->session->userdata('userid')!=1){
						$this->db->where('id',$this->session->userdata('userid'));
					}
				}	
			$i++;
			}
		}
		if($this->session->userdata('userid')!=1){
			$this->db->where('id',$this->session->userdata('userid'));
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
			$this->db->where('id',$this->session->userdata('userid'));
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
			$this->db->where('id',$this->session->userdata('userid'));
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

	
	
}
?>