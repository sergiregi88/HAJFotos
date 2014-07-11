<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller {

	public function getPhotos($id_album)
	{
		$this->load->model('photo_model');
		$data['list_photos']=$this->photo_model->getAllByAlbum($id_album)->result();
		$arr=array();
		foreach($data['list_photos'] as $photo)
		{
				array_push($arr,$photo->url);
		}
		echo json_encode($arr);

	}
	public function getComments($id_album,$id_photo)
	{
		echo json_encode(array("comments"=>array()));
	}


}

/* End of file photos.php */
/* Location: ./application/controllers/photos.php */