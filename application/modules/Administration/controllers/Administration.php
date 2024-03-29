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
		}else{
			redirect('/');
		}

	}
	public function logActivity()
	{
		if($this->checkUser()){
			$this->load->model("m_Administration");
			$data['data'] = $this->m_Administration->bringLog();
			$header['header'] = $this->asignHeader();
			$this->loadView("Administration/v_log_Activity",$data,$header);
			$this->load->view("Administration/modalRegistro_usuarios");
			$this->load->view("Administration/modalRegistro_obras");
			$this->load->view("Administration/modalEditarObra"); 
		}else{
			redirect('/');
		}
	}

	public function asignHeader(){
		if($this->session->userdata('userType') == 1){
			$header = '    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
      <a class="nav-link" href="'. site_url("/administration").'">Lista de usuarios</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" id="button_add_user"  data-toggle="modal" onclick="resetModal()" data-target="#modalRegistro" >Registrar usuario</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="'. site_url("/administration.obras").'">Lista de obras</a>
      </li>
      <li class="nav-item">
      <a class="nav-link"  data-toggle="modal" onclick="resetModalObras()" data-target="#modalRegistroObra" >Registrar obra</a>
      </li>
      <li class="nav-item">
      <a class="nav-link" href="'. site_url("/administration.dashboard").'">Log activity</a>
      </li>
    </ul>';
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
					$log = Array(
						'tabla' => 'users',
						'accion' => 1,
						'direccion_ip' => $this->input->ip_address(),
						'usuario_idusuario' => $this->session->userdata('idUser'),
						'registro_id' => $name,
						'campo' => 'NUEVO REGISTRO',
						'descripcion' => 'Registro de usuario para acceder al sistema -> rol:'. $obj['rol']
					); 
					$this->m_Administration->saveLogActivity($log);
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
					'accion' => 3,
					'direccion_ip' => $this->input->ip_address(),
					'usuario_idusuario' => $this->session->userdata('idUser'),
					'registro_id' => $user,
					'campo' => 'status',
					'descripcion' => 'Proceso de desactivación de usuario ->'.$user
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
					'accion' => 4,
					'direccion_ip' => $this->input->ip_address(),
					'usuario_idusuario' => $this->session->userdata('idUser'),
					'registro_id' => $user,
					'campo' => 'status',
					'descripcion' => 'Proceso de activación de usuario ->'.$user
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
			if($response == 1){
				$log = Array(
				'tabla' => 'users',
				'accion' => 2,
				'direccion_ip' => $this->input->ip_address(),
				'usuario_idusuario' => $this->session->userdata('idUser'),
				'registro_id' => $user["id"],
				'campo' => 'EDITAR REGISTRO DE USUARIO',
				'descripcion' => 'Editra datos de usuario ->'.$user['id']
			); 
			$this->m_Administration->saveLogActivity($log);
			}
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
						'registro_id' => $obra["codigoObra"],
						'campo' => 'NUEVO REGISTRO',
						'descripcion' => 'Guardar nueva obra, código ->'.$obra['codigoObra']
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
			$roles.='<option value="'.$tipo->ID_ROL.'">'.$tipo->nombre.'</option>';
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
					'accion' => 3,
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
					'accion' => 4,
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
					'accion' => 2,
					'direccion_ip' => $this->input->ip_address(),
					'usuario_idusuario' => $this->session->userdata('idUser'),
					'registro_id' => $obra["id"],
					'campo' => 'ACTUALIZACIÓN DE REGISTRO',
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
			if($this->session->userdata('userType') == 5 || $this->session->userdata('userType') == 1){
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
			redirect('/');
		}
		}else{
			$this->load->view('Administration/forbiden');
		}
	}
	public function generateReportObras(){
		if($this->session->userdata('logueado') == true){
			if($this->session->userdata('userType') == 5 || $this->session->userdata('userType') == 1){
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
				redirect('/');			
			}
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