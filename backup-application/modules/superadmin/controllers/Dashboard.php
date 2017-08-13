<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
	}

	function index(){
		$data['total_user'] = $this->total_user();
		$data['total_cart'] = $this->total_cart();
		$data['total_menu'] = $this->total_menu();
		$data['total_order'] = $this->total_order();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "dashboard_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	private function total_user()
	{
		$total_customer = '';
		$this->db->select('COUNT(*) as total');
		$this->db->from('customer');
		$customer_result = $this->db->get(); 

		foreach ($customer_result->result() as $row) {
			$total_customer = $row->total;
		}

		return $total_customer;
	}

	private function total_cart()
	{
		$total_cart = '';
		$this->db->select('COUNT(*) as total');
		$this->db->from('food_cart_detail');
		$this->db->where('status', 'in_cart');
		$customer_result = $this->db->get(); 

		foreach ($customer_result->result() as $row) {
			$total_cart = $row->total;
		}

		return $total_cart;	
	}

	private function total_order()
	{
		$total_order = '';
		$this->db->select('COUNT(*) as total');
		$this->db->from('meal_order');
		$order_result = $this->db->get(); 

		foreach ($order_result->result() as $row) {
			$total_order = $row->total;
		}

		return $total_order;			
	}

	private function total_menu()
	{
		$total_food_menu = '';
		$this->db->select('COUNT(*) as total');
		$this->db->from('food_menu');
		$menu_result = $this->db->get(); 

		foreach ($menu_result->result() as $row) {
			$total_food_menu = $row->total;
		}

		return $total_food_menu;		
	}


}