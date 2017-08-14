<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reload extends Admin_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation'); 
		$this->load->model('reload/reload_mdl', 'reload');
	}

	public function index()
	{
		$data['customer_data'] =  $this->_getCustomer();
		$data['view_module'] = "superadmin";
		$data['view_file'] = "reload_page";
		$this->load->module("templates");
		$this->templates->admin($data);
	}

	public function add_balance()
	{
		$submit = $this->input->post('submit',TRUE);
		
		$customer_id = $this->input->get('customer_id');


		$this->form_validation->set_rules('amount', 'Reload amount', 'required|is_numeric');
		$this->form_validation->set_rules('description', 'Description', 'required');

			if ($this->form_validation->run() == TRUE){
				$insert_data = $this->reload_fetch_from_post();
				$this->db->insert('balance', $insert_data);

				redirect('superadmin/reload/add_balance/'.$customer_id);
				

			}else{

				$data['customer_reload']= $this->reload->get_total_reload($customer_id);
				$data['customer_real_reload'] = $this->reload->get_total_real_reload($customer_id);
				$data['customer_used']= $this->reload->get_total_used($customer_id);
				$admin_id               = $this->session->admin_id;
				$data['admin']    		= get_admin($admin_id);
				$data['order']    		= $this->_getOrder($customer_id);
				$data['customer_data']  = $this->_getSingleCustomer($customer_id);
				$data['view_module']    = "superadmin";
				$data['view_file']      = "reload_add_page";
				$this->load->module("templates");
				$this->templates->admin($data);	
			}
	
	}



	private function _getOrder($customer_id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('balance');
		$this->db->where('customer_id', $customer_id);
		$this->db->where('admin_id <>', '0');
		$this->db->order_by('create_date', 'DESC');

		$order_result = $this->db->get(); 

		foreach ($order_result->result_array() as $row) {
			$data[] = $row;
		}
		return $data;		
	}


	private function _getCustomer()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('customer');

		$customer_result = $this->db->get(); 

		foreach ($customer_result->result_array() as $row) {
			$row['amount_left'] = get_amount($row['customer_id']);
			$row['total_amount'] = get_total_amount($row['customer_id']);
			$data[] = $row;
		}

		return $data;		
	}


	private function _getSingleCustomer($customer_id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id', $customer_id);
		$customer_result = $this->db->get(); 

		foreach ($customer_result->result_array() as $row) {
			$data[] = $row;
		}

		return $data['0'];			
	}

	private function reload_fetch_from_post()
	{
		//from post
		$data['customer_id']  = $this->input->post('customer_id',TRUE);
		$data['description']  = $this->input->post('description',TRUE);
		$data['amount']	      = $this->input->post('amount',TRUE);
		$data['admin_id']     = $this->input->post('admin_id',TRUE);
		$data['order_id']     = '0';
		//additional information 
		$data['create_date'] = $this->get_time_now();
		$data['expire_date'] = $this->_check_if_reload_before($data['customer_id']);

		return $data;
	}


	private function _check_if_reload_before($customer_id)
	{

		$end_of_today = date('Y-m-d')." 23:59:59";
		$data = array();
		$this->db->select('expire_date');
		$this->db->from('balance');
		$this->db->where('customer_id', $customer_id);
		$this->db->where('amount >', '0.00');
		$this->db->where('admin_id <>', '0');
		// $this->db->where('expire_date <', $date);
		$this->db->where('expire_date >=', $end_of_today);
		$this->db->order_by('expire_date', 'DESC');
		$this->db->limit(1);

		$balance_result = $this->db->get(); 

		foreach ($balance_result->result_array() as $row) {
			$data[] = $row;
		}

		if (count($data) > '0') {
			$continue_last_date = date('Y-m-d H:i:s', strtotime($data['0']['expire_date'] . ' +40 day'));
			return $continue_last_date;
		}else{
			$add_forty_from_today = date('Y-m-d H:i:s', strtotime($end_of_today . ' +40 day'));
			return $add_forty_from_today;
		}

	}


	public function reload_report()
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('balance');
		$this->db->order_by('customer_id', 'asc'); 

		$result = $this->db->get(); 

		foreach ($result->result_array() as $row) {
			$row['customer_name'] = $this->get_customer_name($row['customer_id']); 
			$data[] = $row;
		}


		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		$this->excel->getActiveSheet()->setTitle('DELIVERY LIST');		


		$this->excel->getActiveSheet()->fromArray($data, null, 'A2');

		// set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'BALANCE ID');
		$this->excel->getActiveSheet()->setCellValue('B1', 'CUSTOMER ID');
		$this->excel->getActiveSheet()->setCellValue('C1', 'ADMIN ID');
		$this->excel->getActiveSheet()->setCellValue('D1', 'ORDER ID');
		$this->excel->getActiveSheet()->setCellValue('E1', 'AMOUNT');
		$this->excel->getActiveSheet()->setCellValue('F1', 'DESCRIPTION');
		$this->excel->getActiveSheet()->setCellValue('G1', 'IMG RECEIPT');
		$this->excel->getActiveSheet()->setCellValue('H1', 'EXPIRE');
		$this->excel->getActiveSheet()->setCellValue('I1', 'CREATE');
		$this->excel->getActiveSheet()->setCellValue('J1', 'CUSTOMER NAME');

		// change the font size
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		// // make the font become bold
		// $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		// // merge cell A1 until D1
		// $this->excel->getActiveSheet()->mergeCells('A1:D1');
		// set aligment to center for that merged cell (A1 to D1)
		// $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		 
		$filename= 'Reload-REPORT.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');	
	}

	private function get_customer_name($customer_id)
	{
		$data = array();
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id', $customer_id); 
		$this->db->limit(1);

		$query = $this->db->get();
		$first_name = $query->row()->first_name;
		$last_name = $query->row()->last_name;
		$full_name = $first_name." ".$last_name;

		return $full_name;
	}


}