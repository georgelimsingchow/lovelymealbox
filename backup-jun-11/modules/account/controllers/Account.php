<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Account extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
	}

	function index()
	{
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "account";
		$data['view_file'] = "account_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

}