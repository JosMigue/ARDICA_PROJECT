<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MY_Controller {
	public function index()
	{	
		$this->load->model("m_Files");
		$data['data'] = $this->m_Files->BringFiles();
		$header['header'] = $this->asignHeader();
		$this->loadView("Files/v_Files",$data,$header);
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
	
	public function asignHeader(){
		if($this->session->userdata('userType') == 1){
			$header = '<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Administración
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="'. site_url("/administration").'">Lista de usuarios</a>
				<button class="dropdown-item" id="button_add_user"  data-toggle="modal" onclick="resetModal()" data-target="#modalRegistro" >Registrar usuario</button>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="'. site_url("/administration.obras").'">Lista de obras</a>
				<button class="dropdown-item" id="button_add_user" data-toggle="modal" onclick="resetModalObras()" data-target="#modalRegistroObra" >Registrar obra</button>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Caja chica
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<button class="dropdown-item" id="btnAddPettyCash">Registra caja chica</button>
				<a class="dropdown-item"href="'. site_url("/pettyCash").'">Cajas chicas registradas</a>
				<a class="dropdown-item"href="'. site_url("/pettyCash-detail").'">Agregar conceptos a caja chica</a>
				 <a class="dropdown-item"href="'. site_url("/pettyCash").'">Autorizar personas</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item"href="'. site_url("/pettyCash").'">Reportes</a>
				<a class="dropdown-item" href="#"></a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Archivos
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="'. site_url("/files").'">Administrador de archivos</a>
				<button class="dropdown-item" data-toggle="modal" data-target="#modalSubirArchivo">Subir archivo</button>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Catálogos
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item"href="'. site_url("/cataloges-deductible").'">Tipo de deducible</a>
				<a class="dropdown-item"href="'. site_url("/cataloges-concept").'">Conceptos</a>
				<a class="dropdown-item"href="'. site_url("/cataloges-team").'">Equipos</a>
				<a class="dropdown-item"href="'. site_url("/cataloges-obre").'">Tipos de obras</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Reportes
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item"href="'. site_url("/administration/generateReportUsers").'" target="_blank">Reporte de usuarios</a>
				<a class="dropdown-item"href="'. site_url("/pettyCash-reports").'">Reporte de caja chica</a>
				<a class="dropdown-item"href="'. site_url("/administration/generateReportObras").'" target="_blank">Reporte de obras</a>
		</li>';
		}

		if($this->session->userdata('userType') == 2){
			$header = '
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Caja chica
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<button class="dropdown-item" id="btnAddPettyCash">Registra caja chica</button>
				<a class="dropdown-item"href="'. site_url("/pettyCash").'">Cajas chicas registradas</a>
				<a class="dropdown-item"href="'. site_url("/pettyCash-detail").'">Agregar conceptos a caja chica</a>
				 <a class="dropdown-item"href="'. site_url("/pettyCash").'">Autorizar personas</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item"href="'. site_url("/pettyCash").'">Reportes</a>
				<a class="dropdown-item" href="#"></a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Catálogos
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item"href="'. site_url("/cataloges-deductibl").'o de deducible</a>
				<a class="dropdown-item"href="'. site_url("/cataloges-concept").'">Conceptos</a>
				<a class="dropdown-item"href="'. site_url("/cataloges-team").'">Equipos</a>
				<a class="dropdown-item"href="'. site_url("/cataloges-obre").'">Tipos de obras</a>
		</li>';
		}
		if($this->session->userdata('userType') == 3){
			$header = '
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Archivos
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item" href="'.site_url("/files").'">Administrador de archivos</a>
				<button class="dropdown-item" data-toggle="modal" data-target="#modalSubirArchivo">Subir archivo</button>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Catálogos
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item"href="'.site_url("/cataloges-deductible").'">Tipo de deducible</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-concept") .'">Conceptos</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-team") .'">Equipos</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-obre") .'">Tipos de obras</a>
		</li>';
		}
		if($this->session->userdata('userType') == 4){
			$header = '
			<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Caja chica
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item"href="'.site_url("/pettyCash").'">Cajas chicas asignadas</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Catálogos
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item"href="'.site_url("/cataloges-deductible").'">Tipo de deducible</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-concept").'">Conceptos</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-team").'">Equipos</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-obre").'">Tipos de obras</a>
		</li>';
		}
		if($this->session->userdata('userType') == 5){
			$header = '
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Catálogos
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item"href="'.site_url("/cataloges-deductible").'">Tipo de deducible</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-concept").'">Conceptos</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-team").'">Equipos</a>
				<a class="dropdown-item"href="'.site_url("/cataloges-obre").'">Tipos de obras</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Reportes
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				<a class="dropdown-item"href="'. site_url("/administration/generateReportUsers").'" target="_blank">Reporte de usuarios</a>
				<a class="dropdown-item"href="'. site_url("/pettyCash-reports").'">Reporte de caja chica</a>
				<a class="dropdown-item"href="'. site_url("/administration/generateReportObras").' " target="_blank">Reporte de obras</a>
		<';
		}

		return $header;
	}

}

