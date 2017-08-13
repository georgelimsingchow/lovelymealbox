<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	public function get_table() 
	{
		$table_name = "food_menu";
		return $table_name;
	}

	public function get_food_image_list()
	{

		$table = $this->get_table();
		$data = array();

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('pic_url !=', '');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		// print_r($data);exit();

		return $data;
	}

	public function get_gallery_list($type)
	{

		$data = array();

		$this->db->select('*');
		$this->db->from('gallery');
		$this->db->where('img_path !=', '');
		$this->db->where('type', $type);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return $data;
	}

}

?>