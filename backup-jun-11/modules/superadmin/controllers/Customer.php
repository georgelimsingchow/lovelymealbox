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
        $this->load->model('customer/customer_mdl', 'customer');
        $this->load->model('order/order_mdl', 'mOrder');
        $this->load->model('reload/reload_mdl', 'reload');
	}

	public function index()
	{
		$data['customer_data'] =  $this->customer->get_customers();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "customer/customer_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function info()
	{
		$customer_id   = $this->input->get('customer_id',TRUE);
		$data['cdata'] = $this->customer->get_customer($customer_id);
		$data['view_module'] = "superadmin";
		$data['tab']   = "customer/info_tab_page";
		$data['view_file']   = "customer/customer_detail_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function order()
	{
		$customer_id = $this->input->get('customer_id',TRUE);
		$data['customer_order'] = $this->mOrder->get_customer_order($customer_id);

		$data['view_module'] = "superadmin";
		$data['tab']   = "customer/order_tab_page";
		$data['view_file'] = "customer/customer_detail_page";
		$this->load->module("templates");
		$this->templates->admin($data);		
	}

	public function reload()
	{
		$data['customer_id'] = $this->input->get('customer_id',TRUE);

		$data['balance'] = $this->reload->get_customer_balance($data['customer_id']);

		$data['view_module'] = "superadmin";
		$data['tab']   = "customer/reload_tab_page";
		$data['view_file'] = "customer/customer_detail_page";
		$this->load->module("templates");
		$this->templates->admin($data);			
	}

	public function address()
	{
		$data['customer_id'] = $this->input->get('customer_id',TRUE);

		$data['customer_address'] = $this->customer->get_customer_address($data['customer_id']);

		$data['view_module'] = "superadmin";
		$data['tab']   = "customer/address_tab_page";
		$data['view_file'] = "customer/customer_detail_page";
		$this->load->module("templates");
		$this->templates->admin($data);			
	}


}