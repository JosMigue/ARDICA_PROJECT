<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends MY_Controller {
	public function index()
	{
		$this->load->model("m_Administration");
		$data['data'] = $this->m_Administration->bringUser();

		$this->loadView("Administration/v_Administration",$data=null);
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalEditarUsuario");
		$this->load->view("Administration/modalRegistro_obras");
		$this->load->view("Files/modalUploadFiles");
	}

	public function obras()
	{
		$this->load->model("m_Administration");
		$data['data'] = $this->m_Administration->bringObras();
		$this->loadView("Administration/v_Administration_obras",$data);
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalRegistro_obras");
		$this->load->view("Administration/modalEditarObra"); 
		$this->load->view("Files/modalUploadFiles");
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
		$response = $this->m_Administration->updateUser($user);
 		switch($response){
			case 1: echo 'success';
			break;
			case 2: echo 'error';
			break;
			case 0: echo 'no changes';
			break;
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
		$response = $this->m_Administration->updateObra($obra);
		switch($response){
			case 0: echo 'no changes';
			break;
			case 1: echo 'success Obra Edit';
			break;
			case 2: echo 'error Obra Edit';
			break;
			case 3: echo 'name exist';
		}
	}

	function get_autocomplete_name(){
		$this->load->model("m_Administration");
        $result = $this->m_Administration->search_name_user();
		echo json_encode($result);
	}

	function get_autocomplete_obra(){
		$this->load->model("m_Administration");
        $result = $this->m_Administration->search_obra();
		echo json_encode($result);
	}
	
	/* ================================FILTERS SECTION BEGIN================================ */
	function getAllUsers(){
		$this->load->model("m_Administration");
		$start=$this->input->post('start');
		$length=$this->input->post('length');
		$array_like=array();
		$array_where=array();
             if ($this->input->post('nombre')!='') {
                $array_where['name']=$this->input->post('nombre'); 
             }
             if ($this->input->post('nombreUsuario')!='') {
                $array_like['nickname']=$this->input->post('nombreUsuario');
             }
             if ($this->input->post('fecha')!='') {
                $array_where['dateSave']=$this->input->post('fecha');
             }
             if ($this->input->post('idUsuario')!='') {
                $array_where['ID']=$this->input->post('idUsuario');
			 }
			 
		$respuesta=$this->m_Administration->getAllUsers($start,$length,$array_like,$array_where); 
		$total_registros=count($respuesta['data']);
		$respuesta=$respuesta['data']; 
		$rows_total=count($respuesta);  
		$datos=array(); 
		$contador = 0;
		foreach ($respuesta as $row) {   
			$array=array();
			$array['status'] = $row->status;
			$array['Id']=$contador+=1;
			$array['Id_db']=$row->ID;
			$array['name']=$row->name;
			$array['nickname']=$row->nickname;
			$array['phone']=$row->phone;
			$array['email']=$row->email;
			$array['fechaRegistro']=$row->dateSave;
			$array['lastLogin']=$row->timeStamp;
			$datos[]=$array; 
		}
		$json_data=array(
			"draw"=>intval($this->input->post('draw')),
			"recordsTotal"=>intval($rows_total),
			"recordsFiltered"=>intval($total_registros),
			"data"=>$datos);
		echo json_encode($json_data);  
	}
	/* ================================FILTERS SECTION END================================ */

}
