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
                    ->get()
                    ->result();
                 
        
    }



}

/* End of file M_Administration.php */
