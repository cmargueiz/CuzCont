<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class otrosdocumentos_model extends CI_Model {

	

	public function EliminarCD( $num,$control,$item){
        
        $query="DELETE from cuerpodocumento where identificador='".$item."'";
		 //$resultados = $this->db->query( $query );
        
        return $this->db->query( $query );
	
	}
	public function EliminarPC( $num,$control,$item){
        
        $query="DELETE from tblpartidacontable where numControl='".$num."'";
		 //$resultados = $this->db->query( $query );
        
        return $this->db->query( $query );
	
	}

}