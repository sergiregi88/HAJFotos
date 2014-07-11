<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends MY_Model {

	public function __construct() {
        parent::__construct();

        $this->setTable("photo");
    }
	public function insert($data)
	{
    	$iddta=$this->db->select_max("id")->get($this->getTable());
    	$posData=$this->db->select_max("pos")->get($this->getTable());
   		$num=$iddta->result();
        if($num==NULL)
            $max_id=1;
        else
        	$max_id=$num[0]->id+1;
		$pos=$posData->result();
		if($pos==NULL)
			$max_pos=1;
		else
			$max_pos=$pos[0]->pos+1;

		$data['id']=$max_id;
		$data['pos']=$max_pos;
    	$res= parent::insert($data);
    	return array("pos"=>$data['pos'],"res"=>$res);

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
	public function update($id,$id_album,$data,$title1,$title2)
    {
    	return parent::update($data,array($title1=>$id,$title2=>$id_album));
    }
    public function getOnePhoto($field,$id_album,$id)
    {
    	return $this->db->select($field)->from($this->getTable())->where(array("id_album"=>$id_album,"id"=>$id))->get()->result_array();
    }
    public function updateOrder($id,$pos,$id_album)
    {

    	return parent::update(array("pos"=>$pos),array("id"=>$id,"id_album"=>$id_album));
    }
}

/* End of file photos_model.php */
/* Location: ./application/models/photos_model.php */
