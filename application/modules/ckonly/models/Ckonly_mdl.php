<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ckonly_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
	}


	public function report($date)
	{

		$data = array();
		$this->db->select('*');
		$this->db->from('meal_order');
		$this->db->where('meal_order_product.that_day_date', $date);
		$this->db->join('meal_order_product', 'meal_order_product.order_id = meal_order.order_id');
		$this->db->join('customer', 'customer.customer_id = meal_order.customer_id');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {

			$data[$row['order_no']]['mbr'] = $row['account_no'];
			$data[$row['order_no']]['name'] = $row['payment_firstname']." ".$row['payment_lastname'];
			$data[$row['order_no']]['date'] = $row['that_day_date'];
			$data[$row['order_no']]['address_1'] = $row['payment_address_1'];
			$data[$row['order_no']]['address_2'] = $row['payment_address_2'];
			$data[$row['order_no']]['status'] = $row['order_status'];
			$data[$row['order_no']]['meal'][] = array(
				'menu' => $row['selected_menu'],
				'qty' => $row['quantity'],
				'single_price' => $row['price'],
				'total' => $row['price']*$row['quantity'],
				);
		}


		// print_r($data);exit;

		return $data;	

	}




}

?>