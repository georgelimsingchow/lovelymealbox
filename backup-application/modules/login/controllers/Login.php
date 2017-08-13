<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{
	private $time_now = null;

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		if ($this->session->userdata('customer_logged_in'))
        { 
            redirect('home','refresh');
        }
	}

	function index()
	{

		$submit = $this->input->post('submit',TRUE);

		if ($submit == 'submit') {

			$email = $this->input->post('email');
			$password = $this->input->post('password');



			$this->form_validation->set_rules('email', 'email', 'required|valid_email',array('required' => 'Please enter your %s.'));
			$this->form_validation->set_rules('password', 'password', 'required',array('required' => 'Please enter your %s.'));


	        if ($this->form_validation->run() == FALSE)
	        {
				$data['view_module'] = "login";
				$data['view_file'] = "login_page";
				$this->load->module("templates");
				$this->templates->public_bootstrap($data);		
	        }else{

	        	$this->form_validation->set_rules('not_found', 'not_found', 'callback_check_database');
	        	if ($this->form_validation->run() == FALSE) {
	        		$data['view_module'] = "login";
					$data['view_file'] = "login_page";
					$this->load->module("templates");
					$this->templates->public_bootstrap($data);	
	        	}else{

	        	}
	        }

		}else{
			$data['view_module'] = "login";
			$data['view_file'] = "login_page";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);			
		}


	}

	public function check_database()
	{

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('email',$email);
		$this->db->where('login_type','0'); // this is for normal login
		$query = $this->db->get();

		$data = array();
		foreach ($query->result() as $row) {
			$data['email']           = $row->email;
			$data['customer_id']     = $row->customer_id;
			$data['hashed_password'] = $row->password;
		}
		// if not found
		if (empty($data)) {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}

		// if password not match
		$this->load->module('site_security');
		$result = $this->site_security->_verify_password($password,$data['hashed_password']);
		if ($result == TRUE) {
			$user_session = array(
		        'customer_id'  => $data['customer_id'],
		        'customer_logged_in' => TRUE
			);

			$this->session->set_userdata($user_session);
			redirect('home','refresh');
		}else{
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return false;
		}

	}

	public function fb_login()
	{
		$result = $this->facebook->js_login_callback();
		$token = (string) $result->getValue();

		$user_data = $this->facebook->request('get','/me?fields=id,email,first_name,last_name,gender,verified',$token);

		// token log
		$this->add_token($token,$user_data['id']);

		$fb_data = array(
			'fb_id' 	 => $user_data['id'],
			'first_name' => $user_data['first_name'], 
			'last_name'  => $user_data['last_name'], 
			'email'      => $user_data['email'] ? $user_data['email'] : '', // optional
			'gender'     => $user_data['gender'] ? $user_data['gender'] : '',
			'verified'   => $user_data['verified'] ? $user_data['verified'] : '',
			);


		$add_profile = $this->add_or_login($fb_data);
	}

	private function add_or_login($data)
	{
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('fb_id',$data['fb_id']);
		$this->db->limit(1);
		$query = $this->db->get();	

		if ($query->num_rows() == 0) {

		// if new user
		$fb_data = array(
			'fb_id' 			=> $data['fb_id'],
			'first_name' 		=> $data['first_name'],
			'last_name' 		=> $data['last_name'],
			'email' 			=> $data['email'],
			'gender' 			=> $data['gender'],
			'fb_verified'       => $data['verified'],
			'update_date' 		=> $this->time_now,
			'create_date' 		=> $this->time_now,
			'login_type' 		=> '1', // facebook login type is '1'
			'is_email_active' 	=> '1', // facebook login is automatic active			
			'is_active' 		=> '1', // facebook login is automatic active
			);

			$this->db->insert('customer',$fb_data);
			$customer_id = $this->db->insert_id();

			// add account number
			$account_no = "MBR".('3000'+$customer_id);
			$this->db->set('account_no', $account_no);
			$this->db->where('customer_id', $customer_id);
			$this->db->update('customer'); 

			$public_user_session = array(
				'customer_id' => $customer_id,
				'customer_logged_in'=> TRUE,
				'customer_fb_id'   => $data['fb_id'],
				);

			$this->session->set_userdata($public_user_session);
			redirect('home','refresh');	
		}else{
			// if registered user
			foreach ($query->result() as $row)
			{
			    $customer_id = $row->customer_id;
			}

			$public_user_session = array(
				'customer_id' => $customer_id,
				'customer_logged_in'=> TRUE,
				'customer_fb_id'   => $data['fb_id'],
				);
			$this->session->set_userdata($public_user_session);
			redirect('home','refresh');
		}
	}

	private function add_token($token,$fb_id)
	{
		$token_data = array(
			'token_1' => $token,
			'token_2' => $token,
			'fb_id'   => $fb_id ? $fb_id : '0',
			'create_date' => $this->time_now,
		);

		$this->db->insert('fb_token',$token_data);
	}









}