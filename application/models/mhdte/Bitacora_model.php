<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bitacora_model extends CI_Model {


	public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

	public function guardarToken($data){
		return $this->db->insert("bitacora",$data);
	}

	public function obtenerToken($fecha){
		$this->db->select('token');
		$this->db->from('bitacora');
		$this->db->where('fecha', $fecha);
		//$this->db->order_by('fecha', 'DESC');
		$resultados = $this->db->get();
		return $resultados->row();
	}

	public function insertarBitacoraFactura($data){
		return $this->db->insert("bitacoraFactura",$data);
	}

}
