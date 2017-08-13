<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Superadmin extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata('logged_in'))
        { 
            redirect('superadmin/dashboard','refresh');
        }else{
        	redirect('superadmin/login','refresh');
        }
	}

	public function login()
	{	

		$submit = $this->input->post('submit');
		if ($this->session->userdata('logged_in'))
        { 
            redirect('superadmin/dashboard','refresh');
        }
		if ($submit == 'submit') {

			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$this->load->model('admin/mdl_admin');
			$result = $this->mdl_admin->login($username,$password);

			if ($result) {
				$admin_session = array();
				foreach ($result as $row) {
					$admin_session = array(
						'admin_id'=> $row->admin_id,
						'first_name'=> $row->first_name,
						'last_name'=> $row->last_name,
						'email'=> $row->email,
						'status'=> $row->status,
						'image'=> $row->image,
						'admin_id'=> $row->admin_id,
						'logged_in'=> TRUE,
						);
				}
				$this->session->set_userdata($admin_session);
				redirect('superadmin/dashboard','refresh');
			}else{
				redirect('superadmin/login','refresh');
			}

		}else{

			$data['title'] = "Fast Food Express";
			$data['view_module'] = "superadmin";
			$data['view_file'] = "superadmin_login";
			$this->load->module("templates");
			$this->templates->admin_login($data);
		}

	}

	public function logout()
	{		
		$this->session->sess_destroy();
		redirect('superadmin/login','refresh');
	}


}