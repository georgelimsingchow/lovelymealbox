<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
		$this->load->model('foodmenu/foodmenu_mdl', 'fm');
		$this->time_now = date('Y-m-d H:i:s');
	}


	public function read_specific($date,$session)
	{
		$cart_data = array();
		$this->db->select('*');
		$this->db->from('food_cart_detail');
		$this->db->where("that_day_date", $date);
		$this->db->where("session", $session);
		$this->db->where("user_id", '0');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$row['selected_menu'] = $this->_food_sequence($row['selected_menu'],$date,$session);
			$cart_data[] = $row;
		}

		return $cart_data;
	}


	public function add()
	{

	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('food_cart_detail');

		if ($this->db->affected_rows()) {
			return true;
		}else{
			return false;
		}
	}

	private function _food_sequence($item, $date,$session)
	{
		$customer_built = json_decode($item,TRUE);
		$data = array();
		$this->db->select('picked_menu');
		$this->db->from('daily_menu');
		$this->db->where('slug',$date);
		$this->db->where('session',$session);
		$query = $this->db->get();
		foreach ($query->result_array() as $row) {
			$data['menu'] = json_decode($row['picked_menu'],TRUE);
		}

		foreach ($data['menu'] as $key => $value) {
			
			if (in_array($value, $customer_built)) {
				$data['num'][$key+1]  = $key+1;				
			}
		}

		return implode('', $data['num']);
	}



}

?>