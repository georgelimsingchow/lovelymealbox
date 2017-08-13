<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ckonly extends MX_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model('ckonly/ckonly_mdl', 'ck');
	}

	public function index()
	{
		$date = $this->input->get('date');

		$date_validation = $this->_validateDate($date);

		if (!$date_validation) {
			redirect('home');
		}
		
		$data['ck_report']   = $this->ck->report($date);
		$data['view_module'] = "ckonly";
		$data['view_file'] = "ck_report_page";
		$this->load->module("templates");
		$this->templates->report($data);


	}

	private function _validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

}