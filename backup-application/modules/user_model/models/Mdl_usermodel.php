<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_usermodel extends CI_Model {

	private $customer_id;
	private $first_name;
	private $last_name;
	private $email;
	private $phone;
	private $gender;
	private $address_id;
	private $fbid;

	function __construct() 
	{
		parent::__construct();

		if (isset($this->session->customer_id)) {
			$this->db->select('*');
			$this->db->from('customer');
			$this->db->where('customer_id', $this->session->customer_id);
			$query = $this->db->get();

			foreach ($query->result() as $row)
				{
					$this->customer_id 	= $row->customer_id;
					$this->first_name 	= $row->first_name;
					$this->last_name 	= $row->last_name;
					$this->email 		= $row->email;
					$this->phone 		= $row->phone;
					$this->gender 		= $row->customer_id;
					$this->address_id 	= $row->address_id;
					$this->fbid         = $row->fb_id;
				}	
			}

	}

	public function getId() 
	{
		return $this->customer_id;
	}

	public function getFBID()
	{
		return $this->fbid;
	}

	public function getFirstName() 
	{
		return $this->first_name;
	}

	public function getLastName() 
	{
		return $this->last_name;
	}

	public function getGender() 
	{
		return $this->gender;
	}

	public function getEmail() 
	{
		return $this->email;
	}

	public function getPhone()
	{
		return $this->phone;
	}

	public function is_vip()
	{
		$end_of_today = date('Y-m-d')." 23:59:59";
		$data = array();
		$this->db->select('expire_date');
		$this->db->from('balance');
		$this->db->where('customer_id', $this->customer_id);
		$this->db->where('amount >', '0.00');
		$this->db->where('admin_id <>', '0');
		$this->db->where('expire_date >=', $end_of_today);
		$this->db->order_by('expire_date', 'DESC');
		$this->db->limit(1);

		$balance_result = $this->db->get(); 

		foreach ($balance_result->result_array() as $row) {
			$data[] = $row;
		}

		if (count($data) > '0') {
			return true;
		}else{
			return false;
		}	
	}

}

?>