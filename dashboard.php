<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//validate admin login
		if(!is_userlogin())
		{
			redirect(site_url('front/shop_controller'),'refresh');
			exit();
		}
	}

	public function index()
	{
		$this->load->model('front/category_model');
		$this->load->model('front/shop_model');
		$data['records']=$this->shop_model->book_detail();
		$data['categories'] = $this->category_model->view_bookcategory();
		$data['subcategories'] = $this->category_model->view_booksubcategory();
		$data['main_content'] = 'shop_view';
		$this->load->view('front/template', $data);
	}

	public function logout()
	{
		$this->load->library('cart');
		$this->cart->destroy();
		$this->session->unset_userdata('user_logged_in');
		redirect(site_url('front/shop_controller'),'refresh');
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */