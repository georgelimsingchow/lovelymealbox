<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cart extends MX_Controller
{

	function __construct() 
	{
		parent::__construct();
		if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('superadmin/login','refresh');
        }
        $this->load->model('cart/cart_mdl', 'cart');
	}

	public function delete($id)
	{
		$is_delete = $this->cart->delete($id);

		if ($is_delete) {
			echo json_encode(['status'=>'success']);
		}else{
			echo json_encode(['status'=>'fail']);
		}
	}


}
?>