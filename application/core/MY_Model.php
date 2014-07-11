<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model {
	private $table_name;
  // totes les funcions q faig server a tots elsmodels

    public function __construct() {

        parent::__construct();
        $this->load->database();
    }
    public function getTable()
    {
        return $this->table;
    }
    public function setTable($table)
    {
        $this->table=$table;
    }
    public function getAll()
    {
        	return $this->db->select("*")->from($this->getTable())->get()->result();
    }
   	public function insert($data)
   	{
   		if($this->db->insert($this->getTable(),$data))
      return true;
      else
        return false;
   	}
   	public function delete($data_where)
   	{
        return $this->db->delete($this->getTable(),$data_where);

   	}
   	public function update($data,$data_where)
   	{
   		if($this->db->update($this->getTable(),$data,$data_where,1))
      return true;
      else
        return false;
   	}
    public function getOne($id)
    {
        return $this->db->select("*")->from($this->getTable())->where(array("id"=>$id))->get()->result();
    }
    public function getAllByAlbum($id_album)
    {
      return $this->db->select("*")->from($this->getTable())->where(array('id_album'=>$id_album))->get();
    }
     public function getAllByAlbumOrder($id_album)
    {
      return $this->db->select("*")->from($this->getTable())->where(array('id_album'=>$id_album))->order_by("pos")->get();
    }
    public function getAllOrder()
    {

        return $this->db->select("*")->from($this->getTable())->order_by("pos")->get();
    }
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */