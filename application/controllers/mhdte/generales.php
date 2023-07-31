<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class generales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "mhdte/productos_model" );
        $this->load->model( "mhdte/integracion_model" );

    }

    public function listaProducto() {
        
         $codigo = $this->input->post( "codigo" );
         $area = $this->input->post( "area" );
        
        
        $response=$this->productos_model->listaProductos($area,$codigo);
        echo  json_encode($response);
       

    }
    
      public function listaServicioGen() {
        
        $codigo = $this->input->post( "codigo" );
        
        $area = $this->session->userdata( "areafact");
        
        $response=$this->productos_model->listaServicioGen($area,$codigo);
        echo  json_encode($response);
       

    }    
    public function item153() {
        
        $response=$this->productos_model->item153();
        echo  json_encode($response);
       

    }  
    public function item154() {
        
        $response=$this->productos_model->item154();
        echo  json_encode($response);
       

    }
    public function item83() {
        
        $response=$this->productos_model->item83();
        echo  json_encode($response);
       

    } 
    public function regFiscal() {
        
        $response=$this->productos_model->regFiscal();
        echo  json_encode($response);
       

    }
    
    public function consultaPartida() {
        
       $numeroControl = $this->input->post( "numeroControl" );
        
        $codigoGeneracion = $this->input->post("codigoGeneracion");
        
        $response=$this->integracion_model->consultaPartida($numeroControl,$codigoGeneracion);
        echo  json_encode($response);
       

    }  
    public function partConta(){
        
$numeroControl=$this->input->post( "numeroControl" );
$codigoGeneracion=$this->input->post( "codigoGeneracion" );
$cuentaContable=$this->input->post( "cuentaContable" );
$debehaber=$this->input->post( "debehaber" );
$monto=$this->input->post( "monto" );
$descripcion=$this->input->post( "descripcion" );
          
        
         $data  = array(

            'numControlFact'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'cuentaContable'=>$cuentaContable,
            'debeHaber'=>$debehaber,
            'monto'=>$monto ,          
            'descripcion'=>$descripcion           

        );
        
    
        
        if ( $this->integracion_model->savePartida($data) ) {
          
            echo json_encode( $data );
        } else {

            $data  = array(
                'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        } 
    }
    
    
}