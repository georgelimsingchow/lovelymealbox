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
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "cny";
		$data['view_file'] = "cny_main";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	function promo1()
	{
		$data['panel_title'] = "港式菜色";
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "cny";
		$data['view_file'] = "cny_promo1";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	function promo1_validation()
	{
		$fetch['roasted_pork'] = $this->input->post('promo1[roasted_pork]',TRUE);
		$fetch['char_siu'] = $this->input->post('promo1[char_siu]',TRUE);
		$fetch['duck'] = $this->input->post('promo1[duck]',TRUE);
		$fetch['chicken'] = $this->input->post('promo1[chicken]',TRUE);
		$fetch['name'] = $this->input->post('name',TRUE);
		$fetch['phone'] = $this->input->post('phone',TRUE);
		$fetch['email'] = $this->input->post('email',TRUE);
		$fetch['date'] = $this->input->post('date',TRUE);

		if (empty($fetch['roasted_pork']) && empty($fetch['char_siu']) && empty($fetch['duck']) && empty($fetch['chicken'])) {
			$this->form_validation->set_rules('selectone', '', 'required',array('required' => 'Please pick at least one item.'));
		}

		$this->form_validation->set_rules('name', '', 'required',array('required' => 'Name is required'));
		$this->form_validation->set_rules('phone', '', 'required|numeric',array('required' => 'Phone is required'));
		$this->form_validation->set_rules('email', '', 'required|valid_email',array('required' => 'Email is required'));
		$this->form_validation->set_rules('date', '', 'required',array('required' => 'Date is required'));

        if ($this->form_validation->run() == FALSE)
        {
			$data['panel_title'] = "港式菜色";
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
			$data['view_module'] = "cny";
			$data['view_file'] = "cny_promo1";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);
        }
        else
        {

        	$insert_data = array(
        			'customer_id'  => $this->session->customer_id,
			        'pork_belly'   => $fetch['roasted_pork'] ? $fetch['roasted_pork']: '0',
			        'char_siew'     => $fetch['char_siu']     ? $fetch['char_siu']: '0',
			        'roasted_duck' => $fetch['duck']         ? $fetch['duck']: '0',
			        'chicken'      => $fetch['chicken']      ? $fetch['chicken']: '0',
			        'name'         => $fetch['name'],
			        'phone'        => $fetch['phone'],
			        'email'        => $fetch['email'],
			        'order_status' => 'processing',
			        'pickup_date'  => $fetch['date'],
			        'create_date'  => $this->get_time_now(),
			);
			$this->db->insert('cny', $insert_data);
        	
        	$order_id = $this->db->insert_id();
			// add order number
			$order_no = "CNYODR".$order_id;
			$this->db->set('order_no', $order_no);
			$this->db->where('id', $order_id);
			$this->db->update('cny'); 

			redirect('account/cny');
        	
        }	
		
	}

	function promo2()
	{
		$data['panel_title'] = "新年套餐";
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "cny";
		$data['view_file'] = "cny_promo2";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);		
	}

	function promo2_validation()
	{
		$fetch['package'] = $this->input->post('package',TRUE);
		$fetch['name'] = $this->input->post('name',TRUE);
		$fetch['phone'] = $this->input->post('phone',TRUE);
		$fetch['email'] = $this->input->post('email',TRUE);
		$fetch['date'] = $this->input->post('date',TRUE);			

		$this->form_validation->set_rules('name', '', 'required',array('required' => 'Name is required'));
		$this->form_validation->set_rules('phone', '', 'required|numeric',array('required' => 'Phone is required'));
		$this->form_validation->set_rules('email', '', 'required|valid_email',array('required' => 'Email is required'));
		$this->form_validation->set_rules('date', '', 'required',array('required' => 'Date is required'));
		$this->form_validation->set_rules('package', '', 'required',array('required' => 'Please pick at one package'));


        if ($this->form_validation->run() == FALSE)
        {
			$data['panel_title'] = "新年套餐";
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
			$data['view_module'] = "cny";
			$data['view_file'] = "cny_promo2";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);
        }
        else
        {

        	$insert_data = array(
        			'customer_id'  => $this->session->customer_id,
			        'pork_belly'   => '0',
			        'char_siew'    => '0',
			        'roasted_duck' => '0',
			        'chicken'      => '0',
			        'package'      => $fetch['package'],
			        'name'         => $fetch['name'],
			        'phone'        => $fetch['phone'],
			        'email'        => $fetch['email'],
			        'order_status' => 'processing',
			        'pickup_date'  => $fetch['date'],
			        'create_date'  => $this->get_time_now(),
			);
			$this->db->insert('cny', $insert_data);
        	
        	$order_id = $this->db->insert_id();
			// add order number
			$order_no = "CNYPKG".$order_id;
			$this->db->set('order_no', $order_no);
			$this->db->where('id', $order_id);
			$this->db->update('cny'); 

			redirect('account/cny');
        	
        }	
		
	}

	function oishi()
	{
		$data['panel_title'] = "日式套餐";
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['view_module'] = "cny";
		$data['view_file'] = "cny_oishi";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);	
	}


	function oishi_validation()
	{

		$json['sushi1'] 	= $this->input->post('oishi[sushi1]',TRUE);
		$json['sushi2'] 	= $this->input->post('oishi[sushi2]',TRUE);
		$json['appetizer'] = $this->input->post('oishi[appetizer]',TRUE);
		$json['yeeshang'] 	= $this->input->post('oishi[yeeshang]',TRUE);
		$json['sashimi'] 	= $this->input->post('oishi[sashimi]',TRUE);

		$fetch['name'] 		= $this->input->post('name',TRUE);
		$fetch['phone'] 	= $this->input->post('phone',TRUE);
		$fetch['email'] 	= $this->input->post('email',TRUE);
		$fetch['date'] 		= $this->input->post('date',TRUE);

		if (empty($json['sushi1']) && empty($json['sushi2']) && empty($json['appetizer']) && empty($json['yeeshang']) && empty($json['yeeshang'])) {
			$this->form_validation->set_rules('selectone', '', 'required',array('required' => 'Please pick at least one item.'));
		}

		$this->form_validation->set_rules('name', '', 'required',array('required' => 'Name is required'));
		$this->form_validation->set_rules('phone', '', 'required|numeric',array('required' => 'Phone is required'));
		$this->form_validation->set_rules('email', '', 'required|valid_email',array('required' => 'Email is required'));
		$this->form_validation->set_rules('date', '', 'required',array('required' => 'Date is required'));

        if ($this->form_validation->run() == FALSE)
        {
			$data['panel_title'] = "日式套餐";
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
			$data['view_module'] = "cny";
			$data['view_file'] = "cny_oishi";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);	
        }
        else
        {
        	$decode_oishi = json_encode($json);

        	$insert_data = array(
    			'customer_id'  => $this->session->customer_id,
		        'sushi_order'  => $decode_oishi,
		        'name'         => $fetch['name'],
		        'phone'        => $fetch['phone'],
		        'email'        => $fetch['email'],
		        'order_status' => 'processing',
		        'pickup_date'  => $fetch['date'],
		        'create_date'  => $this->get_time_now(),
			);
			
			$this->db->insert('cny', $insert_data);
        	
        	$order_id = $this->db->insert_id();
			// add order number
			$order_no = "CNYOISHI".$order_id;
			$this->db->set('order_no', $order_no);
			$this->db->where('id', $order_id);
			$this->db->update('cny'); 

			redirect('account/cny');
        	
        }
	}

}