<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function index($ss=null)
	{
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->view('abouts');
		$this->load->view('layout/footer');
	}

}