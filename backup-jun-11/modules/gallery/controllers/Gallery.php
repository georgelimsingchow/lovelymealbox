<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends MX_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->model('user_model/mdl_usermodel');
		$this->load->model('gallery_mdl', 'gallery');
	}


	public function index()
	{
		$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		$data['food_image_list'] = $this->gallery->get_food_image_list();

		$data['monthly_cater'] = $this->gallery->get_gallery_list('monthly');
		$data['buffet'] = $this->gallery->get_gallery_list('buffet');
		$data['mealbox'] = $this->gallery->get_gallery_list('mealbox');

 		$data['view_module'] = "gallery";
		$data['view_file'] = "gallery_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);

	}

}