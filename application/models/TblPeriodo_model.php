<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tblPeriodo_model extends CI_Model {

	public function getPeriodos(){
		//$this->db->where("cEstado",$estado);
		$this->db->order_by("cEstado","ASC");
		$resultados = $this->db->get("tblPeriodo");
		return $resultados->result();
	}

	public function getPeriodo($id){
		$this->db->where("cPeriodo",$id);
		$resultados = $this->db->get("tblPeriodo");
		return $resultados->result();
	}

	public function save($data,$orden){

	$data  = array(
		'Respuesta'  =>$this->db->insert("tblPeriodo",$data)
		
		);
	return $data ;

		
	}
	public function update($data,$id){
		$this->db->where("cPeriodo",$id);
		return $this->db->update("tblPeriodo",$data);
	}


	public function delete($id){
		$this->db->where("cPeriodo",$id);
		return $this->db->delete("tblPeriodo");
	}
}
