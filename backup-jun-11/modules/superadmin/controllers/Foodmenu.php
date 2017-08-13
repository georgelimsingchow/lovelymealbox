<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Foodmenu extends MX_Controller
{
	private $time_now = null;

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
		$this->load->library('form_validation');
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
	}

	function index(){

		$this->load->library('session');
		$data['food_menu']  = $this->read();
		$flash = $this->session->flashdata('item');
		$data['view_module'] = "superadmin";
		$data['view_file'] = "foodmenu_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	function read()
	{

		$food_data_array = array();

		$this->db->select('*');
		$this->db->from('food_menu');
		$this->db->order_by('create_date', 'DESC');
		$food = $this->db->get();

		foreach ($food->result_array() as $row ) {
			$food_data_array[] = $row;
		}

		return $food_data_array;

	}

	function add()
	{
		
		$submit = $this->input->post('submit',TRUE);

		if ($submit == 'submit') {

			
			$this->form_validation->set_rules('chinese_name', 'Chinese Name', 'required');
			$this->form_validation->set_rules('english_name', 'English Name', 'required');
			$this->form_validation->set_rules('type', 'Food type', 'required');
			$this->form_validation->set_rules('status', 'Food status', 'required');

            if ($this->form_validation->run() == FALSE)
            {
	            $data['view_module'] = "superadmin";
				$data['view_file'] = "foodmenu_add_page";
				$this->load->module("templates");
				$this->templates->admin($data);

            }else{
            	$data['menu_chinese'] = $this->input->post('chinese_name',TRUE);
				$data['menu_english'] = strtoupper($this->input->post('english_name',TRUE));
				$data['description']  = $this->input->post('food_desc',TRUE);
				$data['type'] 		  = $this->input->post('type',TRUE);
				$data['status']	      = $this->input->post('status',TRUE);
				$data['create_date']  = $this->time_now;
				$data['update_date']  = $this->time_now;

				$this->db->insert('food_menu', $data);
				// $flash_msg = "<h4><i class='icon fa fa-check'></i>Food menu successfully added.</h4>";
				// $value = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>".$flash_msg."</div>";
				// $this->session->set_flashdata('item',$value);

				redirect('/superadmin/foodmenu/');

            }
		}else{
			$data['view_module'] = "superadmin";
			$data['view_file'] = "foodmenu_add_page";
			$this->load->module("templates");
			$this->templates->admin($data);
		}


	}

	function edit()
	{
		
		$item_id = $this->uri->segment(4);
		$submit = $this->input->post('submit');

		if ($submit == 'submit') {

			$this->form_validation->set_rules('chinese_name', 'Chinese Name', 'required');
			$this->form_validation->set_rules('english_name', 'English Name', 'required');
			$this->form_validation->set_rules('type', 'Food type', 'required');
			$this->form_validation->set_rules('status', 'Food status', 'required');

            if ($this->form_validation->run() == FALSE)
            {
            	$data['item_id'] = $item_id;
            	$data = $this->get_data_from_db($data['item_id']);
	            $data['view_module'] = "superadmin";
				$data['view_file'] = "foodmenu_edit_page";
				$this->load->module("templates");
				$this->templates->admin($data);
            }else{
		    	$data['menu_chinese'] = $this->input->post('chinese_name',TRUE);
				$data['menu_english'] = strtoupper($this->input->post('english_name',TRUE));
				$data['description']  = $this->input->post('food_desc',TRUE);
				$data['type'] 		  = $this->input->post('type',TRUE);
				$data['status']	      = $this->input->post('status',TRUE);
				$data['update_date']  = $this->time_now;

				$this->db->where('id', $item_id);
				$this->db->update('food_menu', $data);
				redirect('/superadmin/foodmenu/');
            }

		}

		// first load
		if (is_numeric($item_id)) {

			$data = $this->get_data_from_db($item_id);

			$data['view_module'] = "superadmin";
			$data['view_file'] = "foodmenu_edit_page";
			$this->load->module("templates");
			$this->templates->admin($data);
		}else{
			redirect('/superadmin/foodmenu/');
		}

	}

	private function get_data_from_db($update_id)
	{
			$this->db->select('*');
			$this->db->from('food_menu');
			$this->db->where('id', $update_id);
			$this->db->limit(1);
			$food_single = $this->db->get();

			foreach ($food_single->result() as $row) {
				$data['item_id'] = $row->id;
	            $data['menu_english'] = $row->menu_english;
	            $data['menu_chinese'] = $row->menu_chinese;
	            $data['description']  = $row->description;
	            $data['type'] 		  = $row->type;
	            $data['status'] 	  = $row->status;
			}

			return $data;
	}

	function delete()
	{
		$item_id = $this->uri->segment(4);
		if (is_numeric($item_id)) {
			
			$data['status'] = '0';
			$data['update_date'] = $this->time_now;
			$this->db->where('id', $item_id);
			$this->db->update('food_menu', $data);
			redirect('/superadmin/foodmenu/');

		}else{
			redirect('/superadmin/foodmenu/');
		}
	}


}