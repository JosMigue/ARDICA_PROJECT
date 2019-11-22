<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends MY_Controller {
	public function index()
	{
		if($this->checkUser()){
			$this->load->model("m_Administration");
			$data['data'] = $this->m_Administration->bringUser();
			$header['header'] = $this->asignHeader();
			$this->loadView("Administration/v_Administration",$data,$header);
			$this->load->view("Administration/modalRegistro_usuarios");
			$this->load->view("Administration/modalEditarUsuario");
			$this->load->view("Administration/modalRegistro_obras");
			$this->load->view("PettyCash/modal_Registro_Caja");
			$this->load->view("Files/modalUploadFiles");
		}else{
			redirect('/');
		}
	}

	public function obras()
	{
		if($this->checkUser()){
			$this->load->model("m_Administration");
			$data['data'] = $this->m_Administration->bringObras();
			$header['header'] = $this->asignHeader();
			$this->loadView("Administration/v_Administration_obras",$data,$header);
			$this->load->view("Administration/modalRegistro_usuarios");
			$this->load->view("Administration/modalRegistro_obras");
			$this->load->view("Administration/modalEditarObra"); 
			$this->load->view("PettyCash/modal_Registro_Caja");
			$this->load->view("Files/modalUploadFiles");
		}else{
			redirect('/');
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

	public function saveUser(){
		if(isset($_POST["obj"])){
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
	}

	public function deleteUser(){
		if(isset($_POST["user"])){
			$this->load->model("m_Administration");
			$user = $_POST["user"];
			if($this->m_Administration->deleteUser($user)){
				$log = Array(
					'tabla' => 'users',
					'accion' => 2,
					'direccion_ip' => $this->input->ip_address(),
					'usuario_idusuario' => $this->session->userdata('idUser'),
					'registro_id' => $user,
					'campo' => 'status',
					'descripcion' => 'Proceso de desactivación de usuario'
				); 
				$this->m_Administration->saveLogActivity($log);
				echo 'user has been deleted';
			}else{
				echo 'user has not been deleted';
			}
		}
	}
	public function enableUser(){
		if(isset($_POST["user"])){
			$this->load->model("m_Administration");
			$user = $_POST["user"];
			if($this->m_Administration->enableUser($user)){
				$log = Array(
					'tabla' => 'users',
					'accion' => 3,
					'direccion_ip' => $this->input->ip_address(),
					'usuario_idusuario' => $this->session->userdata('idUser'),
					'registro_id' => $user,
					'campo' => 'status',
					'descripcion' => 'Proceso de activación de usuario'
				); 
				$this->m_Administration->saveLogActivity($log);
				echo 'user has been enabled';
			}else{
				echo 'user has not been disabled';
			}
		}
	}


	public function getUserData(){
		if(isset($_POST["id"])){
			$this->load->model("m_Administration");
			$id = $_POST["id"];
			$data = $this->m_Administration->bringUserEdit($id);
			$data_json['data'] = $data;
			echo json_encode($data_json);
		}
	}

	public function editUser(){
		if(isset($_POST["obj"])){
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
	}

	public function saveObra(){
		if(isset($_POST["obj"])){
			$this->load->model("m_Administration");
			$obra = $_POST["obj"];
			if($this->m_Administration->verifyObra($obra["codigoObra"],$obra["nombreObra"])){
				if($this->m_Administration->saveObra($obra)){
					$log = Array(
						'tabla' => 'obras',
						'accion' => 1,
						'direccion_ip' => $this->input->ip_address(),
						'usuario_idusuario' => $this->session->userdata('idUser'),
						'registro_id' => $obras["codigoObra"],
						'campo' => 'TODO',
						'descripcion' => 'Guardar nueva obra'
					); 
					$this->m_Administration->saveLogActivity($log);
					echo 'success obra';
				}else{
					echo 'error obra';
				}
			}else{
				echo 'obra exist';
			}	
		}
	}

	public function getTypesObres(){
		$this->load->model("m_Administration");
		$tipos = $this->m_Administration->tiposObtras();
		$algo = '<option value="" selected >seleccionar...</option>';
		foreach ($tipos as $tipo) {
			$algo.='<option value="'.$tipo->ID.'">'.$tipo->name.'</option>';
		}

		echo $algo;
	}

	public function getTypesUsers(){
		$this->load->model("m_Administration");
		$tipos = $this->m_Administration->usersTypes();
		$roles  = '<option value="" selected >seleccionar...</option>';
		foreach ($tipos as $tipo) {
			$roles.='<option value="'.$tipo->ID.'">'.$tipo->nombre.'</option>';
		}

		echo $roles;
	}

	public function getObraData(){
		if(isset($_POST["id"])){
			$this->load->model("m_Administration");
			$id = $_POST["id"];
			$data = $this->m_Administration->bringObraEdit($id);
			$data_json['data'] = $data;
			echo json_encode($data_json);
		}
	}

	public function deleteObra(){
		if(isset($_POST["obra"])){
			$this->load->model("m_Administration");
			$obra = $_POST["obra"];
			if($this->m_Administration->deleteObra($obra)){
				$log = Array(
					'tabla' => 'obras',
					'accion' => 2,
					'direccion_ip' => $this->input->ip_address(),
					'usuario_idusuario' => $this->session->userdata('idUser'),
					'registro_id' => $obra,
					'campo' => 'status',
					'descripcion' => 'Proceso de desactivación de obra'
				); 
				$this->m_Administration->saveLogActivity($log);
				echo 'Obra has been deleted';
			}else{
				echo 'Obra has not been deleted';
			}
		}
	}

	public function habilitaObra(){
		if(isset($_POST["obra"])){
			$obra = $_POST["obra"];
			$this->load->model("m_Administration");
			if($this->m_Administration->habilitaObra($obra)){
				$log = Array(
					'tabla' => 'obras',
					'accion' => 2,
					'direccion_ip' => $this->input->ip_address(),
					'usuario_idusuario' => $this->session->userdata('idUser'),
					'registro_id' => $obra,
					'campo' => 'status',
					'descripcion' => 'Proceso de activación de obra'
				); 
				$this->m_Administration->saveLogActivity($log);
				echo 'Obra has been enabled';
			}else{
				echo 'Obra has not been disabled';
			}
		}
	}

	public function editObra(){
		if(isset($_POST["obj"])){
			$this->load->model("m_Administration");
			$obra = $_POST["obj"];
			$response = $this->m_Administration->updateObra($obra);
			switch($response){
				case 0: echo 'no changes';
				break;
				case 1: 
				$log = Array(
					'tabla' => 'obras',
					'accion' => 5,
					'direccion_ip' => $this->input->ip_address(),
					'usuario_idusuario' => $this->session->userdata('idUser'),
					'registro_id' => $obra["id"],
					'campo' => 'TODO',
					'descripcion' => 'Actualización de datos de una obra'
				); 
				$this->m_Administration->saveLogActivity($log);
				echo 'success Obra Edit';
				break;
				case 2: echo 'error Obra Edit';
				break;
				case 3: echo 'name exist';
			}
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

	function getAllUsersSelect(){
		$this->load->model("m_Administration");
		$tipos = $this->m_Administration->bringUser();
		$select = '<option value="" selected >seleccionar...</option>';
		foreach ($tipos as $tipo) {
			$select.='<option value="'.$tipo->ID.'">'.$tipo->name.'</option>';
		}

		echo $select;
	}
	
	/* ================================FILTERS SECTION BEGIN================================ */
	function getAllUsers(){
		$this->load->model("m_Administration");
		$start=$this->input->post('start');
		$length=$this->input->post('length');
		$array_like=array();
		$array_where=array();
             if ($this->input->post('nombre')!='') {
                $array_like['name']=$this->input->post('nombre'); 
             }
             if ($this->input->post('nombreUsuario')!='') {
                $array_where['nickname']=$this->input->post('nombreUsuario');
             }
             if ($this->input->post('fecha')!='') {
                $array_where['dateSave']=$this->input->post('fecha');
             }
             if ($this->input->post('idUsuario')!='') {
                $array_where['ID']=$this->input->post('idUsuario');
			 }
			 if ($this->input->post('statusUsuario')!=0){
				$array_where['status']=$this->input->post('statusUsuario');
			 }
			 
		$response=$this->m_Administration->getAllUsers($start,$length,$array_like,$array_where); 
		$total_registros=$response['total']->total;
		$response=$response['data'];  
		$rows_total=count($response);  
		$datos=array(); 
		$contador = 0;
		foreach ($response as $row) {   
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
			$array['rol']=$row->role;
			$datos[]=$array; 
		}
		$json_data=array(
			"draw"=>intval($this->input->post('draw')),
			"recordsTotal"=>intval($total_registros),
			"recordsFiltered"=>intval($total_registros),
			"data"=>$datos);
			echo json_encode($json_data);  
	}

	function getAllObras(){
		$this->load->model("m_Administration");
		$start=$this->input->post('start');
		$length=$this->input->post('length');
		$array_like=array();
		$array_where=array();
             if ($this->input->post('codigoObra')!='') {
                $array_where['cc']=$this->input->post('codigoObra'); 
             }
             if ($this->input->post('nombreObra')!='') {
                $array_like['name']=$this->input->post('nombreObra');
             }
             if ($this->input->post('fechaObra')!='') {
                $array_like['dateSave']=$this->input->post('fechaObra');
             }
             if ($this->input->post('tipoObra')!=0) {
                $array_where['type']=$this->input->post('tipoObra');
			 }
             if ($this->input->post('estadoObra')!=0) {				 
				$array_where['status']=$this->input->post('estadoObra');
			 }
			 
		$response=$this->m_Administration->getAllObras($start,$length,$array_like,$array_where); 
		$total_registros=$response['total']->total;
		$response=$response['data'];  
		$rows_total=count($response);  
		$datos=array(); 
		$contador = 0;
		foreach ($response as $row) {   
			$array=array();
			$array['contador']=$contador+=1;
			$array['status']=$row->status;
			$array['ID'] = $row->ID;
			$array['cc']=$row->cc;
			$array['name']=$row->name;
			$array['dateSave']=$row->dateSave;
			$array['type']=$row->type;
			$datos[]=$array; 
		}
		$json_data=array(
			"draw"=>intval($this->input->post('draw')),
			"recordsTotal"=>intval($total_registros),
			"recordsFiltered"=>intval($total_registros),
			"data"=>$datos);
			echo json_encode($json_data);  
	}
	/* ================================FILTERS SECTION END================================ */

	/* ================================REPORTS SECTION BEGIN================================ */
	public function generateReportUsers(){
		if($this->session->userdata('logueado') == true){
		$this->load->model('m_Administration');
		$data['data'] = $this->m_Administration->bringUser();
		$mpdfConfig = array(
			'margin_top' => 30,     // 30mm not pixel
		);
		$mpdf = new \Mpdf\Mpdf($mpdfConfig);
		$html = $this->load->view('Administration/reporteUsuarios',$data,true);
		$mpdf->SetHTMLHeader('
		<table width="100%">
			<tr>
				<td width="50%" >Reporte de usuarios en plataforma</td>
				<td width="50%" style="text-align: right;"><img src="img/Ardica_Construcciones_SA_de__CV_Logo.png" width="100" height="30"></td>
			</tr>
		</table> <hr>');
		$mpdf->SetHTMLFooter('
		<table width="100%">
			<tr>
				<td width="33%">{DATE j-m-Y}</td>
				<td width="33%" align="center">{PAGENO}/{nbpg}</td>
				<td width="33%" style="text-align: right;">Reporte de usuarios</td>
			</tr>
		</table>');
		$mpdf->WriteHTML($html);
		$mpdf->Output('Reporte de usuarios_'.date("d")."-".date("m")."-".date("Y").'.pdf', I);
		}else{
			$this->load->view('Administration/forbiden');
		}
	}
	public function generateReportObras(){
		if($this->session->userdata('logueado') == true){
		$this->load->model('m_Administration');
		$data['data'] = $this->m_Administration->bringObras();
		$mpdfConfig = array(
			'margin_top' => 30,     // 30mm not pixel
		);
		$mpdf = new \Mpdf\Mpdf($mpdfConfig);
		$html = $this->load->view('Administration/reporteObras',$data,true);
		$mpdf->SetHTMLHeader('
		<table width="100%">
			<tr>
				<td width="50%" >Reporte de obras o ubicaciones en plataforma</td>
				<td width="50%" style="text-align: right;"><img src="img/Ardica_Construcciones_SA_de__CV_Logo.png" width="100" height="30"></td>
			</tr>
		</table> <hr>');
		$mpdf->SetHTMLFooter('
		<table width="100%">
			<tr>
				<td width="33%">{DATE j-m-Y}</td>
				<td width="33%" align="center">{PAGENO}/{nbpg}</td>
				<td width="33%" style="text-align: right;">Reporte de obras y ubicaciones</td>
			</tr>
		</table>');
		$mpdf->WriteHTML($html);
		$mpdf->Output();
		}else{
			$this->load->view('Administration/forbiden');
		}
	}
	/* ================================REPORTS SECTION END================================ */
	public function checkUser(){
		if($this->session->userdata('userType') == 1){
			return true;
		}else{
			return false;
		}
	}

}