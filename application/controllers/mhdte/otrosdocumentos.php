<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class otrosdocumentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "mhdte/otrosdocumentos_model" );

    }

 
    public function EliminarCD( ) {
        
      $num = $this->input->post( "numeroControl" );
        $control = $this->input->post( "codigoGeneracion" );
       $item = $this->input->post( "item" );
       
       
         if ( $this->otrosdocumentos_model->EliminarCD( $num,$control,$item) ) {
            $data  = array(
                'OK' => '1',
            );
            echo json_encode($data);
        } else {

            $data  = array(
                'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }
     
    }
public function EliminarPC( ) {
        
        $num = $this->input->post( "numeroControl" );
         $control = $this->input->post( "codigoGeneracion" );
         $item = $this->input->post( "item" );
       
       
         if ( $this->otrosdocumentos_model->EliminarPC( $num,$control,$item) ) {
            $data  = array(
                'OK' => '1',
            );
            echo json_encode($data);
        } else {

            $data  = array(
                'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }
     
    }

}