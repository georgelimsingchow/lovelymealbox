<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MX_Controller
{
	private $time_now = null;

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
		$this->load->library('form_validation');
		if ($this->session->userdata('customer_logged_in'))
        { 
            redirect('home','refresh');
        }
	}

	function index()
	{
		$submit = $this->input->post('submit',TRUE);

		if ($submit == 'submit') {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('firstname', 'firstname', 'required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('lastname', 'lastname', 'required',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('mobile', 'mobile', 'required|min_length[9]|numeric',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[customer.email]',array('required' => 'You must provide an %s.','is_unique' => 'This %s has already been used otherwise try facebook login.'));
			$this->form_validation->set_rules('password', 'password', 'required|min_length[5]',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('repassword', 'repassword', 'required|matches[password]|min_length[5]');

	        if ($this->form_validation->run() == FALSE)
	        {
				$data['view_module'] = "register";
				$data['view_file'] = "register_page";
				$this->load->module("templates");
				$this->templates->public_bootstrap($data);
	        }
	        else
	        {
	        	$this->load->module('site_security');
	        	$data = $this->fetch_data_from_post();

	        	$data['hashed_password'] = $this->site_security->_hash_password($data['password']);

	        	$insert_customer = array(
	        		'first_name' => $data['firstname'], 
	        		'last_name' => $data['lastname'], 
	        		'password' => $data['hashed_password'], 
	        		'fb_verified' => '0', 
	        		'email' => $data['email'], 
	        		'phone' => $data['mobile'] , 
	        		'gender' => '', 
	        		'address_id' => '0',  
	        		'login_type' => '0', // normal login
	        		'is_email_active' => '0', // need verification
	        		'fb_id' => '', 
	        		'is_active' => '1',
	        		'update_date' => $this->time_now, 
	        		'create_date' => $this->time_now, 
	        	);

	        	$this->db->insert('customer', $insert_customer);
	        	$customer_id = $this->db->insert_id();

				// add account number
				$account_no = "MBR".('3000'+$customer_id);
				$this->db->set('account_no', $account_no);
				$this->db->where('customer_id', $customer_id);
				$this->db->update('customer'); 

	        	redirect('login','refresh');


	        }
		}else{

			$data['view_module'] = "register";
			$data['view_file'] = "register_page";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);
		}
	}

	public function fetch_data_from_post()
	{

		$data['firstname'] = $this->input->post('firstname',TRUE);
		$data['lastname'] = $this->input->post('lastname',TRUE);
		$data['mobile'] = $this->input->post('mobile',TRUE);
		$data['email'] = $this->input->post('email',TRUE);
		$data['password'] = $this->input->post('password',TRUE);
		$data['repassword'] = $this->input->post('repassword',TRUE);

		return $data;
	}














}