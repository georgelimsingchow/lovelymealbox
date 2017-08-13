<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Customer_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	function get_table() 
	{
		$table_name = "customer";
		return $table_name;
	}

	function get_customer($customer_id,$column = '*')
	{
		$table = $this->get_table();

		$this->db->select($column);
		$this->db->from($table);
		$this->db->where("customer_id", $customer_id);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row();
	}

	function get_customers()
	{
		$table = $this->get_table();

		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by('customer_id','DESC');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) 
		{
			$row['name'] = $row['first_name']." ".$row['last_name'];
			$data[] = $row;
		}
		return $data;		
	}

	function get_customer_address($customer_id)
	{
		$data = array();

		$this->db->select('*');
		$this->db->from('customer_address');
		if (!empty($customer_id)) {
			$this->db->where("customer_id", $customer_id);
		}
		
		$this->db->order_by('id','DESC');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) 
		{
			$data[] = $row;
		}
		
		return $data;		
	}

	function select_box($column)
	{
		$data = array();
		$data[''] = 'Please Select';

		$this->db->select($column);
		$this->db->from('customer');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) 
		{
			$data[] = $row[$column];
		}
		

		return $data;	
	}




}
?>