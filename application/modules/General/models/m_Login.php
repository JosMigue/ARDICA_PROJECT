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

		$usuario["user"] = $this->db->select('U.ID, U.name, U.password ,U.nickname, U.timeStamp, U.status, U.typeUser')
      			->from('users U')
				->where('nickname', $nick)
      			->get()
				->row();
				  
		$usuario["user_status"] = $this->db->select('U.ID, U.name, U.password ,U.nickname, U.timeStamp, U.status, U.typeUser')
      			->from('users U')
				->where('nickname', $nick)
				->where('status',1)
      			->get()
				->row();
		
		return $usuario;
	}


	public function updateAcceso($idUsuario){
		$date=new DateTime(); 
	    $this->db->trans_begin();
	    $this->db->update('users',array('timeStamp' => $date->format('Y-m-d H:i:s')), array('ID' => $idUsuario));
		$dataLog=array('tabla'=>'usuario','accion'=>5,'fecha'=>$date->format('Y-m-d H:i:s'),'direccion_ip'=>$this->input->ip_address(),'usuario_idusuario'=>$idUsuario,'registro_id'=>$idUsuario,'campo'=>'ultimo_acceso','descripcion'=>'inicio de sesion');
	    $this->db->insert('eventos_log', $dataLog);
	    if ($this->db->trans_status() === FALSE){ 
	    	$this->db->trans_rollback();
	    }else{
	    	$this->db->trans_commit();
	    }
	}





}