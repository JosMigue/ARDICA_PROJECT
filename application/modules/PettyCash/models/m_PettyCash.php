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
                        'fecha_inicio' => $pettyCash["fechaInicio"],
                        'fecha_terminacion' => $pettyCash["fechaTermina"],
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

function disablePettyCash($id){
        $data=array(
                'estado'=> 0
        );
        $this->db->set($data)->where('ID',$id)->update('caja_chica');
        /* $this->db->delete('users',$data); */
        $rows = $this->db->affected_rows();
        if ($rows>0) {
                return true;
        } else {
                return false;
        } 
}        

function enablePettyCash($id){
        $data=array(
                'estado'=> 1
        );
        $this->db->set($data)->where('ID',$id)->update('caja_chica');
        /* $this->db->delete('users',$data); */
        $rows = $this->db->affected_rows();
        if ($rows>0) {
                return true;
        } else {
                return false;
        } 
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
                ->where('estado',1)
                ->get()
                ->result();
}



function getConcepts(){
        return $this->db->select('*')
                ->from('conceptos_caja_chica')
                ->where('estado',1)
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
                ->where('estado',1)
                ->get()
                ->result();
}


function getObresTypes(){
        return $this->db->select('*')
                ->from('obras_type')
                ->where('estado',1)
                ->get()
                ->result();
}

function getAllPettyCash($start,$length,$array_like,$array_where){
        $result['data'] = $this->db->select('CC.estado, CC.ID, CC.numero, O.name as ubicacion, CC.fecha_inicio as fIni, TD.nombre as deducible, CC.fecha_terminacion as fFin, COCA.nombre as concepto, U.name as encargado, E.nombre as equipo, CC.fecha_registro as fRegistro')
                        ->from('caja_chica CC')
                        ->join('obras O', 'O.ID = CC.ubicacion')
                        ->join('conceptos_caja_chica COCA', 'COCA.ID=CC.concepto')
                        ->join('users U','U.ID = CC.encargado')
                        ->join('equipo E','E.ID = CC.equipo')
                        ->join('tipos_deducible TD','CC.tipo_deducible=TD.ID')
                        ->like($array_like, 'after')
                        ->where($array_where)
                        ->limit($length,$start)
                        ->get()
                        ->result();
        $result['total']=$this->db->select("count(1) as total")
                        ->from('caja_chica')
                        ->like($array_like)
                        ->where($array_where)
                        ->get()
                        ->row();  
        return $result;
        
    }

function getNumberAutocomplete(){
        return $this->db->select('numero')
                        ->from('caja_chica')
                        ->where('estado',1)
                        ->get()
                        ->result();
}

function saveDeductible($nombre){
        $data =  array(
                'nombre' => $nombre
        );
        if($this->db->insert('tipos_deducible', $data)){
                $result['id'] = $this->db->insert_id();
                $result['nombre'] =$this->db->select('nombre')->from('tipos_deducible')->where('ID',$result['id'])->get()->row();
                return $result;
                
        }else{
                return false;
        }
}

function deleteDeductible($id){
        $data = array(
                'estado' => 0
        );
        $this->db->set($data)->where('ID',$id)->update('tipos_deducible');
        $rows = $this->db->affected_rows();
        if ($rows>0) {
                return true;
        }else{
                return false;
        }
}

function saveConcept($nombre){
        $data =  array(
                'nombre' => $nombre
        );
        if($this->db->insert('conceptos_caja_chica', $data)){
                $result['id'] = $this->db->insert_id();
                $result['nombre'] =$this->db->select('nombre')->from('conceptos_caja_chica')->where('ID',$result['id'])->get()->row();
                return $result;
                
        }else{
                return false;
        }
}

function deleteConcept($id){
        $data = array(
                'estado' => 0
        );
        $this->db->set($data)->where('ID',$id)->update('conceptos_caja_chica');
        $rows = $this->db->affected_rows();
        if ($rows>0) {
                return true;
        }else{
                return false;
        }
}

function saveTeam($nombre){
        $data =  array(
                'nombre' => $nombre
        );
        if($this->db->insert('equipo', $data)){
                $result['id'] = $this->db->insert_id();
                $result['nombre'] =$this->db->select('nombre')->from('equipo')->where('ID',$result['id'])->get()->row();
                return $result;
                
        }else{
                return false;
        }
}

function deleteTeam($id){
        $data = array(
                'estado' => 0
        );
        $this->db->set($data)->where('ID',$id)->update('equipo');
        $rows = $this->db->affected_rows();
        if ($rows>0) {
                return true;
        }else{
                return false;
        }
}

function saveObrasType($nombre){
        $data =  array(
                'name' => $nombre
        );
        if($this->db->insert('obras_type', $data)){
                $result['id'] = $this->db->insert_id();
                $result['nombre'] =$this->db->select('name')->from('obras_type')->where('ID',$result['id'])->get()->row();
                return $result;
                
        }else{
                return false;
        }
}

function deleteObrasType($id){
        $data = array(
                'estado' => 0
        );
        $this->db->set($data)->where('ID',$id)->update('obras_type');
        $rows = $this->db->affected_rows();
        if ($rows>0) {
                return true;
        }else{
                return false;
        }
}


}