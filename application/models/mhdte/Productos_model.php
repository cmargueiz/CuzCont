<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Productos_model extends CI_Model {

    public function listaProductos( $area, $estado ) {
        // $this->db->like( 'codigo', $estado, 'after' );

        $this->db->from( "Productos" );
        $this->db->like( 'codigo', $estado, 'after' );
        $this->db->where( "area", $area );

        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function listaServicioGen($area, $estado ) {
        $this->db->from( "Productos" );
        $this->db->like( 'codigo', $estado,'after' );
        $this->db->where( "area", $area );
        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function item153() {
        $this->db->from( "cat016" );
        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function item154() {
        $this->db->from( "cat017" );
        $resultados = $this->db->get();
        return $resultados->result();
    }
    public function item83() {
        $this->db->from( "cat014" );
        $resultados = $this->db->get();
        return $resultados->result();
    } 
    public function regFiscal() {
        $this->db->from( "cat027" );
        $resultados = $this->db->get();
        return $resultados->result();
    }
}