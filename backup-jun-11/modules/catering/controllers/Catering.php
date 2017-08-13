<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Catering extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
	}

	function index()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}
		$data['view_module'] = "catering";
		$data['view_file'] = "catering_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	function monthly_catering()
	{
		$data['heading'] = 'Monthly';
		$data['img_url'] = 'monthly_catering.jpg';
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "catering";
		$data['view_file'] = "catering_type_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	function buffet_catering()
	{
		$data['heading'] = 'Buffet';
		$data['img_url'] = 'buffet_catering.jpg';
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "catering";
		$data['view_file'] = "catering_type_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

}