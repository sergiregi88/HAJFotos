<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {
	public function __construct() {
	  	parent::__construct();
	  	if(!$this->session->userdata("isLoggedIn"))
	  		redirect("login");
	  }
	public function comments($file,$id_album,$id_photo)
	{
		$this->load->model("comment_model");

			$res=$this->comment_model->getAllCom($id_album,$id_photo);

			$data['tree_comments']=$this->MakeTree($res);

			$data['content']="comment/list";
			$data['error']='';
			$this->load->vars($data);
			$this->load->view("template");
	}
	function MakeTree($arr)
	{
		$parent_arr=array();
		foreach($arr as $key=>$value)
		{
			$parent_arr[$value['id_parent']][$value['id']]=$value;
		}
		$tree=$parent_arr['0'];
		$this->createTree($tree,$parent_arr);
		return $tree;
	}
	function mapTree($dataset , $parntid)
	{
		$tree=array();
		$i=0;
		foreach($dataset as $id=>&$node)
		{
			if(!$node['id_parent'])
			{
				$tree[$id]=&$node;
			}
			else
			{
				$dataset[$node['id_parent']]['childs'][$id]=&$node;
			}

			$i++;
		}
		return $tree;
	}
	function createTree(&$tree,$parent_arr)
	{
		foreach($tree as $key=>$value)
		{
			if(!isset($value['children']))
				$tree[$key]['children']=array();
			if(array_key_exists($key,$parent_arr))
			{
				$tree[$key]['children']=$parent_arr[$key];
				$this->createTree($tree[$key]['children'],$parent_arr);
			}
		}
		}

	public function edit($id,$id_photo,$id_album)
	{
		$this->load->model("comment_model");
		$this->load->model("photo_model");
		$this->load->model("album_model");
		$data['album']=$this->album_model->getOne($id_album);
		$data['photo']=$this->photo_model->getOnePhoto("title",$id_album,$id_photo);
		$data['comment']=$this->comment_model->getOne($id_photo,$id_album,$id);
$this->load->model("comment_model");

			$res=$this->comment_model->getAllCom($id_album,$id_photo);

			$data['tree_comments']=$this->MakeTree($res);
		$data['content']="comment/edit";
			$data['error']='';
			$this->load->vars($data);
			$this->load->view("template");
	}
	public function change_parent($id,$new_parent)
	{
		$this->load->model("comment_model");
		if($this->comment_model->update(array("id_parent"=>$new_parent),array("id"=>$id)))
		{
			echo json_encode(array("result"=>"success","message"=>"Comentario padre cambiado correctamente"));
		}
		else
		{
			echo json_encode(array("result"=>"error","message"=>"Error al cambiar el comentario padre"));
		}
	}
	public function update($id)
	{

	}
}

/* End of file comment.php */
/* Location: ./application/controllers/comment.php */