<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tblCatalogoCuentas_model extends CI_Model {

	public function getCatalogo($estado){
		$this->db->where("cEstado",$estado);
		$resultados = $this->db->get("tblCatalogoCuentas");
		return $resultados->result();
	}

	public function save($data){
		return $this->db->insert("tblCatalogoCuentas",$data);
	}
	public function obteberEditado($id){
		$this->db->select("cCodigoCuenta,cEstado,cNombreCuenta");
		$this->db->where("cCodigoCuenta",$id);
		$resultado = $this->db->get("tblCatalogoCuentas");
		return $resultado->row();

	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("categorias",$data);
	}
}
