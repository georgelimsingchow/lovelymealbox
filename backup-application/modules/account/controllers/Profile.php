<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
	}

	public function index()
	{

		$submit = $this->input->post('submit',TRUE);

		if ($submit == 'submit') {
			
			$this->form_validation->set_rules('fname', 'first name', 'required');
			$this->form_validation->set_rules('lname', 'last name', 'required');			
			$this->form_validation->set_rules('email', 'email|valid_email', 'required');
			$this->form_validation->set_rules('mobile', 'mobile', 'required');

	        if ($this->form_validation->run() == TRUE)
	        {

	        	$data = $this->profile_fetch_from_post();

	        	$customer_data = array(
	        		'first_name'   => $data['fname'],
	        		'last_name'    => $data['lname'],
	        		'email'   	  => $data['email'],
	        		'phone'       => $data['mobile'],
	        		);

	        	$this->db->where('customer_id', $this->mdl_usermodel->getID());
				$this->db->update('customer', $customer_data);

			    $msg = "<div class='alert alert-success'>";
	        	$msg .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
	        	$msg .= "Profile has been updated.</div>";

	        	$this->session->set_flashdata('flsh_msg', $msg);
	        	redirect('account/profile');
	        	
	        }

		}

		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "account";
		$data['view_file'] = "profile/manage_profile_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	private function profile_fetch_from_post()
	{
		
		$data['fname']	= $this->input->post('fname',TRUE);
		$data['lname']	= $this->input->post('lname',TRUE);
		$data['mobile']	= $this->input->post('mobile',TRUE);
		$data['email'] 	= $this->input->post('email',TRUE);

		return $data;
	}

}
