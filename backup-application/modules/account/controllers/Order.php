<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Order extends Member_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
	}


	public function index()
	{

		$order_type = $this->input->get('type') ? $this->input->get('type') : 'processing';
		switch ($order_type) {
			case 'processing':
				$order_type = 'processing';
				break;
			case 'paid':
				$order_type = 'paid';
				break;
			case 'delivered':
				$order_type = 'delivered';
				break;	
			case 'cancelled':
				$order_type = 'cancelled';
				break;			
			default:
				$order_type = 'processing';
				break;
		}
		
		$firstname 			 = $this->mdl_usermodel->getFirstName();
		$lastname 			 = $this->mdl_usermodel->getLastName();
		$customer_id 		 = $this->mdl_usermodel->getID();

		$data['order_type']  = $order_type;
		$data['name'] 		 = $firstname." ".$lastname;
		//order type
		$data['all_order'] 	 = $this->_getOrder($customer_id,$order_type);

		// print_r($data);exit();
		$data['all'] 		 = count($this->_getOrder($customer_id));
		$data['processing']  = count($this->_getOrder($customer_id,'processing'));
		$data['paid'] 		 = count($this->_getOrder($customer_id,'paid'));
		$data['delivered']  = count($this->_getOrder($customer_id,'delivered'));
		$data['cancelled'] 	 = count($this->_getOrder($customer_id,'cancelled'));

		$data['view_module'] = "account";
		$data['view_file'] 	 = "order/order_show_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	private function _getOrder($customer_id, $order_type = 'all')
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('meal_order');
		$this->db->where('customer_id', $customer_id);

		switch ($order_type) {
			case 'processing':
				$this->db->where('order_status', $order_type);
				break;
			case 'paid':
				$this->db->where('order_status', $order_type);
				break;
			case 'delivered':
				$this->db->where('order_status', $order_type);
				break;
			case 'cancelled':
				$this->db->where('order_status', $order_type);
				break;			
			default:
				break;
		}
		$this->db->order_by('order_id', 'DESC');

		$order_result = $this->db->get(); 

		foreach ($order_result->result_array() as $row)
		{
			$row['order_details'] = $this->_order_details($row['order_id']);
		    $data[] = $row;
		}

		return $data;
	}

	private function _order_details($order_id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('meal_order_product');
		$this->db->where('order_id', $order_id);

		$order_details_result = $this->db->get();

		foreach ($order_details_result->result_array() as $row)
		{	
			$row['selected_menu'] = json_to_array(json_decode($row['selected_menu'],true));
		    $data[] = $row;
		}

		return $data; 	
	}

}
