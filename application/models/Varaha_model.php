<?php
class Varaha_model extends CI_Model
{
	
	public function __construct()
	{
		
		$this->load->database();
		
	}
	
	public function getCode($table, $code){
		$lastId = $this->getLastRec($table);

		return $code.sprintf('%05d', $lastId);
	}
	
	public function getLastRec($table){
		$this->db->select('id');
		$this->db->order_by("id","DESC");
		$this->db->limit(1);
		$q = $this->db->get($table);
		if($q->num_rows() > 0){
			return $q->row()->id + 1;
		}
		return 0;

	}
	public function getGstRows(){
		$this->db->where('status',1);
		$q = $this->db->get('gst');
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function updateorderItem($data = array()){
		if($data){
			if($this->db->insert('wallet',$data)){
				return true;
			}
		}
		return false;
	}
	public function getUserData($id){
		$this->db->where('id',$id);
		$q = $this->db->get('register');
		if($q->num_rows() > 0){
			return $q->row();
		}
		return false;

	}

	public function changePassword($old,$password){

		if($old){
			$this->db->where('id',$this->session->userdata('userid'));
			$this->db->where('password',md5($old));
			$q = $this->db->get('register');
			if($q->num_rows() > 0){
				if($password){
					$pass = md5($password);
					$this->db->where('id',$this->session->userdata('userid'));
					if($this->db->update('register', array('password' => $pass))){
						return 1;
					}
				}
			}
			return 3;
		}

	}

	public function getCommissionRate($id){
		$this->db->where('id',$id);
		$q = $this->db->get('commision_rates');
		if($q->num_rows() > 0){
			return $q->row()->commision;
		}
		return false;
	}
}
?>