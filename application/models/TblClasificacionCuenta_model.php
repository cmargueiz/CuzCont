<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tblClasificacionCuenta_model extends CI_Model {

	public function getlistaclasificacion(){
		//$this->db->where("cEstado",$estado);
		$resultados = $this->db->get("tblClasificacionCuenta");
		return $resultados->result();
	}

	public function save($data,$orden){
$this->db->where("cOrden",$orden);
$resultados = $this->db->get("tblClasificacionCuenta");
$row = $resultados->row();
if(isset($row)){
	$data  = array(
		'Respuesta'  =>"Numero de Orden Ya existe"
		
		);
		return $data;
}
else{
	$data  = array(
		'Respuesta'  =>$this->db->insert("tblClasificacionCuenta",$data)
		
		);
	return $data ;
}
		
	}

	public function getCategoria($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("categorias");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("categorias",$data);
	}
}
