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
        $this->load->model('settings/settings_mdl', 'settings');
        $this->load->model('foodmenu/foodmenu_mdl', 'fm');

        
	}

	public function index()
	{
		$data['count_active_cater']  = $this->mcater->count_status('1');
		$data['count_inactive_cater'] = $this->mcater->count_status('0');
		$data['cater_data'] = $this->mcater->get_cater();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "monthly_cater/monthly_cater_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}



	public function add_cater()
	{

		$name 		 =  $this->input->post('name');
		$phone 		 =  $this->input->post('phone');
		$customer_id =  $this->input->post('customer_id') ? $this->input->post('customer_id') : '0';
		$address     =  $this->input->post('address');
		$area     =  $this->input->post('area');
		$nick_name   =  $this->input->post('nickname');

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');  
		$this->form_validation->set_rules('address', 'Address', 'required'); 
		$this->form_validation->set_rules('nickname', 'Nick Name', 'required'); 


		    if ($this->form_validation->run() == FALSE) 
		    { 
				$data['cater_data'] = $this->mcater->get_cater();
				$data['view_module'] = "superadmin";
				$data['view_file'] = "monthly_cater/monthly_add_cater_page";
				$this->load->module("templates");
				$this->templates->admin($data);
		    } 
		    else {

		    	// print_r($this->input->post());exit;
		    	$insert_data = array(
		    		'name'        => $name,
		    		'phone'       => $phone,
		    		'customer_id' => $customer_id,
		    		'address'     => $address,
		    		'area'        => $area,
		    		'nick_name'   => $nick_name,
		    		'create_date' => date('Y-m-d H:i:s'),
		    		);

		    	$this->mcater->insert_cater_customer($insert_data);
		    	redirect('superadmin/monthly_cater'); 
		    } 
	}

	public function add_cater_detail()
	{
		$id = $this->input->get('id');

		$start_date =  $this->input->post('start_date'); // ok
		$end_date =  $this->input->post('end_date'); // ok
		$day_range  =  json_encode($this->input->post('day')); // ok
		$session    =  json_encode($this->input->post('session')); // ok
		$qty        =  $this->input->post('qty');
		$pax        =  $this->input->post('pax');
		$fee        =  $this->input->post('fee');		
		$comment    =  $this->input->post('comment');

		$this->form_validation->set_rules('start_date', 'Start Date', 'required');
		$this->form_validation->set_rules('end_date', 'End Date', 'required');
		$this->form_validation->set_rules('day[]', 'Day', 'required'); 
		$this->form_validation->set_rules('session[]', 'Session', 'required'); 
		$this->form_validation->set_rules('qty', 'Quantity', 'required|integer'); 
		$this->form_validation->set_rules('pax', 'pax', 'required|integer'); 
		$this->form_validation->set_rules('fee', 'Fee', 'required'); 

	    if ($this->form_validation->run() == FALSE) 
	    { 	    	
	    	$data['cater'] = $this->mcater->get_cater_customer($id);
			$data['cater_detail'] = $this->mcater->get_cater_detail($id);
			$data['view_module'] = "superadmin";
			$data['view_file'] = "monthly_cater/monthly_add_detail_page";
			$this->load->module("templates");
			$this->templates->admin($data);
	    } 
	    else {
	    	$insert_data = array(
	    		'cater_id'    => $id,
	    		'start_date'  => $start_date,
	    		'end_date'     => $end_date,
	    		'day_range'   => $day_range,
	    		'session'     => $session,
	    		'credit'      => $qty,
 	    		'pax'         => $pax,
	    		'fee'         => $fee,	    		
	    		'comment'     => $comment,
	    		'create_date' => date('Y-m-d H:i:s'),
	    		);

	    	$this->mcater->insert_cater_detail($insert_data);
	    	redirect('superadmin/monthly_cater'); 
	    }
	}

	public function order_cater_detail()
	{
		$id = $this->input->get('id');

    	$data['cater'] = $this->mcater->get_cater_customer($id);
		$data['cater_detail'] = $this->mcater->get_cater_detail($id);
		$data['view_module'] = "superadmin";
		$data['view_file'] = "monthly_cater/monthly_order_cater_page";
		$this->load->module("templates");
		$this->templates->admin($data);

	}

	public function json_cater_order()
	{
		// print_r($this->input->post());exit;
		$input_obj = json_decode(file_get_contents('php://input'));
			
		$insertCater['menu_date'] = $input_obj->date;
		$insertCater['cater_id'] = $input_obj->cater_id;
		$insertCater['picked_menu'] = json_encode($input_obj->selected_menu);
		$insertCater['session'] = $input_obj->session;
		$insertCater['credit'] = '1';
		$insertCater['order_status'] = 'paid';
		$insertCater['create_date'] = date('Y-m-d H:i:s');


		$add_to_order = $this->mcater->json_add_cater_order($insertCater);

		if ($add_to_order) {
			echo json_encode(['status'=>'success']);exit;
		}else{
			echo json_encode(['status'=>'fail']);exit;
		}		
	}

	public function json_get_cater($id)
	{
		$session = $this->input->get('session');
		$date    = $this->input->get('date');

		$cart_data = array();
		$this->db->select('*');
		$this->db->from('cater_order');
		$this->db->where("cater_id", $id);
		$this->db->order_by("menu_date", "DESC");
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$row['picked_menu'] = $this->_food_sequence($row['picked_menu'],$row['menu_date'],$row['session']);
			$cart_data[] = $row;
		}

		echo json_encode($cart_data);
	}

	private function _food_sequence($item, $date,$session)
	{
		$customer_built = json_decode($item,TRUE);
		$data = array();
		$this->db->select('picked_menu');
		$this->db->from('daily_menu');
		$this->db->where('slug',$date);
		$this->db->where('session',$session);
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data['menu'] = json_decode($row['picked_menu'],TRUE);
		}

		foreach ($data['menu'] as $key => $value) {
			
			if (in_array($value, $customer_built)) {
				$data['num'][$key+1]  = $key+1;				
			}
		}

		return implode('', $data['num']);
	}




}
?>