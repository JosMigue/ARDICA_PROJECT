<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class M_Login extends CI_Model {

	public function saveCaptcha($cap){

		$data = array(

				'captcha_time' => $cap['time'],

				'ip_address'   => $this->input->ip_address(),

				'word'         => $cap['word']

		);

		$query= $this->db->insert_string('captcha',$data);

		$this->db->query($query);

	}



	public function deleteOldCaptcha($expiration){

		$this->db->where('captcha_time <',$expiration);

		$this->db->delete('captcha');

	}



	public function check($ip,$expiration,$captcha){

		$this->db->where('word',$captcha);

		$this->db->where('ip_address',$ip);

		$this->db->where('captcha_time >',$expiration);

		$query= $this->db->get('captcha');

		return $query->num_rows();

	}

	public function busca_usuario($nick,$password){

		return $this->db->select('U.ID, U.name, U.password ,U.nickname, U.timeStamp, U.status, U.typeUser')

      			->from('users U')

      			->where('nickname', $nick)
				  
      			->get()

      			->row();

      

	}

	public function get_informacion_usuario($id){

		return $this->db->select('U.nombre_usuario as nombre, U.apellido_usuario as apellido, U.email_usuario as email, U.tipo_usuario as tipo, U.entidad_usuario as entidad, E.nombre_empresa as empresa,U.foto')

				 		->from('usuario U')

				 		->join('empresa E', 'U.empresa_idempresa=E.idempresa')

				 		->where('U.idusuario='.$id)

				 		->get()

				 		->row();

	}

	public function getModulesPerfil($idUsuario){
			return $this->db->select('AM.titulo_mostrado as nombre,AM.url_acceso as controlador,AM.img1,AM.img2')
							->from('usuario U')
							->join('perfil P','U.perfil_id=P.id')
							->join('perfil_has_accesos_modulos DPM','P.id=DPM.perfil_id')
							->join('accesos_modulos AM','DPM.accesos_modulos_id=AM.id')
							->where('U.idusuario',$idUsuario)
							->order_by('AM.id','asc')
							->get()
							->result();
	}
	public function updateAcceso($idUsuario){
		$date=new DateTime(); 
	    $this->db->trans_begin();
	    $this->db->update('users',array('timeStamp' => $date->format('Y-m-d H:i:s')), array('ID' => $idUsuario));
		$dataLog=array('tabla'=>'usuario','accion'=>2,'fecha'=>$date->format('Y-m-d H:i:s'),'direccion_ip'=>$this->input->ip_address(),'usuario_idusuario'=>$idUsuario,'registro_id'=>$idUsuario,'campo'=>'ultimo_acceso','descripcion'=>'inicio de sesion');
	    $this->db->insert('eventos_log', $dataLog);
	    if ($this->db->trans_status() === FALSE){ 
	    	$this->db->trans_rollback();
	    }else{
	    	$this->db->trans_commit();
	    }
	}





}