<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cny extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
	}

	function index()
	{
		$data['cny_order'] = $this->cny_order();
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "account";
		$data['view_file'] = "cny/cny_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	private function cny_order()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('cny');
		$this->db->where('customer_id', $this->session->customer_id);
		$this->db->order_by("create_date","desc");
		$query = $this->db->get();

		foreach ($query->result_array() as $row)
		{
			$data[] = $row;
		}

		return $data;
	}

}