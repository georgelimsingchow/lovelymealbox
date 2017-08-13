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
		$data['customer_id'] = $this->input->get('customer_id');
		$data['order_id'] = $this->input->get('order_id');
		$data['that_day_date'] = $this->input->get('that_day_date');

		print_r($data);exit();

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
			$data[] = $row;
		}

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('DELIVERY LIST');		


		$this->excel->getActiveSheet()->fromArray($data, null, 'A2');

		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'FIRST NAME');
		$this->excel->getActiveSheet()->setCellValue('B1', 'LAST NAME');
		$this->excel->getActiveSheet()->setCellValue('C1', 'PHONE');
		$this->excel->getActiveSheet()->setCellValue('D1', 'DATE');
		$this->excel->getActiveSheet()->setCellValue('E1', 'ITEM');
		$this->excel->getActiveSheet()->setCellValue('F1', 'QTY');
		$this->excel->getActiveSheet()->setCellValue('G1', 'ADDRESS 1');
		$this->excel->getActiveSheet()->setCellValue('H1', 'ADDRESS 2');
		$this->excel->getActiveSheet()->setCellValue('I1', 'POSTCODE');
		$this->excel->getActiveSheet()->setCellValue('J1', 'SESSION');
		$this->excel->getActiveSheet()->setCellValue('K1', 'STATUS');
		$this->excel->getActiveSheet()->setCellValue('L1', 'STATUS');
		$this->excel->getActiveSheet()->setCellValue('M1', 'COMMENT');

		//change the font size
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		//make the font become bold
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		// $this->excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		// $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 
		$filename= $get['that_day_date'].'-REPORT.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');		
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