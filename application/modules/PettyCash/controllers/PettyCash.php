<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PettyCash extends MY_Controller {

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
		$this->loadView("PettyCash/v_Petty_Cash",$data=null);
		$this->load->view("PettyCash/modal_Registro_Caja");
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalRegistro_obras");
		$this->load->view("Files/modalUploadFiles");
	}

	public function savePettyCash(){
		if(isset($_POST["obj"])){
			$obj = $this->input->post("obj");
			$this->load->model("m_PettyCash");
			$response = $this->m_PettyCash->savePettyCash($obj);
			switch($response){
				case 1: echo 'success petty cash'; 
				break;
				case 2: echo 'error petty cash';
				break;
				case 3: echo 'petty cash exist';
				break;
			}
		}else{
			redirect ("/");
		};
	}

	public function getLocationTypes(){
		$this->load->model("m_PettyCash");
		$location = $this->m_PettyCash->getlocations();
		$options = '<option value="" selected >seleccionar...</option>';
		foreach ($location as $ubicacion) {
			$options.='<option value="'.$ubicacion->ID.'">'.$ubicacion->name.'</option>';
		}

		echo $options;
	}

	public function getDeductibleTypes(){
		$this->load->model("m_PettyCash");
		$deductible = $this->m_PettyCash->getDeductibles();
		$options = '<option value="" selected >seleccionar...</option>';
		foreach ($deductible as $deducible) {
			$options.='<option value="'.$deducible->ID.'">'.$deducible->nombre.'</option>';
		}
		echo $options;
	}

	public function getConceptTypes(){
		$this->load->model("m_PettyCash");
		$concepts = $this->m_PettyCash->getConcepts();
		$options = '<option value="" selected >seleccionar...</option>';
		foreach ($concepts as $concepto) {
			$options.='<option value="'.$concepto->ID.'">'.$concepto->nombre.'</option>';
		}
		echo $options;
	}

	public function getAllResponsable(){
		$this->load->model("m_PettyCash");
		$responsable = $this->m_PettyCash->getallResponsables();
		$options = '<option value="" selected >seleccionar...</option>';
		foreach ($responsable as $encargado) {
			$options.='<option value="'.$encargado->ID.'">'.$encargado->name.'</option>';
		}
		echo $options;
	}

	public function getAllTeams(){
		$this->load->model("m_PettyCash");
		$teams = $this->m_PettyCash->getTeams();
		$options = '<option value="" selected >seleccionar...</option>';
		foreach ($teams as $equipo) {
			$options.='<option value="'.$equipo->ID.'">'.$equipo->name.'</option>';
		}
		echo $options;
	}
}
