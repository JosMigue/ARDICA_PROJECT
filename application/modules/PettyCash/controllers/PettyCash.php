<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PettyCash extends MY_Controller {
	public function index()
	{
		$this->loadView("PettyCash/v_Petty_Cash",$data=null);
		$this->load->view("PettyCash/modal_Registro_Caja");
		$this->load->view("PettyCash/modal_RegistrarGastoCaja");
		$this->load->view("Administration/modalRegistro_usuarios");
		$this->load->view("Administration/modalRegistro_obras");
		$this->load->view("Files/modalUploadFiles");
	}

	public function detailPettyCash()
	{
		$this->loadView("PettyCash/v_Petty_Cash-Gastos",$data=null);
		$this->load->view("PettyCash/modal_Registro_Caja");
		$this->load->view("PettyCash/modal_RegistrarGastoCaja");
		$this->load->view("PettyCash/modal_Editar_Caja");
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
			redirect ("/pettyCash");
		};
	}

	public function saveDetailPettyCash(){
		if(isset($_POST["obj"])){
			$this->load->model("m_PettyCash");
			$obj =  $this->input->post('obj');
			$response = $this->m_PettyCash->saveDetailPettyCash($obj);
			switch($response){
				case 1: echo 'success detail petty cash'; 
				break;
				case 2: echo 'error detail petty cash';
				break;
			}
		}else{
			redirect ("/pettyCash");
		}
	}

	public function deleteDetailPettyCash(){
		if(isset($_POST['id'])){
			$this->load->model("m_PettyCash");
			$id =  $this->input->post('id');
			$response = $this->m_PettyCash->deleteDetailPettyCash($id);
			switch($response){
				case 1: echo 'delete detail is done'; 
				break;
				case 2: echo 'delete detail has been failed';
				break;
			}
		}else{
			redirect ("/pettyCash");
		}
	}

	public function updateDetailPettyCash(){
		if(isset($_POST["obj"])){
			$this->load->model("m_PettyCash");
			$obj =  $this->input->post('obj');
			$response = $this->m_PettyCash->updateDetailPettyCash($obj);
			switch($response){
				case 1: echo 'success detail petty cash updated'; 
				break;
				case 2: echo 'error detail petty cash update';
				break;
			}
		}else{
			redirect ("/pettyCash");
		}
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
			redirect ("/pettyCash");
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
			redirect ("/pettyCash");
		};
	}

	public function bringPettyCashData(){
		if(isset($_POST["id"])){
			$this->load->model("m_PettyCash");
			$id = $this->input->post('id');
			$data = $this->m_PettyCash->bringPettyCashData($id);
			$data_json['data'] = $data;
			echo json_encode($data_json);
		}else{
			redirect ("/pettyCash");
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

	public function getPettyCash(){
		$this->load->model("m_PettyCash");
		$pettyCash = $this->m_PettyCash->getPettyCash();
		$options = '<option value="" selected >seleccionar...</option>';
		foreach ($pettyCash as $caja) {
			$options.='<option value="'.$caja->ID.'">'.$caja->numero.'</option>';
		}
		echo $options;
	}

	public function getPettyCashTwo(){
		$this->load->model("m_PettyCash");
		$pettyCash = $this->m_PettyCash->getPettyCashTwo();
		$options = '<option value="" selected >seleccionar...</option>';
		foreach ($pettyCash as $caja) {
			$options.='<option value="'.$caja->numero.'">'.$caja->numero.'</option>';
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
					$array_where['estado_caja'] = 0;
				}else{
					$array_where['estado_caja']=$this->input->post('estadoCajaChica');
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
			$array['fechaInic']=$row->fIni;
			$array['fechaTerm']=$row->fFin;
			$array['encargado']=$row->encargado;
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

	public function getAllDetailPettyCash(){
		$this->load->model("m_PettyCash");
		$start=$this->input->post('start');
		$length=$this->input->post('length');
		$array_where=array();
             if ($this->input->post('idCajaChicaDetail')!='') {
                $array_where['caja_chica_ID']=$this->input->post('idCajaChicaDetail');
             }
		$response=$this->m_PettyCash->getAllDetailPettyCash($start,$length,$array_where); 
		$total_registros=$response['total']->total;
		$response=$response['data'];  
		$rows_total=count($response);  
		$datos=array(); 
		$contador = 0;
		foreach ($response as $row) {   
			$array=array();
			$array['Id'] = $row->ID;
			$array['numero']=$row->numero;
			$array['ubicacion']=$row->ubicacion;
			$array['equipo']=$row->equipo;
			$array['concepto']=$row->concepto;
			$array['subtotal']=$row->subtotal;
			$array['IVA']=$row->IVA;
			$array['total']=$row->total;
			$array['deducible']=$row->deducible;
			$array['observacion']=$row->observacion;
			$array['registro']=$row->registro;
			$datos[]=$array; 
		}
		$json_data=array(
			"draw"=>intval($this->input->post('draw')),
			"recordsTotal"=>intval($total_registros),
			"recordsFiltered"=>intval($total_registros),
			"data"=>$datos);
			echo json_encode($json_data);  
	}


public function plusPettyCashData(){
	if(isset($_POST['pettyCahsnumber'])){
		$this->load->model('m_PettyCash');
		$number = $this->input->post('pettyCahsnumber');
		$response = $this->m_PettyCash->plusAll($number);
		echo json_encode($response);
	}else{
		redirect('/pettyCash');
	}
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
	

	/*================ADD CATALOGE BEGIN=============================*/
	public function saveDeductible(){
		$this->load->model('m_PettyCash');
		$name = $this->input->post('deductible');
		$response = $this->m_PettyCash->saveDeductible($name);
		if($response!= false){
			echo json_encode($response);
		}else{
			echo 'error';
		}
	}

	public function saveConcept(){
		$this->load->model('m_PettyCash');
		$name = $this->input->post('concept');
		$response = $this->m_PettyCash->saveConcept($name);
		if($response!= false){
			echo json_encode($response);
		}else{
			echo 'error';
		}
	}

	public function saveTeam(){
		$this->load->model('m_PettyCash');
		$name = $this->input->post('team');
		$response = $this->m_PettyCash->saveTeam($name);
		if($response!= false){
			echo json_encode($response);
		}else{
			echo 'error';
		}
	}

	public function saveObrasType(){
		$this->load->model('m_PettyCash');
		$name = $this->input->post('obra_type');
		$response = $this->m_PettyCash->saveObrasType($name);
		if($response!= false){
			echo json_encode($response);
		}else{
			echo 'error';
		}
	}
	/*================ADD CATALOGE END=============================*/


	/*================DELETE CATALOGE BEGIN=============================*/
	public function deleteDeductible(){
		$this->load->model('m_PettyCash');
		$id = $this->input->post('deductible');
		$response = $this->m_PettyCash->deleteDeductible($id);
		if($response){
			echo true;
		}else{
			echo false;
		}
	}

	public function deleteConcept(){
		$this->load->model('m_PettyCash');
		$id = $this->input->post('concept');
		$response = $this->m_PettyCash->deleteConcept($id);
		if($response){
			echo true;
		}else{
			echo false;
		}
	}

	public function deleteTeam(){
		$this->load->model('m_PettyCash');
		$id = $this->input->post('team');
		$response = $this->m_PettyCash->deleteTeam($id);
		if($response){
			echo true;
		}else{
			echo false;
		}
	}

	public function deleteObrasType(){
		$this->load->model('m_PettyCash');
		$id = $this->input->post('obra_type');
		$response = $this->m_PettyCash->deleteObrasType($id);
		if($response){
			echo true;
		}else{
			echo false;
		}
	}

	/*================DELETE CATALOGE END=============================*/

}

