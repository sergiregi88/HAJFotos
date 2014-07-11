<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
	  	parent::__construct();
	  	if(!$this->session->userdata("isLoggedIn"))
	  		redirect("login");
	  }
	public function index()
	{


		$data['content']="home";
		$data['title']="Inicio";
		$data['pg']="home";
        $session_data = $this->session->userdata('isLoggedIn');
        $data['logged'] = $session_data;
		$this->load->vars($data);
		$this->load->view("template");

	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */