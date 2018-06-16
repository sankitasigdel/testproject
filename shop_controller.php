<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_controller extends CI_Controller {

	public function index()
	{
		$this->load->model('front/shop_model');
		$this->load->model('front/category_model');
		$data['records']=$this->shop_model->book_detail();
		$data['categories'] = $this->category_model->view_bookcategory();
		$data['subcategories'] = $this->category_model->view_booksubcategory();
		$this->load->view('front/shop_view.php',$data);
	}
	
}

/* End of file shop.php */
/* Location: ./application/controllers/front/shop.php */