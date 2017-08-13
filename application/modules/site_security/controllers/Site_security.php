<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Site_security extends MX_Controller
{

	function __construct() {
	parent::__construct();
	}

	function _hash_password($password) {

	$hashed_password = password_hash($password,PASSWORD_BCRYPT,array(
		'cost' => 11,
		));

	return $hashed_password;
	}

	function _verify_password($plain_password,$hashed_password = null)
	{
		$result = password_verify($plain_password,$hashed_password);
		return $result; //TRUE OR FALSE
	}

}