<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Order extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
        $this->load->model('order/order_mdl', 'mOrder');
        $this->load->model('customer/customer_mdl', 'customer');
        $this->load->model('foodmenu/foodmenu_mdl', 'foodmenu');
        $this->load->model('dailymenu/dailymenu_mdl', 'daily');
        $this->load->model('cart/cart_mdl', 'cart');

         $this->load->model('settings/settings_mdl', 'settings');
	}

	public function index()
	{	
		//select data
		$data['order_no'] = $this->_get_data('meal_order','order_no');
		$data['customer_name'] = $this->_get_first_last_name();
		$data['order_status'] = $this->_get_order_status();
		$data['delivery_session'] = $this->_get_delivery_session();

		// fetch data
		$get['order_number']     = $this->input->get('order_number',TRUE);
		$get['customer_id']      = $this->input->get('customer_id',TRUE);
		$get['order_status']     = $this->input->get('order_status',TRUE);
		$get['that_day_date']    = $this->input->get('that_day_date',TRUE);
		$get['delivery_session'] = $this->input->get('delivery_session',TRUE);
		$get['submit']           = $this->input->get('submit',TRUE);

		if ($get['submit'] == 'submit') {

			$data['details'] = array();
			$mo = 'meal_order.order_no';
			$mo_p = 'meal_order_product.order_no';
			$data['url'] = '';	

			$this->db->select('*');
			$this->db->from('meal_order');
			$this->db->join('meal_order_product', 'meal_order.order_id = meal_order_product.order_id');	

			// order_no=&that_day_date=&customer_id=&delivery_session=&order_status=

			if (($get['order_number']    != '')) 
				{
					$this->db->where('meal_order.order_no',$get['order_number']);
					$data['url'] .= '&order_no=' . $get['order_number'];
				}
			if (($get['customer_id']     != '')) 
				{
					$this->db->where('meal_order.customer_id',$get['customer_id']);
					$data['url'] .= '&customer_id=' . $get['customer_id'];
				}
			if (($get['order_status']    != '')) 
				{
					$this->db->where('meal_order.order_status',$get['order_status']);
					$data['url'] .= '&order_status=' . $get['order_status'];
				}
			if (($get['delivery_session']!= '')) 
				{
					$this->db->where('meal_order.delivery_session',$get['delivery_session']);
					$data['url'] .= '&delivery_session=' . $get['delivery_session'];
				}
			if (($get['that_day_date']   != '')) 
				{
					$this->db->where('meal_order_product.that_day_date',$get['that_day_date']);
					$data['url'] .= '&that_day_date=' . $get['that_day_date'];
				}

			$query = $this->db->get();
			foreach ($query->result() as $row) {
				$data['details'][$row->order_no][] = $row;
			}

			$this->_repeat_detail_view($data);

		}else{
			$this->_repeat_detail_view($data);
		}	
	}

	private function _repeat_detail_view($data)
	{
		$data['view_module'] = "superadmin";
		$data['view_file'] = "order/order_detail_page";
		$this->load->module("templates");
		$this->templates->admin($data);	
	}

	public function add_box()
	{
		$date    = $this->input->get('date');
		$session = $this->input->get('session');

		if ((isset($date)) && (isset($session))) {
			$data['single_dailymenu'] = $this->daily->json_get_single_dailymenu($date,$session);
		}

		$data['view_module'] = "superadmin";
		$data['view_file'] = "order/add_meal_page";
		$this->load->module("templates");
		$this->templates->admin($data);	
	}

	public function info()
	{
		$data['order_id']      = $this->input->get('order_id');
		$data['info'] 	       = $this->mOrder->get_single_order($data['order_id']);
		$data['that_day_date'] = $this->mOrder->get_that_day_that($data['order_id']);

		$data['view_module'] = "superadmin";
		$data['view_file'] = "order/order_edit_page";
		$this->load->module("templates");
		$this->templates->admin($data);			
	}

	public function edit_status($order_id)
	{
		$order_status = $this->input->post('order_status');

		$this->db->set('order_status', $order_status);
		$this->db->where('order_id', $order_id);
		$this->db->update('meal_order');

		$this->session->set_flashdata('msg', 'Order has been updated');
		redirect("superadmin/order/info?order_id=$order_id");

	}

	public function report()
	{
		$order_data = array();

		$get['order_number']     = $this->input->get('order_number',TRUE);
		$get['customer_id']      = $this->input->get('customer_id',TRUE);
		$get['order_status']     = $this->input->get('order_status',TRUE);
		$get['that_day_date']    = $this->input->get('that_day_date',TRUE);
		$get['delivery_session'] = $this->input->get('delivery_session',TRUE);

		if (($get['order_number']    != '')) {$this->db->where('meal_order.order_no',$get['order_number']);}
		if (($get['customer_id']     != '')) {$this->db->where('meal_order.customer_id',$get['customer_id']);}
		if (($get['order_status']    != '')) {$this->db->where('meal_order.order_status',$get['order_status']);}
		if (($get['delivery_session']!= '')) {$this->db->where('meal_order.delivery_session',$get['delivery_session']);}
		if (($get['that_day_date']   != '')) {$this->db->where('meal_order_product.that_day_date',$get['that_day_date']);}

		$this->db->select("*, meal_order.create_date AS mo_create_date, meal_order.update_date AS mo_update_date, meal_order.total AS mo_total");
		$this->db->from('meal_order');
		$this->db->join('meal_order_product', 'meal_order.order_id = meal_order_product.order_id');	

		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			if ($row['delivery_session'] == 'lunch') {
				$order_data['lunch'][$row['order_no']]['order_date'] = $row['that_day_date'];
				$order_data['lunch'][$row['order_no']]['customer_id'] = $row['customer_id'];
				$order_data['lunch'][$row['order_no']]['name'] = $row['firstname']." ".$row['lastname'];
				$order_data['lunch'][$row['order_no']]['address'] = $row['payment_address_1'].",".$row['payment_address_2'];
			$order_data['lunch'][$row['order_no']]['phone'] = $row['payment_phone'];
			$order_data['lunch'][$row['order_no']]['total'] = $row['mo_total']+$row['delivery_fee'];
			$order_data['lunch'][$row['order_no']]['comment'] = $row['comment'];
			$order_data['lunch'][$row['order_no']]['status'] = $row['order_status'];
			if ($row['type'] == 'mealbox') {
				$order_data['lunch'][$row['order_no']]['food'][] = $this->_food_sequence($row['selected_menu'],$row['that_day_date'],$row['delivery_session'])." x".$row['quantity'];
			}else{
				$order_data['lunch'][$row['order_no']]['food'][] = $this->_get_single_alacarte($row['selected_menu'])." x".$row['quantity'];
			}
			}

			if ($row['delivery_session'] == 'dinner') {
				$order_data['dinner'][$row['order_no']]['order_date'] = $row['that_day_date'];
				$order_data['dinner'][$row['order_no']]['customer_id'] = $row['customer_id'];
				$order_data['dinner'][$row['order_no']]['name'] = $row['firstname']." ".$row['lastname'];
				$order_data['dinner'][$row['order_no']]['address'] = $row['payment_address_1'].",".$row['payment_address_2'];
			$order_data['dinner'][$row['order_no']]['phone'] = $row['payment_phone'];
			$order_data['dinner'][$row['order_no']]['total'] = $row['mo_total']+$row['delivery_fee'];
			$order_data['dinner'][$row['order_no']]['comment'] = $row['comment'];
			$order_data['dinner'][$row['order_no']]['status'] = $row['order_status'];
			if ($row['type'] == 'mealbox') {
				$order_data['dinner'][$row['order_no']]['food'][] = $this->_food_sequence($row['selected_menu'],$row['that_day_date'],$row['delivery_session'])." x".$row['quantity'];
			}else{
				$order_data['dinner'][$row['order_no']]['food'][] = $this->_get_single_alacarte($row['selected_menu'])." x".$row['quantity'];
			}
			}


		}
		
		$data['page_title']   = $get['that_day_date'];
		$data['order_report'] = $order_data;
		$data['view_module'] = "superadmin";
		$data['view_file'] = "order/order_report_page";
		$this->load->module("templates");
		$this->templates->report($data);		

		return $data;
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

	private function convert_to_food($data){
		$new_data = array();
		$decoded_data = json_decode($data);
		foreach ($decoded_data as $key['id'] => $value) {
			$new_data[] = $this->foodmenu->get_single_food($value->id);
		}

		$splitted = implode(",", $new_data);
		return $splitted;
	}

	private function _get_single_alacarte($id)
	{
		$this->db->select('id,menu_english,menu_chinese,price');
		$this->db->from('alacarte');
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret->menu_english;
	}

	private function _get_data($table_name,$column_name)
	{
		$data[''] = 'Please Select';
		$this->db->select($column_name);
		$this->db->from($table_name);		
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$data[$row->$column_name] = $row->$column_name;
		}
		return $data;
	}

	private function _get_first_last_name()
	{
		$data[''] = 'Please Select';
		$this->db->select('*');
		$this->db->from('customer');	
		
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$data[$row->customer_id] = $row->first_name." ".$row->last_name." (".$row->account_no.")";
		}
		return $data;
	}

	private function _get_order_status()
	{
		$data = array(
			'' =>'Please Select',
	        'processing' => 'Processing',
	        'paid'       => 'Paid',
	        'delivered'  => 'Delivered',
	        'cancelled'  => 'Cancelled',			
			);

		return $data;
	}

	private function _get_delivery_session()
	{
		$data = array(
			'' =>'Please Select',
	        'lunch' => 'Lunch',
	        'dinner'       => 'Dinner',			
			);
		return $data;
	}

	public function printable_report()
	{
		$print_data =array();
		$get['order_number']     = $this->input->get('order_number',TRUE);
		$get['customer_id']      = $this->input->get('customer_id',TRUE);
		$get['order_status']     = $this->input->get('order_status',TRUE);
		$get['that_day_date']    = $this->input->get('that_day_date',TRUE);
		$get['delivery_session'] = $this->input->get('delivery_session',TRUE);

		if (($get['order_number']    != '')) {$this->db->where('meal_order.order_no',$get['order_number']);}
		if (($get['customer_id']     != '')) {$this->db->where('meal_order.customer_id',$get['customer_id']);}
		if (($get['order_status']    != '')) {$this->db->where('meal_order.order_status',$get['order_status']);}
		if (($get['delivery_session']!= '')) {$this->db->where('meal_order.delivery_session',$get['delivery_session']);}
		if (($get['that_day_date']   != '')) {$this->db->where('meal_order_product.that_day_date',$get['that_day_date']);}

		$mo  = 'meal_order';
		$mop = 'meal_order_product';

		$this->db->select("$mo.payment_firstname,$mo.payment_lastname,$mo.phone,$mop.that_day_date,$mop.selected_menu,$mop.quantity,$mo.payment_address_1,$mo.payment_address_2,$mo.payment_postcode,$mo.delivery_session,$mo.order_status,$mop.price,$mo.comment");
		$this->db->from('meal_order');
		$this->db->join('meal_order_product', 'meal_order.order_id = meal_order_product.order_id');	

		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$row['selected_menu'] = $this->convert_to_food($row['selected_menu']);
			$print_data[] = $row;
		}

		$data['print_report'] = $print_data;
		$data['view_module'] = "superadmin";
		$data['view_file'] = "order/print_report_page";
		$this->load->module("templates");
		$this->templates->report($data);			
	}

}