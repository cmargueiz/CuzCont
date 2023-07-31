<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tblNivelCuenta_model extends CI_Model {

	public function getNiveles(){
		$this->db->select_max('cNnivelCuenta');
		$resultado = $this->db->get("tblNivelCuenta");
		$row = $resultado->row();
		
		if(isset($row))
{
	$data  = array(
			
		'cNnivelCuenta'  =>$row->cNnivelCuenta+1,
	);
    return $this->db->insert("tblNivelCuenta",$data);
}
		
	}
	public function getCliente($id){
		$this->db->where("id",$id);
		$resultado = $this->db->get("clientes");
		return $resultado->row();

	}
	public function save($data){
		return $this->db->insert("clientes",$data);
	}
	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("clientes",$data);
	}
}