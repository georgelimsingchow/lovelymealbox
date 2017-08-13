<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MX_Controller
{
	private $time_now = null;

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
		$this->load->library('form_validation');
		// if ($this->session->userdata('customer_logged_in'))
  //       { 
  //           redirect('home','refresh');
  //       }
	}

	function index()
	{		
		session_destroy();
		redirect('home','refresh');
	}














}