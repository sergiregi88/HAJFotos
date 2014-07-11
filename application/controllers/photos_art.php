<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos_art extends CI_Controller {

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
				$this->load->model("photo_art_model");
		$data['list']=$this->photo_art_model->getAll();
		$this->load->view('home',$data);

		$this->load->view('layout/footer');


	}

}

/* End of file photos_arts.php */
/* Location: ./application/controllers/events.php */