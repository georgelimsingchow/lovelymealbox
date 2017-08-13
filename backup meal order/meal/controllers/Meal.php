<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Meal extends Member_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model('meal/meal_mdl', 'mm');
	}


	public function index()
	{		
		redirect('home');
	}

	public function session($session)
	{
		$date = $this->input->get('date');

		$date_validation = $this->_validateDate($date);

		if (!$date_validation) {
			redirect('home');
		}

		if (($session == 'lunch')  || ($session == 'dinner')) {
			$data['menu'] = $this->mm->get_meal($session,$date);
		}

		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}

		$data['get_cart']    = $this->mm->get_cart($session,$date);
		$data['total']       = $this->mm->count_cart_total($session,$date);
		$data['view_module'] = "meal";
		$data['view_file']   = "meal_order_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}


	public function ajax_meal_add()
	{
		$meat = array();
		$vege = array();
		$user_input = array();

		// get user input and put into an array
		$user_input['meat'] 			= $this->input->post('meat') ? $this->input->post('meat') : array();
		$user_input['vege'] 			= $this->input->post('vege') ? $this->input->post('vege') : array();
		$user_input['quantity']			= $this->input->post('box-quantity');
		$user_input['session'] 		    = $this->input->post('session');
		$user_input['that_day_date']    = $this->input->post('that_day_date');

		// count meat and vege
		$count['v'] = count($user_input['vege']);
		$count['m'] = count($user_input['meat']);

		//generate dish code
		$string['v'] = str_repeat('v', $count['v']);
		$string['m'] = str_repeat('m', $count['m']);
		$user_input['code'] = $string['v'].$string['m'];


		// validate all the boxes to get the price and the quantity
		$msg = $this->mm->add_mealbox($user_input);

		echo json_encode($msg);exit;		
	}

	public function delete_item()
	{

		$id = $this->input->post('id');

		$del = $this->mm->del_item($id);

		if ($del) {
			$msg['status'] = 'success';
			echo json_encode($msg);
		}else{
			$msg['status'] = 'failed';
			echo json_encode($msg);
		}
	}


	private function _validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

}