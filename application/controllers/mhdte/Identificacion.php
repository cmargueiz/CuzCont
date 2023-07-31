<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class identificacion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "mhdte/Identificacion_model" );

    }

    public function index() {
        $data  = array(
            'productos' => $this->Productos_model->getProductos(),
        );
        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "admin/productos/list", $data );
        $this->load->view( "layouts/footer" );

    }

    public function add() {
        $data = array(
            "categorias" => $this->Categorias_model->getCategorias()
        );
        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "admin/productos/add", $data );
        $this->load->view( "layouts/footer" );
    }

    public function store() {
        $codigo = $this->input->post( "codigo" );

        $version = $this->input->post( "item1" );
        $ambDestino = $this->input->post( "item2" );
        $tipoDoc = $this->input->post( "item3" );
        $numeroControl = $this->input->post( "item4" );
        $codigoGeneracion = $this->input->post( "item5" );
        $modFacturacion = $this->input->post( "item6" );
        $tipTransmicion = $this->input->post( "item7" );
        $tipContingencia = $this->input->post( "item8" );
        $motContingencia = $this->input->post( "item9" );
        $fecha = $this->input->post( "item10" );
        $hora = $this->input->post( "item11" );
        $tipMoneda = $this->input->post( "item12" );

        $data  = array(
            'version'=>$version,
            'ambDestino'=>$ambDestino,
            'tipoDoc'=>$tipoDoc,
            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'modFacturacion'=>$modFacturacion,
            'tipTransmicion'=>$tipTransmicion,
            'tipContingencia'=>$tipContingencia,
            'motContingencia'=>$motContingencia,
            'fecha'=>$fecha,
            'hora'=>$hora,
            'tipMoneda'=>$tipMoneda
        );

        if ( $this->Identificacion_model->save( $data ) ) {
            redirect( base_url()."mantenimiento/productos" );
        } else {
            $this->session->set_flashdata( "error", "No se pudo guardar la informacion" );
            redirect( base_url()."mantenimiento/productos/add" );
        }
    }
    

    public function edit( $id ) {
        $data = array(
            "producto" => $this->Productos_model->getProducto( $id ),
            "categorias" => $this->Categorias_model->getCategorias()
        );
        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "admin/productos/edit", $data );
        $this->load->view( "layouts/footer" );
    }

    public function update() {
        $idproducto = $this->input->post( "idproducto" );
        $codigo = $this->input->post( "codigo" );
        $nombre = $this->input->post( "nombre" );
        $descripcion = $this->input->post( "descripcion" );
        $precio = $this->input->post( "precio" );
        $stock = $this->input->post( "stock" );
        $categoria = $this->input->post( "categoria" );
        $data  = array(
            'codigo' => $codigo,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'categoria_id' => $categoria,
        );
        if ( $this->Productos_model->update( $idproducto, $data ) ) {
            redirect( base_url()."mantenimiento/productos" );
        } else {
            $this->session->set_flashdata( "error", "No se pudo guardar la informacion" );
            redirect( base_url()."mantenimiento/productos/edit/".$idproducto );
        }
    }

    public function delete( $id ) {
        $data  = array(
            'estado' => "0",
        );
        $this->Productos_model->update( $id, $data );
        echo "mantenimiento/productos";
    }

  
    
}