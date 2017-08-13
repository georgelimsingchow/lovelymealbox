<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('json_to_string'))
{
    function json_to_string($json)
    {    	
    	$modified_array = array();

    	foreach ($json as $key => $value) {
    		$modified_array[$value['id']] = $value['id'];
    	}

    	return $modified_array;
    }   
}


if ( ! function_exists('json_to_array'))
{
    function json_to_array($picked_menu)
    {

    	$ci=& get_instance();
        $ci->load->database(); 

        $meat_vege = array();

		for ($i=0; $i < count($picked_menu); $i++) {

				$ci->db->select('id,menu_english,type,menu_chinese');
				$ci->db->from('food_menu');
				$ci->db->where('id', $picked_menu[$i]['id']);
				$ci->db->limit(1); 
				$cart_data = $ci->db->get(); 

				foreach ($cart_data->result() as $row) {
					$data[$i]['id'] = $row->id;
					$data[$i]['menu_english'] = $row->menu_english;
					$data[$i]['menu_chinese'] = $row->menu_chinese;			
					$data[$i]['type'] = $row->type;		
				}	
		}

		foreach ($data as $key => $value) {
			if ($data[$key]['type'] == 'meat') {
				$meat_vege['meat']['eng'][$data[$key]['id']] = $data[$key]['menu_english'];
				$meat_vege['meat']['cn'][$data[$key]['id']] = $data[$key]['menu_chinese'];
			}else{
				$meat_vege['vege']['eng'][$data[$key]['id']] = $data[$key]['menu_english'];
				$meat_vege['vege']['cn'][$data[$key]['id']] = $data[$key]['menu_chinese'];
			}
		}
		return $meat_vege;
    }   
}

if ( ! function_exists('json_to_array_english'))
{
    function json_to_array_english($picked_menu)
    {

    	$ci=& get_instance();
        $ci->load->database(); 

        $meat_vege = array();

		for ($i=0; $i < count($picked_menu); $i++) {

				$ci->db->select('id,menu_english,type,menu_chinese');
				$ci->db->from('food_menu');
				$ci->db->where('id', $picked_menu[$i]['id']);
				$ci->db->limit(1); 
				$cart_data = $ci->db->get(); 

				foreach ($cart_data->result() as $row) {
					$data[$i]['id'] = $row->id;
					$data[$i]['menu_english'] = $row->menu_english;
					$data[$i]['menu_chinese'] = $row->menu_chinese;			
					$data[$i]['type'] = $row->type;		
				}	
		}

		foreach ($data as $key => $value) {
			if ($data[$key]['type'] == 'meat') {
				$meat_vege['meat'][$data[$key]['id']] = $data[$key]['menu_english'];
			}else{
				$meat_vege['vege'][$data[$key]['id']] = $data[$key]['menu_english'];
			}
		}

		return $meat_vege;
    }   
}

if ( ! function_exists('count_individual_total_quantity'))
{
    function count_individual_total_quantity($that_day_date,$customer_id)
    {
		$today = date('Y-m-d H:i:s');
    	$ci=& get_instance();
        $ci->load->database(); 

		$ci->db->select('that_day_date,SUM(quantity) as total_boxes');
		$ci->db->from('food_cart_detail');
		$ci->db->where('that_day_date', $that_day_date);
		$ci->db->where('status', 'in_cart');
		$ci->db->where('user_id', $customer_id);

		// custom where expiry date
		$where = "expire_date > '$today'";
		$ci->db->where($where);	
		$ci->db->group_by("that_day_date");
		$cart_result = $ci->db->get(); 

		foreach ($cart_result->result() as $row)
		{
		    $total =  $row->total_boxes;
		}

		return $total;
    }   
}

if ( ! function_exists('count_individual_total_amount'))
{
    function count_individual_total_amount($that_day_date,$customer_id)
    {
		$today = date('Y-m-d H:i:s');
    	$ci=& get_instance();
        $ci->load->database(); 

		$ci->db->select('that_day_date,SUM(quantity*unit) as total_amount');
		$ci->db->from('food_cart_detail');
		$ci->db->where('that_day_date', $that_day_date);
		$ci->db->where('status', 'in_cart');
		// custom where expiry date
		$where = "expire_date > '$today'";
		$ci->db->where($where);	
		$ci->db->where('user_id', $customer_id);
		$ci->db->group_by("that_day_date");
		$cart_result = $ci->db->get(); 

		foreach ($cart_result->result() as $row)
		{
		    $total =  $row->total_amount;
		}
		return $total;
    }   
}

if ( ! function_exists('count_total_amount'))
{
    function count_total_amount($user_id)
    {

		$today = date('Y-m-d H:i:s');

    	$ci=& get_instance();
        $ci->load->database(); 

		$ci->db->select('SUM(unit*quantity) as total');
		$ci->db->from('food_cart_detail');
		$ci->db->where('user_id', $user_id);
		$ci->db->where('status', 'in_cart');
		
		// custom where 
		$where = "expire_date > '$today'";
		$ci->db->where($where);
		$ci->db->group_by("user_id");		
		$cart = $ci->db->get(); 

		foreach ($cart->result() as $row)
		{
		    $total =  $row->total;
		}
		return $total;
    }   
}

if ( ! function_exists('check_minimum_order'))
{
    function check_minimum_order($customer_id)
    {
    	$minimum_boxes = '3';
    	$today = date('Y-m-d H:i:s');
    	$boxes = array();
    	
    	$ci=& get_instance();
        $ci->load->database(); 

		$ci->db->select('that_day_date,SUM(quantity) as total_boxes');
		$ci->db->from('food_cart_detail');
		$ci->db->where('status', 'in_cart');
		$ci->db->where('user_id', $customer_id);

		// custom where expiry date
		$where = "expire_date > '$today'";
		$ci->db->where($where);	

		$ci->db->group_by("that_day_date");
		$cart_result = $ci->db->get(); 
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
}


if ( ! function_exists('get_cart'))
{
    function get_cart($user_id)
    {
		$today = date('Y-m-d H:i:s');

    	$ci=& get_instance();
        $ci->load->database(); 

		$cart_data_array = array();

		$ci->db->select('(unit*quantity) as total ,id,unit,quantity,that_day_date,selected_menu,create_date,expire_date');
		$ci->db->from('food_cart_detail');
		$ci->db->where('user_id', $user_id);
		$ci->db->where('status', 'in_cart');
		
		// custom where 
		$where = "expire_date > '$today'";
		$ci->db->where($where);
		$ci->db->order_by('that_day_date', 'ASC');		
		$cart = $ci->db->get(); 

		foreach ($cart->result_array() as $key => $value) {
			$cart_data_array[$value['that_day_date']][$key] = $value;
			$cart_data_array[$value['that_day_date']][$key]['selected_menu'] = json_to_array(json_decode($cart_data_array[$value['that_day_date']][$key]['selected_menu'],true));
		}

		return $cart_data_array;
    }   
}

if ( ! function_exists('fifty'))
{
    function fifty()
    {
		$fifty = array();
		for ($i=1; $i <= 50; $i++) { 
			$fifty[$i] = $i;
		}
		return $fifty;
    }   
}

if ( ! function_exists('get_account_no'))
{
    function get_account_no($customer_id)
    {
    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('account_no');
		$ci->db->from('customer');
		$ci->db->where('customer_id', $customer_id);
		$ci->db->limit('1');
		$account_no = $ci->db->get()->row()->account_no;

		return $account_no;
    }   
}

// controller use
// checkout.php , address.php

if ( ! function_exists('getAddress'))
{
    function getAddress($user_id)
    {

    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('*');
		$ci->db->from('customer_address');
		$ci->db->where('customer_id', $user_id);
		$ci->db->where('status', '1');
		$ci->db->order_by('id', 'DESC');
		$query = $ci->db->get();

		foreach ($query->result_array() as $row)
		{
			$row['state_id'] = getState($row['state_id']);
			$row['long_address'] = "<strong>".$row['address_1'].", ".$row['address_2'].", ".$row['postcode']." ".$row['city'].", ".$row['state_id']."</strong>";
		    $data[] = $row;
		}

		// $row['long_address'] = "<strong>".$row['address_1'].", ".$row['address_2'].", ".$row['postcode']." ".$row['city'].", ".$row['state_id']."</strong> [".$row['firstname']." ".$row['lastname']." ".$row['mobile_no']."]";

		// print_r($data);exit();
		return $data;
    }   
}

if ( ! function_exists('getState'))
{
    function getState($id = null)
    {
    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('state_id,name');
		$ci->db->from('state');
		$ci->db->where('status', '1');

		if (isset($id)) {
			$ci->db->where('state_id', $id);
			$ci->db->limit(1);
			$query = $ci->db->get();

			foreach ($query->result_array() as $row)
			{
			        $data[] = $row;
			}

			return $data['0']['name'];
		}else{
			$query = $ci->db->get();
			foreach ($query->result_array() as $row)
			{
			        $data[$row['state_id']] = $row['name'];
			}

			return $data;
		}		

		foreach ($query->result_array() as $row)
		{
		        $data[$row['state_id']] = $row['name'];
		}

		return $data;
    }   
}

if ( ! function_exists('get_login_type'))
{
    function get_login_type($id = '0')
    {
    	$login_type = array(
    		'0' => 'normal',
    		'1' => 'facebook'
    		);

		return $login_type[$id];
    }   
}

if ( ! function_exists('get_admin'))
{
    function get_admin($admin_id = null)
    {
    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('*');
		$ci->db->from('admin');
		$ci->db->where('admin_id', $admin_id);
		$query = $ci->db->get();

		foreach ($query->result_array() as $row)
		{
		    $data[] = $row;
		}

		return $data['0'];
    }   
}

if ( ! function_exists('get_amount'))
{
    function get_amount($customer_id)
    {
    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('SUM(amount) as total_amount');
		$ci->db->from('balance');
		$ci->db->where('customer_id', $customer_id);
		$query = $ci->db->get();

		foreach ($query->result() as $row)
		{
			$total_amount = $row->total_amount;
		}

		return $total_amount;
    }   
}

if ( ! function_exists('get_total_amount'))
{
    function get_total_amount($customer_id)
    {
    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('SUM(amount) as total_amount');
		$ci->db->from('balance');
		$ci->db->where('customer_id', $customer_id);
		$ci->db->where('order_id', '0');
		$query = $ci->db->get();

		foreach ($query->result() as $row)
		{
			$total_amount = $row->total_amount;
		}

		return $total_amount;
    }   
}

if ( ! function_exists('get_order_number'))
{
    function get_order_number()
    {
    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('order_no');
		$ci->db->from('meal_order');
		$query = $ci->db->get();

		foreach ($query->result() as $row)
		{
			$data[$row->order_no] = $row->order_no;
		}

		return $data;
    }   
}


if ( ! function_exists('get_order_status'))
{
    function get_order_status()
    {

    	$data = array(
    		'processing' => 'PROCESSING',
    		'paid' => 'PAID',
    		'delivered' => 'DELIVERED',
    		'cancelled' => 'CANCELLED',
    		);

		return $data;
    }   
}

if ( ! function_exists('get_customer_name'))
{
    function get_customer_name()
    {

    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('customer_id,first_name,last_name');
		$ci->db->from('customer');
		$query = $ci->db->get();

		foreach ($query->result() as $row)
		{
			$data[$row->customer_id] = $row->first_name." ".$row->last_name;
		}

		return $data;
    }   
}

if ( ! function_exists('get_order_settled'))
{
    function get_order_settled()
    {
    	$data = array(
    		'0' => 'NO',
    		'1' => 'YES',
    		);

		return $data;
    }   
}

if ( ! function_exists('outputCSV'))
{

    function inHouseOutputCSV($data) {


   		$header = array(
			'Customer',
			'Qty',
			'Menu',			
			'Order date',
			'Staff signature'
			);
        $outputBuffer = fopen("php://output", 'w');
        fprintf($outputBuffer, chr(0xEF).chr(0xBB).chr(0xBF)); 
        foreach($data as $title => $val) {
        	$temp_title = array();
        	$temp_title[] = $title;
        	fputcsv($outputBuffer, $temp_title);
        	fputcsv($outputBuffer, $header);
        	foreach ($val as $value) {

        		// unset extra data
        		unset($value['comment']);
        		unset($value['create_date']);
        		unset($value['customer_id']);
        		unset($value['daily_menu_id']);
        		unset($value['email']);
        		unset($value['firstname']);
        		unset($value['is_settled']);
        		unset($value['lastname']);
        		unset($value['order_id']);
        		unset($value['order_no']);
        		unset($value['order_product_id']);
        		unset($value['order_status']);
        		unset($value['payment_address_1']);
        		unset($value['payment_address_2']);
        		unset($value['payment_city']);
        		unset($value['payment_firstname']);
        		unset($value['payment_lastname']);
        		unset($value['payment_phone']);
        		unset($value['payment_postcode']);
        		unset($value['payment_state']);
        		unset($value['phone']);
        		unset($value['price']);
        		unset($value['selected_menu']);
        		unset($value['total']);
        		unset($value['update_date']);
        		


				fputcsv($outputBuffer, $value);
        	}
        }
        fclose($outputBuffer);
    }
}


if ( ! function_exists('outputCSV'))
{

    function deliveryOutputCSV($data) {
        $outputBuffer = fopen("php://output", 'w');

		$header = array(
			'Customer',
			'Phone',
			'Address',			
			'Postcode',
			'Order Date',
			'Customer Signature'
			);

        foreach($data as $title => $val) {
        	$temp_title = array();
        	$temp_title[] = $title;
        	fputcsv($outputBuffer, $temp_title);
        	fputcsv($outputBuffer, $header);
        	fputcsv($outputBuffer, $val);
        }
        fclose($outputBuffer);
    }
}

if (! function_exists('deliveryfee')) 
{
	function deliveryfee()
	{
    	$ci=& get_instance();
        $ci->load->database(); 

		$data = array();
		$ci->db->select('amount');
		$ci->db->from('delivery');
		$ci->db->where('delivery_id', '1');
		$ci->db->where('status', '1');
		$ci->db->limit('1');

		$query = $ci->db->get();

		foreach ($query->result() as $row)
		{
			$deliveryfee = $row->amount;
		}

		// echo $deliveryfee;

		return $deliveryfee;
	}
}