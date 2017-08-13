<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cny extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
        $this->load->model('cny/cny_mdl', 'mcny');

        
	}

	public function index(){
		$data['contact_data'] = $this->mcny->get_cny();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "cny/cny_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}


}
?>