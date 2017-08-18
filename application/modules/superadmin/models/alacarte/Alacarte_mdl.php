<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Alacarte_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	public function find_all()
	{

		$this->db->select('*');
		$this->db->from('alacarte');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return $data;
	}

	public function find_by_id($id)
	{
		return $this->db->where('id',$id)->limit(1)->get('alacarte')->row();
	}

	public function edit($data,$id)
	{

		$this->db->where('id', $id);
		$this->db->update('alacarte', $data);

		if($this->db->affected_rows() >=0){
		  return true; //add your code here
		}else{
		  return false; //add your your code here
		}
	}

}

?>