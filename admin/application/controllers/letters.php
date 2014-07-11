<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Letters extends CI_Controller {
public function __construct() {
	  	parent::__construct();
	  	if(!$this->session->userdata("isLoggedIn"))
	  		redirect("login");
	  }
	public function index()
	{

		$data['content']="letters/edit";
		$data['pg']="letters";
		$data['pg']="letters";
		$data['title']="Cartas";
        $session_data = $this->session->userdata('isLoggedIn');
        $data['logged'] = $session_data;
		$this->load->vars($data);
		$this->load->view("template");
	}
	public function listfiles()
	{

		        $upload_path_url = base_url() . 'files/letters/';

		        $config['upload_path'] = FCPATH . 'files/letters/';
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['max_size'] = 0	;

		        $this->load->library('upload', $config);
		            //Load the list of existing files in the upload directory
		            $this->load->model('letters_model');
		            $array=$this->letters_model->getAllOrder()->result_array();
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
	public function do_upload2()
	{

			if(is_dir(FCPATH."files/letters") &&
				is_writable(FCPATH."files/letters/") &&
				is_dir(FCPATH."files/letters/thumbs/") &&
				is_writable(FCPATH."files/letters/thumbs/")
				)
			{

					//es liarte posar una altre carpeta pk el plugin esta fet aix
		        $upload_path_url = base_url() . 'files/letters/';

		        $config['upload_path'] = FCPATH . 'files/letters/';
		        $config['allowed_types'] = 'jpg|jpeg|png|gif';
		        $config['max_size'] = 0	;

		        $this->load->library('upload', $config);

		        if (!$this->upload->do_upload())
		        {
		        	$files=array();
		        	 $info->error=$this->upload->display_errors("","");
		        	$files[] =$info;
		        	echo json_encode(array("files"=>$files));
				}
				else
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
		            $config['source_image'] = $data['full_path'];
		            $config['create_thumb'] = TRUE;
		            $config['new_image'] = $data['file_path'] . 'thumbs/';
		            $config['maintain_ratio'] = TRUE;
		            $config['thumb_marker'] = '';
		            $config['width'] = 75;
		            $config['height'] = 50;
		            $this->load->library('image_lib', $config);
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
		            $info->deleteUrl = base_url() . 'letters/deleteImage/' . $data['file_name'];
		            $info->modifyUrl = base_url() . 'letters/updateImage/' . $data['file_name'];
		            $info->deleteType = 'DELETE';
		            $info->title=$titlephoto;
		            $info->description=$desc;

		          	 $info->error = $this->upload->display_errors();
		          	 if(strlen($info->error)==0){
		            	$this->load->model("letters_model");
		           		$res= $this->letters_model->insert(array('title'=>$titlephoto[0],"description"=>$desc[0],"size"=>$data['file_size'],'name'=>$data['file_name'],"url"=>$info->url,
		            	'thumbnailUrl'=>$info->thumbnailUrl,'deleteType'=>$info->deleteType,'deleteUrl'=>$info->deleteUrl,'modifyUrl'=>$info->modifyUrl,'error'=>$info->error,'type'=>$info->type));
		           	}
		           	if($res['res']!=false){
		           	$info->pos=$res['pos'];
		            $files[] = $info;}

		            //this is why we put this in the constants to pass only json data
		            if (IS_AJAX){

		              echo json_encode(array("files" => $files));}
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
	public function updateImage($photo,$field,$id)
	{
		$array=array($field=>$this->input->post('value'));
		$this->load->model("letters_model");
		if($this->letters_model->update($id,$array,'id','id_album'))
		{
			$d=$this->letters_model->getOnePhoto($field,$id);
			echo json_encode(array("res"=>"success","data"=>$d[0][$field]));
		}
		else
		{
			$d=$this->letters_model->getOnePhoto($field,$id);
			echo json_encode(array("res"=>"error","data"=>$d[0][$field]));
		}
	}
	public function deleteImage($file)//gets the job done but you might want to add error checking and security
	{



		$this->load->model("letters_model");

		$this->letters_model->deleteByFileName($file);
		$success =unlink(FCPATH.'files/letters/' .$file);
		//info to see if it is doing what it is supposed to
		$info->sucess =$success;
		$info->path =base_url().'files/letters/' .$file;
		$info->file =is_file(FCPATH.'files/letters'.$file);


		if (IS_AJAX)
			//I don't think it matters if this is set but good for error checking in the console/firebug
			echo json_encode(array($info));
		else {
			//here you will need to decide what you want to show for a successful delete
			$file_data['delete_data'] = $file;
				$this->load->view('admin/delete_success', $file_data);
		}
	}
	public function sort()
	{
			$ids=$_POST['listId'];


			$this->load->model("letters_model");
			$ret=false;

			foreach ($ids as $key => $value) {
					$ret=$this->letters_model->updateOrder($value,$key,$id_album);

			}


			if($ret==true)
			{
				echo json_encode(array("result"=>"success"));
			}


	}
}

/* End of file letters.php */
/* Location: ./application/controllers/letters.php */