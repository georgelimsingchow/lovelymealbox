<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dailymenu_mdl extends CI_Model {

	function __construct() 
	{
		parent::__construct();
		$this->load->model('foodmenu/foodmenu_mdl', 'fm');
		$this->time_now = date('Y-m-d H:i:s');
	}

	public function get_table() 
	{
		$table_name = "daily_menu";
		return $table_name;
	}

	public function edit()
	{
		$table = $this->get_table();
		$daily_menu = $this->input->post('dailymenu');
		$daily_menu_id = $this->input->post('dailymenuid');

		$data = array(
		        'picked_menu' => $daily_menu,
		        'update_date' => $this->time_now,
		);

		$this->db->where('id', $daily_menu_id);
		$this->db->update($table, $data);

		if ($this->db->affected_rows() == '1') {
		    return TRUE;
		} else {
		    return FALSE;
		}
	}


	public function add()
	{
		$table = $this->get_table();
		$daily_menu = $this->input->post('dailymenu');
		$status = $this->input->post('status');
		$session = $this->input->post('session');
		$date = $this->input->post('date');

		$modify_expire = strtotime("$date -1 days");
	    $expire_date = date("Y-m-d", $modify_expire)." 21:00:00";

		$menu_date = $date." 00:00:00";

		$this->db->where('slug',$date);
		$this->db->where('session',$session);
		$q = $this->db->get($table);

	   if ( $q->num_rows() > 0 ) 
	   {
	   		$msg['real_status'] = TRUE;
	   		$msg['status'] = 'failed';
			$msg['msg'] = 'Please choose another date and session';
			return $msg;
	   }else{
		$data = array(
			'menu_date' => $menu_date,
	        'picked_menu' => $daily_menu,
	        'slug' => $date,
	        'status' => $status,
	        'session' => $session,
	        'expire_date' => $expire_date,
	        'create_date' => $this->time_now,
	        'update_date' => $this->time_now,
		);

		$this->db->insert($table,$data);

		if ($this->db->affected_rows() == '1') {
	   		$msg['real_status'] = TRUE;
	   		$msg['status'] = 'success';
			$msg['msg'] = 'Successfully Updated';
			return $msg;
		}

	   }




		echo json_encode($data);die;

		if ($this->db->affected_rows() == '1') {
		    return TRUE;
		} else {
		    return FALSE;
		}
	}

	public function get_single_dailymenu($menu_id)
	{
		$table = $this->get_table();
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where("id", $menu_id);
		$this->db->limit(1);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}
		return $data;
	}

	public function get_single_datemenu($date)
	{
		$table = $this->get_table();
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where("slug", $date);
		$this->db->limit(1);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$data = $row;
		}
		return $data;
	}

	private function decoder($json)
	{
		$decoded_menu = json_decode($json,TRUE);
		$converted = array();

		foreach ($decoded_menu as $key => $id) {
			$converted[] = $this->fm->get_single_food($id);
		}
		return $converted;
	}

	public function json_get_single_dailymenu($date,$session)
	{
		$data = array();
		$table = $this->get_table();
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('slug', $date);
		$this->db->where('session', $session);
		$this->db->limit(1);
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$row['picked_menu'] = $this->decoder($row['picked_menu']);
			$data = $row ;
		}

		return $data;
	}

	public function json_admin_add_to_cart($data)
	{
		$this->db->insert('food_cart_detail', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	public function json_get_cart_data($date,$session)
	{

		$cart_data = array();
		$this->db->select('*');
		$this->db->from('food_cart_detail');
		$this->db->where("that_day_date", $date);
		$this->db->where("session", $session);
		$this->db->where("user_id", '0');
		$query = $this->db->get();

		foreach ($query->result_array() as $row) {
			$row['selected_menu'] =$this->_food_sequence($row['selected_menu'],$date,$session);
			$cart_data[] = $row;
		}

		return $cart_data;
		
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