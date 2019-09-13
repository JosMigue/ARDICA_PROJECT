<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Files extends CI_Model {
    public function BringFiles(){
        return $this->db->select('*')
                ->from('files')
                ->get()
                ->result();
        
    }
}