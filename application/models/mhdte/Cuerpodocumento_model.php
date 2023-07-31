<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cuerpodocumento_model extends CI_Model {

	public function getProductos(){
		$this->db->select("p.*,c.nombre as categoria");
		$this->db->from("productos p");
		$this->db->join("categorias c","p.categoria_id = c.id");
		$this->db->where("p.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}
    
	public function getParaResumen($numeroControl,$codigoGeneracion){
        $this->db->select("item,identificador,unidadMedida,descripcion,precioUnitario,cantidad,ventasGravadas subtotal,ivaItem,ivaRetenido,ivaPercibido,observacionesItem, JSON_EXTRACT(observacionesItems,  '$.rentaMenos') retencionRenta, JSON_EXTRACT(observacionesItems,  '$.ivaRetenido') ivaRetenido");
		$this->db->where("numeroControl",$numeroControl);
		$this->db->where("codigoGeneracion",$codigoGeneracion);
		$resultados = $this->db->get("cuerpodocumento");
		return $resultados->result();
	}
    public function getParaResumenExp($numeroControl,$codigoGeneracion){
        $this->db->select("item,identificador,unidadMedida,descripcion,precioUnitario,cantidad,ventasGravadas subtotal,ivaItem,ivaRetenido,ivaPercibido,observacionesItem,observacionesItems,JSON_EXTRACT(sacosEsp,  '$.Qesp') Qesp,
JSON_EXTRACT(sacosEsp,  '$.sacos') sacos, JSON_EXTRACT(sacosEsp,  '$.contrato') contrato, '' retencionRenta");
		$this->db->where("numeroControl",$numeroControl);
		$this->db->where("codigoGeneracion",$codigoGeneracion);
		$resultados = $this->db->get("cuerpodocumento");
		return $resultados->result();
	}
    
    public function getImpuestos(){
      
        $this->db->from("tblimpuestosvariables");
        $this->db->order_by('estado','ASC');
        $resultados = $this->db->get();
		return $resultados->result();
	}
    
    
    
    
	public function save($data){
		return $this->db->insert("cuerpodocumento",$data);
	}

	public function update($num,$cod,$data){
		$this->db->where("numeroControl",$num);
		$this->db->where("codigoGeneracion",$cod);
		return $this->db->update("cuerpodocumento",$data);
	}

    
    
}