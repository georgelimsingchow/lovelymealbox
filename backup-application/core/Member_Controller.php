<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";

class Member_Controller extends MX_Controller {
	private $time_now = null;
	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('user_model/mdl_usermodel');		
		$this->time_now = date('Y-m-d H:i:s');
		if ( !$this->session->userdata('customer_logged_in'))
        { 
            redirect('login','refresh');
        }
	}


	public function get_time_now()
	{
		return $this->time_now;
	}

}

?>