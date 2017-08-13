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

		$this->db->select_sum('amount');
		$this->db->from($table);
		$this->db->where("customer_id", $customer_id);
		$this->db->where("amount >=", '132.00');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}

		return $data['amount'];		
	}

	function get_remaining($customer_id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select_sum('amount');
		$this->db->from($table);
		$this->db->where("customer_id", $customer_id);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}

		return $data['amount'];		
	}

}

?>