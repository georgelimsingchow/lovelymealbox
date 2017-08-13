<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
	}

	public function index()
	{
		$data['customer_data'] =  $this->_getCustomer();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "customer_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	private function _getCustomer()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('customer');
		$order_result = $this->db->get(); 

		foreach ($order_result->result_array() as $row) {
			$data[] = $row;
		}

		return $data;		
	}


}