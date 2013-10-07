<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function index()
	{
			$this->load->model("album_model");
			$data['list_albums']=$this->album_model->getAll();
			$data['content']="albums/list";
			$this->load->vars($data);
			$this->load->view("template");
	}
	public function create()
	{
		$styles=array(array('file'=>'jquery.fileupload',"noscript"=>false),array('file'=>'jquery.fileupload-ui',"noscript"=>false),array('file'=>'jquery.fileupload-noscript',"noscript"=>true),array('file'=>'jquery.fileupload-ui-noscript',"noscript"=>true));
		$scripts=array(array('file'=>'jquery.ui.widget',"extern"=>'0'),
						array('file'=>'http://blueimp.github.io/JavaScript-Templates/js/tmpl.min',"extern"=>'1'),
						array('file'=>'http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min',"extern"=>'1'),
						array('file'=>'http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.',"extern"=>'1'),
						array('file'=>'http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.',"extern"=>'1'),
						array('file'=>'jquery.iframe-transport',"extern"=>'0'),
						array('file'=>'jquery.fileupload',"extern"=>'0'),
						array('file'=>'jquery.fileupload-process.',"extern"=>'0'),
						array('file'=>'jquery.fileupload-image',"extern"=>'0'),
						array('file'=>'jquery.fileupload-video',"extern"=>'0'),
						array('file'=>'jquery.fileupload-audio',"extern"=>'0'),
						array('file'=>'jquery.fileupload-validate',"extern"=>'0'),
						array('file'=>'jquery.fileupload-ui',"extern"=>'0'),
						array('file'=>'main',"extern"=>'0'),


						);
		$data['scripts']=$scripts;
		$data['styles']=$styles;
		if($this->input->post())
		{
			if($this->input->is_ajax_request())
			{

			}
			else
			{

			}
			$data['content']="albums/create";

			$this->load->vars($data);
			$this->load->view("template");
		}
		else
		{

			$data['content']="albums/create";
			$this->load->vars($data);
			$this->load->view("template");
		}


	}
	public function doUpload()
	{
		$config_file=array(
			'upload_path'=>'/files/',
			'');
	}
}

/* End of file albums.php */
/* Location: ./application/controllers/albums.php */