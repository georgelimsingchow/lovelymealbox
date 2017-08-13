<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Order_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	function get_table() 
	{
		$data['mo'] = "meal_order";
		$data['mop'] = "meal_order_product";
		return $data;
	}

	function get_single_order($order_id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select('*');
		$this->db->from($table['mo']);
		// $this->db->join($table['mop'], "$table[mop].order_id = $table[mo].order_id");
		$this->db->where("order_id", $order_id);
		$this->db->limit(1);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$row['details'] = $this->get_order_details($row['order_id']);
			$row['total_amount'] = $this->get_order_total($row['order_id']);
			$data = $row;
		}
		// print_r($data);exit();
		return $data;
	}

	function get_that_day_that($order_id)
	{
		$table = $this->get_table();
		$this->db->select('*');
		$this->db->from($table['mop']);
		$this->db->where("order_id", $order_id);
		$this->db->limit(1);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$that_day_that = $row['that_day_date'];
		}
		
		return $that_day_that;	
	}



	function get_order_details($order_id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select('*');
		$this->db->from($table['mop']);
		$this->db->where("order_id", $order_id);
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return $data;

	}

	function get_order_total($order_id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select('SUM(total) AS total_amount');
		$this->db->from($table['mop']);
		$this->db->where("order_id", $order_id);
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data = $row['total_amount'];
		}
		
		return $data;
	}

	function count_order_status($order_status = 'ALL')
	{
		$table = $this->get_table();

		if ($order_status != 'ALL') {
			$this->db->where('order_status', $order_status);
		}		
		$query=$this->db->get($table['mo']);
		$num_rows = $query->num_rows();

		return $num_rows;	
	}

	function get_customer_order($customer_id)
	{		
		$table = $this->get_table();
		$data = array();

		$this->db->select('*');
		$this->db->from($table['mo']);
		$this->db->where('customer_id', $customer_id);
		$query = $this->db->get();
		
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return $data;
	}

	function count_ordered_meal($date,$session = null)
	{
		$table = $this->get_table();
		$data_1 = array();
		$this->db->select('meal_order_product.selected_menu, meal_order_product.type, meal_order_product.quantity, meal_order.delivery_session');
		$this->db->from('meal_order');
		$this->db->join('meal_order_product', "meal_order_product.order_id = meal_order.order_id");
		$this->db->where('that_day_date', $date);
		$query = $this->db->get();
		
		foreach ($query->result_array() as $row) {

			$row['selected_menu'] = json_decode($row['selected_menu']);

			if ($row['delivery_session'] == 'lunch') {
				if ($row['type'] == 'mealbox') {
					$data_1['lunch']['mealbox'][] = $row['selected_menu'];
				}else{
					$data_1['lunch']['alacarte'][] = $row['selected_menu'];
				}
			 	
			}

			if ($row['delivery_session'] == 'dinner') {
				if ($row['type'] == 'mealbox') {
					$data_1['dinner']['mealbox'][] = $row['selected_menu'];
				}else{
					$data_1['dinner']['alacarte'][] = $row['selected_menu'];
				}
			 } 
			
		}

		return $data_1;
	}


}

?>