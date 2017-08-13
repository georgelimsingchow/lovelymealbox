<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Settings extends MX_Controller
{

	function __construct() {
		parent::__construct();
	}

	# VIP free delivery even 1 box

	# non VIP delivery fee RM 1
// $this->load->module('site_security');
	function minimum_order($customer_id)
	{
    	$minimum_boxes = '1';
    	$today = date('Y-m-d H:i:s');
    	$boxes = array();

		$this->db->select('that_day_date,SUM(quantity) as total_boxes');
		$this->db->from('food_cart_detail');
		$this->db->where('status', 'in_cart');
		$this->db->where('user_id', $customer_id);

		$this->db->where('expire_date >', $today);	

		$this->db->group_by("that_day_date");
		$cart_result = $this->db->get(); 
		$is_empty = $cart_result->result();

		foreach ($is_empty as $row) {
			if ($row->total_boxes < $minimum_boxes) {
				return false;
			}
		}

		if (empty($is_empty)) {
			return false;
		}

		return true;
	}

	function delivery_fee($customer_id)
	{
		// order fee RM 1
	}

}