<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album_model extends MY_Model {
  		public function __construct() {
            parent::__construct();

            $this->setTable("album");
        }
        public function insert($data)
        {
        	$iddta=$this->db->select_max("id")->from($this->getTable())->get()->result();

			$max_id=$iddta[0]->id+1;

            $data['id']=$max_id;


        	$ret=parent::insert($data);
        	return array('result'=>$ret,"id"=>$max_id);
        }
        public function update($id,$data,$title)
        {
        	return parent::update($data,array($title=>$id));
        }
        public function delete($id)
        {
            $data=array("id"=>$id);
          return  parent::delete($data);
        }

}

/* End of file album_model.php */
/* Location: ./application/models/album_model.php */