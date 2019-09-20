<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MY_Controller {
	public function index()
	{	
		$this->load->model("m_Files");
		$data['data'] = $this->m_Files->BringFiles();
		$this->loadView("Files/v_Files",$data);
		$this->load->view("Files/modalUploadFiles");
		$this->load->view("Files/previewFile");
	}

	function fileStore()  
    {  
		if(isset($_FILES["image_file"]["name"]))  
		{  
			 $config['upload_path'] = './uploads/';  
			 $config['allowed_types'] = 'jpg|jpeg|png|pdf|docx|doc|xlsx|xls';  
			 $this->load->library('upload', $config);  
			 if(!$this->upload->do_upload('image_file'))  
			 {  
				 $error =  $this->upload->display_errors(); 
				 echo json_encode(array('msg' => $error, 'success' => false));
			 }  
			 else 
			 {  
				  $data = $this->upload->data(); 
				  $insert['name'] = $data['file_name'];
				  $this->db->insert('files',$insert);
				  $getId = $this->db->insert_id();

				  $arr = array('msg' => 'El archivo no pudo subirse', 'success' => false);

				  if($getId){
				   $arr = array('msg' => 'El archivo ha sido subido exitosamente', 'success' => true);
				  }
				  echo json_encode($arr);
			 }  
		}  
    } 

}
