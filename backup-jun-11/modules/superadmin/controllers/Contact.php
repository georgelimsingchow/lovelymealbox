<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
        $this->load->model('contact/contact_mdl', 'mcontact');

        
	}

	public function index(){
		$data['contact_data'] = $this->mcontact->get_contact();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "contact/contact_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}


}
?>