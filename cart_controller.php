<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_controller extends CI_Controller {
	public function __construct(){
			parent::__construct();
			//Load Library and model.
			if(!is_userlogin())
		{
			redirect(site_url('front/customer_controller'),'refresh');
			exit();
		}
			$this->load->library('cart');
			$this->load->model('front/bookdetail_model');
			$this->load->model('front/cart_model');
			}

				public function index()
						{
						//$data['books'] = $this->cart_model->getallbooks();
						$this->load->view('front/cart');
						if(!is_userlogin()){
							
						}
						}

				public function add_to_cart()
				{
					$id=$this->input->post('id');
					$name=$this->input->post('book_title');
					$price=$this->input->post('price');
					
					$data = array(
					'id' => $id,
					'name' => $name,
					'price' => $price,
					'qty' => 1
					);
					$this->cart->insert($data);
					redirect(site_url('front/cart_controller'),'refresh');

				}


				public function remove($rowid) 
				{
					if ($rowid =="all")
					{
					//$this->cart->destroy();
					}
					else
					{
						$data = array(
						'rowid' => $rowid,
						'qty' => 0
						);
						$this->cart->update($data);
						redirect(site_url('front/cart_controller'),'refresh');
					}
				}

					public function update_cart(){
							//$cart_info = $this->input->post('cart');
							//print_r($cart_info);
							//exit();
							//foreach( $cart_info as $id => $cart)
							//{
							$cart = $this->cart->contents();
							$data = array();
							if ($cart):
			                    foreach ($cart as $item):
			                    	$tmp_data = array(
												'rowid' => $item['rowid'],
												'qty' => $this->input->post($item['rowid'].'_quantity')
												);
			                    $data[] = $tmp_data;
			                    endforeach;
		                    endif;

							$this->cart->update($data);
						//}
							redirect(site_url('front/cart_controller'),'refresh');
							//}
					}

							public function cart_view(){
									$this->load->view('front/cart');
								}


								
}

/* End of file cart_controller.php */
/* Location: ./application/controllers/front/cart_controller.php */