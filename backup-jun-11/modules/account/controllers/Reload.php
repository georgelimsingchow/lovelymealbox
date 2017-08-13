<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reload extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
	}

	public function index()
	{
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['reload_data'] = $this->_get_reload_data();
		$data['view_module'] = "account";
		$data['view_file'] = "reload/reload_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);		
	}

	private function _get_reload_data()
	{
		$data = array();
		$customer_id = $this->session->customer_id;
		$this->db->select('*');
		$this->db->from('balance');
		$this->db->where('customer_id',$customer_id);
		$this->db->where('admin_id !=','0');
		$this->db->where('order_id','0');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return $data;
	}

}
