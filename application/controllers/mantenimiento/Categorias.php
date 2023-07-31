<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function __construct(){
		
		parent::__construct();
		if (!$this->session->userdata("nombre")) {
						redirect(base_url());

		}
		$this->load->model("tblCatalogoCuentas_model");
		$this->load->model("tblNivelCuenta_model");
		$this->load->model("tblClasificacionCuenta_model");
		$this->load->model("tblPeriodo_model");
	}

	
	public function index(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/CuentasNuevas");
		$this->load->view("layouts/footer");

	}
	public function niveles(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/Niveles");
		$this->load->view("layouts/footer");

	}
	public function periodo(){

		$this->load->view("layouts/header");
		$this->load->view("layouts/aside");
		$this->load->view("admin/categorias/Periodo");
		$this->load->view("layouts/footer");

	}
	
	public function store(){
		
		$data  = array(
			'cTipocuenta'  => $this->input->post("tipocuenta"),
			'cNombrecuenta'  => $this->input->post("nombrecuenta"),
			'cNumcuenta'  => $this->input->post("numcuenta"),
			'cNivelcuenta'  => $this->input->post("nivelcuenta"),
			'cClasificacioncuenta'  =>$this->input->post("clascuenta"),
			'cCargoSumaResta'  => $this->input->post("sumaresta"),
			'cEstado'  => $this->input->post("estado"),
		);

		if ($this->tblCatalogoCuentas_model->save($data)) {
			//redirect(base_url()."mantenimiento/categorias");
			$datos[0]="OK";
			echo json_encode($datos);
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			//redirect(base_url()."mantenimiento/categorias/add");
		}
	}

	public function update(){
		$idCuenta= $this->input->post("ecodigo");
		$nombre = $this->input->post("enombrecuenta");
		$estado = $this->input->post("eestado");

		$data = array(
			'nombre' => $nombre, 
			'descripcion' => $descripcion,
		);

		if ($this->Categorias_model->update($idCategoria,$data)) {
			redirect(base_url()."mantenimiento/categorias");
		}
		else{
			$this->session->set_flashdata("error","No se pudo actualizar la informacion");
			redirect(base_url()."mantenimiento/categorias/edit/".$idCategoria);
		}
	}

	public function delete($id){
		$data  = array(
			'estado' => "0", 
		);
		$this->Categorias_model->update($id,$data);
		echo "mantenimiento/categorias";
	}

	public function listacuenta(){

		$estado=$this->input->post("estado");
		$response=$this->tblCatalogoCuentas_model->getCatalogo($estado);
		$datos=array();
		for($i=0;$i<count($response);$i++){
            
            $datos[$i]["codigocuenta"]=$response[$i]->cCodigoCuenta;
            $datos[$i]["nombre"]=$response[$i]->cNombreCuenta;
			$datos[$i]["numcuenta"]=$response[$i]->cNumCuenta;
			$datos[$i]["nivel"]=$response[$i]->cNivelCuenta;
			$datos[$i]["tipo"]=$response[$i]->cTipoCuenta;
			$datos[$i]["clasificacion"]=$response[$i]->cClasificacionCuenta;
			$datos[$i]["cuentapadre"]=$response[$i]->cCuentaPadre;
            $datos[$i]["link"]='<button class="btn btn-sm btn-danger" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash" onclick="eliminar('.$response[$i]->cCodigoCuenta.')"><i class="fa fa-trash-o"></i></button>
								<button class="btn btn-sm btn-warning" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash" onclick="editar('.$response[$i]->cCodigoCuenta.')"><i class="fa fa-edit"></i></button>
                                ';
        }
		echo  json_encode($datos);
	}

	public function obteberEditado(){
		$id=$this->input->post("editado");
		$response=$this->tblCatalogoCuentas_model->obteberEditado($id);
		echo json_encode($response);

	}

	/*   NIVELES */

	public function agreganivel(){
		$response=$this->tblNivelCuenta_model->getNiveles();
		if ($response) {
			//redirect(base_url()."mantenimiento/categorias");
			$datos[0]="OK";
			echo json_encode($datos);
		}
		else{
			$datos[0]="error, No se pudo guardar la informacion";
			//redirect(base_url()."mantenimiento/categorias/add");
		}
	}


	/*  CLASIFICACION  */
	public function listaclasificacion(){
		$response=$this->tblClasificacionCuenta_model->getlistaclasificacion();
		$datos=array();
		for($i=0;$i<count($response);$i++){
            
            $datos[$i]["codigo"]=$response[$i]->cCodigo;
            $datos[$i]["nombre"]=$response[$i]->cClasificacion;
			$datos[$i]["orden"]=$response[$i]->cOrden;
			
            $datos[$i]["link"]='<button class="btn btn-sm btn-danger" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash" onclick="eliminar('.$response[$i]->cCodigo.')"><i class="fa fa-trash-o"></i></button>
								<button class="btn btn-sm btn-warning" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash" onclick="eliminar('.$response[$i]->cCodigo.')"><i class="fa fa-edit"></i></button>
                                ';
        }
		echo  json_encode($datos);
	}
	public function guardarClasificacion(){
		
		$data  = array(
			'cClasificacion'  =>strtoupper($this->input->post("nombre")),
			'cOrden'  => $this->input->post("orden"),
			);
			$response=$this->tblClasificacionCuenta_model->save($data,$this->input->post("orden"));
		if ($response) {
			//redirect(base_url()."mantenimiento/categorias");
			$datos[0]=$response["Respuesta"];
			echo json_encode($datos);
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			//redirect(base_url()."mantenimiento/categorias/add");
		}
	}

	/*  Periodo  */
	public function listaPeriodos(){
	$response=$this->tblPeriodo_model->getPeriodos();
	$datos=array();
	for($i=0;$i<count($response);$i++){
		
		$datos[$i]["codigo"]=$response[$i]->cPeriodo;
		$datos[$i]["anio"]=$response[$i]->cAnio;
		$datos[$i]["fechaini"]=$response[$i]->cFechaIni;
		$datos[$i]["fechafin"]=$response[$i]->cFechaFin;
		$datos[$i]["estado"]=$response[$i]->cEstado;
		
		$datos[$i]["link"]='<button class="btn btn-sm btn-danger" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash" onclick="eliminar('.$response[$i]->cPeriodo.')"><i class="fa fa-trash-o"></i></button>
							<button class="btn btn-sm btn-warning" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash" onclick="editar('.$response[$i]->cPeriodo.')"><i class="fa fa-edit"></i></button>
							';
	}
	echo  json_encode($datos);
	}
	public function guardarPeriodo(){
		$fechaEntera = strtotime($this->input->post("fecha1"));
		$anio = date("Y", $fechaEntera);
		$data  = array(
			'cFechaIni'  =>$this->input->post("fecha1"),
			'cFechaFin'  => $this->input->post("fecha2"),
			'cAnio'=>$anio,
			'cEstado'=>'1'
			);
			
			$response=$this->tblPeriodo_model->save($data,$anio);
		if ($response) {
			//redirect(base_url()."mantenimiento/categorias");
			$datos[0]=$response["Respuesta"];
			echo json_encode($datos);
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			//redirect(base_url()."mantenimiento/categorias/add");
		}
	}
	public function borrarPeriodo(){
		$idBorrar = $this->input->post("borrar");
		$response=$this->tblPeriodo_model->delete($idBorrar);
		if (isset($response)) {
			//redirect(base_url()."mantenimiento/categorias");
			$datos[0]="Eliminado Correctamente";
			echo json_encode($datos);
		}
		else{
			$this->session->set_flashdata("error","No se pudo Eliminar la informacion");
			//redirect(base_url()."mantenimiento/categorias/add");
		}
	}
	public function editarPeriodo(){
		$fechaEntera = strtotime($this->input->post("fecha1"));
		$estado=$this->input->post("estado");
		$id=$this->input->post("editar");
		$anio = date("Y", $fechaEntera);
		$data  = array(
			'cFechaIni'  =>$this->input->post("fecha1"),
			'cFechaFin'  => $this->input->post("fecha2"),
			'cAnio'=>$anio,
			'cEstado'=>$estado
			);
			
			$response=$this->tblPeriodo_model->update($data,$id);
		if ($response) {
			//redirect(base_url()."mantenimiento/categorias");
			$datos[0]=$response;
			echo json_encode($datos);
		}
		else{
			$this->session->set_flashdata("error","No se pudo guardar la informacion");
			//redirect(base_url()."mantenimiento/categorias/add");
		}
	}
	public function traePeriodo(){
		$id=$this->input->post("editar");
		$response=$this->tblPeriodo_model->getPeriodo($id);
		echo json_encode($response);
	}


}
