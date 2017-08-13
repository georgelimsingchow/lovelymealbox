<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cny_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	public function get_table() 
	{
		$table_name = "cny";
		return $table_name;
	}

	public function get_cny()
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