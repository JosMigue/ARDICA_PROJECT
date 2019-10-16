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

	public function catalogo_deducible(){
		$this->load->model("m_PettyCash");
		$data["data"] = $this->m_PettyCash->getDeductibles();
		$this->loadView("PettyCash/v_tiposDeducible",$data);
		$this->load->view("PettyCash/modal_Registro_Caja");
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalRegistro_obras");
		$this->load->view("Files/modalUploadFiles");
	}

	public function catalogo_concepto(){
		$this->load->model("m_PettyCash");
		$data["data"] = $this->m_PettyCash->getConcepts();
		$this->loadView("PettyCash/v_conceptos",$data);
		$this->load->view("PettyCash/modal_Registro_Caja");
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalRegistro_obras");
		$this->load->view("Files/modalUploadFiles");
	}

	public function catalogo_equipo(){
		$this->load->model("m_PettyCash");
		$data["data"] = $this->m_PettyCash->getTeams();
		$this->loadView("PettyCash/v_equipo",$data);
		$this->load->view("PettyCash/modal_Registro_Caja");
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalRegistro_obras");
		$this->load->view("Files/modalUploadFiles");
	}

	public function catalogo_obra(){
		$this->load->model("m_PettyCash");
		$data["data"] = $this->m_PettyCash->getObresTypes();
		$this->loadView("PettyCash/v_tipos_obras",$data);
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

	public function disablePettyCash(){
		if(isset($_POST["id"])){
			$this->load->model("m_PettyCash");
			$id = $this->input->post("id");
			$response = $this->m_PettyCash->disablePettyCash($id);
			if($response){
				echo 'Petty Cash is disabled';
			}else{
				echo 'Petty Cash disabled error';
			}

		}else{
			redirect ("/");
		};
	}
	public function enablePettyCash(){
		if(isset($_POST["id"])){
			$this->load->model("m_PettyCash");
			$id = $this->input->post("id");
			$response = $this->m_PettyCash->enablePettyCash($id);
			if($response){
				echo 'Petty Cash is enabled';
			}else{
				echo 'Petty Cash enabled error';
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
			$options.='<option value="'.$equipo->ID.'">'.$equipo->nombre.'</option>';
		}
		echo $options;
	}

	public function getAllPettyCash(){
		$this->load->model("m_PettyCash");
		$start=$this->input->post('start');
		$length=$this->input->post('length');
		$array_like=array();
		$array_where=array();
             if ($this->input->post('numeroCajaChica')!='') {
                $array_like['numero']=$this->input->post('numeroCajaChica'); 
             }
             if ($this->input->post('localizacionCajaChica')!='') {
                $array_where['ubicacion']=$this->input->post('localizacionCajaChica');
             }
             if ($this->input->post('deducibleCajaChica')!='') {
                $array_where['tipo_deducible']=$this->input->post('deducibleCajaChica');
             }
             if ($this->input->post('responsableCajaChica')!='') {
                $array_where['encargado']=$this->input->post('responsableCajaChica');
			 }
			 if ($this->input->post('equipoCajaChica')!=''){
				$array_where['equipo']=$this->input->post('equipoCajaChica');
			 }
             if ($this->input->post('estadoCajaChica')!='') {
				if($this->input->post('estadoCajaChica')==2){
					$array_where['estado'] = 0;
				}else{
					$array_where['estado']=$this->input->post('estadoCajaChica');
				}
			 }
			 if($this->input->post('fechaIni')!=''){
				 $array_where['fecha_inicio'] = $this->input->post('fechaIni');
			 }
			 if($this->input->post('fechaFin')!=''){
				$array_where['fecha_terminacion'] = $this->input->post('fechaIni');
			 }
			 if ($this->input->post('autorizadaCajaChica')!=''){
				 if($this->input->post('autorizadaCajaChica')==2){
					$array_where['autorizada']=0;
				 }else{
					$array_where['autorizada']=$this->input->post('autorizadaCajaChica');
				 }
			 }
			 
		$response=$this->m_PettyCash->getAllPettyCash($start,$length,$array_like,$array_where); 
		$total_registros=$response['total']->total;
		$response=$response['data'];  
		$rows_total=count($response);  
		$datos=array(); 
		$contador = 0;
		foreach ($response as $row) {   
			$array=array();
			$array['status'] = $row->estado;
			$array['Id']=$contador+=1;
			$array['Id_db']=$row->ID;
			$array['numero']=$row->numero;
			$array['ubicacion']=$row->ubicacion;
			$array['fechaInic']=$row->fIni;
			$array['fechaTerm']=$row->fFin;
			$array['deducible']=$row->deducible;
			$array['concepto']=$row->concepto;
			$array['encargado']=$row->encargado;
			$array['equipo']=$row->equipo;
			$array['fechaRegistro']=$row->fRegistro;
			$datos[]=$array; 
		}
		$json_data=array(
			"draw"=>intval($this->input->post('draw')),
			"recordsTotal"=>intval($total_registros),
			"recordsFiltered"=>intval($total_registros),
			"data"=>$datos);
			echo json_encode($json_data);  
	}



	/*===========AUTOCOMPLETE FUNCTIONS SECTION BEGIN=============*/
	public function get_autocomplete_PettyCash_Filters_Number(){
		$this->load->model('m_PettyCash');		
		$response = $this->m_PettyCash->getNumberAutocomplete();
		echo json_encode($response);
	}

	public function get_autocomplete_PettyCash_Filters_Location(){
		$this->load->model('m_PettyCash');		
		$response = $this->m_PettyCash->getlocations();
		echo json_encode($response);
	}

	public function get_autocomplete_PettyCash_Filters_Responsable(){
		$this->load->model('m_PettyCash');		
		$response = $this->m_PettyCash->getallResponsables();
		echo json_encode($response);
	}

	public function get_autocomplete_PettyCash_Filters_Team(){
		$this->load->model('m_PettyCash');		
		$response = $this->m_PettyCash->getTeams();
		echo json_encode($response);
	}
	/*===========AUTOCOMPLETE FUNCTIONS SECTION END=============*/
}

