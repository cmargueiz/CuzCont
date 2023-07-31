<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Identificacion_model extends CI_Model {


    public function save($data){
		return $this->db->insert("identificacion",$data);
	}
    public function save2($data){
		return $this->db->insert("receptordocumen",$data);
	}
    public function corelativo($anio){
        $this->db->select("(numeroControl)");
		$this->db->where("fechanio",$anio);
		$resultado = $this->db->get("controlcodigos");
		return $resultado->row();
	}
    
   public function corelativoUpdate($anio,$data){
		$this->db->where("fechanio",$anio);
		return $this->db->update("controlcodigos",$data);
	}
      
    /**        consultas    **/
   public function verificarComRete($numeroControl, $codigoGeneracion){
       
       
    //  $this->db->where("numeroControl",$numeroControl);
		$this->db->where("numDocRelacion",$codigoGeneracion);
        $resultados = $this->db->get("docrelacionados");
		return $resultados->result();
       
   } 
    public function verificarComReteCD($numeroControl, $codigoGeneracion){
       
       
    //  $this->db->where("numeroControl",$numeroControl);
		$this->db->where("numDocRelacion",$codigoGeneracion);
        $resultados = $this->db->get("cuerpodocumento");
		return $resultados->result();
       
   }
   
}