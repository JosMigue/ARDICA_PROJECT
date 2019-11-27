<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MY_Controller {
	public function index()
	{	
		if($this->checkUser()){
			$this->load->model("m_Files");
			$data['data'] = $this->m_Files->BringFiles();
			$header['header'] = $this->asignHeader();
			$this->loadView("Files/v_Files",$data,$header);
			$this->load->view("Files/modalUploadFiles");
			$this->load->view("Files/previewFile");
		}else{
			redirect('/');
		}
	}

	function fileStore()  
    {  

	 	if(isset($_FILES["image_file"]["name"]))  
		{  
			$path = $_POST["path"];
			$config['upload_path'] = './'.$path.'/';  
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
	function fileErase()  
    {  
		if(isset($_POST['path'])){
			$path = $_POST['path'];
			$type = $_POST['classes'];
			if($type == 'files'){
				unlink($path);
			}else if($type == 'folders'){
				rmdir($path);
			}
		}else{
			redirect('/');
		}
		
	}
	
	public function scanDirectory(){
		$dir = "Raiz";
		$response = $this->scan($dir);
		header('Content-type: application/json');
		echo json_encode(array(
			"name" => "Raiz",
			"type" => "folder",
			"path" => $dir,
			"items" => $response
		));
	}
	private function scan($dir){

	$files = array();

	// Is there actually such a folder/file?

	if(file_exists($dir)){
	
		foreach(scandir($dir) as $f) {
		
			if(!$f || $f[0] == '.') {
				continue; // Ignore hidden files
			}

			if(is_dir($dir . '/' . $f)) {

				// The path is a folder

				$files[] = array(
					"name" => $f,
					"type" => "folder",
					"path" => $dir . '/' . $f,
					"items" => $this->scan($dir . '/' . $f) // Recursively get the contents of the folder
				);
			}
			
			else {

				// It is a file

				$files[] = array(
					"name" => $f,
					"type" => "file",
					"path" => $dir . '/' . $f,
					"size" => filesize($dir . '/' . $f) // Gets the size of this file
				);
			}
		}
	
	}

	return $files;
}

public function createFolder(){
	$directorio=$_POST['currentPath'];
	$nameFolder=$_POST['nameFolder'];
	$path=$directorio."/".$nameFolder;
	if (is_dir($directorio)) {
		if (file_exists($path)) {
			echo "Ya existe el directorio";
		}else{
			mkdir($path, 0700);
			echo "directorio creado correctamente";
		}	
	}else{
		echo "No se encontró la ruta ".$directorio;
	}
}

	public function asignHeader(){
		if($this->session->userdata('userType') == 3 || $this->session->userdata('userType') == 1){
			$header = '
		<ul class="navbar-nav mr-auto">
      		<li class="nav-item">
      			<a class="nav-link" href="'.site_url("/files").'">Administrador de archivos</a>
      		</li>
      		<li class="nav-item">
      			<a class="nav-link" data-toggle="modal" data-target="#modalSubirArchivo">Subir archivo</a>
      		</li>
    	</ul>
		';
		}

		return $header;
	}

	public function checkUser(){
		if($this->session->userdata('userType') == 3 || $this->session->userdata('userType') == 1){
			return true;
		}else{
			return false;
		}
	}

}

