<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class get_cat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "mhdte/get_cat_model" );

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

    public function getCat002() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat002()
        );
       
    }
    public function getCat003() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat003()
        );
       
    }
    public function getCat004() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat004()
        );
       
    }
    public function getCat005() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat005()
        );
       
    }
    public function getCat006() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat006()
        );
       
    }
    public function getCat007() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat007()
        );
       
    }
    public function getCat008() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat008()
        );
       
    }
   public function getCat009() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat009()
        );
       
    }
   public function getCat0010() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat0010()
        );
       
    }
   public function getCat0011() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat0011()
        );
       
    }
   public function getCat0012() {
        $data = array(
            "categorias" => $this->get_cat_model->getCat0012()
        );
       
    }


}