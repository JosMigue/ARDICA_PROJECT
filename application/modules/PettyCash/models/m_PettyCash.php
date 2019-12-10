<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class m_PettyCash extends CI_Model {


function getLastNumerOfUser(){
        $result = $this->db->select('count(caja_consecutiva) as contar')
                                        ->from('consecutivo_cajas')
                                        ->where('ano', date("Y"))
                                        ->where('Usuario',$this->session->userdata('idUser'))
                                        ->get()
                                        ->row();
        return $result;                        
        
}


function savePettyCash($pettyCash){
        $numero =  $this->getLastNumerOfUser();
        if($numero->contar > 0 || $numero->contar < 10){
                $numeroCaja = '0'.($numero->contar+1); 
                $numeroContar = $numero->contar+1;
        }else if($numero->contar>10){
                $numeroCaja = $numero+1;
                $numeroContar = $numero->contar+1;
        }else if($numero->contar == 0){
                $numeroCaja = '01';
                $numeroContar =  1;
        }
        $data = array(
                'numero' => $numeroCaja.'-'.date("Y"),
                'fecha_inicio' => $pettyCash["fechaInicio"],
                'encargado' => $this->session->userdata('idUser'),
                'autorizada' => 0
                       
        );
        if($this->db->insert('caja_chica', $data)){
                $dataConsecutive = array('caja_consecutiva' => $numeroContar, 'numero_caja' => $numeroCaja.'-'.date("Y"), 'Usuario' => $this->session->userdata('idUser'), 'ano' => date("Y"));
                $this->db->insert('consecutivo_cajas', $dataConsecutive);
                return 1;
        }else{
                return 2;
        }
        

}
function saveDetailPettyCash($detail,$user){
                if($detail["deducibleCajaChica"] == 1){
                        $sub = floatval($detail["subtotalCajaChica"]);
                        $iva = ($sub*IVA);
                        $total = $sub + $iva;
                }else{
                        $sub = floatval($detail["subtotalCajaChica"]);
                        $iva = 0.00;
                        $total = $sub + $iva;
                }
                $data = array(
                        'caja_chica_ID' => $detail["numeroCajaChica"],
                        'ubicacion' => $detail["localizacionCajaChica"],
                        'deducible' => $detail["deducibleCajaChica"],
                        'concepto' => $detail["conceptoCajaChica"],
                        'subtotal' => $detail["subtotalCajaChica"],
                        'IVA' => $iva,
                        'total' => $total,
                        'equipo' => $detail["equipoCajachica"],
                        'observaciones' => $detail["observacion"],
                        'capturadorGasto' => $user
                        
                );
                if($this->db->insert('detalle_caja_chica', $data)){
                        return 1;
                }else{
                        return 2;
                }
}


function updateDetailPettyCash($detail){
        $detail2 = $this->db->select('*')
                        ->from('detalle_caja_chica')
                        ->where('ID',$detail["idDetalle"])
                        ->get()
                        ->row();

        
        if($detail["deducibleCajaChicaEdit"] == 1){
                $sub = floatval($detail["subtotalCajaChicaEdit"]);
                $iva = ($sub*IVA);
                $total = $sub + $iva;
        }else{
                $sub = floatval($detail["subtotalCajaChicaEdit"]);
                $iva = 0.00;
                $total = $sub + $iva;
        }

        $us = array(
                'ubicacion' => $detail2->ubicacion,
                'deducible' => $detail2->deducible,
                'concepto' => $detail2->concepto,
                'subtotal' => $detail2->subtotal,
                'IVA' => $detail2->IVA,
                'total' => $detail2->total,
                'equipo' => $detail2->equipo,
                'observaciones' => $detail2->observaciones
        );

        $data = array(
                'ubicacion' => $detail["ubicacionCajaChicaEdit"],
                'deducible' => $detail["deducibleCajaChicaEdit"],
                'concepto' => $detail["conceptoCajaChicaEdit"],
                'subtotal' => $detail["subtotalCajaChicaEdit"],
                'IVA' => $iva,
                'total' => $total,
                'equipo' => $detail["equipoCajaChicaEdit"],
                'observaciones' => $detail["observacion"]
                        
        );
        if($us != $data){
                if($this->db->set($data)->where('ID',$detail["idDetalle"])->update('detalle_caja_chica')){
                        return 1;
                }else{
                        return 2;
                }
        }else{
                return 3;
        }
}

function disablePettyCash($id){
        $data=array(
                'estado_caja'=> 0,
                'fecha_terminacion' => date("Y")."-". date("m")."-".date("d")
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
                'estado_caja'=> 1,
                'fecha_terminacion' => '0000-00-00'
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

function deleteDetailPettyCash($id){
        if($this->db->where('ID',$id)->delete('detalle_caja_chica')){
                return 1;
        }else{
                return 2;
        }
        
}

function authorizePersonal($idPettyCash, $UserOwner, $userAuthorized){
        $data =  array(
                'ID_User_Owner' => $UserOwner,
                'ID_User_Authorized' => $userAuthorized,
                'ID_PettyCash' => $idPettyCash
        );
        $compare = $this->db->select('ID_PettyCash')->from('authorizeduserspettycash')->where('ID_User_Authorized', $userAuthorized)->where('ID_PettyCash',$idPettyCash)->get()->result();
        if(count($compare) == 0){
                if($this->db->insert('authorizeduserspettycash', $data))
                {
                        return true;
                }else{
                        return false;
                }
        }else{
                return 'duplicate';
        }
        
}

function plusAll($number){
        $response['total'] = $this->db->select('sum(subtotal) as subtotal,sum(IVA) as iva, sum(total) as total')
                                        ->from('detalle_caja_chica')
                                        ->where('caja_chica_ID',$number)
                                        ->get()
                                        ->row();
        
        $response['totalDeducible'] = $this->db->select('sum(subtotal) as subtotal, sum(total) as total')
                                        ->from('detalle_caja_chica')
                                        ->where('deducible',1)
                                        ->where('caja_chica_ID',$number)
                                        ->get()
                                        ->row();
        $response['totalNoDeducible'] = $this->db->select('sum(subtotal) as subtotal, sum(total) as total')
                                        ->from('detalle_caja_chica')
                                        ->where('deducible',2)
                                        ->where('caja_chica_ID',$number)
                                        ->get()
                                        ->row();
        $response['cajaChica'] = $this->db->select('numero')
                                        ->from('caja_chica')
                                        ->where('ID',$number)
                                        ->get()
                                        ->row();
                                       
        return $response;
        
}

function getPettyCashDetail($id){
        $consult = "SELECT DCC.ID, CC.numero , O.name as ubicacion, E.nombre as equipo, COCA.nombre as concepto, DCC.subtotal, DCC.IVA, DCC.total, TD.nombre as deducible, DCC.observaciones as observacion, DCC.fecha_registro as registro, U.name as capturadorGasto
        FROM detalle_caja_chica DCC 
        JOIN obras O ON O.ID = DCC.ubicacion 
        JOIN conceptos_caja_chica COCA ON COCA.ID = DCC.concepto 
        JOIN tipos_deducible TD ON DCC.deducible = TD.ID 
        JOIN equipo  E ON E.ID = DCC.equipo 
        JOIN caja_chica CC ON CC.ID = DCC.caja_chica_ID
        JOIN users U ON U.ID = DCC.capturadorGasto 
        WHERE DCC.caja_chica_ID = ?";                

        $result['suma'] = $this->plusAll($id);

        $result['data'] = $this->db->query($consult,$id)->result();
        
        return $result;
}

function getPettyCashDetailAuthorized($id){
        $consult = "SELECT DCC.ID, CC.numero , O.name as ubicacion, E.nombre as equipo, COCA.nombre as concepto, DCC.subtotal, DCC.IVA, DCC.total, TD.nombre as deducible, DCC.observaciones as observacion, DCC.fecha_registro as registro, U.name as capturadorGasto
        FROM detalle_caja_chica DCC 
        JOIN obras O ON O.ID = DCC.ubicacion 
        JOIN conceptos_caja_chica COCA ON COCA.ID = DCC.concepto 
        JOIN tipos_deducible TD ON DCC.deducible = TD.ID 
        JOIN equipo  E ON E.ID = DCC.equipo 
        JOIN caja_chica CC ON CC.ID = DCC.caja_chica_ID 
        JOIN users U ON U.ID = DCC.capturadorGasto
        WHERE DCC.caja_chica_ID = ?";                

        $result['suma'] = $this->plusAll($id);

        $result['data'] = $this->db->query($consult,$id)->result();
        
        return $result;
}

function bringPettyCashData($id){
        return $this->db->select('*')
                        ->from('detalle_caja_chica')
                        ->where('ID',$id)
                        ->get()
                        ->row();
        
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

function getPettyCash(){
        return $this->db->select('*')
                ->from('caja_chica')
                ->where('encargado',$this->session->userdata('idUser'))
                ->get()
                ->result();
}

function getPettyCashSelect($id){
        return $this->db->select('*')
                        ->from('caja_chica')
                        ->where('encargado',$id)
                        ->get()
                        ->result();
        
}

function getAuthorizedUsers(){
        $query = 'SELECT * FROM users where typeUser = 4 OR typeUser = 2 order by name';
        return $this->db->query($query)->result();
}

function getPettyCashReport($id,$resposable){
        $result['data'] =  $this->db->select('CC.ID, CC.numero, CC.fecha_inicio, CC.fecha_terminacion, U.name as encargado, CC.fecha_registro')
                ->from('caja_chica CC')
                ->join('users U','CC.encargado = U.ID')
                ->where('CC.ID',$id)
                ->get()
                ->result();

                $consult = "SELECT DCC.ID, CC.numero , O.name as ubicacion, E.nombre as equipo, COCA.nombre as concepto, DCC.subtotal, DCC.IVA, DCC.total, TD.nombre as deducible, DCC.observaciones as observacion, DCC.fecha_registro as registro
                FROM detalle_caja_chica DCC 
                JOIN obras O ON O.ID = DCC.ubicacion 
                JOIN conceptos_caja_chica COCA ON COCA.ID = DCC.concepto 
                JOIN tipos_deducible TD ON DCC.deducible = TD.ID 
                JOIN equipo  E ON E.ID = DCC.equipo 
                JOIN caja_chica CC ON CC.ID = DCC.caja_chica_ID 
                WHERE DCC.caja_chica_ID IN (select ID from caja_chica where encargado = ? )";                
        $result['detail'] = $this->db->query($consult,$resposable)->result();                       

        return $result;
}

function getPettyCashTwo(){
        return $this->db->select('*')
                ->from('caja_chica')
                ->where('estado_caja',1)
                ->where('encargado',$this->session->userdata('idUser'))
                ->get()
                ->result();
}

function getAllPettyCash($start,$length,$array_like,$array_where){
        if($this->session->userdata('userType') == 1){
                $result['data'] = $this->db->select('CC.estado_caja as estado, CC.ID, CC.numero, CC.fecha_inicio as fIni, CC.fecha_terminacion as fFin, U.name as encargado, CC.fecha_registro as fRegistro')
                                ->from('caja_chica CC')
                                ->join('users U','U.ID = CC.encargado')
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
        }else if($this->session->userdata('userType') == 2){
                $result['data'] = $this->db->select('CC.estado_caja as estado, CC.ID, CC.numero, CC.fecha_inicio as fIni, CC.fecha_terminacion as fFin, U.name as encargado, CC.fecha_registro as fRegistro')
                                ->from('caja_chica CC')
                                ->join('users U','U.ID = CC.encargado')
                                ->like($array_like, 'after')
                                ->where('CC.encargado',$this->session->userdata('idUser'))
                                ->where($array_where)
                                ->limit($length,$start)
                                ->get()
                                ->result();
                $result['total']=$this->db->select("count(1) as total")
                                ->from('caja_chica')
                                ->like($array_like)
                                ->where($array_where)
                                ->where('encargado',$this->session->userdata('idUser'))
                                ->get()
                                ->row();  
        }
        return $result;
        
    }

function getAllPettyCashAuthorized($start,$length,$array_like,$array_where){
        if($this->session->userdata('userType') == 4 || $this->session->userdata('userType') == 2 || $this->session->userdata('userType') == 1){
                $query = 'SELECT CC.estado_caja as estado, CC.ID, CC.numero, CC.fecha_inicio as fIni, 
                CC.fecha_terminacion as fFin, U.name as encargado, CC.fecha_registro as fRegistro
                FROM caja_chica CC 
                JOIN Users U ON CC.encargado = U.ID
                JOIN authorizeduserspettycash ACCC ON CC.ID  = ACCC.ID_PettyCash
                WHERE CC.ID IN (SELECT ACC.ID_PettyCash FROM authorizeduserspettycash ACC) AND ACCC.ID_User_Authorized = ? AND CC.estado_caja = 1';

                $result['data'] = $this->db->query($query,$this->session->userdata('idUser'))->result();
                $result['total']=$this->db->select("count(1) as total")
                                ->from('authorizeduserspettycash')
                                ->like($array_like)
                                ->where($array_where)
                                ->where('ID_User_Authorized',$this->session->userdata('idUser'))
                                ->get()
                                ->row(); 
        }
        return $result;
        
    }

function getNumberAutocomplete(){
        return $this->db->select('numero')
                        ->distinct()
                        ->from('caja_chica')
                        ->where('estado_caja',1)
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

function saveConceptOnModal($nombre){
        $data =  array(
                'nombre' => $nombre
        );
        if($this->db->insert('conceptos_caja_chica', $data)){
                $result['id'] = $this->db->insert_id();
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

public function getAuthorizedOPeople($user){
        $result['data']  = $this->db->select('CJ.numero as ID_PettyCash, U.name as ID_User_Authorized, AUPC.date_Time as dateTime')
                ->from('authorizeduserspettycash AUPC')
                ->join('users U','U.ID = AUPC.ID_User_Authorized')
                ->join('caja_chica CJ','CJ.ID = AUPC.ID_PettyCash')
                ->where('AUPC.ID_User_Owner',$user)
                ->get()
                ->result();        
        return $result;
}

public function saveLogActivity($log){
        $this->db->insert('eventos_log', $log);
        }
        
}