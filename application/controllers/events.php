<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->model("event_model");
		$data['list']=$this->event_model->getAll();
		$this->load->view('home',$data);
		$this->load->view('layout/footer');


	}

}

/* End of file events.php */
/* Location: ./application/controllers/events.php */

//on colllons es