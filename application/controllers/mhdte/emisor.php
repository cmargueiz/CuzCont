<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class emisor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "mhdte/emisor_model" );

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

        $nit = $this->input->post( "item17" );
        $tipoDoc = $this->input->post( "ite18m19" );
        $numdoc = $this->input->post( "item" );
        $ncr = $this->input->post( "item20" );
        $nombre = $this->input->post( "item21" );
        $codactEco = $this->input->post( "item22" );
        $desactEco = $this->input->post( "item23" );
        $nomComercial = $this->input->post( "item24" );
        $tipEstablecimiento = $this->input->post( "item25" );
        $Departamento = $this->input->post( "item26" );
        $Municipio = $this->input->post( "item27" );
        $Direccion = $this->input->post( "item28" );
        $telefono = $this->input->post( "item29" );
        $correo = $this->input->post( "item30" );
        $codEstableMH = $this->input->post( "item31" );
        $codEstable = $this->input->post( "item32" );
        $codPuntoVentaMH = $this->input->post( "item33" );
        $codPuntoVenta = $this->input->post( "item34" );
        $tipoItem = $this->input->post( "item35" );
        $recintoFiscal = $this->input->post( "item36" );
        $regExportacion = $this->input->post( "item37" );

        $data  = array(

            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'nit'=>$nit,
            'tipoDoc'=>$tipoDoc,
            'numdoc'=>$numdoc,
            'ncr'=>$ncr,
            'nombre'=>$nombre,
            'codactEco'=>$codactEco,
            'desactEco'=>$desactEco,
            'nomComercial'=>$nomComercial,
            'tipEstablecimiento'=>$tipEstablecimiento,
            'Departamento'=>$Departamento,
            'Municipio'=>$Municipio,
            'Direccion'=>$Direccion,
            'telefono'=>$telefono,
            'correo'=>$correo,
            'codEstableMH'=>$codEstableMH,
            'codEstable'=>$codEstable,
            'codPuntoVentaMH'=>$codPuntoVentaMH,
            'codPuntoVenta'=>$codPuntoVenta,
            'tipoItem'=>$tipoItem,
            'recintoFiscal'=>$recintoFiscal,
            'regExportacion'=>$regExportacion
        );

        if ( $this->emisor_model->save( $data ) ) {
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