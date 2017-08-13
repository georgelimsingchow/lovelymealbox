<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Address extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
	}

	public function index()
	{

		$user_id = $this->session->customer_id;
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['addresses'] = getAddress($user_id); 
		$data['view_module'] = "account";
		$data['view_file'] = "address/address_show_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);		
	}

	public function add()
	{
		$data['state'] = getState();
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();		
		$submit = $this->input->post('submit',TRUE);

		if ($submit == 'submit') {
			
			$this->form_validation->set_rules('fname', 'first name', 'required');
			$this->form_validation->set_rules('lname', 'last name', 'required');
			$this->form_validation->set_rules('mobile', 'mobile', 'required');
			$this->form_validation->set_rules('address_1', 'address 1', 'required');
			$this->form_validation->set_rules('city', 'city', 'required');
			$this->form_validation->set_rules('postcode', 'postcode', 'required|numeric');

	        if ($this->form_validation->run() == TRUE)
	        {
	        	$data = $this->address_fetch_from_post();

	        	$address_data = array(
	        		'customer_id' => $this->mdl_usermodel->getId(),
	        		'firstname'   => $data['fname'],
	        		'lastname'    => $data['lname'],
	        		'mobile_no'   => $data['mobile'],
	        		'address_1'   => $data['address_1'],
	        		'address_2'   => $data['address_2'],
	        		'city'        => $data['city'],
	        		'postcode'    => $data['postcode'],
	        		'state_id'    => $data['state'],
	        		'status'      => '1',
	        		);

	        	$this->db->insert('customer_address', $address_data);
			    $msg = "<div class='alert alert-success'>";
	        	$msg .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
	        	$msg .= "New address has been added.</div>";

	        	$this->session->set_flashdata('flsh_msg', $msg);
	        	redirect('account/address');
	        	
	        }

		}

		$data['view_module'] = "account";
		$data['view_file'] = "address/address_add_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function edit($update_id = null)
	{

		$submit = $this->input->post('submit',TRUE);
		
		if (is_numeric($update_id)) {
			$data = $this->address_fetch_from_db($update_id);
		}

		$data['id'] = $update_id;
		$data['state'] = getState();
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();	

		if ($submit == 'submit') {
			
			$this->form_validation->set_rules('fname', 'first name', 'required');
			$this->form_validation->set_rules('lname', 'last name', 'required');
			$this->form_validation->set_rules('mobile', 'mobile', 'required');
			$this->form_validation->set_rules('address_1', 'address 1', 'required');
			$this->form_validation->set_rules('city', 'city', 'required');
			$this->form_validation->set_rules('postcode', 'postcode', 'required|numeric');

	        if ($this->form_validation->run() == TRUE)
	        {
	        	$data = $this->address_fetch_from_post();

	        	$address_data = array(
	        		'customer_id' => $this->mdl_usermodel->getId(),
	        		'firstname'   => $data['fname'],
	        		'lastname'    => $data['lname'],
	        		'mobile_no'   => $data['mobile'],
	        		'address_1'   => $data['address_1'],
	        		'address_2'   => $data['address_2'],
	        		'city'        => $data['city'],
	        		'postcode'    => $data['postcode'],
	        		'state_id'    => $data['state'],
	        		'status'      => '1',
	        		);

	        	$this->db->where('id', $update_id);
				$this->db->update('customer_address', $address_data);

			    $msg = "<div class='alert alert-success'>";
	        	$msg .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
	        	$msg .= "Address has been updated.</div>";

	        	$this->session->set_flashdata('flsh_msg', $msg);
	        	redirect('account/address');
	        	
	        }

		}
		$data['view_module'] = "account";
		$data['view_file'] = "address/address_edit_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);

	}

	public function delete($id = null)
	{

		$msg = "<div class='alert alert-danger'>";
       	$msg .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";

		if (!is_numeric($id)) {
			$msg .= "Error occured.</div>";
			$this->session->set_flashdata('flsh_msg', $msg);
			redirect('account/address');
		}else{
			$data = array(
			    'status' => '0',
			);

			$this->db->where('id', $id);
			$this->db->update('customer_address', $data);

        	$msg .= "Address has been deleted.</div>";
        	$this->session->set_flashdata('flsh_msg', $msg);
        	redirect('account/address');			
		}
	}


	private function address_fetch_from_post()
	{
		
		$data['fname']	= $this->input->post('fname',TRUE);
		$data['lname']	= $this->input->post('lname',TRUE);
		$data['mobile']	= $this->input->post('mobile',TRUE);
		$data['address_1'] 	= $this->input->post('address_1',TRUE);
		$data['address_2'] 	= $this->input->post('address_2',TRUE);
		$data['city']	= $this->input->post('city',TRUE);
		$data['postcode']	= $this->input->post('postcode',TRUE);
		$data['state']	= $this->input->post('state',TRUE);

		return $data;
	}

	private function address_fetch_from_db($update_id)
	{
		$this->db->select('*');
		$this->db->from('customer_address');
		$this->db->where('id', $update_id);
		$this->db->where('customer_id', $this->mdl_usermodel->getId());
		$this->db->limit(1);
		$query = $this->db->get();

		foreach ($query->result() as $row)
		{
	        $data['firstname'] = $row->firstname;
	        $data['lastname'] = $row->lastname;
	        $data['mobile_no'] = $row->mobile_no;
	        $data['address_1'] = $row->address_1;
	        $data['address_2'] = $row->address_2;
	        $data['city']     = $row->city;
	        $data['postcode'] = $row->postcode;
	        $data['state_id'] = $row->state_id;

		}

		if (count($data) == '0') {
		    $msg = "<div class='alert alert-danger'>";
        	$msg .= "<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>";
        	$msg .= "No address found.</div>";
        	$this->session->set_flashdata('flsh_msg', $msg);
        	redirect('account/address');
		}else{
			return $data;
		}
		
	}

}
