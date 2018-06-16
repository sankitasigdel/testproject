<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_controller extends CI_Controller {
	
	public function index()
	{
		$this->load->view('front/customer_register_view');
	}

	public function customer_register()
	{
		//exit();
		$this->load->model('front/customer_model');
		$filename=$this->upload_file();
		$this->load->library('form_validation');
		$this->form_validation->set_rules(
        					'username', 'username',
        					'required|min_length[5]|max_length[20]|required|is_unique[customer/retailer.username]');
		$this->form_validation->set_rules(
        					'password', 'password',
        					'required|min_length[5]|max_length[20]|required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
				if ($this->form_validation->run())
                {
						$data= $this->customer_model->insert_user($filename);
                }
          		else{
          	 			echo validation_errors();
          	 			exit();		
          		}	
         
		if($data){
			redirect(site_url('front/shop_controller'),'refresh');
		}else{
			$this->session->set_flashdata('Error Registering', TRUE);
			redirect(site_url('front/customer_register_view'),'refresh');
			exit();
		}

	}

	public function validate_user()
	{
		if($this->input->post('login') != NULL && $this->input->post('login') == 'LOGIN')
		{
			$this->load->model('front/customer_model');
			$result = $this->customer_model->validate_user();
			if($result)
			{
				$data['user_logged_in'] = TRUE;
				$data['username'] = $result->username;
				$data['password']= $result->password;
				$data['id']= $result->id;
				
				$this->session->set_userdata( $data );

				//redirecting to dashboard after succesful login
				redirect(site_url('front/shop_controller'),'refresh');
				exit();
			}
			else
			{
				$this->session->set_flashdata('invalid_user', TRUE);
				redirect(site_url('front/customer_controller'),'refresh');
				exit();
			}
		}
	}	
	public function upload_file()
        {

                $config['upload_path']          = './uploads/custretailer/';
                $config['allowed_types']        = 'gif|jpg|png|pdf|doc';
                $config['max_size']             = 1000;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;

                $this->load->library('upload', $config);
                //var_dump($_FILES);

                if($this->upload->do_upload('image'))
				{	
					
   					$upload_data = $this->upload->data();
   					$image_name = $upload_data['file_name'];
   					return $image_name;
   				}	
				else
				{
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
					die();
				}
        }
}

/* End of file customer.php */
/* Location: ./application/controllers/front/customer.php */