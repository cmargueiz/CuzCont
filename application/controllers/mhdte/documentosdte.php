<?php

defined('BASEPATH') or exit('No direct script access allowed');

class documentosdte extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ( !$this->session->userdata( "nombre" ) ) {
            redirect( base_url() );

        }

        $this->load->model('mhdte/json_model');
    }


    public function cargarDocumento()
    {
		$numeroControl = $this->input->post('numeroControl');
		$codigoGeneracion = $this->input->post('codigoGeneracion');

       $identificacion = $this->json_model->getIdentificacion(false, $numeroControl, $codigoGeneracion);

		if($identificacion == null) {
			echo json_encode(array("error" => "No se encontraron documentos. Debe contactar con el administrador del sistema."));
			return;
		}

            $this->json_model->numeroControl = $identificacion->numeroControl;
            $this->json_model->codigoGeneracion = $identificacion->codigoGeneracion;

            $tipoDTE = $this->obtenerTipoDTE((int)$identificacion->tipoDoc);

            $this->json_model->tipoDTE = $tipoDTE;

            $identificacion->identificacion = $this->obtenerIdentificacion($identificacion, $tipoDTE);

            $identificacion->emisor = $this->json_model->getEmisor();
            $identificacion->emisor->direccion = $this->construirDireccion($identificacion->emisor);
            $identificacion->cuerpoDocumento = $this->json_model->getCuerpoDocumento() ?? null;

            switch ($tipoDTE) {
                case json_model::CCFE:
                    $identificacion->documentoRelacionado = null;


                    $identificacion->receptor = $this->json_model->getReceptorDocumento();
                    if($identificacion->receptor!=null) {
                        $identificacion->receptor->direccion = $this->construirDireccion($identificacion->receptor);
                    }

                    $identificacion->otrosDocumentos = $this->json_model->getOtrosDocumentos() ?? null;
                    $identificacion->ventaTercero = null;


                    $identificacion->resumen = $this->json_model->getResumen();

                    if($identificacion->resumen != null) {
                        $identificacion->resumen->pagos = $this->construirPagos($identificacion->resumen);
                    } else {
                        $identificacion->resumen = null;
                    }

                    $identificacion->resumen->tributos = $this->construirTributos($identificacion->resumen);
                    $identificacion->extension = null;
                    break;
                case json_model::FE:
                    $identificacion->documentoRelacionado = null;

                    $identificacion->receptor = $this->json_model->getReceptorDocumento();
                    if($identificacion->receptor!=null) {
                        $identificacion->receptor->direccion = $this->construirDireccion($identificacion->receptor);
                    }
                    $identificacion->otrosDocumentos = $this->json_model->getOtrosDocumentos() ?? null;
                    $identificacion->ventaTercero = null;

                    $identificacion->resumen = $this->json_model->getResumen();

                    if($identificacion->resumen != null) {
                        $identificacion->resumen->pagos = $this->construirPagos($identificacion->resumen);
                        $identificacion->resumen->tributos = $this->construirTributos($identificacion->resumen);
                    } else {
                        $identificacion->resumen = null;
                    }
                    $identificacion->extension = null;
                    break;
                case json_model::NCE:
                    $identificacion->documentoRelacionado = $this->json_model->getDocumentoRelacionado();// si van

                    $identificacion->receptor = $this->json_model->getReceptorDocumento();
                    if($identificacion->receptor!=null) {
                        $identificacion->receptor->direccion = $this->construirDireccion($identificacion->receptor);
                    }

                    $identificacion->ventaTercero = null;

                    $identificacion->resumen = $this->json_model->getResumen();

					if($identificacion->resumen != null) {

                        $identificacion->resumen->tributos = $this->construirTributos($identificacion->resumen);
                    } else {
                        $identificacion->resumen = null;
                    }

                    $identificacion->extension = null;
                    break;
                case json_model::NDE:
                    $identificacion->documentoRelacionado = $this->json_model->getDocumentoRelacionado();// si van

                    $identificacion->receptor = $this->json_model->getReceptorDocumento();
                    if($identificacion->receptor!=null) {
                        $identificacion->receptor->direccion = $this->construirDireccion($identificacion->receptor);
                    }

                    $identificacion->ventaTercero = null;

                    $identificacion->resumen = $this->json_model->getResumen();

					if($identificacion->resumen != null) {
                        $identificacion->resumen->tributos = $this->construirTributos($identificacion->resumen);
                    } else {
                        $identificacion->resumen = null;
                    }

                    $identificacion->extension = null;
                    break;
                case json_model::FEXE:

                    $identificacion->receptor = $this->json_model->getReceptorDocumento();

                    $identificacion->otrosDocumentos = null;
                    $identificacion->ventaTercero = null;

					foreach($identificacion->cuerpoDocumento as $cuerpoDocumento){
						$cuerpoDocumento->tributos = null;
					}

                    $identificacion->resumen = $this->json_model->getResumen();

					if($identificacion->resumen != null) {
                        $identificacion->resumen->pagos = $this->construirPagos($identificacion->resumen);
                    } else {
                        $identificacion->resumen = null;
                    }

                    break;
                case json_model::FSEE:
                    $identificacion->sujetoExcluido = $this->json_model->getReceptorDocumento();
                    if($identificacion->sujetoExcluido != null) {
                        $identificacion->sujetoExcluido->direccion = $this->construirDireccion($identificacion->sujetoExcluido);
                    }

                    $identificacion->resumen = $this->json_model->getResumen();

					if($identificacion->resumen != null) {
                        $identificacion->resumen->pagos = $this->construirPagos($identificacion->resumen);
                    } else {
                        $identificacion->resumen = null;
                    }
                    break;
				
				case json_model::CRE:

                    $identificacion->receptor = $this->json_model->getReceptorDocumento();

                    if($identificacion->receptor!=null) {
                        $identificacion->receptor->direccion = $this->construirDireccion($identificacion->receptor);
                    }

					$identificacion->resumen = $this->json_model->getResumen();
					$identificacion->extension = null;
					$identificacion->apendice = null;

				break;

            }

            unset($identificacion->resumen->descripcion);
            unset($identificacion->resumen->codigoTributo);
            unset($identificacion->resumen->codigoFormaPago);
            $identificacion->apendice = null;

            $this->limpiarDocumento($identificacion);

        echo json_encode($identificacion);

    }

    public function obtenerIdentificacion($identificacion, $tipoDTE)
    {

        $parcialIdentificacion = array(
            "version"=> $identificacion->version,
            "ambiente"=> $identificacion->ambDestino,
            "tipoDte" => $tipoDTE,
            "numeroControl" => $identificacion->numeroControl,
            "codigoGeneracion" => $identificacion->codigoGeneracion,
            "tipoModelo" => $identificacion->modFacturacion,
            "tipoOperacion" => $identificacion->tipTransmicion,
            "tipoContingencia" => $identificacion->tipContingencia,
            "fecEmi" => $identificacion->fecha,
            "horEmi" => $identificacion->hora,
            "tipoMoneda" =>$identificacion->tipMoneda,
        );

        if($tipoDTE == json_model::FEXE) {
            $parcialIdentificacion = array_merge($parcialIdentificacion, array(
                "motivoContigencia" => $identificacion->motContingencia,
            ));
        } else {
            $parcialIdentificacion = array_merge($parcialIdentificacion, array(
            "motivoContin" => $identificacion->motContingencia,
    ));
        }

        return $parcialIdentificacion;
    }

    public function limpiarDocumento($identificacion)
    {
        $keys = array_keys((array)$identificacion->identificacion);
        foreach ($keys as $key) {
            unset($identificacion->$key);

        }
        unset($identificacion->ambDestino);
        unset($identificacion->tipoDoc);
        unset($identificacion->modFacturacion);
        unset($identificacion->tipContingencia);
        unset($identificacion->motContingencia);
        unset($identificacion->estado);
        unset($identificacion->tipTransmicion);
        unset($identificacion->fecha);
        unset($identificacion->hora);
        unset($identificacion->tipMoneda);

        unset($identificacion->resumen->formaPago);
        unset($identificacion->resumen->montoPago);
        unset($identificacion->resumen->referencia);
        unset($identificacion->resumen->plazo);
        unset($identificacion->resumen->periodo);

    }

    public function obtenerTipoDTE($tipoDoc)
    {
        return 	match((int)$tipoDoc) {
            1 => json_model::FE,//Factura Electrónico
            3 => json_model::CCFE,//Comprobante de Crédito Fiscal Electrónico
            4 => json_model::NRE,//Nota de Remisión Electrónica
            5 => json_model::NCE,//Nota de Crédito Electrónica
            6 => json_model::NDE,//Nota de Débito Electrónica
            11 => json_model::FEXE,//Factura de Exportación Electrónica
            14 => json_model::FSEE,//Factura de Sujeto Excluido Electrónica
			7 => json_model::CRE,//Comprobante de Retención Electrónico
			default => json_model::CCFE
        };
    }

    public function construirDireccion($entidad)
    {

        $direccion = array();

        // print_r($entidad->direccion);

        if($entidad!=null) {
            if($entidad->direccion != null) {
                $direccion = array(
                    "complemento" => $entidad->direccion,
                    "municipio" => $entidad->municipio,
                    "departamento" => $entidad->departamento,
                );

                unset($entidad->municipio);
                unset($entidad->departamento);

                return $direccion;
            }
        }
        return null;
    }

    public function contruirOtrosDocumentos($otrosDocumentos)
    {
        if(count($otrosDocumentos) > 0) {
            $estructuraOtroDocumento = array();

            foreach ($otrosDocumentos as $otroDocumento) {
                $estructuraOtroDocumento[] = array(
                    'codDocAsoc' => $otroDocumento->codDocAsociado,
                    'desDocumento' => $otroDocumento->descDocumento,
                    'detalleDocumento' => $otroDocumento->detalleDocumento,
                    'medico' => array(
                        'nombre' => $otroDocumento->nombreMedico,
                        'nit' => $otroDocumento->nit,
                        'docIdentificacion' => $otroDocumento->docIdentificacion,
                        'tipoServicio' => $otroDocumento->tipoServicio,
                    ),
                );
            }

            return $estructuraOtroDocumento;

        }

        return null;
    }

    public function construirPagos($resumen)
    {
        $pagos []= array(
            'codigo' => $resumen->codigoFormaPago,
            'montoPago' => $resumen->montoPago,
            'referencia' => $resumen->referencia,
            'plazo' => $resumen->plazo,
            'periodo' => $resumen->periodo,
        );

        return $pagos;

    }

    public function construirTributos($resumen)
    {
        $jsonTributos = $resumen?->descripcion;

        if($jsonTributos == null || $jsonTributos == "") {
            return null;
        }

        return json_decode($jsonTributos, true);
    }

	public function modificarEstadoDte(){
		$numeroControl = $this->input->post('numeroControl');
		$codigoGeneracion = $this->input->post('codigoGeneracion');
		$estado = $this->input->post('estado');

		$response = $this->json_model->modificarEstadoDte($numeroControl, $codigoGeneracion, $estado);
	}


}
