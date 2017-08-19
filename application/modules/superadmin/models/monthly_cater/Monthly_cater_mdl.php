<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Monthly_cater_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	public function get_table() 
	{
		$table_name = array("cater","cater_detail");
		return $table_name;
	}

	public function count_status($status)
	{
		return  $this->db->where('status', $status)->from('cater')->count_all_results();		
	}

	public function get_cater_total_reload($id)
	{
		$data = array();

		$this->db->select('SUM(fee) as total_fee, SUM(credit) as total_credit');
		$this->db->from('cater_detail');
		$this->db->where('cater_id', $id);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}

		return $data;		
	}

	public function get_cater_total_spent($id)
	{
		$data = array();

		$this->db->select('SUM(credit) as total_credit');
		$this->db->from('cater_order');
		$this->db->where('cater_id', $id);
		$names = array('paid', 'delivered');
		$this->db->where_in('order_status', $names);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}

		return $data;	




	}

	public function get_cater()
	{
		$table = $this->get_table();
		$query = $this->db->get($table['0']);
        return $query->result_array();
	}

	public function get_cater_customer($id)
	{
		$table = $this->get_table();

		$this->db->select('*');
		$this->db->from($table['0']);
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$single = $row;
		}

		return $single;
	}

	public function get_single_detail($id)
	{
		$single = '';
		$table = $this->get_table();
		$this->db->select('*');
		$this->db->from($table['1']);
		$this->db->where('cater_id', $id);
		$this->db->where('end_date > ', date('Y-m-d H:i:s'));
		$this->db->order_by('create_date', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$single[] = $row;
		}

		return $single;
	}

	public function get_cater_detail($id)
	{
		$table = $this->get_table();
		$data = array();

		$this->db->select('*');
		$this->db->from($table['1']);
		$this->db->where('cater_id', $id);
		$this->db->order_by('create_date', 'DESC');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		
		return $data;
	}


	public function insert_cater_customer($data)
	{
		$table = $this->get_table();
		$this->db->insert($table['0'], $data);
	}

	public function insert_cater_detail($data)
	{
		$table = $this->get_table();
		$this->db->insert($table['1'], $data);
	}

	public function json_add_cater_order($data)
	{
		$this->db->insert('cater_order', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

}

?>