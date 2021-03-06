<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MX_Controller
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
		$data['daily_menu_details'] = $this->_daily_menu();


		// print_r($data['daily_menu_details']);exit;
		$data['view_module'] = "home";
		$data['view_file'] = "home_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);

	}

	private function _daily_menu()
	{
		$modified_week = array();
		$week = array(
			'MONDAY' => 'next monday',
			'TUESDAY' => 'next tuesday',
			'WEDNESDAY' => 'next wednesday',
			'THURSDAY' => 'next thursday',
			'FRIDAY' => 'next friday',
			'SATURDAY' => 'next saturday',
			// 'SUNDAY' => 'next sunday',
			);

		foreach ($week as $key => $value) {
			$date = date("Y-m-d",strtotime($value));
			$modified_week[$key] = $this->_get_daily_menu_details($date);
			$modified_week[$key]['sub_date'] = $date;
		}

		return $modified_week;
	}

	private function _get_daily_menu_details($date)
	{


		$data = array();
		$normal_date = date("Y-m-d",strtotime($date));

		$data = array();

		// LUNCH
		$this->db->select('*');
		$this->db->from('daily_menu');
		$this->db->where('slug', $normal_date);
		$this->db->where('status', '1');
		$this->db->where('session', 'lunch');
		// custom where expiry date
		$where = "expire_date > '$this->time_now'";
		$this->db->where($where);
		$this->db->limit(1);
		$lunch = $this->db->get();

		foreach ($lunch->result_array() as $row) {
			$data['lunch'] = $row;
		}

		// DINNER
		$this->db->select('*');
		$this->db->from('daily_menu');
		$this->db->where('slug', $normal_date);
		$this->db->where('status', '1');
		$this->db->where('session', 'dinner');
		// custom where expiry date
		$where = "expire_date > '$this->time_now'";
		$this->db->where($where);
		$this->db->limit(1);
		$dinner = $this->db->get();

		foreach ($dinner->result_array() as $row) {
			$data['dinner'] = $row;
		}

		return $data;
	}


}