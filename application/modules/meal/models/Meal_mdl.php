<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Meal_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
		$this->time_now = date('Y-m-d H:i:s');
		$this->current_user_id = $this->mdl_usermodel->getId();
	}

	public function get_alacarte()
	{

		$get_date = $this->input->get('date');
        $timestamp = strtotime($get_date);
        $day = date('N', $timestamp); 
		$data = array();

		$this->db->select('*');
		$this->db->from('alacarte');
		$this->db->where('status', '1');
		$this->db->where("start_date < '$this->time_now'");
		$lunch = $this->db->get();

		foreach ($lunch->result_array() as $row) {
			$availability_date = explode(',', $row['availability']);
			if (in_array($day, $availability_date)) {
				$data[] = $row;
			}			
		}

		return $data;			
	}

	public function get_single_alacarte($id)
	{
		$this->db->select('id,menu_english,menu_chinese,price');
		$this->db->from('alacarte');
		$this->db->where('id', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		$ret = $query->row();
		return $ret;		
	}

	public function add_alacarte($insert)
	{
		$query = $this->db->insert('food_cart_detail', $insert);	
		return true;
	}


	public function get_meal($session,$date)
	{	
		$data = array();

		$this->db->select('*');
		$this->db->from('daily_menu');
		$this->db->where('slug', $date);
		$this->db->where('status', '1');
		$this->db->where('session', $session);
		// custom where expiry date
		$where = "expire_date > '$this->time_now'";
		$this->db->where($where);
		$this->db->limit(1);
		$lunch = $this->db->get();

		foreach ($lunch->result_array() as $row) {
			$data = $row;
		}

		return $data;		
	}


	public function add_mealbox($data)
	{

		// echo json_encode($data);exit;
		$msg['status'] = 'failed';
		$msg['message'] = 'Unknown Error';

		$code_found = $this->db->get_where('mealbox_price', array('code' => $data['code']));
		$price = $code_found->row();

	    if ($code_found->num_rows() <= 0){
	    	$msg['status'] = 'failed';
	    	$msg['message'] = '<strong>Warning!</strong> Wrong Combination';
	    	return $msg;
	    }elseif ($data['quantity'] <= '0') {
	    	$msg['status'] = 'failed';
	    	$msg['message'] = '<strong>Warning!</strong> Please pick at least 1 box';
	    	return $msg;
	    }else{

		    $combined = array_merge($data['meat'],$data['vege']);

			$cart_detail = array(
				'user_id' => $this->current_user_id,
				'type'    => 'mealbox',
				'daily_menu_id' => '',
				'that_day_date' => $data['that_day_date'],
				'session'       => $data['session'],
				'selected_menu' => json_encode($combined),				
				'unit'          => $price->amount,
				'quantity'      => $data['quantity'],			
				'create_date'   => $this->time_now,
				'expire_date'   => date('Y-m-d',(strtotime ( '-1 day', strtotime($data['that_day_date']))))." 21:00:00",
				);

			$query = $this->db->insert('food_cart_detail', $cart_detail);	
			$msg['status'] = 'success';

			return $msg;
	    }   


	    return $msg;



	}
	public function get_cart($session,$date)
	{
		$data = array();

		$this->db->select('*');
		$this->db->from('food_cart_detail');
		$this->db->where('that_day_date', $date);
		$this->db->where('status', 'in_cart');
		$this->db->where('session', $session);
		$this->db->where('user_id', $this->current_user_id);
		// custom where expiry date
		$where = "expire_date > '$this->time_now'";
		$this->db->where($where);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data[] = $row;
		}
		
		return $data;			
	}


	public function del_item($id)
	{
		$this->db->where('user_id', $this->current_user_id);
		$this->db->where('id', $id);
		$this->db->delete('food_cart_detail');

		if ($this->db->affected_rows()) {
			return true;
		}else{
			return false;
		}
			
	}

	public function count_cart_total($session,$date)
	{
		$total = array();

		$this->db->select('SUM(unit*quantity) AS total');
		$this->db->from('food_cart_detail');
		$this->db->where('that_day_date', $date);
		$this->db->where('status', 'in_cart');
		$this->db->where('session', $session);
		$this->db->where('user_id', $this->current_user_id);
		// custom where expiry date
		$where = "expire_date > '$this->time_now'";
		$this->db->where($where);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$total = $row;
		}

		// print_r($total);exit;
		
		return $total;		
	}


}

?>