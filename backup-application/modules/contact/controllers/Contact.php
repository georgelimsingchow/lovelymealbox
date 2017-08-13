<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Contact extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model/mdl_usermodel');
		$this->form_validation->CI =& $this;
		$this->time_now = date('Y-m-d H:i:s');
	}

	function index()
	{
		if ($this->session->userdata('customer_logged_in')) {
			$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
		}

		$data['view_module'] = "contact";
		$data['view_file'] = "contact_page";
		$this->load->module("templates");
		$this->templates->public_bootstrap($data);
	}

	public function send()
	{

		$insert_data['name'] = $this->input->post('name');
		$insert_data['email'] 	 = $this->input->post('email');
		$insert_data['phone'] 	 = $this->input->post('phone');
		$insert_data['subject'] = $this->input->post('subject');
		$insert_data['message'] = $this->input->post('message');
		$insert_data['create_date'] = $this->time_now;
		$captcha 	     = $this->input->post('g-recaptcha-response');

		//form validation
		$this->form_validation->set_rules('name','Name','trim|required|max_length[50]',array('required' => 'Please insert name'));
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[50]',array('required' => 'Please insert email'));
		$this->form_validation->set_rules('phone','Phone','trim|required|max_length[50]',array('required' => 'Please insert phone'));  
		$this->form_validation->set_rules('subject','Subject','trim|required|max_length[50]',array('required' => 'Please insert subject'));
		$this->form_validation->set_rules('message','Message','trim|required',array('required' => 'Please insert message'));
		$this->form_validation->set_rules('g-recaptcha-response','Captcha','trim|required|callback_recaptcha',array('required' => 'please check captcha'));

	    if($this->form_validation->run()===TRUE)
	    {
	     	
	    	
	     	$this->db->insert('contact', $insert_data);
		    $msg = "set_message";

        	$this->session->set_flashdata('flsh_msg', $msg);
	     	redirect('contact');
	    }
	    else
	    {

			if ($this->session->userdata('customer_logged_in')) {
				$data['name'] = $this->mdl_usermodel->getFirstName()." ".$this->mdl_usermodel->getLastName();
			}
			$data['view_module'] 	  = "contact";
			$data['view_file'] 		  = "contact_page";
			$this->load->module("templates");
			$this->templates->public_bootstrap($data);	

	    }


	}



	  public function recaptcha($captcha)
	  {

		$secret = '6LeAfwsUAAAAANX_aBju7dNq6kb6D4BN_F1MMMOB';
		$captcha = $captcha;

		if ( isset($captcha) && $captcha) {

			$site = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
			$result = json_decode($site,TRUE);


			if ($result['success'] == 'true') {
				return TRUE;
			}else{
				$this->form_validation->set_message('recaptcha', 'The {field} field is telling me that you are a robot. Shall we give it another try?');
				return FALSE;
			}
		}
	  }

}