<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment_model extends MY_Model {
  		public function __construct() {
            parent::__construct();

            $this->setTable("comment");
        }
        public function getAllCom($id_album,$id_photo)
        {
            return $this->db->select("*")
            ->from($this->getTable())
            ->where(array("id_photo"=>$id_photo,"id_album"=>$id_album))
            ->order_by("id","asc")->get()->result_array();
        }
        public function insert($data)
        {
        	$iddta=$this->db->select_max("id")->from($this->getTable())->get()->result();

			$max_id=$iddta[0]->id+1;

            $data['id']=$max_id;


        	return parent::insert($data);

        }
        public function delete($id)
        {
            $data=array("id"=>$id);
          return  parent::delete($data);
        }
        public function getOne($id_photo,$id_album, $id)
        {
            return $this->db->select("*")
                        ->from($this->getTable())
                        ->where(array("id_album"=>$id_album,"id_photo"=>$id_photo,"id"=>$id))
                        ->get()->result();
        }

}

/* End of file album_model.php */
/* Location: ./application/models/album_model.php */