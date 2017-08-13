<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dailymenu extends MX_Controller
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

	function index()
	{		

		$data['daily_menu_array'] = $this->_get_daily_menu();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "dailymenu_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function add()
	{

		$submit = $this->input->post('submit',TRUE);

		if ($submit == 'submit') {
			$food_with_id = array();
			$food_array = $this->input->post('food_menu',TRUE);
			$food_date = $this->input->post('food_date',TRUE);
			$status = $this->input->post('d_menu_status',TRUE);
			
			$this->form_validation->set_rules('food_menu[]', 'Food Menu', 'required');
			$this->form_validation->set_rules('food_date', 'Food Date', 'required');
			$this->form_validation->set_rules('d_menu_status', 'Status', 'required');

            if ($this->form_validation->run() == FALSE)
            {
            	$data['select_box'] = $this->_get_all_menu();
				$data['select_date'] = $this->_every_week();
	            $data['view_module'] = "superadmin";
				$data['view_file'] = "dailymenu_add_page";
				$this->load->module("templates");
				$this->templates->admin($data);

            }else{
				//last order date
				$time = strtotime("$food_date -1 days");
	    		$last_date = date("Y-m-d", $time)." 20:00:00";
				
				foreach ($food_array as $key => $value) {
					$food_with_id[$key]['id'] = $value;
				}

	        	$data['slug'] = $food_date;
	        	$data['menu_date'] = $food_date." 00:00:00";
	        	$data['picked_menu'] = json_encode($food_with_id);
				$data['expire_date'] = $last_date;
				$data['status']       = $status;
				$data['create_date']  = $this->time_now;
				$data['update_date']  = $this->time_now;

				$this->db->insert('daily_menu', $data);

				redirect('/superadmin/dailymenu/');

            }
		}else{
			$data['select_box'] = $this->_get_all_menu();
			$data['select_date'] = $this->_every_week();
			$data['view_module'] = "superadmin";
			$data['view_file'] = "dailymenu_add_page";
			$this->load->module("templates");
			$this->templates->admin($data);
		}



	}

	private function _get_daily_menu()
	{

		$daily_menu_array = array();

		$this->db->select('*');
		$this->db->from('daily_menu');
		$this->db->order_by('expire_date', 'DESC');
		// $this->db->where('menu_last_date >', $this->time_now);
		$daily_menu = $this->db->get();
		// json_to_array(json_decode($row->picked_menu,true));

		foreach ($daily_menu->result_array() as $row) {
			$daily_menu_array[] = $row;
		}

		return $daily_menu_array;
	}

	private function _get_all_menu()
	{
		$food_data_array = array();

		$this->db->select('id,menu_english,menu_chinese,type');
		$this->db->from('food_menu');
		$this->db->where('status', '1');
		$food = $this->db->get();

		foreach ($food->result_array() as $key => $value) {
			$food_data_array[$value['id']] = "( ".$value['id']." ) ".$value['menu_english'];
		}
		return $food_data_array;
	}

	private function _every_week($day = 'Monday')
	{
		$specific_day = array();
		$startDate = date('Y-m-d');
		$endDate = strtotime($startDate . "+2 week");
		for($i = strtotime($startDate, strtotime($startDate)); $i <= $endDate; $i = strtotime('+1 day', $i)){
			$the_date = date('Y-m-d', $i);
			if ($the_date != date('Y-m-d',strtotime("now"))) {
				$specific_day[$the_date] = date('Y-M-d (l)', $i);
			}
		}

		return $specific_day;
	}

}