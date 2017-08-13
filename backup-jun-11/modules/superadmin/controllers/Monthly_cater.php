<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Monthly_cater extends MX_Controller
{
	function __construct() 
	{
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
        $this->load->library('form_validation');
        $this->load->model('monthly_cater/monthly_cater_mdl', 'mcater');

        
	}

	public function index()
	{
		$data['cater_data'] = $this->mcater->get_cater();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "monthly_cater/monthly_cater_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function add_cater()
	{
		
		$submit      =  $this->input->post('submit');

		if ($submit == 'submit') {

			$name 		 =  $this->input->post('name');
			$phone 		 =  $this->input->post('phone');
			$customer_id =  $this->input->post('customer_id');
			$address     =  $this->input->post('address');
			$area        =  $this->input->post('area');

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');  
			$this->form_validation->set_rules('address', 'Address', 'required'); 

		    if ($this->form_validation->run() == FALSE) { 
		    	
		    	$this->_add_cater_view();
		    } 
		    else {
		    	$insert_data = array(
		    		'name'        => $name,
		    		'phone'       => $phone,
		    		'customer_id' => $customer_id,
		    		'address'     => $address,
		    		'area'        => $area,
		    		'create_date' => date('Y-m-d H:i:s'),
		    		);

		    	$this->mcater->insert_cater_customer($insert_data);
		    	redirect('superadmin/monthly_cater'); 
		    } 

		}else{
			$this->_add_cater_view();
		}
	}

	private function _add_cater_view()
	{
		$data['cater_data'] = $this->mcater->get_cater();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "monthly_cater/monthly_add_cater_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function add_cater_detail()
	{
		$submit =  $this->input->post('submit');
		$id = $this->input->get('id');

		if ($submit == 'submit') {

		$start_date =  $this->input->post('start_date');
		$end_date 	=  $this->input->post('end_date');
		$from_day   =  $this->input->post('from_day');
		$to_day     =  $this->input->post('to_day');
		$pax        =  $this->input->post('pax');
		$fee        =  $this->input->post('fee');
		$session        =  $this->input->post('session');
		$comment        =  $this->input->post('comment');
		$tingkat        =  $this->input->post('tingkat');

		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		$this->form_validation->set_rules('from_day', 'From', 'required');
		$this->form_validation->set_rules('to_day', 'To', 'required');  
		$this->form_validation->set_rules('fee', 'Fee', 'required|integer'); 
		$this->form_validation->set_rules('tingkat', 'Tingkat', 'required'); 

	    if ($this->form_validation->run() == FALSE) 
	    { 	    	
	    	$this->_add_cater_detail_view($id);
	    } 
	    else {
	    	$insert_data = array(
	    		'cater_id'    => $id,
	    		'start_date'  => $start_date,
	    		'end_date'    => $end_date,
	    		'from_day'    => $from_day,
	    		'to_day'      => $to_day,
	    		'pax'         => $pax,
	    		'fee'         => $fee,
	    		'session'     => $session,
	    		'comment'     => $comment,
	    		'is_tingkat'  => $tingkat,
	    		'create_date' => date('Y-m-d H:i:s'),
	    		);

	    	$this->mcater->insert_cater_detail($insert_data);
	    	redirect('superadmin/monthly_cater'); 
	    }

		}else{
			$this->_add_cater_detail_view($id);
		}

	}


	private function _add_cater_detail_view($id)
	{		
		$data['cater'] = $this->mcater->get_cater_customer($id);
		$data['cater_detail'] = $this->mcater->get_cater_detail($id);
		$data['view_module'] = "superadmin";
		$data['view_file'] = "monthly_cater/monthly_add_detail_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}


}
?>