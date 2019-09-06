<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends MY_Controller {

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

	
	function __construct(){

		parent::__construct();
	
		//cargamos el helper string
	
		$this->load->helper('string');
	
		//generamos un random alfanumerico de 6 caracteres
	
		$this->rand=random_string('numeric', 6);
	
		//cargamos el modelo del captcha
		$this->load->model('m_Login');
	
		
	}

	public function index(){	
		if($this->session->userdata('logueado')){

			$this->logueado();

		}else{

			$data['captcha']= $this->generarCaptcha();

			$this->session->set_userdata('captcha',$this->rand);

			$this->loadLogin('General/Login',$data);   

		}

		 

	}

	public function generarCaptcha(){

		$config = array(

					'word'         => $this->rand,

					'img_path'     => './captcha/', 

					'img_url'      => base_url().'captcha/', 

					'font_path'    => realpath('./fonts/Login.ttf'),

					'img_width'    => '250', 

					'img_height'   => 70, 

					'expiration'   => 120, 

					'font_size'    => 26, 

					'colors'       => array(

										'background'  => array(20, 21, 77),

										'border'  => array(0,0,0),

										'text'  => array(245,124,0),

										'grid'  => array(240, 144, 144))

					);

		

		$cap=create_captcha($config);

		$this->m_Login->saveCaptcha($cap);

		return $cap;

	}

	public function validaCaptcha(){
		$obj = $_POST["obj"];
		$captcha = $obj["captcha"];
		if ($captcha!= $this->session->userdata('captcha')) { 
			echo 'captcha mal';

		}else{

			$expiration = time()-120;

			$ip=$this->input->ip_address();
			
			$this->m_Login->deleteOldCaptcha($expiration);

			$last = $this->m_Login->check($ip,$expiration,$captcha);

			if ($last ==1) {
				$user = $obj["user"];
				$password = $obj["password"];
				$passCost = [
					'cost' => 12,
				];
				$usuario = $this->m_Login->busca_usuario($user, password_hash($password,PASSWORD_BCRYPT,$passCost)); 
				if ($usuario!='' && $usuario!=null ) {

					if(password_verify($password,$usuario->password)){
	
				   $usuario_data = array(
	
							  'idUser' => $usuario->ID,
	
							  'nameUser' => $usuario->name,
	
							  'userNickName' => $usuario->nickname,
	
							  'userTimeStamp'    =>$usuario->timeStamp,
	
							  'userStatus'    =>$usuario->status,
	
							  'userType' =>$usuario->typeUser,
	
							  'logueado' => TRUE
				   
	
				   );
				   $this->session->set_userdata($usuario_data);
				   $this->m_Login->updateAcceso($usuario->ID);  
				   /* This block will be use when we decided to add cookies on WEB page */
	/* 			   if ($this->input->post("recordar")){
					   $this->input->set_cookie('uemailhouder', $correo, 172800);
					   $this->input->set_cookie('upasswordhouder', $password, 172800);
				   }else{
					   delete_cookie('uemailhouder'); 
					   delete_cookie('upasswordhouder'); 
				   } */
				  echo 'user OK';
				}else{
					
					echo 'wrong password';
				}
	
			}else{
				  
				echo 'user not found';
				  
			 } 
			}else{

				//si no, redirecciona a vista login

				echo 'default';

			}

		}

	}

  public function logueado() {
	 if($this->session->userdata('logueado')){
/* 		  $idUsuario=$this->session->userdata('id');
		  $data['modulos']=$this->m_Login->getModulesPerfil($idUsuario);  */
		  $data='';
		$this->loadHome('General/Home',$data); 

	 }else{

		redirect('Login');

	 }

  }

  public function cerrar_sesion() {

	 $usuario_data = array(

		'logueado' => FALSE

	 );

	 $this->session->set_userdata($usuario_data);

	 $this->session->sess_destroy();

	 redirect('/');

  }





   public function vista_contenido(){

		   $this->cargar_vista('principal',$data=null);

   }

   public function vista_contenido2(){

		   $this->cargar_vista('Ayuda',$data=null);

   }

   public function panel_principal(){

		   $this->cargar_vista3('principal');

   }



   public function perfil(){

		$this->load->model('m_Login');

		$respuesta['datos']=$this->m_Login->get_informacion_usuario($this->session->userdata('id'));

		$this->cargar_vista3('Login/v_perfil', $respuesta);

   }









}



/* End of file login.php */

/* Location: ./application/modules/Login/controllers/login.php */
