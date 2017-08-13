<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reload extends Admin_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation'); 
	}

	public function index()
	{
		$data['customer_data'] =  $this->_getCustomer();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "reload_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function add_balance($customer_id)
	{
		$submit = $this->input->post('submit',TRUE);

		if ($submit == 'submit') {

			$this->form_validation->set_rules('amount', 'Reload amount', 'required|is_numeric');

			if ($this->form_validation->run() == TRUE){
				$insert_data = $this->reload_fetch_from_post();
				$this->db->insert('balance', $insert_data);

				redirect('superadmin/reload/add_balance/'.$customer_id);
				

			}else{
				$this->_repeat_view($customer_id);	
			}


			
		}else{
			$this->_repeat_view($customer_id);			
		}
	
	}

	private function _repeat_view($customer_id)
	{
			$admin_id               = $this->session->admin_id;
			$data['admin']    		= get_admin($admin_id);
			$data['order']    		= $this->_getOrder($customer_id);
			$data['customer_data']  = $this->_getSingleCustomer($customer_id);
			$data['view_module']    = "superadmin";
			$data['view_file']      = "reload_add_page";
			$this->load->module("templates");
			$this->templates->admin($data);			
	}

	private function _getOrder($customer_id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('balance');
		$this->db->where('customer_id', $customer_id);
		$this->db->where('admin_id <>', '0');
		$this->db->order_by('create_date', 'DESC');

		$order_result = $this->db->get(); 

		foreach ($order_result->result_array() as $row) {
			$data[] = $row;
		}
		return $data;		
	}


	private function _getCustomer()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('customer');

		$customer_result = $this->db->get(); 

		foreach ($customer_result->result_array() as $row) {
			$row['amount_left'] = get_amount($row['customer_id']);
			$row['total_amount'] = get_total_amount($row['customer_id']);
			$data[] = $row;
		}

		return $data;		
	}


	private function _getSingleCustomer($customer_id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id', $customer_id);
		$customer_result = $this->db->get(); 

		foreach ($customer_result->result_array() as $row) {
			$data[] = $row;
		}

		return $data['0'];			
	}

	private function reload_fetch_from_post()
	{
		//from post
		$data['customer_id']  = $this->input->post('customer_id',TRUE);
		$data['amount']	      = $this->input->post('amount',TRUE);
		$data['admin_id']     = $this->input->post('admin_id',TRUE);
		$data['order_id']     = '0';
		//additional information 
		$data['create_date'] = $this->get_time_now();
		$data['expire_date'] = $this->_check_if_reload_before($data['customer_id']);

		return $data;
	}


	private function _check_if_reload_before($customer_id)
	{

		$end_of_today = date('Y-m-d')." 23:59:59";
		$data = array();
		$this->db->select('expire_date');
		$this->db->from('balance');
		$this->db->where('customer_id', $customer_id);
		$this->db->where('amount >', '0.00');
		$this->db->where('admin_id <>', '0');
		// $this->db->where('expire_date <', $date);
		$this->db->where('expire_date >=', $end_of_today);
		$this->db->order_by('expire_date', 'DESC');
		$this->db->limit(1);

		$balance_result = $this->db->get(); 

		foreach ($balance_result->result_array() as $row) {
			$data[] = $row;
		}

		if (count($data) > '0') {
			$continue_last_date = date('Y-m-d H:i:s', strtotime($data['0']['expire_date'] . ' +40 day'));
			return $continue_last_date;
		}else{
			$add_forty_from_today = date('Y-m-d H:i:s', strtotime($end_of_today . ' +40 day'));
			return $add_forty_from_today;
		}

	}


}