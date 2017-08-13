<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Faq extends MX_Controller
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
		$data['view_module'] = "faq";
		$data['view_file'] = "faq_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

}