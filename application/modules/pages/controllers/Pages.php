<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MX_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
		$this->load->model('user_model/mdl_usermodel');
		$this->load->model('pages/pages_mdl', 'pages');
		$this->load->model('superadmin/customer/customer_mdl', 'customer');
		$this->load->library('form_validation');
	}

	public function tomorrow_menu()
	{
		$tomorrow = date("Y-m-d", time() + 86400);
		$tomorrow_data = array();


		$this->db->select('*');
		$this->db->from('daily_menu');
		$this->db->where('slug', $tomorrow);
		$this->db->where('status', '1');
		// custom where expiry date
		$where = "expire_date > '$this->time_now'";
		$this->db->where($where);
		$lunch = $this->db->get();

		foreach ($lunch->result_array() as $row) {
			if ($row['session'] == 'lunch') {
				$tomorrow_data['lunch'] = $row;
			}
			if ($row['session'] == 'dinner') {
				$tomorrow_data['dinner'] = $row;
			}
			
		}

		$data['page_title'] = 'Menu | '.$tomorrow;	
		$data['next_day'] = $tomorrow;
		$data['tomorrow_data'] = $tomorrow_data;
		$data['view_module'] = "pages";
		$data['view_file'] = "tomorrow_menu_page";
		$this->load->module("templates");
		$this->templates->report($data);
	}

	public function monthly_catering()
	{
		$data['heading'] = 'Monthly';
		$data['img_url'] = 'monthly_catering.jpg';
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "pages";
		$data['view_file'] = "catering_type_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function buffet_catering()
	{
		$data['heading'] = 'Buffet';
		$data['img_url'] = 'buffet_catering.jpg';
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "pages";
		$data['view_file'] = "catering_type_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function order()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}
		$data['view_module'] = "pages";
		$data['view_file'] = "how_to_order_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function reload()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}
		$data['view_module'] = "pages";
		$data['view_file'] = "how_to_reload_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function faq()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}
		$data['view_module'] = "pages";
		$data['view_file'] = "faq_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function reload_report()
	{
		$month = $this->input->get('month') ? $this->input->get('month') : '00';
		$year  = $this->input->get('year') ? $this->input->get('year') : '0000';

		$start_date = $year."-".$month."-01" ;
		$end_date =  date("Y-m-t", strtotime($start_date));

		$data['reload_report'] = $this->pages->reload_report($start_date,$end_date);

		$data['page_title'] = "MB ".$month."-".$year." REPORT";	
		$data['view_module'] = "pages";
		$data['view_file'] = "reload_report_page";
		$this->load->module("templates");
		$this->templates->report($data);
	}


	public function lucky_draw()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}

		$this->form_validation->set_rules('prize', 'prize', 'required',array('required' => 'Please Select One!'));

        if ($this->form_validation->run() == FALSE)
        {
			$data['view_module'] = "pages";
			$data['view_file'] = "lucky_draw_page";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);
        }else{
        	$insert = $this->pages->insert_prize($this->session->customer_id);

        	if ($insert) {
        		redirect('lucky-draw');
        	}
        }
	
	}

	public function customer_address()
	{

		$customer_list = array();

		$this->db->select('account_no');
		$this->db->from('customer');		
		$query = $this->db->get();

		foreach ($query->result_array() as $row) 
		{
			$customer_list[$row['account_no']] = $row['account_no'];
		}
		

		$customer_id = substr($this->input->get('account_no'), 4);
		$data['page_title'] = "Customer Address";
		$data['account_no'] = $customer_list;
		$data['all_address'] = 	$this->customer->get_customer_address($customer_id);
		$data['view_module'] = "pages";
		$data['view_file'] = "customer_address_page";
		$this->load->module("templates");
		$this->templates->report($data);
	}



}