<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Administration extends CI_Model {

    function bringUser(){
            return $this->db->select('*')
                    ->from('users')
                    ->get()
                    ->result();
                 
        
    }
    function getOneUser($id){
            return $this->db->select('name, nickname, email, phone')
                    ->from('users')
                    ->where('ID',$id)
                    ->get()
                    ->row();
                 
        
    }
    function bringObras(){
            return $this->db->select('O.ID ,O.cc , O.name, OB.name as nameType, O.dateSave, O.status')
                    ->from('obras O')
                    ->join('obras_type OB','O.Type=OB.ID')
                    ->get()
                    ->result(); 
    }

    function verifyUser($user, $name){
         $consultuser = $this -> db->select('*')
                ->from('users')
                ->where('nickname',$user)
                ->get()
                ->result();

        $consultname = $this -> db->select('*')
                        ->from('users')
                        ->where('name',$name)
                        ->get()
                        ->result();

        if( count($consultname)==0 & count($consultuser)==0){
            return false;
        }else{
            return true;
        }
    }

    function saveUser($obj){
        $opciones = [
            'cost' => 12,
        ];
        $contrasena = password_hash( $obj["contrasena"],PASSWORD_BCRYPT,$opciones);
        $data=array(
            'name'=>$obj["Nombre"]." ".$obj["ApellidoP"]." ".$obj["ApellidoM"],
            'nickname'=>$obj["user"],
            'password'=>$contrasena,
            'phone'=>$obj["telefono"],
            'email' =>$obj["email"],
            'status'=>1,
            'typeUser'=>0
          );
        if($this->db->insert('users', $data)){
            $log = Array(
                'tabla' => 'usuarios',
                'accion' => 'Guardar',
                'direccion_ip' => $this->input->ip_address(),
                'usuario_idusuario' => $this->session->userdata('idUser'),
                'registro_id' => $data['name'],
                'campo' => 'Tabla usuarios',
                'descripcion' => 'Registro de usuario para ingresar al sistema'
            ); 
            $this->db->insert('eventos_log', $log);
            return true;
        }else{
            return false;
        }
    }

    function deleteUser($id){
        $data=array(
            'status'=> 0
          );
        $this->db->set($data)->where('ID',$id)->update('users');
        /* $this->db->delete('users',$data); */
        $rows = $this->db->affected_rows();
        if ($rows>0) {
            return true;
        } else {
            return false;
        } 
    }

    function bringUserEdit($id){
       return $this->db->select('*')
                ->from('users')
                ->where('ID',$id)
                ->get()
                ->row();
        
    }

    function updateUser($obj){
        $user = $this->getOneUser($obj["id"]);
        $data=array(
            'name'=>$obj["Nombre"],
            'nickname'=>$obj["user"],
            'phone'=>$obj["telefono"],
            'email' =>$obj["email"]
        );
        $us = array(
            'name'=>$user->name,
            'nickname'=>$user->nickname,
            'phone'=>$user->phone,
            'email' =>$user->email
        );
         if($data  == $us){
             return 0;
        }else{
            $this->db->set($data)->where('ID',$obj["id"])->update('users');
            $rows = $this->db->affected_rows();
          if($rows == 1){
              return 1;
          }else{
              return 2;
          }
        }  
    }

    function bringObraEdit($id){
        return $this->db->select('*')
        ->from('obras')
        ->where('ID',$id)
        ->get()
        ->row();
    }

    function verifyObra($cc, $nombre){
        $data = $this->db->select('cc')
                ->from('obras')
                ->where('cc',$cc)
                ->get()
                ->row();
        $data2 = $this->db->select('cc')
                ->from('obras')
                ->where('name',$nombre)
                ->get()
                ->row();

        if($data == null && $data2 == null){
            return true;
        }else{
            return false;
        }
        
    }
    function saveObra($data){
        $datos = array(
            'cc' => $data["codigoObra"],
            'name' => $data["nombreObra"],
            'type' => $data["tipoObra"],
            'status' =>1
        );
        if($this->db->insert('obras', $datos)){
            return true;
        }else{
            return false;
        }
        
        
    }

    function tiposObtras(){
        return $this->db->select('*')
                ->from('obras_type')
                ->order_by('name','ASC')
                ->get()
                ->result();
    }

    function deleteObra($id){
        $data=array(
            'status'=> 0
          );
        $this->db->set($data)->where('ID',$id)->update('obras');
        $rows = $this->db->affected_rows();
        if ($rows>0) {
            return true;
        } else {
            return false;
        } 
    }

/*     function nameObraVerify($nombre){
        return $this->db->select('name')
                ->from('obras')
                ->where('name',$nombre)
                ->where('status',1)
                ->get()
                ->row();
        
    } */

    function updateObra($obj){
        $obra = $this->bringObraEdit($obj["id"]);

        $ob =  array(
            'name' => $obra->name,
            'type' => $obra->type
        );
        $data=array(
            'name'=>$obj["nombreObraEdit"],
            'type'=>$obj["tipoObraEdit"]
          );

        
          if($ob == $data){
            return 0;
          }else{
          $this->db->set($data)->where('ID',$obj["id"])->update('obras');
          $rows = $this->db->affected_rows();
        if($rows == 1){
            return 1;
        }else{
            return 2;
        }
        }
    }

    /* This is the section for autocomplete functions*/
    
    function search_name_user(){
         return $this->db->select('*')
                ->from('users')
                ->get()
                ->result();
    }

    function search_obra(){
        return $this->db->select('*')
                    ->from('obras')
                    ->get()
                    ->result();
        
    }

    /*This is the section for filters functions*/
    function getAllUsers($start,$length,$array_like,$array_where){
        $result['data'] = $this->db->select('*')
                        ->from('users')
                        ->like($array_like, 'after')
                        ->where($array_where)
                        ->limit($length,$start)
                        ->get()
                        ->result();
        $result['total']=$this->db->select("count(1) as total")
                        ->from('users')
                        ->like($array_like)
                        ->where($array_where)
                        ->get()
                        ->row();  
        return $result;
        
    }
    
    function getAllObras($start,$length,$array_like,$array_where){
        $result['data'] = $this->db->select('*')
                        ->from('obras')
                        ->like($array_like, 'after')
                        ->where($array_where)
                        ->limit($length,$start)
                        ->get()
                        ->result();
        $result['total']=$this->db->select("count(1) as total")
                        ->from('obras')
                        ->like($array_like)
                        ->where($array_where)
                        ->get()
                        ->row();  
        return $result;
        
    }
}

/* End of file M_Administration.php */
