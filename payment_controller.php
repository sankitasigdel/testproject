<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_controller extends CI_Controller {

	public function index()
	{	
			$this->load->library('cart');
			$cart = $this->cart->contents();
			foreach ($cart as $item):
				$item_name[] = $item['name'].'-'.$item['qty'].' items';
				//$item_id[] = $item['rowid'];
			    $item_total_amount[] = $item['price'] * $item['qty'];
			    /*$data = array(
			    	'name' => $item['name'],
			    	'id' => $item['rowid'],
			    	'amount' => $item['price']
			    	); */                                           
			endforeach;
			$data['total_amount'] = array_sum($item_total_amount);
			$data['total_items'] = implode(',', $item_name);
			//print_r($items);
			//exit();
			$this->load->view('front/payment',$data);
	}
	public function success()
	{
		$this->load->model('front/order');
		if($this->order->getorder())
		{
			$this->load->library('cart');
			$this->cart->destroy();
		}
		$this->load->view('front/success');
	}
	public function failure()
	{
		$this->load->view('front/failure');
	}
}

/* End of file payment_controller.php */
/* Location: ./application/controllers/front/payment_controller.php */