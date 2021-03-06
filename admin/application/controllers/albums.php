<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {
	public function __construct() {
	  	parent::__construct();
	  	if(!$this->session->userdata("isLoggedIn"))
	  		redirect("login");
	  }
	public function index()
	{
			$this->load->model("album_model");
			$data['list_albums']=$this->album_model->getAll();
			$data['content']="albums/list";
			$data['error']='';
			$data['pg']="albums";
			$data['title']="&Aacute;lbumes";
	        $session_data = $this->session->userdata('isLoggedIn');
            $data['logged'] = $session_data;
			$this->load->vars($data);
			$this->load->view("template");
	}
	public function create()
	{
	        $session_data = $this->session->userdata('isLoggedIn');
            $data['logged'] = $session_data;
			$data['content']="albums/create";
			$data['pg']="albums";
			$data['title']="&Aacute;lbumes";
			$this->load->vars($data);
			$this->load->view("template");
	}
	public function createAlbum()
	{
		if($this->input->post())
		{
			$this->load->model("album_model");
			$randir=random_string();

			if(mkdir(FCPATH."files/albums/" . $randir) && chmod(FCPATH."files/albums/" . $randir, 0777))
			{
				mkdir(FCPATH."files/albums/" . $randir."/thumbs/");
				chmod(FCPATH."files/albums/" . $randir."/thumbs/", 0777);
				$ret=$this->album_model->insert(array(
											'title'=>$this->input->post('title'),
											'description'=>$this->input->post('description'),
											'date'=>date('Y-m-d h:i:s',time()),
											'folder_name'=>$randir));
				if(IS_AJAX)
				{

					if($ret)
						echo json_encode(array('result'=>"success","message"=>"Álbum creado correctamente"));
					else
						echo json_encode(array('result'=>"error","message"=>"Error al crear el álbum"));
				}
				else
				{

					redirect('albums');
				}

			}
			else
			{
				if(IS_AJAX)
					echo json_encode(array('result'=>"errorDir","message"=>"Error al crear el album"));
				else
					redirect("albums");

			}
		}

	}
	public function updateAlbum($id)
	{
		if(!$id)
		{

		}
		$this->load->model("album_model");
		if($this->album_model->update($id,array("title"=>$this->input->post("title"),"description"=>$this->input->post("description")),"id"))
			echo json_encode(array("result"=>"success","message"=>"Álbum modificado correctamente"));
		else

			echo json_encode(array("result"=>"error","message"=>"Error al modificar el álbum"));

	}
	public function listfiles($randir=false,$id=false)
	{

		        $upload_path_url = base_url() . 'files/albums/'.$randir."/";

		        $config['upload_path'] = FCPATH . 'files/albums/'.$randir."/";
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['max_size'] = 0	;

		        $this->load->library('upload', $config);
		            //Load the list of existing files in the upload directory
		            $this->load->model('photo_model');
		            $array=$this->photo_model->getAllByAlbumOrder($id)->result_array();

		            //var_dump($array);
		            $existingFiles = get_dir_file_info($config['upload_path']);
		            for($i=0;$i<count($array);$i++) {
		            	 $array[$i]['size']=intval($array[$i]['size']);
		            	 $array[$i]['pos']=$i;

		            }
/*		            $foundFiles = array();
		            $f=0;
		            foreach ($existingFiles as $fileName => $info) {
			              if($fileName!='thumbs'){//Skip over thumbs directory
				                //set the data for the json array

				                $foundFiles[$f]['name'] = $fileName;
				                $foundFiles[$f]['size'] = $info['size'];
				                $foundFiles[$f]['url'] = $upload_path_url . $fileName;
				                $foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
				                $foundFiles[$f]['deleteUrl'] = base_url() . 'albums/deleteImage/' . $fileName;
				                $foundFiles[$f]['deleteType'] = 'DELETE';
				                $foundFiles[$f]['modifyUrl'] = base_url() . 'photos/editImage/' . $fileName;
				                $foundFiles[$f]['error'] = null;

				                $foundFiles[$f]['pos']=$f;
				                $foundFiles[$f]['title']="sssss";
				                $foundFiles[$f]['description']="ppp";
			                	$f++;
			              }
			        }*/
		            $this->output
		            ->set_content_type('application/json')
		            ->set_output(json_encode(array('files' => $array)));

	}
	public function do_upload2($randir=false,$id=false)
	{

			if($randir!="" && is_dir(FCPATH."files/albums/" . $randir."/") &&
				is_writable(FCPATH."files/albums/" . $randir."/") &&
				is_dir(FCPATH."files/albums/" . $randir."/thumbs/") &&
				is_writable(FCPATH."files/albums/" . $randir."/thumbs/")
				)
			{

					//es liarte posar una altre carpeta pk el plugin esta fet aix
		        $upload_path_url = base_url() . 'files/albums/'.$randir."/";

		        $config['upload_path'] = FCPATH . 'files/albums/'.$randir."/";
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['max_size'] = 0	;

		        $this->load->library('upload', $config);

		        if (!$this->upload->do_upload())
		        {
		        	$files=array();
		        	 $info->error=$this->upload->display_errors("","");
		        	$files[] =$info;
		        	echo json_encode(array("files"=>$files));
	}     else
		        {
		            //$error = array('error' => $this->upload->display_errors());
		            //$this->load->view('upload', $error);


		            $data = $this->upload->data();

					$desc=$this->input->post('desc');
					$titlephoto=$this->input->post('titlephoto');

		            /*
		             * Array
		              (
		              [file_name] => png1.jpg
		              [file_type] => image/jpeg
		              [file_path] => /home/ipresupu/public_html/uploads/
		              [full_path] => /home/ipresupu/public_html/uploads/png1.jpg
		              [raw_name] => png1
		              [orig_name] => png.jpg
		              [client_name] => png.jpg
		              [file_ext] => .jpg
		              [file_size] => 456.93
		              [is_image] => 1
		              [image_width] => 1198
		              [image_height] => 1166
		              [image_type] => jpeg
		              [image_size_str] => width="1198" height="1166"
		              )
		             */
		            // to re-size for thumbnail images un-comment and set path here and in json array
		            $config = array();
		            $config['image_library'] = 'gd2';
		            $config['width'] = 705;
		            $config['height'] = 500;
		            $config['maintain_ratio'] = TRUE;
		            $config['create_thumb'] = FALSE;
		            $config['source_image'] = $data['full_path'];
		            $config['new_image'] = $data['file_path'];
$this->load->library('image_lib', $config);

		            $this->image_lib->resize();

		            $config['image_library'] = 'gd2';
		            $config['source_image'] = $data['full_path'];
		            $config['create_thumb'] = TRUE;
		            $config['new_image'] = $data['file_path'] . 'thumbs/';
		            $config['maintain_ratio'] = TRUE;
		            $config['thumb_marker'] = '';
		            $config['width'] = 75;
		            $config['height'] = 50;
		            $this->image_lib->initialize($config);
		            $this->image_lib->resize();
		            /*$this->load->model("photo_model");
		            $this->photo_model->insert(array('id_album'=>$id,'title'=>$titlephoto[0],"description"=>$desc[0],"size"=>$data['file_size'],'name'=>$data['file_name'],"url"=>$data['full_path'],));*/

		            //set the data for the json array
		            $info->name = $data['file_name'];
		            $info->size = $data['file_size'];

		            $info->type = $data['file_type'];
		            $info->url = $upload_path_url . $data['file_name'];
		            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
		            $info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
		            $info->deleteUrl = base_url() . 'albums/deleteImage/' . $data['file_name']."/".$id;
		            $info->modifyUrl = base_url() . 'albums/updateImage/' . $data['file_name']."/".$id;
		            $info->commentUrl = base_url() . 'comment/comments/' . $data['file_name']."/".$id;
		            $info->deleteType = 'DELETE';
		            $info->title=$titlephoto;
		            $info->description=$desc;

		            $info->error = $this->upload->display_errors();
		            $this->load->model("photo_model");
		           $res= $this->photo_model->insert(array('id_album'=>$id,'title'=>$titlephoto[0],"description"=>$desc[0],"size"=>$data['file_size'],'name'=>$data['file_name'],"url"=>$info->url,
		            	'thumbnailUrl'=>$info->thumbnailUrl,'deleteType'=>$info->deleteType,'deleteUrl'=>$info->deleteUrl,'modifyUrl'=>$info->modifyUrl,'commentUrl'=>$info->commentUrl,'error'=>$info->error,'type'=>$info->type));
		           	$info->pos=$res['pos'];
		            $files[] = $info;

		            //this is why we put this in the constants to pass only json data
		            if (IS_AJAX)
		              echo json_encode(array("files" => $files));
		                //this has to be the only data returned or you will get an error.
		                //if you don't give this a json array it will give you a Empty file upload result error
		                //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
		                // so that this will still work if javascript is not enabled
		            else {
		                $file_data['upload_data'] = $this->upload->data();
		                $this->load->view('upload/upload_success', $file_data);
		            }
		        }


		}
	}
	public	function edit($id=false)
	{
		if(isset($id))
		{
			$this->load->model("album_model");
			$data['album']=$this->album_model->getOne($id);
			$data['content']="albums/edit";
			$data['error']='';
			$data['pg']="albums";
	        $session_data = $this->session->userdata('isLoggedIn');
            $data['logged'] = $session_data;

			$this->load->vars($data);
			$this->load->view("template");
		}
	}
	public function updateImage($photo,$id_album,$field,$id)
	{
		$array=array($field=>$this->input->post('value'));
		$this->load->model("photo_model");
		if($this->photo_model->update($id,$id_album,$array,'id','id_album'))
		{
			$d=$this->photo_model->getOnePhoto($field,$id_album,$id);
			echo json_encode(array("res"=>"success","data"=>$d[0][$field]));
		}
		else
		{
			$d=$this->photo_model->getOnePhoto($field,$id_album,$id);
			echo json_encode(array("res"=>"error","data"=>$d[0][$field]));
		}
	}
	public function delete($id)
	{
		if(!$id)
		{
			return false;
		}
		$this->load->model("photo_model");
		if($this->photo_model->getCountPhotosAllByAlbum($id)>0)
		{
			echo json_encode(array('result'=>"question","url"=>base_url()."albums/deleteImagesOfAlbum/".$id));
		}
		else
		{
			$this->load->model("album_model");
			if($this->album_model->delete($id))
				echo json_encode(array('result'=>"success","message"=>"Álbum eliminado correctamente"));
			else
				echo json_encode(array('result'=>"error","message"=>"Error al eliminar el álbum"));
		}

	}
	public function deleteImagesOfAlbum($id)
	{
		$this->load->model("photo_model");
		//vfger phyos of album
		$photosToDelete=$this->photo_model->getAllByAlbum($id)->result();

		if($this->photo_model->deletePhotosOfAlbum($photosToDelete,$id))
			echo json_encode(array("result"=>"success","message"=>"Imágenes y álbum eliminados correctamente"));
		else
			echo json_encode(array("result"=>"error","message"=>"Error al eliminar las Imágenes i el álbum"));
	}
	public function deleteImage($file,$albumid)//gets the job done but you might want to add error checking and security
	{

		$this->load->model('album_model');
		$album=$this->album_model->getOne($albumid);

		$this->load->model("photo_model");

		$this->photo_model->deleteByFileName($albumid,$file);
		$success =unlink(FCPATH.'files/albums/'.$album[0]->folder_name."/" .$file);
		//info to see if it is doing what it is supposed to
		$info->sucess =$success;
		$info->path =base_url().'files/albums/'.$album[0]->folder_name."/" .$file;
		$info->file =is_file(FCPATH.'files/albums/'.$album[0]->folder_name."/" .$file);


		if (IS_AJAX)
			//I don't think it matters if this is set but good for error checking in the console/firebug
			echo json_encode(array($info));
		else {
			//here you will need to decide what you want to show for a successful delete
			$file_data['delete_data'] = $file;
				$this->load->view('admin/delete_success', $file_data);
		}
	}
	public function sort($id_album=false)
	{

			$ids=$_POST['listId'];


			$this->load->model("photo_model");
			$ret=false;

			foreach ($ids as $key => $value) {
					$ret=$this->photo_model->updateOrder($value,$key,$id_album);

			}
			if($ret==true)
				echo json_encode(array("result"=>"success","message"=>"Reordenacion aplicada correctamente"));
			else
				echo json_encode(array("result"=>"error","message"=>"Error al reordenar"));
	}
}

/* End of file albums.php */
/* Location: ./application/controllers/albums.php */