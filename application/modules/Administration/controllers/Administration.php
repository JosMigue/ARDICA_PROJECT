<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
		$this->load->model("m_Administration");
		$data['data'] = $this->m_Administration->bringUser();
		$this->loadView("Administration/v_Administration",$data);
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalEditarUsuario");
		$this->load->view("Administration/modalRegistro_obras");
	}

	public function obras()
	{
		$this->load->model("m_Administration");
		$data['data'] = $this->m_Administration->bringObras();
		$this->loadView("Administration/v_Administration_obras",$data);
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalRegistro_obras");
		$this->load->view("Administration/modalEditarObra");
	}

	public function saveUser(){
		$this->load->model("m_Administration");
		$obj = $_POST["obj"];
		$name = $obj["Nombre"]." ".$obj["ApellidoP"]." ".$obj["ApellidoM"];
		if(!$this->m_Administration->verifyUser($obj["user"],$name)){
			if($this->m_Administration->saveUser($obj)){
				echo 'user is null';
			}else{
				echo 'user fail';
			}

		}else{
			echo 'user is not null';
		}
	}

	public function deleteUser(){
		$this->load->model("m_Administration");
		$user = $_POST["user"];
		if($this->m_Administration->deleteUser($user)){
			echo 'user has been deleted';
		}else{
			echo 'user has not been deleted';
		}
	}

	public function getUserData(){
		$this->load->model("m_Administration");
		$id = $_POST["id"];
		$data = $this->m_Administration->bringUserEdit($id);
		$data_json['data'] = $data;
		echo json_encode($data_json);
	}

	public function editUser(){
		$this->load->model("m_Administration");
		$user = $_POST["obj"];

		if($this->m_Administration->updateUser($user)){
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function saveObra(){
		$this->load->model("m_Administration");
		$obra = $_POST["obj"];
		if($this->m_Administration->verifyObra($obra["codigoObra"],$obra["nombreObra"])){
			if($this->m_Administration->saveObra($obra)){
				echo 'success obra';
			}else{
				echo 'error obra';
			}
		}else{
			echo 'obra exist';
		}	
	}

	public function getTypesObres(){
		$this->load->model("m_Administration");
		$tipos = $this->m_Administration->tiposObtras();
		$algo = '<option value="" default selected>seleccionar...</option>';
		foreach ($tipos as $tipo) {
			$algo.='<option value="'.$tipo->ID.'">'.$tipo->name.'</option>';
		}

		echo $algo;
	}

	public function getObraData(){
		$this->load->model("m_Administration");
		$id = $_POST["id"];
		$data = $this->m_Administration->bringObraEdit($id);
		$data_json['data'] = $data;
		echo json_encode($data_json);
	}

	public function deleteObra(){
		$this->load->model("m_Administration");
		$obra = $_POST["obra"];
		if($this->m_Administration->deleteObra($obra)){
			echo 'Obra has been deleted';
		}else{
			echo 'Obra has not been deleted';
		}
	}

	public function editObra(){
		$this->load->model("m_Administration");
		$obra = $_POST["obj"];

		if($this->m_Administration->updateObra($obra)){
			echo 'success Obra Edit';
		}else{
			echo 'error Obra Edit';
		}
	}

}
