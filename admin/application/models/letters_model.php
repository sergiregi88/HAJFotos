<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Letters_model extends MY_Model {

	public function __construct() {
        parent::__construct();

        $this->setTable("letters");
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
	public function delete($id_photo)
	{
		$data=array("id"=>$id_photo);
		return parent::delete($data);
	}
	public function deleteByFileName($filename)
	{
		$data=array("name"=>$filename);
		return parent::delete($data);
	}
	public function update($id,$data,$title1)
    {
    	return parent::update($data,array($title1=>$id));
    }
    public function getOnePhoto($field,$id)
    {
    	return $this->db->select($field)->from($this->getTable())->where(array("id"=>$id))->get()->result_array	();
    }
    public function updateOrder($id,$pos)
    {
    	return parent::update(array("pos"=>$pos),array("id"=>$id));
    }


}

/* End of file books_model.php */
/* Location: ./application/models/books_model.php */