<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
		$this->current_user_id = $this->mdl_usermodel->getId();
	}

	public function get_checkout_cart($session,$date)
	{
		$data = array();

		$this->db->select('*');
		$this->db->from('food_cart_detail');
		$this->db->where('status', 'in_cart');
		$this->db->where('session', $session);
		$this->db->where('that_day_date', $date);
		$this->db->where('user_id', $this->current_user_id);
		// custom where expiry date
		$where = "expire_date > '$this->time_now'";
		$this->db->where($where);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		
		return $data;			
	}


	public function add_to_order($data,$total)
	{
		//config
		$from_address = $this->_get_single_address($data['checkout_address'],$this->current_user_id);
		$order_no     = "MB-INV-".date('YmdHis')."".$this->current_user_id;

		//transfer or credit
		if ($data['payment_option'] == 'transfer') {
			$delivery_fee = deliveryfee();
			$order_status = 'processing';
		}else{
			$delivery_fee = '0';
			$order_status = 'paid';
		}



		$insert_order = array(
			'customer_id'       => $this->current_user_id,
			'order_no'          => $order_no,
			'firstname'         => $this->mdl_usermodel->getFirstName(),
			'lastname'          => $this->mdl_usermodel->getLastName(),
			'email'             => $this->mdl_usermodel->getEmail(),
			'phone'             => $from_address['mobile_no'] 	? $from_address['mobile_no'] : $this->mdl_usermodel->getPhone(),
			'payment_firstname' => $from_address['firstname'] 	? $from_address['firstname'] : '',
			'payment_lastname'  => $from_address['lastname'] 	? $from_address['lastname']  : '',
			'payment_address_1' => $from_address['address_1'] 	? $from_address['address_1'] : '',
			'payment_address_2' => $from_address['address_2'] 	? $from_address['address_2'] : '',
			'payment_city'      => $from_address['city'] 		? $from_address['city']      : '',
			'payment_postcode'  => $from_address['postcode'] 	? $from_address['postcode']  : '',
			'payment_state'     => $from_address['state_id'] 	? $from_address['state_id']  : '',
			'payment_phone'     => $from_address['mobile_no'] 	? $from_address['mobile_no'] : '',
			'payment_option'	=> $data['payment_option'] 	    ? $data['payment_option']     :'',
			'delivery_session'  => $data['session'],
			'delivery_fee'      => $delivery_fee,
			'comment'           => $data['comment']				? $data['comment']            : '',
			'total'				=> $total['total'],
			'order_status'      => $order_status,
			'create_date'       => $this->time_now,
			'update_date'       => $this->time_now,

			);

			$this->db->insert('meal_order', $insert_order);
			$order_id = $this->db->insert_id();			
			/*
				if user choose payment option is credit
				balance will have record.
			*/
			if ($data['payment_option'] == 'credit') {					
				$insert_balance = array(
					'order_id' => $order_id,
					'admin_id' => '0',
					'customer_id' => $this->current_user_id,
					'description' => $order_no,
					'amount'      => sprintf('%0.2f',-$total['total']-$delivery_fee),
					'create_date' => $this->time_now,
					);
				$this->db->insert('balance', $insert_balance);
			}


			$cart_data = array();
			$this->db->select('*');
			$this->db->from('food_cart_detail');
			$this->db->where('status', 'in_cart');
			$this->db->where('session', $data['session']);
			$this->db->where('user_id', $this->current_user_id);
			$this->db->where('that_day_date', $data['that_day_date']);
			$cart_result = $this->db->get(); 

			foreach ($cart_result->result_array() as $row)
			{
				$cart_data[] = $row;
			}

			foreach ($cart_data as $key => $value) 
			{

				$update_cart = array(
				    'status' => 'to_order',
				);

				$this->db->where('id', $value['id']);
				$this->db->update('food_cart_detail', $update_cart);

				$insert_to_product_date = array(
			        'order_id' 		=> $order_id,
			        'selected_menu' => $value['selected_menu'],
			        'quantity' 		=> $value['quantity'],
			        'price' 		=> $value['unit'],
			        'type'			=> $value['type'],
			        'total' 		=> sprintf('%0.2f',($value['unit']*$value['quantity'])),
			        'that_day_date' => $value['that_day_date'],
			        'daily_menu_id' => '0',
				);

				$this->db->insert('meal_order_product', $insert_to_product_date);
			}

			return true;

	}


	private function _get_single_address($address_id,$customer_id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('customer_address');
		$this->db->where('id', $address_id);
		$this->db->where('customer_id', $customer_id);
		$this->db->limit(1);

		$address_result = $this->db->get(); 

		foreach ($address_result->result() as $row)
		{
            $data['firstname'] = $row->firstname;
            $data['lastname']  = $row->lastname;
            $data['mobile_no'] = $row->mobile_no;
            $data['address_1'] = $row->address_1;
            $data['address_2'] = $row->address_2;
            $data['city']      = $row->city;
            $data['postcode']  = $row->postcode;
            $data['state_id']  = $row->state_id;
		}

		return $data;

	}


}

?>