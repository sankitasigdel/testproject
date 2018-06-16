<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_controller extends CI_Controller {

	public function index()
	{
		$this->load->model('front/category_model');
		$data['categories'] = $this->category_model->view_bookcategory();
		$data['subcategories'] = $this->category_model->view_booksubcategory();
		$this->load->view('front/sidebar',$data);
	}

	public function getbookscategory()
	{
		$this->load->model('front/category_model');
		if($this->input->get('cat_id') != NULL)
		{
			$id=$this->input->get('cat_id');
			$data['records'] = $this->category_model->get_book_category($id);
		}
		else if($this->input->get('subcat_id') != NULL)
		{
			$id=$this->input->get('subcat_id');
			$data['records'] = $this->category_model->get_book_sub($id);
		}
		
		$data['categories'] = $this->category_model->view_bookcategory();
		$data['subcategories'] = $this->category_model->view_booksubcategory();
		//$data['records'] = $this->category_model->get_book_category($id);
		$this->load->view('front/shop_view', $data);
	}
	public function getbookssub()
	{
		$id=$this->input->get('id');
		$this->load->model('front/category_model');
		$data['records'] = $this->category_model->get_book_sub($id);
		$data['categories'] = $this->category_model->view_bookcategory();
		$data['subcategories'] = $this->category_model->view_booksubcategory();
		$this->load->view('front/shop_view', $data);
	}
}

/* End of file category_controller.php */
/* Location: ./application/controllers/front/category_controller.php */