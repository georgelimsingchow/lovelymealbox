<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Checkout extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->module('settings');
		$this->form_validation->CI =& $this;
		$this->load->model('checkout/checkout_mdl', 'checkout');
		$this->load->model('meal/meal_mdl', 'mm');
		$this->current_user_id = $this->mdl_usermodel->getId();
	}

	public function lunch()
	{
		// config
		$date = $this->input->get('date');
		$session = 'lunch';
		$date_validation = $this->_validateDate($date);
		$checkout_detail = $this->checkout->get_checkout_cart($session,$date);
		$total           = $this->mm->count_cart_total($session,$date);
		$data['name']    = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();		

		if (!$date_validation) {
			redirect('home');
		}

		if (empty($checkout_detail)) {
			$redirect = $session."?date=$date";
			redirect($redirect);
		}

		$this->form_validation->set_rules('checkout_address', 'checkout_address','required', array('required' => 'Please pick one or create new address'));
		$this->form_validation->set_rules('payment_option', 'payment_option', 'required',array('required' => 'Please pick one payment option'));

        if ($this->form_validation->run() == FALSE)
        {
        	
			$data['customer_address'] = getAddress($this->current_user_id);
			$data['checkout_detail']  = $checkout_detail;
			$data['total']            = $total;
			$data['view_module'] 	  = "checkout";
			$data['view_file'] 		  = "session_checkout_page";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);	 
        }
        else
        {
        	$insert['payment_option']   = $this->input->post('payment_option');
        	$insert['that_day_date']    = $this->input->post('that_day_date');
        	$insert['checkout_address'] = $this->input->post('checkout_address');
        	$insert['session']          = $this->input->post('session');
        	$insert['comment']          = $this->input->post('comment');

        	$add_to_order = $this->checkout->add_to_order($insert,$total);

        	if ($add_to_order) {
        		redirect('account/order/');
        	}



        }



	}

	public function dinner()
	{
		// config
		$date = $this->input->get('date');
		$session = 'dinner';
		$date_validation = $this->_validateDate($date);
		$checkout_detail = $this->checkout->get_checkout_cart($session,$date);
		$total           = $this->mm->count_cart_total($session,$date);
		$data['name']    = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();



		if (!$date_validation) {
			redirect('home');
		}

		if (empty($checkout_detail)) {
			$redirect = $session."?date=$date";
			redirect($redirect);
		}

		$this->form_validation->set_rules('checkout_address', 'checkout_address','required', array('required' => 'Please pick one or create new address'));
		$this->form_validation->set_rules('payment_option', 'payment_option', 'required',array('required' => 'Please pick one payment option'));

        if ($this->form_validation->run() == FALSE)
        {
        	
			$data['customer_address'] = getAddress($this->current_user_id);
			$data['checkout_detail']  = $checkout_detail;
			$data['total']            = $total;
			$data['view_module'] 	  = "checkout";
			$data['view_file'] 		  = "session_checkout_page";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);	 
        }
        else
        {
        	$insert['payment_option']   = $this->input->post('payment_option');
        	$insert['that_day_date']    = $this->input->post('that_day_date');
        	$insert['checkout_address'] = $this->input->post('checkout_address');
        	$insert['session']          = $this->input->post('session');
        	$insert['comment']          = $this->input->post('comment');

        	$add_to_order = $this->checkout->add_to_order($insert,$total);

        	if ($add_to_order) {
        		redirect('account/order/');
        	}
        }
	}


	private function _validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}


}