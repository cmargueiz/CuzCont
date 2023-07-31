<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ServiciosGenerales_model extends CI_Model {

	
	public function save($data){
		return $this->db->insert("cuerpodocumento",$data);
	}
    
    public function ListProducto($data){
		$this->db->select("codigo,descripcion,precio,UnidadMedida");
        $this->db->where( "area", $data );
		$this->db->from("productos");
        //$this->db->order_by('estado','ASC');
        $resultados = $this->db->get();
		return $resultados->result();
	}
     public function verificarComRete($numeroControl,$codigoGeneracion){
         $this->db->select("numeroControl,codigoGeneracion,fechaGendoc");
		
		$this->db->where("numDocRelacionado",$codigoGeneracion);
        $resultados = $this->db->get("cuerpodocumento");
		return $resultados->result();
	}
    
    public function getParaResumen($numeroControl,$codigoGeneracion){

		$this->db->where("numeroControl",$numeroControl);
		$this->db->where("codigoGeneracion",$codigoGeneracion);
        $resultados = $this->db->get("resumen");
		return $resultados->result();
	}
    
    public function getParaResumenrete($numeroControl,$codigoGeneracion){

		$this->db->where("numeroControl",$numeroControl);
		$this->db->where("codigoGeneracion",$codigoGeneracion);
        $resultados = $this->db->get("cuerpodocumento");
		return $resultados->result();
	}
    
}