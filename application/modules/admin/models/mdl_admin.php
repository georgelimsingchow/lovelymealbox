<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_Admin extends CI_Model {

	function __construct() 
	{
		parent::__construct();
	}

	public function login($username,$password)
	{

		$hashed_password = hash ( "sha256", $password );
		$admin_session = array();

		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('username', $username);
		$this->db->where('password', $hashed_password);
		$this->db->where('status', '1');
		$this->db->limit(1);
		$query = $this->db->get();

	   if($query -> num_rows() == 1)
	   {
	     return $query->result();
	   }
	   else{
	     return false;
	   }
	}

}