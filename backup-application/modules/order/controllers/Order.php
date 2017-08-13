<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Member_Controller {

	function __construct() 
	{
		parent::__construct();
	}

	function date($that_day)
	{

		//check if other order in the cart 
		// if so , please ask customer to complete before continue second order

		if ($this->_check_match_date($this->session->customer_id,$that_day) == false) {
			$data['message'] = "Please complete one transction or remove item from shopping cart";
		}

		if ($this->check_order_expire($that_day) == true) {
			redirect('home','refresh');
		}else{
			$data['order_date'] = $that_day;
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
			$data['output'] = $this->data_for_that_day($that_day);
			$data['view_module'] = "order";
			$data['view_file'] = "order_date_page";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);		
		}	

	}

	function data_for_that_day($data_date)
	{
		$now = $this->get_time_now();
		$data_date = date("Y-m-d",strtotime($data_date));
		$start_date = $data_date." 00:00:00";
		$end_date = $data_date." 23:59:59";
		$query_1 = "select * from daily_menu where menu_date between DATE('$start_date') and DATE('$end_date') LIMIT 1";
		$query1 = $this->_custom_query($query_1);
		foreach ($query1->result() as $row) {
			$data['daily_menu_id']	= $row->id;
			$data['menu_date'] 		= $row->menu_date;
			$data['slug'] 			= $row->slug;
			$data['picked_menu'] 	= json_to_array_english(json_decode($row->picked_menu,true));			
			$data['expire_date'] 	= $row->expire_date;
			$data['create_date'] 	= $row->create_date;
			$data['update_date'] 	= $row->update_date;
		}

		$query_2 = "select * from food_cart_detail where daily_menu_id = ".$data['daily_menu_id']." AND status = 'in_cart' AND user_id = ".$this->session->customer_id." AND expire_date > '$now' ORDER BY id DESC";
		$query2 = $this->_custom_query($query_2);

		foreach ($query2->result() as $key => $value) {
			$data['cart'][$key]['total']			= '0';
			$data['cart'][$key]['quantity'] 		= $value->quantity;
			$data['cart'][$key]['selected_menu'] 	= json_to_array_english(json_decode($value->selected_menu,true));
			$data['cart'][$key]['id'] 				= $value->id; 
			$data['cart'][$key]['single_price']     = $value->unit;
			$data['cart'][$key]['total']            += $value->quantity*$value->unit;
			
		}
		return $data;
	}
	
	function order_ajax_add()
	{
		$meat = array();
		$vege = array();
		$user_input = array();

		// get user input and put into an array
		$user_input['meat'] 			= $this->input->post('meat');
		$user_input['vege'] 			= $this->input->post('vege');
		$user_input['quantity']			= $this->input->post('box-quantity');
		$user_input['that_day_menu_id'] = $this->input->post('daily_menu_id');
		$user_input['that_day_date']    = $this->input->post('that_day_date');

		// count meat and vege
		$count['v'] = count($user_input['vege']);
		$count['m'] = count($user_input['meat']);

		//generate dish code
		$string['v'] = str_repeat('v', $count['v']);
		$string['m'] = str_repeat('m', $count['m']);
		$string['code'] = $string['v'].$string['m'];

		
		// validate all the boxes to get the price and the quantity
		$msg = $this->_box_validation($string['code']);

		if ($msg['condition'] == 'success') {
			$vege 			= $user_input['vege'];
			$meat 			= $user_input['meat'];

			$selected_menu = array();
			if ($count['v'] != '0') {
				foreach ($vege as $key => $value) {
					$selected_menu[]['id'] = $vege[$key];
				}
			}
			if ($count['m'] != '0') {
				foreach ($meat as $key => $value) {
					$selected_menu[]['id'] = $meat[$key];
				}
			}

			$cart_detail = array(
				'user_id' => $this->mdl_usermodel->getId(),
				'daily_menu_id' => $user_input['that_day_menu_id'],
				'that_day_date' => $user_input['that_day_date'],
				'selected_menu' => json_encode($selected_menu),				
				'unit'          => $msg['single_price'],
				'quantity'      => $user_input['quantity'],			
				'create_date'   => $this->get_time_now(),
				'expire_date'   => date('Y-m-d',(strtotime ( '-1 day', strtotime($user_input['that_day_date']))))." 20:00:00",
				);

			$query = $this->db->insert('food_cart_detail', $cart_detail);
			echo json_encode($msg);
		}else{
			echo json_encode($msg);
		}
	
	}

	private function _box_validation($food_code)
	{
		// find food code in database
		$this->db->select('amount');
		$this->db->from('mealbox_price');
		$this->db->where('code', $food_code);
		$box_price_query = $this->db->get();

		foreach ($box_price_query->result() as $row) {
			$box_price = $row->amount;
		}

		if (!isset($box_price)) {
			$msg['condition'] = 'failed';
			$msg['option_string'] = "Please select <strong>(1 vege 1 meat)</strong> <strong>(1 vege 2 meat)</strong> <strong>(2 vege 1 meat)</strong> <strong>(2 meat)</strong>";
			return $msg;
		}else{
			$msg['condition'] = 'success';
			$msg['single_price'] = $box_price;
			return $msg;
		}
	}

	function remove_item_from_cart()
	{
		$id = (int)$this->input->post('id');
		$this->db->delete('food_cart_detail', array('id' => $id,'user_id' => $this->mdl_usermodel->getId()));
	}

	private function check_order_expire($date = null)
	{
		if ($date == null) {
			return false;
		}else{
			$data = array();
			$this->db->select('*');
			$this->db->from('daily_menu');
			$this->db->where('status', '1');
			$this->db->where('slug', $date);
			// custom where expiry date
			$where = "expire_date > '".$this->get_time_now()."'";
			$this->db->where($where);	
			$daily_menu_result = $this->db->get(); 

			foreach ($daily_menu_result->result_array() as $row) {
				$data[] = $row;
			}

			$result = count($data);

			if ($result == '0') {
				return true;
			}else{
				return false;
			}	
		}
	}


	function _custom_query($mysql_query) {
	$this->load->model('mdl_order');
	$query = $this->mdl_order->_custom_query($mysql_query);
	return $query;
	}


	private function _check_match_date($customer_id,$date)
	{
		$cart = array();
		$this->db->select('*');
		$this->db->from('food_cart_detail');
		$this->db->where('status', 'in_cart');
		$this->db->where('user_id', $customer_id);
		$where = "expire_date > '".$this->get_time_now()."'";
		$this->db->where($where);

		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$cart[] = $row;
		}

		if (empty($cart)) {
			return true;
		}

		if ($cart['0']['that_day_date'] == $date || empty($cart)) {
			return true;
		}else{
			return false;
		}

	}
}