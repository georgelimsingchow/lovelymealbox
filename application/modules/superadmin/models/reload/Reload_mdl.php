<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reload_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	function get_table() 
	{
		$table = "balance";
		return $table;
	}

	function get_customer_balance($customer_id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where("customer_id", $customer_id);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		return $data;
	}

	function get_total_reload($customer_id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select('SUM(amount) as total');
		$this->db->from($table);
		$this->db->where("customer_id", $customer_id);
		$this->db->where("order_id", '0');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}
		return $data['total'];		
	}

	function get_total_real_reload($customer_id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select('SUM(real_amount) as total');
		$this->db->from($table);
		$this->db->where("customer_id", $customer_id);
		$this->db->where("order_id", '0');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}
		return $data['total'];		
	}

	function get_total_used($customer_id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select('SUM(amount) as spent');
		$this->db->from($table);
		$this->db->where("customer_id", $customer_id);
		$this->db->where("admin_id", '0');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}
		return $data['spent'];			
	}

}

?>