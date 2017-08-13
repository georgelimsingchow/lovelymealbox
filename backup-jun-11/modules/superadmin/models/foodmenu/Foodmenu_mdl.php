<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Foodmenu_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	public function get_table() 
	{
		$table_name = "food_menu";
		return $table_name;
	}

	public function get_single_food($id)
	{

		$table = $this->get_table();

		$this->db->select('menu_chinese');
		$this->db->from($table);
		$this->db->where("id", $id);
		$this->db->limit(1);

		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row['menu_chinese'];
		}

		return $data;
	}

}

?>