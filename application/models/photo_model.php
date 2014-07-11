<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends MY_Model {

	public function __construct() {
            parent::__construct();

            $this->setTable("photo");
        }
      public function getFirstImageOfAlbum($id_album)
      {
      	$this->db->select_min("pos")->from($this->getTable())->	where(array("id_album"=>$id_album));
      	$where=$this->db->get_compiled_select();

      	return $this->db->select("thumbnailUrl")->from($this->getTable())
      	->where("pos IN (".$where.")")->get()->result();



      }
}

/* End of file albums_model.php */
/* Location: ./application/models/albums_model.php */