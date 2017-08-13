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
        $this->load->model('dailymenu/dailymenu_mdl', 'dailymenu');
	}

	function index()
	{		

		$data['daily_menu_array'] = $this->_get_daily_menu();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "dailymenu/dailymenu_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function edit()
	{
		$id = $this->input->get('id');

		if (!isset($id)) {
			redirect('superadmin/dailymenu');
		}else{

			//method 3 CORRECT:
			$this->load->module('superadmin/foodmenu');
			
			$data['food_menu_list'] = $this->foodmenu->read();
			$data['dailymenu'] = $this->dailymenu->get_single_dailymenu($id);
			$data['view_module'] = "superadmin";
			$data['view_file'] = "dailymenu/dailymenu_edit_page";
			$this->load->module("templates");
			$this->templates->admin($data);
		}
	}

	public function ajax_edit()
	{
		$edit = $this->dailymenu->edit();

		if ($edit) {
			$data['status'] = 'success';
			$data['msg'] = 'Successfully Updated';
			echo json_encode($data);
		}else{
			$data['status'] = 'failed';
			$data['msg'] = 'Unknown Error Happened';
			echo json_encode($data);
		}
	}

	public function add()
	{			
		$this->load->module('superadmin/foodmenu');
		$data['food_menu_list'] = $this->foodmenu->read();
		$data['select_box'] = $this->_get_all_menu();
		$data['select_date'] = $this->_every_week();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "dailymenu/dailymenu_add_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function ajax_add()
	{
		$add = $this->dailymenu->add();

		if ($add['real_status'] == TRUE) {
			echo json_encode($add);
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

	// json 

	public function json_dailymenu()
	{
		
		$date = $this->input->get('date');
		$session = $this->input->get('session');
		$data = $this->dailymenu->json_get_single_dailymenu($date,$session);

		echo json_encode($data);
		
	}

	public function json_add_to_cart()
	{

		// print_r($this->input->post());exit;
		$input_obj = json_decode(file_get_contents('php://input'));

		$insertToCart['that_day_date'] = $input_obj->date;
		$insertToCart['admin_id'] = $this->session->admin_id;
		$insertToCart['selected_menu'] = json_encode($input_obj->selected_menu);
		$insertToCart['session'] = $input_obj->session;
		$insertToCart['unit'] = $input_obj->unit;
		$insertToCart['quantity'] = $input_obj->quantity;
		$insertToCart['create_date'] = $this->time_now;
		$insertToCart['status'] = 'in_cart';
		$insertToCart['type']   = 'mealbox';
		$insertToCart['expire_date'] = "0000-00-00 00:00:00";

		$add_to_cart = $this->dailymenu->json_admin_add_to_cart($insertToCart);

		if ($add_to_cart) {
			echo json_encode(['status'=>'success']);exit;
		}else{
			echo json_encode(['status'=>'fail']);exit;
		}
		// echo json_encode($this->session->admin_id);
	}

	public function json_get_cart()
	{
		$session = $this->input->get('session');
		$date    = $this->input->get('date');

		$data = $this->dailymenu->json_get_cart_data($date,$session);

		echo json_encode($data);


	}

}