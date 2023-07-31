<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class emisor_model extends CI_Model {

	public function getEmisor(){
		$this->db->select();
		$this->db->from("emisor");
		
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getProducto($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("productos");
		return $resultado->row();
	}
    
    
	public function save($data){
		return $this->db->insert("Identificacion",$data);
	}

	public function update($data){
		//$this->db->where("id",$id);
		return $this->db->update("emisor",$data);
	}

}