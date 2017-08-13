<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->module('settings');
	}

	function index()
	{
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['fifty'] = fifty();
		$data['cart_details'] = get_cart($this->session->customer_id);
		$data['view_module'] = "cart";
		$data['view_file'] = "cart_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function remove()
	{

		$id = $this->input->post('key');
		$this->db->where('id', $id);
		$this->db->delete('food_cart_detail');

	}

	public function update()
	{
		$id = $this->input->post('key');
		$value = $this->input->post('value');

		$this->db->set('quantity',(int) $value, FALSE);
		$this->db->where('id', $id);
		$this->db->update('food_cart_detail');
	}

}