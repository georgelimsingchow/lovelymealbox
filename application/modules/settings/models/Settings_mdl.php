<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}


	public function box_validation()
	{
		$data = array();
		$this->db->select('code,amount');
		$this->db->from('mealbox_price');
		$this->db->where('status','1');

		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data[$row['code']] = $row['amount'];
		}

		echo json_encode($data);
	}

}

?>