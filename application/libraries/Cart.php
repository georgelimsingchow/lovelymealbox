<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
class Cart {

    public function __construct() 
    {
        parent::__construct();
    }

    public function get_fastfood($data)
    {
    	print_r($data);
    }

    public function get_dessert($data)
    {
    	print_r($data);
    }

    public function get_drink($data)
    {
    	print_r($data);
    }

    public function get_dish($data)
    {
    	print_r($data);
    }
}

?>