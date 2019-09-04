<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Administration extends CI_Model {

    function bringUser(){
/*        $data['users']= $this->db->select('U.name,P.name as nom')
                 ->from('users U')
                 ->join('porfile P','U.ID = P.idUser')
                 ->where('status',1)
                 ->get() en caso de que la consulta solo sea de una fila, entonces se sustituye por row
                 ->result();
                 return $data; */
            return $this->db->select('*')
                    ->from('users')
                    ->where('status',1)
                    ->get()
                    ->result();
                 
        
    }
    function bringObras(){
            return $this->db->select('O.ID ,O.cc , O.name, OB.name as nameType, O.dateSave')
                    ->from('obras O')
                    ->join('obras_type OB','O.Type=OB.ID')
                    ->where('O.status',1)
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
        $data=array(
            'name'=>$obj["Nombre"],
            'nickname'=>$obj["user"],
            'phone'=>$obj["telefono"],
            'email' =>$obj["email"]
          );
          $this->db->set($data)->where('ID',$obj["id"])->update('users');
          $rows = $this->db->affected_rows();
        if($rows == 1){
            return true;
        }else{
            return false;
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

    function updateObra($obj){
        $data=array(
            'name'=>$obj["nombreObraEdit"],
            'type'=>$obj["tipoObraEdit"]
          );
          $this->db->set($data)->where('ID',$obj["id"])->update('obras');
          $rows = $this->db->affected_rows();
        if($rows == 1){
            return true;
        }else{
            return false;
        }
    }
}

/* End of file M_Administration.php */
