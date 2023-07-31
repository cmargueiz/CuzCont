<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class receptor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "mhdte/receptor_model" );

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

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );

        $tipDoc = $this->input->post( "item38" );
        $numDoc = $this->input->post( "item39" );
        $nit = $this->input->post( "item40" );
        $ncr = $this->input->post( "item41" );
        $NomDenominacion = $this->input->post( "item42" );
        $codActEco = $this->input->post( "item43" );
        $actEco = $this->input->post( "item44" );
        $nomComercial = $this->input->post( "item45" );
        $tipEstablecimiento = $this->input->post( "item46" );
        $Departamento = $this->input->post( "item47" );
        $Municipio = $this->input->post( "item48" );
        $dirComplemento = $this->input->post( "item49" );
        $codPais = $this->input->post( "item50" );
        $paisDestino = $this->input->post( "item51" );
        $domFiscal = $this->input->post( "item52" );
        $codEstable = $this->input->post( "item53" );
        $codPuntoVenta = $this->input->post( "item54" );
        $bienesRemitidos = $this->input->post( "item55" );
        $tipoReceptor = $this->input->post( "item56" );
        $telReceptor = $this->input->post( "item57" );
        $correoReceptor = $this->input->post( "item58" );

        $data  = array(

            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'tipDoc'=>$tipDoc,
            'numDoc'=>$numDoc,
            'nit'=>$nit,
            'ncr'=>$ncr,
            'NomDenominacion'=>$NomDenominacion,
            'codActEco'=>$codActEco,
            'actEco'=>$actEco,
            'nomComercial'=>$nomComercial,
            'tipEstablecimiento'=>$tipEstablecimiento,
            'Departamento'=>$Departamento,
            'Municipio'=>$Municipio,
            'dirComplemento'=>$dirComplemento,
            'codPais'=>$codPais,
            'paisDestino'=>$paisDestino,
            'domFiscal'=>$domFiscal,
            'codEstable'=>$codEstable,
            'codPuntoVenta'=>$codPuntoVenta,
            'bienesRemitidos'=>$bienesRemitidos,
            'tipoReceptor'=>$tipoReceptor,
            'telReceptor'=>$telReceptor,
            'correoReceptor'=>$correoReceptor

        );

        if ( $this->receptor_model->save( $data ) ) {
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

    public function listaBuscarCliente(){
      
        $codigo = $this->input->post( "codigo" );
        $area = $this->session->userdata( "areafact");
        
        $response=$this->receptor_model->listareceptor($codigo,$area);
        echo  json_encode($response);

    }
    
   
}