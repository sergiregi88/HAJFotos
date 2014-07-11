<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function index()
	{
		$this->load->view('layout/header');
		$this->load->view('layout/menu');
		$this->load->model('album_model');
		$this->load->model('photo_model');
		$data['list_albums']=$this->album_model->getAll();
		for($i=0;$i<count($data['list_albums']);$i++)
		{
			$img=$this->photo_model->getFirstImageOfAlbum($data['list_albums'][$i]->id);
			if(empty($img))
				$data['list_albums'][$i]->image="";//;array(array("thumbnailUrl"=>base_url()."public/images/empty_album.png");
			else
				$data['list_albums'][$i]->image=$img;

		}

		$this->load->view('albums/albums',$data);
		$this->load->view('layout/footer');
	}

}

/* End of file albums.php */
/* Location: ./application/controllers/albums.php */