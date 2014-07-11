<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Presentation extends CI_Controller {

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->model("presentation_model");
		$data['list']=$this->presentation_model->getAll();
		$this->load->view('home',$data);
		$this->load->view('layout/footer');


	}

}

/* End of file letters.php */
/* Location: ./application/controllers/events.php */