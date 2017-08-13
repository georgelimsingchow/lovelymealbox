<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
		$this->current_user_id = $this->mdl_usermodel->getId();
	}


	public function reload_report($start,$end)
	{
		
		$data = array();

		$this->db->select('*, balance.create_date AS b_create_date');
		$this->db->from('balance');
		$this->db->where("balance.create_date BETWEEN '$start' and '$end'");
		$this->db->join('customer', 'customer.customer_id = balance.customer_id');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[$row['account_no']]['name'] = $row['first_name']." ".$row['last_name'];
			$data[$row['account_no']]['customer_id'] = $row['customer_id'];

			if ($row['amount'] < 0) {
			$data[$row['account_no']]['expenses'][] = array(
				'amount'      =>$row['amount'],
				'description' => $row['description'],
				'expiry_date' => $row['expire_date'],
				'create_date' => $row['b_create_date']  
				);
			}
		}

		return $data;	
	}

	public function customer_reload($customer_id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('balance');
		$this->db->where('customer_id' , $customer_id);
		$this->db->where('order_id' , '0');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return $data;
	}

	public function insert_prize($customer_id)
	{
		$data['customer_id'] = $customer_id;
		$data['firstname'] =$this->mdl_usermodel->getFirstName();
		$data['lastname'] = $this->mdl_usermodel->getLastName();
		$data['account_no'] = "MBR".($customer_id+3000);
		$data['prize'] = $this->input->post('prize');
		$data['create_date'] = $this->time_now;

		$this->db->insert('lucky_draw', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function has_joined($customer_id)
	{
		$this->db->select('*');
		$this->db->from('lucky_draw');
		$this->db->where('customer_id' , $customer_id);
		$query = $this->db->get();
		$count = $query->num_rows();

		if ($count != 0) {
			return true;
		}else{
			return false;
		}
	}
}

?>