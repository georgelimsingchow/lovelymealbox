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
	}

	public function index()
	{

		$data['processing'] = $this->_getProcessingOrder();
		$data['paid'] = $this->_getPaidOrder();
		$data['delivered'] = $this->_getDeliveredOrder();
		$data['cancelled'] = $this->_getCancelledOrder();
		$data['all_order'] = $this->_getAllOrder();

		$data['view_module'] = "superadmin";
		$data['view_file'] = "order_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	private function _selectOrder()
	{
		$this->db->select('*');
		$this->db->from('meal_order');		
	}



	public function new_one()
	{

		$order_number = $this->input->get('order_number',TRUE);
		$customer_name = $this->input->get('customer_name',TRUE);
		$order_status = $this->input->get('order_status',TRUE);
		$that_day_date = $this->input->get('that_day_date',TRUE);
		$is_settled = $this->input->get('is_settled',TRUE);
		$submit = $this->input->get('submit',TRUE);
		$url    = '?';

		$order_data = array();
		if ($submit == 'submit') {
			$data = array();
			$this->_selectOrder();

			if (!empty($order_number)) {
				$this->db->where('order.order_no', $order_number);
				$url    .= 'order_number='.$order_number.'&';
			}

			if (!empty($customer_name)) {
				$this->db->where('order.customer_id', $customer_name);
				$url    .= 'customer_name='.$customer_name.'&';
			}

			if (!empty($order_status)) {
				$this->db->where('order.order_status', $order_status);
				$url    .= 'order_status='.$order_status.'&';
			}

			if (!empty($that_day_date)) {
				$this->db->where('order_product.that_day_date', $that_day_date);
				$url    .= 'that_day_date='.$that_day_date.'&';
			}

			if (!is_null($is_settled)) {
				$this->db->where('order_product.is_settled', $is_settled);
				$url    .= 'is_settled='.$is_settled;
			}

			$this->db->join('order_product', 'order.order_id = order_product.order_id');

			$query = $this->db->get();

			foreach ($query->result_array() as $row) {
				$order_data[$row['order_no']][] = $row;
			}
		}

		$data['url_data']          = (string)$url;

		$data['get_order_settled'] = get_order_settled();
		$data['get_order_number'] = get_order_number();
		$data['get_order_status'] = get_order_status();
		$data['get_customer_name'] = get_customer_name();
		$data['order_data'] = $order_data;
		$data['view_module'] = "superadmin";
		$data['view_file'] = "order_filter_page";
		$this->load->module("templates");
		$this->templates->admin($data);		
	}

	public function delivery_csv() 
	{		

		$order_data = array();
		$this->_report_query();	

		# special purpose
		$that_day_date = $this->input->get('that_day_date',TRUE);
		if (!empty($that_day_date)) {
			$this->db->where('order_product.that_day_date', $that_day_date);
		}else{
			$that_day_date = 'ALL';
		}

		$query = $this->db->get();

		foreach ($query->result_array() as $row) {

			// $order_data[$row['order_no']][] = $row;
			$order_data[$row['order_no']]['buyer_name'] = $row['payment_firstname']." ".$row['payment_lastname'];
			$order_data[$row['order_no']]['buyer_phone'] = $row['payment_phone'];
			$order_data[$row['order_no']]['address'] = $row['payment_address_1'].",".$row['payment_address_2'].",".$row['payment_city'];
			$order_data[$row['order_no']]['postcode'] = $row['payment_postcode'];
			$order_data[$row['order_no']]['postcode'] = $row['payment_postcode'];
			$order_data[$row['order_no']]['order_date'] = $row['that_day_date'];

		}

		# if not date then show all
	    $filename = "MB-REPORT-DELIVERY-".$that_day_date;

		header("Content-type: text/csv; charset=UTF-8");
	    header("Content-type: text/csv");
	    header("Content-Disposition: attachment; filename={$filename}.csv");
	    header("Pragma: no-cache");
	    header("Expires: 0");

	    deliveryOutputCSV($order_data);
	}

	# show only customer name, buyer name, quantity, selected menu
	public function inhouse_csv($language = 'EN')
	{
		$order_data = array();

		$this->_report_query();			

		# special purpose
		$that_day_date = $this->input->get('that_day_date',TRUE);
		if (!empty($that_day_date)) {
			$this->db->where('order_product.that_day_date', $that_day_date);
		}else{
			$that_day_date = 'ALL';
		}

		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			//self made array
			$row['selected_menu_text'] = $this->_string(json_to_string(json_decode($row['selected_menu'],TRUE)),$language);
			$row['buyer_name'] = $row['payment_firstname']." ".$row['payment_lastname'];
			$order_data[$row['order_no']][] = $row;
		}

		foreach ($order_data as $key => $value) {
			foreach ($value as $v_k => $v_v) {
				ksort($order_data[$key][$v_k]);
			}			
		}

		# if not date then show all
	    $filename = "MB-REPORT-INHOUSE-".$that_day_date."-".$language;

		header("Content-type: text/csv; charset=UTF-8");
	    header("Content-type: text/csv");
	    header("Content-Disposition: attachment; filename={$filename}.csv");
	    header("Pragma: no-cache");
	    header("Expires: 0");

	    inHouseOutputCSV($order_data);
	}

	private function _string($data,$language = 'EN')
	{	

		if ($language == 'EN') {
			$str = 'menu_english';
		}else{
			$str = 'menu_chinese';
		}

		$data_to_string = implode(",", $data);

		$text_data = array();
		$query_new = $this->db->query("SELECT $str FROM food_menu WHERE id IN ($data_to_string)");
		foreach ($query_new->result_array() as $row) {
			$text_data[] = $row[$str];
		}

		$comma_separated = implode("|", $text_data);
		
		return $comma_separated;
	}

	private function _report_query()
	{

		$order_number = $this->input->get('order_number',TRUE);
		$customer_name = $this->input->get('customer_name',TRUE);
		$order_status = $this->input->get('order_status',TRUE);
		$is_settled = $this->input->get('is_settled',TRUE);

		$this->_selectOrder();

		if (!empty($order_number)) {
			$this->db->where('order.order_no', $order_number);
		}

		if (!empty($customer_name)) {
			$this->db->where('order.customer_id', $customer_name);
		}

		if (!empty($order_status)) {
			$this->db->where('order.order_status', $order_status);
		}

		if (!is_null($is_settled)) {
			$this->db->where('order_product.is_settled', $is_settled);
		}

		$this->db->join('order_product', 'order.order_id = order_product.order_id');
	}

	/*
	1 = processing
	2 = paid 
	3 = cancelled also mean expire
	4 = delivered 
	*/
	private function _getProcessingOrder()
	{
		$data = array();
		$this->_selectOrder();
		$this->db->where('order_status', 'processing');
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		$data['total'] = count($data);

		return $data;
	}

	private function _getPaidOrder()
	{
		$data = array();
		$this->_selectOrder();
		$this->db->where('order_status', 'paid');
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		$data['total'] = count($data);		

		return $data;
	}

	private function _getDeliveredOrder()
	{
		$data = array();
		$this->_selectOrder();
		$this->db->where('order_status', 'delivered');
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		$data['total'] = count($data);	

		return $data;
	}

	private function _getCancelledOrder()
	{
		$data = array();
		$this->_selectOrder();
		$this->db->where('order_status', 'cancelled');
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		$data['total'] = count($data);		

		return $data;
	}

	private function _getAllOrder()
	{
		$data = array();
		$this->_selectOrder();
		$this->db->order_by('create_date', 'DESC');
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data['details'][] = $row;
		}
		$data['total'] = count($data);	

		return $data;
	}




}