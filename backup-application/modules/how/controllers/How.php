<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class How extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->model('user_model/mdl_usermodel');
	}

	function index()
	{
		redirect('how/order');
	}

	public function order()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}
		$data['view_module'] = "how";
		$data['view_file'] = "how_to_order_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function reload()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}
		$data['view_module'] = "how";
		$data['view_file'] = "how_to_reload_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

}