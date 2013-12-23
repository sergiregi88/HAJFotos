<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends MY_Model {

	public function __construct() {
        parent::__construct();

        $this->setTable("photo");
    }
	public function insert($data)
	{
    	$iddta=$this->db->select_max("id")->from($this->getTable())->get()->result();
    	$posData=$this->db->select_max("pos")->from($this->getTable())->get()->result();
		$max_id=$iddta[0]->id+1;
		$max_pos=$posData[0]->pos+1;
		$data['id']=$max_id;
		$data['pos']=$max_pos;
    	return parent::insert($data);
	}
	public function getCountPhotosAllByAlbum($id_album)
	{

		return parent::getAllByAlbum($id_album)->num_rows();
	}
	public function deletePhotosOfAlbum($photos,$id)
	{
		$this->load->model("album_model");
	//	var_dump($photos,$id);
	$ret=true;
		//$this->db->trans_start();
		for($i=0;$i<count($photos);$i++)
		{

			$ret = $this->delete($photos[$i]->id_album,$photos[$i]->id);
		}

		$ret=$this->album_model->delete($id);


		//return $this->db->trans_complete();
		return $ret;

	}
	public function delete($id_album,$id_photo)
	{
		$data=array("id"=>$id_photo,'id_album'=>$id_album);
		return parent::delete($data);
	}
	public function deleteByFileName($id_album,$filename)
	{
		$data=array("name"=>$filename,'id_album'=>$id_album);
		return parent::delete($data);
	}

}

/* End of file photos_model.php */
/* Location: ./application/models/photos_model.php */