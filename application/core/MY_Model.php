<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Model extends CI_Model {
	private $table_name;

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
   		$this->db->insert($this->getTable(),$data);
   	}
   	public function delete($id)
   	{

   	}
   	public function update($id,$data,$data_where)
   	{
   		$this->db->update($this->getTable(),$data,$data_where,1);
   	}

}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */