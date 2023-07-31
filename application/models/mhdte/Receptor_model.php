<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class receptor_model extends CI_Model {

	public function getreceptor($num,$cod){
         $area = $this->session->userdata( "areafact");
		$this->db->select("p.*, C.*");
		$this->db->from("receptor p");
		$this->db->join("receptordocumen c"," p.codigo =c.idReceptor ");
		$this->db->where("c.numeroControl",$num);
		$this->db->where("c.codigoGeneracion",$cod);
        if($area=="EX"){
             $this->db->where("p.area",$area);
          }else {
           $this->db->where_not_in( "p.area", "EX" );
      }
		
		$resultados = $this->db->get();
		return $resultados->result();
	}
	public function getdatosReceptor($num,$cod){
		$this->db->where("id",$id);
		$resultado = $this->db->get("receptor");
		return $resultado->row();
	}
    
    
	public function save($data){
		return $this->db->insert("receptor",$data);
	}

	public function update($id,$data){
		$this->db->where("id",$id);
		return $this->db->update("receptor",$data);
	}
public function listareceptor($estado,$area){
		//$this->db->where("codigo",$estado);
        $this->db->like('codigo', $estado, 'after'); 
      if($area=="EX"){
               $this->db->where( "area", $area );
          }else {
           $this->db->where_not_in( "area", "EX" );
      }
       
		$resultados = $this->db->get("receptor");
		return $resultados->result();
	}
    
    
    public function getMH($num,$cod){
       // $this->db->where("numeroControl",$num);
		$this->db->where("codigoGeneracion",$cod);
		$resultado = $this->db->get("bitacorafactura");
		return $resultado->result();
        
    }
}