<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class m_PettyCash extends CI_Model {

function savePettyCash($pettyCash){
        $exist = $this->db->select('numero')
                ->from('caja_chica')
                ->where('numero',$pettyCash["numeroCajaChica"].'-'.date("Y"))
                ->get()
                ->row();
        if($exist == null || $exist == ''){
                $data = array(
                        'numero' => $pettyCash["numeroCajaChica"].'-'.date("Y"),
                        'ubicacion' => $pettyCash["localizacionCajaChica"],
                        'tipo_deducible' => $pettyCash["fechaInicio"],
                        'fecha ' => $pettyCash["fechaTermina"],
                        'tipo_deducible' => $pettyCash["deducibleCajaChica"],
                        'concepto' => $pettyCash["conceptoCajaChica"],
                        'encargado' => $pettyCash["responsableCajaChica"],
                        'equipo' => $pettyCash["equipoCajachica"],
                        'autorizada' => 0
                        
                );
                if($this->db->insert('caja_chica', $data)){
                        return 1;
                }else{
                        return 2;
                }
                
        }else{
                return 3;
        };
        
}

function getlocations(){
        return $this->db->select('*')
                ->from('obras')
                ->order_by('name','ASC')
                ->get()
                ->result();
    }



function getDeductibles(){
        return $this->db->select('*')
                ->from('tipos_deducible')
                ->order_by('nombre','ASC')
                ->get()
                ->result();
}



function getConcepts(){
        return $this->db->select('*')
                ->from('conceptos_caja_chica')
                ->order_by('nombre','ASC')
                ->get()
                ->result();
}



function getallResponsables(){
        return $this->db->select('*')
                ->from('users')
                ->order_by('name','ASC')
                ->get()
                ->result();
}



function getTeams(){
        return $this->db->select('*')
                ->from('equipo')
                ->order_by('nombre','ASC')
                ->get()
                ->result();
}

}

