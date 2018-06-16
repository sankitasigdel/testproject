<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ourteam_controller extends CI_Controller{
	
	public function index(){
		$this->load->model('front/ourteam_model');
		$this->ourteam_model->add_ourteam();
		
		}
	public function addourteam(){
		$filename = $this->upload_file();
		$this->load->model('front/ourteam_model');
		$this->ourteam_model->insert_ourteam($filename);
		$data=$this->load->view('front/ourteam_view');
		if($data){
			redirect(site_url('front/ourteam_controller'),'refresh');
		}else{
			echo"error";
		}
	}
	public function upload_file()
        {

                $config['upload_path']          = './uploads/ourteam/';
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
