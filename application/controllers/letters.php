<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Letters extends CI_Controller {

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->model("letter_model");
		$data['list']=$this->letter_model->getAll();
		$this->load->view('home',$data);
		$this->load->view('layout/footer');


	}

}

/* End of file letters.php */
/* Location: ./application/controllers/events.php */