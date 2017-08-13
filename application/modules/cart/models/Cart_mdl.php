<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cart_mdl extends CI_Model {

	private $time_now = null;

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
	}

	// new function 
	// new table name
	public function get_cart()
	{

		$data = array();
		$this->db->select('*');
		$this->db->from('new_cart');
		$this->db->where('customer_id', '1');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}

		return $data;
	}

	public function mealbox_insert_cart($data)
	{
		// merge meat and vege
		$data['mv'] = array_merge($data['meat'],$data['vege']);

		// create mealbox option
		$data['mealbox'] = array(
			'mealbox' =>array(
				'option'=> $data['mv'],
				)
			);

		$insert_data = array(
			'user_id' => $this->session->customer_id,
			'daily_menu_id' => '0',
			'that_day_date' => $data['date'],
			'selected_menu' => json_encode($data['mealbox']),
			'unit'          => $data['msg']['single_price'],
			'quantity'		=> $data['quantity'],
			'status'        => 'in_cart',
			'session'       => $data['input_session'],
			'create_date'   => $this->time_now,
			'expire_date'   => $data['expiry_date'],
			);

		$this->db->insert('food_cart_detail', $insert_data);

		
		
	}






}

?>