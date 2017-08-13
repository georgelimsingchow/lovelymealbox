<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends Member_Controller {

	function __construct() 
	{
		parent::__construct();
	}

	function date($that_day)
	{
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['output'] = $this->data_for_that_day($that_day);
		$data['view_module'] = "order";
		$data['view_file'] = "order_date_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	function data_for_that_day($data_date)
	{
		$data_date = date("Y-m-d",strtotime($data_date));
		$start_date = $data_date." 00:00:00";
		$end_date = $data_date." 23:59:59";
		// print_r($end_date);exit();
		$query_1 = "select * from daily_menu where menu_date between DATE('$start_date') and DATE('$end_date') LIMIT 1";
		$query1 = $this->_custom_query($query_1);
		foreach ($query1->result() as $row) {
			$data['daily_menu_id']	= $row->id;
			$data['menu_date'] 		= $row->menu_date;
			$data['slug'] 			= $row->slug;
			$data['picked_menu'] 	= json_to_array_english(json_decode($row->picked_menu,true));			
			$data['menu_last_date'] = $row->menu_last_date;
			$data['create_date'] 	= $row->create_date;
			$data['update_date'] 	= $row->update_date;
		}

		$query_2 = "select * from food_cart_detail where daily_menu_id = ".$data['daily_menu_id']." ORDER BY id DESC";
		$query2 = $this->_custom_query($query_2);

		foreach ($query2->result() as $key => $value) {
			$data['cart'][$key]['total']			= '0';
			$data['cart'][$key]['quantity'] 		= $value->quantity;
			$data['cart'][$key]['selected_menu'] 	= json_to_array_english(json_decode($value->selected_menu,true));
			$data['cart'][$key]['id'] 				= $value->id; 
			$data['cart'][$key]['single_price']     = $value->unit;
			$data['cart'][$key]['total']            += $value->quantity*$value->unit;
			
		}

		// print_r($data);exit();
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


		// validate all the boxes to get the price and the quantity
		$messages = $this->_box_validation();
		if ($messages['condition'] == 'success') {

			$meat 			= $user_input['meat'];
			$vege 			= $user_input['vege'];
			$meat_length 	= count($meat); 
			$vege_length 	= count($vege);			
			$quantity 		= $user_input['quantity'];
			$single_price 	= $messages['single_price'];
			$d_menu_id 		= $this->input->post('daily_menu_id');

			//check if this user has cart or not. if no cart, create one for the user
			$cart_id = $this->_insert_item_into_cart($user_input);				

			$selected_menu = array();
			if ($meat_length != '0') {
				foreach ($meat as $key => $value) {
					$selected_menu[]['id'] = $meat[$key];
				}
			}

			if ($vege_length != '0') {
				foreach ($vege as $key => $value) {
					$selected_menu[]['id'] = $vege[$key];
				}
			}

			$cart_detail = array(
				'user_id' => $this->mdl_usermodel->getId(),
				'daily_menu_id' => $d_menu_id,
				'food_cart_id' => $cart_id,
				'selected_menu' => json_encode($selected_menu),
				'quantity' => $quantity,
				'unit' => $single_price,			
				'create_date' => $this->get_time_now(),
				'update_date' => $this->get_time_now(),
				);


			$query = $this->db->insert('food_cart_detail', $cart_detail);
			echo json_encode($messages);
		}else{
			echo json_encode($messages);
		}
	
	}

	private function _insert_item_into_cart($data)
	{

		$where = array(
			'user_id' => $this->mdl_usermodel->getId(),
			'that_day_date' => $data['that_day_date'],
			'daily_menu_id' => $data['that_day_menu_id'],
			);

		$cart_id ='';

		// to check if this user for that day has cart or not
		$query = $this->db->get_where('food_cart', $where, '0', '1');
		$result = count($query->result());

		foreach ($query->result() as $row) {
			$cart_id = $row->food_cart_id;
		}

		if (empty($cart_id)) {
			$create_cart = array(
				'user_id' 		=> $this->mdl_usermodel->getId(),
				'that_day_date' => $data['that_day_date'],
				'daily_menu_id' => $data['that_day_menu_id'],
				'delivery_time' => '',
				'status' 		=> '',
				'create_date' 	=> $this->get_time_now(),
				'update_date' 	=> $this->get_time_now(),
				);
			$this->db->insert('food_cart', $create_cart);
			$cart_id = $this->db->insert_id();

			return $cart_id;
		}else{
			return $cart_id;
		}
	}

	private function _box_validation()
	{

		$meat = $this->input->post('meat');
		$vege = $this->input->post('vege');
		$quantity = $this->input->post('box-quantity');

		$vege_count = count($vege) ? count($vege):'0'; // e.g 0	
		$meat_count = count($meat) ? count($meat):'0'; // e.g 2			

		//always count vege followed by meat
		$combo_string = (string)$vege_count.$meat_count; //e.g 20

		//default is failed
		$status = "failed";
		$single_price = "0.00";
		$msg = array();

		if ($combo_string == '21') {
			$status = "success";
			$single_price = "5.50";			
		}

		if ($combo_string == '11') {
			$status = "success";
			$single_price = "5.50";			
		}

		if ($combo_string == '12') {
			$status = "success";
			$single_price = "6.00";			
		}

		if ($combo_string == '02') {
			$status = "success";
			$single_price = "6.00";		
		}

		if ($status == "success") {
			$msg['condition'] = $status;
			$msg['single_price'] = $single_price;
		}else{
			$msg['condition'] = $status;
			$msg['option_string'] = "Please select <strong>(1 vege 1 meat)</strong> <strong>(1 vege 2 meat)</strong> <strong>(2 vege 1 meat)</strong> <strong>(2 meat)</strong>";
		}

		return $msg;
	}

	function remove_item_from_cart()
	{
		$id = (int)$this->input->post('id');
		$this->db->delete('food_cart_detail', array('id' => $id,'user_id' => $this->mdl_usermodel->getId()));
	}

	function _custom_query($mysql_query) {
	$this->load->model('mdl_order');
	$query = $this->mdl_order->_custom_query($mysql_query);
	return $query;
	}

}