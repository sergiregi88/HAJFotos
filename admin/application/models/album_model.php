<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album_model extends MY_Model {
  		public function __construct() {
            parent::__construct();

            $this->setTable("album");
        }
        public function insert($data)
        {
        	$iddta=$this->db->select_max("id")->get($this->getTable());
            $num=$iddta->result();
            if($num==NULL)
                $max_id=1;
            else;
            $max_id=$num[0]->id+1;

            $data['id']=(string)$max_id;


        	return parent::insert($data);

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