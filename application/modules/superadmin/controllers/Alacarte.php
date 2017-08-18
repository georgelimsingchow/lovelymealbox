<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Alacarte extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
        $this->load->library('form_validation');
        $this->load->model('alacarte/alacarte_mdl', 'alacarte');
	}

	function index()
	{
		$data['alacarte_list'] = $this->alacarte->find_all();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "alacarte/alacarte_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function edit()
	{

		$id = $this->input->get('id');

		$this->form_validation->set_rules('menu_chinese', 'Chinese Name', 'required');
		$this->form_validation->set_rules('menu_english', 'English Name', 'required');
		$this->form_validation->set_rules('availibility[]', 'Food type', 'required');
		$this->form_validation->set_rules('status', 'Food status', 'required');

        if ($this->form_validation->run() == FALSE)
        {
			$data['alacarte'] = $this->alacarte->find_by_id($id);
			$data['view_module'] = "superadmin";
			$data['view_file'] = "alacarte/alacarte_edit_page";
			$this->load->module("templates");
			$this->templates->admin($data);	
        }

        else{

        	$processed = implode(",", $this->input->post('availibility'));


        	$data['menu_english'] = $this->input->post('menu_english');
        	$data['menu_chinese'] = $this->input->post('menu_chinese');
        	$data['availability'] = $processed;
        	$data['status'] = $this->input->post('status');

        	$edit = $this->alacarte->edit($data,$id);

        	if ($edit) {
        		redirect('superadmin/alacarte');
        	}


        	
        }

	
	}




}