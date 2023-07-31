<?php

use function PHPSTORM_META\type;

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class bitacora extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("mhdte/Bitacora_model");

    }

	public function index(){

		echo "Hola mundo";
	}

    public function store()
    {
		$fecha=date('Y-m-d');
        $data= array(
            'usuario'=>$this->input->post('usuario'),
            'comentario'=>$this->input->post('comentario'),
            'fecha'=>$fecha,//$this->input->post('fecha'),
            'token'=>$this->input->post('token') ?? null,
            'mensaje'=>$this->input->post('mensaje') ?? null,
        );

        $response = $this->Bitacora_model->guardarToken($data);

        if($response) {
			$this->session->set_userdata( "token", $this->input->post('token') );
			
            echo json_encode(array('status'=>true,'message'=>'Token guardado en sesion correctamente'));
        } else {
            echo json_encode(array('status'=>false,'message'=>'Error al guardar el token'));
        }
    }

	public function obtenerToken(){
$fecha=date('Y-m-d');
		$token = $this->Bitacora_model->obtenerToken($fecha);
//echo json_encode(date('Y-m-d'));
		if($token != null){
			$this->session->set_userdata( "token", $token->token );

			echo json_encode(array('status'=>true,'token'=>$token->token, 'message'=>'Token obtenido correctamente. Guardado en sesion'));
			return;
		}
		
		$this->session->unset_userdata('token');

		echo json_encode(array('status'=>false,'token' => $token, 'message'=>'Error al obtener el token. Debe generar uno nuevo. Click en '));
	}

	public function guardarBitacoraFactura(){

		$data = array(
			'version'=> $this->input->post('version'),
			'ambiente' => $this->input->post('ambiente'),
			'versionApp' => $this->input->post('versionApp'),
			'codigoGeneracion' => $this->input->post('codigoGeneracion'),
			'selloRecibido' => $this->input->post('selloRecibido') ?? NULL,
			'fhProcesamiento' => $this->input->post('fhProcesamiento'),
			'clasificaMsg' => $this->input->post('clasificaMsg') ?? NULL,
			'descripcionMsg' => $this->input->post('descripcionMsg') ?? NULL,
			'observaciones' => json_encode($this->input->post('observaciones'), true) ?? NULL,
			'usuario' => $this->input->post('usuario') ?? null,
            'estado'=>$this->input->post('estado') ?? 'RECHAZADO',
		);

		if($data['version'] == null || $data['ambiente'] == null || $data['versionApp'] == null || $data['codigoGeneracion'] == null || $data['fhProcesamiento'] == null){
			echo json_encode(array('status'=>false,'message'=>'Error al guardar la bitacora. Campos obligatorios vacios'));
			return;
		}

		$response = $this->Bitacora_model->insertarBitacoraFactura($data);

		if($response) {
			echo json_encode(array('status'=>true,'message'=>'Bitacora guardada correctamente'));
		} else {
			echo json_encode(array('status'=>false,'message'=>'Error al guardar la bitacora'));
		}

	}
}
