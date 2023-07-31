<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class get_cat_model extends CI_Model {

	public function getCat002(){
		$resultados = $this->db->get("cat002");
		return $resultados->result();
	}
		public function getCat003(){
		$resultados = $this->db->get("cat003");
		return $resultados->result();
	}
		public function getCat004(){
		$resultados = $this->db->get("cat004");
		return $resultados->result();
	}
		public function getCat005(){
		$resultados = $this->db->get("cat005");
		return $resultados->result();
	}
		public function getCat006(){
		$resultados = $this->db->get("cat006");
		return $resultados->result();
	}
		public function getCat007(){
		$resultados = $this->db->get("cat007");
		return $resultados->result();
	}
		public function getCat008(){
		$resultados = $this->db->get("cat008");
		return $resultados->result();
	}
	
    	public function getCat009(){
		$resultados = $this->db->get("cat009");
		return $resultados->result();
	}
	
    	public function getCat0010(){
		$resultados = $this->db->get("cat0010");
		return $resultados->result();
	}
	
    	public function getCat0011(){
		$resultados = $this->db->get("cat0011");
		return $resultados->result();
	}
	
    	public function getCat0012(){
		$resultados = $this->db->get("cat0012");
		return $resultados->result();
	}
	
    
    
	

}