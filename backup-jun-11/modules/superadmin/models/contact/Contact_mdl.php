<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contact_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	public function get_table() 
	{
		$table_name = "contact";
		return $table_name;
	}

	public function get_contact()
	{

		$table = $this->get_table();

		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return $data;
	}

}

?>