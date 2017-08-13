<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Controller.php";

class Admin_Controller extends MX_Controller {
	private $time_now = null;
	
	function __construct() 
	{
		parent::__construct();	
		$this->time_now = date('Y-m-d H:i:s');
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
	}


	public function get_time_now()
	{
		return $this->time_now;
	}

}

?>