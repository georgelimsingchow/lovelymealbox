<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Checkout extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->module('settings');
		$this->form_validation->CI =& $this;
	}

	function index()
	{
		$user_id = $this->session->customer_id;
		$submit = $this->input->post('submit');

		// chec if they have minimum order
		if ($this->settings->minimum_order($user_id) == false) {
			redirect('cart');
		}

		if ($submit == 'submit') {

			$this->form_validation->set_rules('checkout_address', 'checkout_address', 'required',array('required' => 'Please pick one or create new address'));
			$this->form_validation->set_rules('payment_option', 'payment_option', 'required|callback_payment_option_check',array('required' => 'Please choose a payment option'));
			$this->form_validation->set_rules('delivery_session', 'delivery_session', 'required',array('required' => 'Please pick a delivery session'));

			

	        if ($this->form_validation->run() == FALSE)
	        {
	        	$this->_repeat_view($user_id);	
	        }else{
	        	$insert['order_number']		= "MB-INV-".date('YmdHis')."".$this->mdl_usermodel->getId();
	        	$insert['customer_id'] 		= $this->session->customer_id;
				$insert['payment_option']	= $this->input->post('payment_option',TRUE);
				$insert['delivery_session'] = $this->input->post('delivery_session',TRUE);
				$insert['date_key']			= $this->input->post('date_key',TRUE);
				$insert['checkout_address'] = $this->input->post('checkout_address',TRUE);
				$insert['comment']			= $this->input->post('comment',TRUE);

				if ($insert['payment_option'] == 'transfer') {
					$order_status = 'processing';
				}
				if ($insert['payment_option'] == 'credit') {
					$order_status = 'paid';
				}

				// convert to array 
				$data['details'] 	      = $this->_get_single_address($insert['checkout_address'],$insert['customer_id']);
				$data['total_amount']     = count_total_amount($insert['customer_id']);
				$data['customer_balance'] = get_amount($insert['customer_id']);

				$insert_order = array(
					'customer_id'       => $insert['customer_id'],
					'order_no'			=> $insert['order_number'],
					'firstname'         => $this->mdl_usermodel->getFirstName(),
					'lastname'          => $this->mdl_usermodel->getLastName(),
					'email'             => $this->mdl_usermodel->getEmail(),
					'phone'             => $data['details']['mobile_no'] 	? $data['details']['mobile_no'] : $this->mdl_usermodel->getPhone(),
					'payment_firstname' => $data['details']['firstname'] 	? $data['details']['firstname'] : '',
					'payment_lastname'  => $data['details']['lastname'] 	? $data['details']['lastname']  : '',
					'payment_address_1' => $data['details']['address_1'] 	? $data['details']['address_1'] : '',
					'payment_address_2' => $data['details']['address_2'] 	? $data['details']['address_2'] : '',
					'payment_city'      => $data['details']['city'] 		? $data['details']['city']      : '',
					'payment_postcode'  => $data['details']['postcode'] 	? $data['details']['postcode']  : '',
					'payment_state'     => $data['details']['state_id'] 	? $data['details']['state_id']  : '',
					'payment_phone'     => $data['details']['mobile_no'] 	? $data['details']['mobile_no'] : '',
					'payment_option'	=> $insert['payment_option'] 		? $insert['payment_option']     :'',
					'delivery_session'  => $insert['delivery_session']		? $insert['delivery_session']	: '0',
					'delivery_fee'      => deliveryfee() 					? deliveryfee() 				: '0',
					'comment'           => $insert['comment']				? $insert['comment']            : '',
					'total'				=> $data['total_amount'] ,
					'order_status'      => $order_status,
					'create_date'       => $this->get_time_now(),
					'update_date'       => $this->get_time_now(),
					);

				$this->db->trans_begin();

				$this->db->insert('meal_order', $insert_order);
				$order_id = $this->db->insert_id();

				
				/*
					if user choose payment option is credit
					balance will have record.
				*/
				if ($insert['payment_option'] == 'credit') {					
					$insert_balance = array(
						'order_id' => $order_id,
						'admin_id' => '0',
						'customer_id' => $insert['customer_id'],
						'description' => $insert['order_number'],
						'amount'      => sprintf('%0.2f',-$data['total_amount']-deliveryfee()),
						'create_date' => $this->get_time_now(),
						);
					$this->db->insert('balance', $insert_balance);
				}
				
				$cart_data = array();
				$this->db->select('*');
				$this->db->from('food_cart_detail');
				$this->db->where('status', 'in_cart');
				$this->db->where_in('that_day_date', $insert['date_key']);
				$cart_result = $this->db->get(); 

				foreach ($cart_result->result_array() as $row)
				{
					$cart_data[] = $row;
				}

				foreach ($cart_data as $key => $value) {

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
				        'total' 		=> sprintf('%0.2f',($value['unit']*$value['quantity'])),
				        'that_day_date' => $value['that_day_date'],
				        'daily_menu_id' => $value['daily_menu_id'],
					);

					$this->db->insert('meal_order_product', $insert_to_product_date);
				}

				if ($this->db->trans_status() === FALSE)
				{
				        $this->db->trans_rollback();
				}
				else{
				        $this->db->trans_commit();
				        redirect('account/order/');
				}
	        }

		}else{
			$this->_repeat_view($user_id);		
		}
	
	}

	private function _repeat_view($user_id)
	{
		$data['name'] 			  = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['customer_address'] = getAddress($user_id);			
		$data['fifty'] 			  = fifty();
		$data['cart_details'] 	  = get_cart($user_id);
		$data['hidden_date']      = $this->_get_cart_date($data['cart_details']);		
		$data['total_amount'] 	  = count_total_amount($user_id);
		$data['view_module'] 	  = "checkout";
		$data['view_file'] 		  = "checkout_page";

		$this->load->module("templates");
		$this->templates->public_bootstrap($data);		
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

	private function _get_cart_date($data)
	{
		$date_detail = array();
		foreach ($data as $key => $value) {
			$date_detail[] = $key;
		}

		return $date_detail;
	}

	public function payment_option_check($option)
	{

		$customer_id = $this->session->customer_id;

		// customer credit
		if ($option == 'credit') {
			$data['total_expenses'] = sprintf('%0.2f',count_total_amount($customer_id)+deliveryfee()); // added delivery fee
			$data['total_balance'] = get_amount($customer_id);

			if ($data['total_balance'] >= $data['total_expenses']) {
				return TRUE;
			}else{
				$this->form_validation->set_message('payment_option_check', "You only have RM ".$data['total_balance']." in your account");
                return FALSE;
			}
		}

		// online bank transfer
		if ($option == 'transfer') {
			$data['total_expenses'] = sprintf('%0.2f',count_total_amount($customer_id)+deliveryfee()); // added delivery fee 
			if ($data['total_expenses'] < '20.00') {
				$this->form_validation->set_message('payment_option_check', "Spend at least RM 20.00 and above.");
                return FALSE;				
			}else{
				return TRUE;
			}
		}
	}


}