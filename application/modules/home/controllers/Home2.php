<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home2 extends MX_Controller
{
	private $time_now = null;

	function __construct() 
	{
		parent::__construct();
		$this->load->model('user_model/mdl_usermodel');
		$this->time_now = date('Y-m-d H:i:s');
	}

	function index()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}
		$data['view_module'] = "home";
		$data['view_file'] = "home_page2";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);

	}

	private function _selectbox_daily_menu()
	{

		// show 3 days on home page
		$days = '7';
		$expiry_date = date("Y-m-d")." 22:00:00";
		$data_date = array();
		$filter_date = array();	

		for ($i=0; $i < $days; $i++) { 

			if ($i == '0') {
				$date = date("Y-m-d H:i:s");
			}else{
				$date = date("Y-m-d",strtotime("+$i day"))." 22:00:00";
			}

			$data_date[] = $date;
		}

		foreach ($data_date as $key => $single_date) {

			if ((date('Y-m-d',strtotime($single_date)) == date('Y-m-d')) && ($single_date >= $expiry_date)) {
			}else{

				if ('Sun' != date('D',strtotime($single_date))) {
					$filter_date[] = $single_date;
				}
				
			}
		}

		return $filter_date;
	}


}