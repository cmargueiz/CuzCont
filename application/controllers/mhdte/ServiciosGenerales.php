<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class serviciosgenerales extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ( !$this->session->userdata( "nombre" ) ) {
            redirect( base_url() );

        }
        $this->load->model( "mhdte/cuerpodocumento_model" );
        $this->load->model( "mhdte/resumen_model" );
        $this->load->model( "mhdte/identificacion_model" );
        $this->load->model( "mhdte/serviciosgenerales_model" );
        $this->load->model( "mhdte/receptor_model" );
        $this->load->model( "mhdte/docrelacionados_model" );

        $this->load->library( 'Uuid' );
        $this->load->library( 'Lrenta' );

    }
    
    public function buscarProductos(){
        
         $area = $this->session->userdata( "areafact");
        $tablaResumen = $this->serviciosgenerales_model->ListProducto( $area);
        echo json_encode( $tablaResumen );
        
    }
    public function comrete() {
       $this->session->set_userdata( "areafact","CC") ;//$this->input->get('Cat');
        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "dteMH/ComRete" );
        $this->load->view( "dteMH/envioDte");
        $this->load->view( "layouts/footer" );
    } 
    
    public function Notcredi() {
       
        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "dteMH/Notcredit" );
        $this->load->view( "dteMH/modalPro");
        $this->load->view( "dteMH/envioDte");
        $this->load->view( "layouts/footer" );
    } 
   
    public function index() {
 $this->session->set_userdata( "areafact","SE") ;//$this->input->get('Cat');
       
        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "dteMH/SujetoEx" );
        $this->load->view( "dteMH/envioDte");
        $this->load->view( "layouts/footer" );
    } 
     public function NotRemicion() {
 $this->session->set_userdata( "areafact","EX") ;//$this->input->get('Cat');
           $texto="Nota de Remisión";
        
        $datos['titulo']=$texto;
       
        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "dteMH/NotRemicion",$datos );
        $this->load->view( "dteMH/envioDte");
        $this->load->view( "layouts/footer" );
    } 
    
    public function fsep() {
         $this->session->set_userdata( "areafact","SG") ;//$this->input->get('Cat');
       

        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "dteMH/SujetoExPagos" );
        $this->load->view( "dteMH/envioDte");
        $this->load->view( "layouts/footer" );
    }

    public function store() {

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
        $cantidad = $this->input->post( "item80" );
        $precio = $this->input->post( "item85" );
        $tipodocSelect = $this->input->post( "tipodocSelect" );
        $observacionesItem=$this->input->post( "observacionesItem" );
        $grancontribuyente= $this->input->post( "grancontribuyente" );
        
        $impuestos =  $this->cuerpodocumento_model->getImpuestos();
        $iva13 =    $impuestos[2]->valor;
        $Renta =    $impuestos[3]->valor;
       
        $ivaxitem=0.00;
        $ivaRetenido=$rentaMenos=0.00;
       
         $ivaRetenido=$ivaxitem = $this->lrenta->caliva13( $precio, $cantidad, $iva13 );
       
        $gravadas = (floatval( $cantidad )*floatval( $precio )) ;
      
        $rentaMenos=  $this->lrenta->calrenta( $gravadas, $Renta );
         
      
        $data2  = array(
'rentaMenos'=>$rentaMenos,
'ivaRetenido'=>$ivaRetenido
);

        $data  = array(

            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'item'=>$this->input->post( "item72" ),
            'tipoItem'=>1,
            'areafact'=>$this->session->userdata( "areafact"),
            'cantidad'=>$this->input->post( "item80" ),
            'codigo'=>$this->input->post( "item81" ),
            'ventasGravadas'=>$gravadas,
            'unidadMedida'=>$this->input->post( "item83" ),
            'descripcion'=>$this->input->post( "item84" ),
            'precioUnitario'=>$precio,
            'ventas'=>$gravadas,
            'ivaItem'=>$ivaxitem,
           
              'observacionesItem'=>$observacionesItem,
              'observacionesItems'=>json_encode($data2)
            
        );
         
      
        if ( $this->cuerpodocumento_model->save( $data ) ) {
            $data  = array(
                'OK' => '1',
            );
            echo json_encode( $data );
        } else {

            $data  = array(
                'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }

    }
    
    public function Excluido() {

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
        $cantidad = $this->input->post( "item80" );
        $precio = $this->input->post( "item85" );
        $tipodocSelect = $this->input->post( "tipodocSelect" );
        $calculos = $this->input->post( "calculos" );
        
        $grancontribuyente= $this->input->post( "grancontribuyente" );
        $observacionesItem= $this->input->post( "observacionesItem" );
        
        $impuestos =  $this->cuerpodocumento_model->getImpuestos();
        $iva13 =    $impuestos[2]->valor;
        $Renta =    $impuestos[4]->valor;
        $iva1 =    $impuestos[5]->valor;
        $ivaxitem=$rentaMenos=$ivaRetenido=0.00;
        
        $gravadas = number_format((floatval( $cantidad )*floatval( $precio )) , 2, '.', '' );
        
        if($calculos==1){ 
            // Renta y 13%
        $ivaRetenido=$ivaxitem = $this->lrenta->caliva13( $precio, $cantidad, $iva13 );
        $rentaMenos=$this->lrenta->calrenta( $gravadas, $Renta );
		 
        }  elseif($calculos==2){
            //solo Renta
        $rentaMenos=$this->lrenta->calrenta( $gravadas, $Renta );
            
        }  elseif($calculos==3){
            // solo 13%
        $ivaRetenido= $ivaxitem = $this->lrenta->caliva13( $precio, $cantidad, $iva13 );
        }          
        
       

$data2  = array(
'rentaMenos'=>$rentaMenos,
'ivaRetenido'=>$ivaRetenido
);
        $data  = array(

            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'item'=>$this->input->post( "item72" ),
            'tipoItem'=>1,
            
            'cantidad'=>$this->input->post( "item80" ),
            'codigo'=>$this->input->post( "item81" ),
            'areafact'=>$this->session->userdata( "areafact"),
            'unidadMedida'=>$this->input->post( "item83" ),
            'descripcion'=>$this->input->post( "item84" ),
            'precioUnitario'=>$precio,
            'ventas'=>$gravadas,
            'ventasGravadas'=>$gravadas,
            'ivaItem'=>$ivaxitem,
            'observacionesItem'=>$observacionesItem,
            'observacionesItems'=>json_encode($data2)
            
        );
         
      
        if ( $this->cuerpodocumento_model->save( $data ) ) {
            $data  = array(
                'OK' => '1',
            );
            echo json_encode( $data );
        } else {

            $data  = array(
                'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }
//echo json_encode( $data );
    }
   
    public function llenarTabla() {

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );

        $tablaResumen = $this->cuerpodocumento_model->getParaResumen( $numeroControl, $codigoGeneracion );
        echo json_encode( $tablaResumen );

    }

    public function ingresoResumen() {

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
        $ClienteExcluido = $this->input->post( "excluido" );
        $condicionOpera = $this->input->post( "item153" );
        $codFormaPago = $this->input->post( "item154" );
        $Plazo = $this->input->post( "item157" );
        $periodoPlazo = $this->input->post( "item158" );
        $numPagoElecNPE = '';

        $grancontribuyente = $this->input->post( "grancontribuyente" );
        $tipodocElec = $this->input->post( "tipodocElec" );
        $resumenConsulta = $this->input->post( "tipoConsulta" );

        $respuesta = $this->cuerpodocumento_model->getParaResumen( $numeroControl, $codigoGeneracion );
        $impuestos =  $this->cuerpodocumento_model->getImpuestos();
        $iva13 =    $impuestos[2]->valor;
        $Renta =    $impuestos[3]->valor;
      
        $totalGravado = 0.00;
        $ivaResumen = 0.00;
        $sumadeprecioxcantidad = 0.00;
        $ivaRetenido= $ivaRetenido=$rentaMenos = 0.00;

        for ( $i = 0; $i<count( $respuesta ); $i++ ) {
            $totalGravado += $respuesta[$i]->subtotal;
            $ivaResumen += $respuesta[$i]->ivaItem;
            $sumadeprecioxcantidad += ( $respuesta[$i]->precioUnitario*$respuesta[$i]->cantidad );
            $rentaMenos+=floatval(trim($respuesta[$i]->retencionRenta,'"'));
            $ivaRetenido+=floatval(trim($respuesta[$i]->ivaRetenido,'"'));
            
        }

       
          // $rentaMenos=  $this->lrenta->calrenta( $totalGravado, $Renta );

        
      
        $totalAPagar = number_format($totalGravado-$rentaMenos, 2, '.', '' );
       $totalGravado =  number_format($totalGravado, 2, '.', '' );
       
        $ivaResumen   = number_format( $ivaResumen, 2, '.', '' );
       
 $this->load->helper('numeros');
        $valorletras = array(
            'leyenda' => num_to_letras($totalAPagar)
            , 'cantidad' => $totalAPagar
            );
       // echo json_encode($valorletras);
       
        // ingreso a resumen
      
          $data  = array(
            'totalNoSuj'=>'0.00',
            'totalExenta'=>'0.00',
            'totalGravada'=>number_format($totalGravado, 2, '.', '' ),
            'totalOperaciones'=>number_format($totalGravado, 2, '.', '' ),
            'subTotal'=>number_format(( $sumadeprecioxcantidad ), 2, '.', '' ),
			 'totalMonSujRet'=>number_format($totalGravado, 2, '.', '' ),
            'montoGloDescNS'=>'0.00',
            'montoGloDescVE'=>'0.00',
            'montoGloDescVG'=>'0.00',
            'porcMontoGloDesc'=>'0.00',
            'totalDescBonRev'=>'0.00',
            'nombreTributo'=> '20',
            'ivaRetenido'=> $ivaRetenido,
            'retencionRenta'=>$rentaMenos,
            'montoTotalOp'=> number_format($totalAPagar-$ivaResumen, 2, '.', '' ),
            'totalCargoBasImpon'=>'0.00',
            'totalAPagar'=> number_format($totalAPagar-$ivaResumen, 2, '.', '' ),
            'valorLetras'=>$valorletras['leyenda'],
            'iva13'=>$ivaResumen,
            'saldoAFavor'=>'0.00',
            'condicionOpera'=>$condicionOpera,
            'codFormaPago'=>$codFormaPago,
            'montoPorFormaPag'=>number_format($totalAPagar-$ivaResumen, 2, '.', '' ),
            'refModalidadPago'=>'',
            'plazo'=>$Plazo,
            'periodoPlazo'=>$periodoPlazo,
            'numPagoElecNPE'=>$numPagoElecNPE,
            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
           
            //'observaciones'=>$observaciones
        );

        //

        if ( $resumenConsulta == 'fin' ) {
            if ( $this->resumen_model->savetho( $data,$numeroControl,$codigoGeneracion ) ) {
                $data  = array(
                    'OK' => '1',
                );
                echo json_encode( $data );
            } else {

                $data  = array(
                    'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
                );
                echo json_encode( $data );
            }

        } else {
            echo json_encode( $data );

        }

    }
  
    public function ingresoResumenEx() {

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
        $ClienteExcluido = $this->input->post( "excluido" );
        $condicionOpera = $this->input->post( "item153" );
        $codFormaPago = $this->input->post( "item154" );
        $Plazo = $this->input->post( "item157" );
        $periodoPlazo = $this->input->post( "item158" );
        $consin = $this->input->post( "consin" );
        $consinDesc = $this->input->post( "consinDes" );
        $numPagoElecNPE = '';

        $grancontribuyente = $this->input->post( "grancontribuyente" );
        $tipodocElec = $this->input->post( "tipodocElec" );
        $resumenConsulta = $this->input->post( "tipoConsulta" );

        $respuesta = $this->cuerpodocumento_model->getParaResumen( $numeroControl, $codigoGeneracion );
        $impuestos =  $this->cuerpodocumento_model->getImpuestos();
        $iva13 =    $impuestos[2]->valor;
        $Renta =    $impuestos[4]->valor;
      
        $totalGravado = 0.00;
        $ivaResumen = 0.00;
        $sumadeprecioxcantidad = 0.00;
        $ivaRetenido=$rentaMenos = 0.00;

        for ( $i = 0; $i<count( $respuesta ); $i++ ) {
            $totalGravado += $respuesta[$i]->subtotal;
           // $ivaResumen += $respuesta[$i]->ivaItem;
            $sumadeprecioxcantidad += ( $respuesta[$i]->precioUnitario*$respuesta[$i]->cantidad );
        }

                   
        $rentaMenos=0.0;

        $totalAPagar = number_format($totalGravado, 2, '.', '' );
       $totalGravado = number_format($totalGravado, 2, '.', '' );
        $ivaResumen = number_format( $ivaResumen, 2, '.', '' );
       
 $this->load->helper('numeros');
        $valorletras = array(
            'leyenda' => num_to_letras($totalAPagar)
            , 'cantidad' => $totalAPagar
            );
       // echo json_encode($valorletras);
      
        // ingreso a resumen
        $data  = array(
            'totalNoSuj'=>'0.00',
            'totalExenta'=>'0.00',
            'totalGravada'=>$totalGravado,
            'totalOperaciones'=>$totalGravado,
            'subTotal'=>( $sumadeprecioxcantidad -$rentaMenos),
			 'totalMonSujRet'=>$totalGravado,
            'montoGloDescNS'=>'0.00',
            'montoGloDescVE'=>'0.00',
            'montoGloDescVG'=>'0.00',
            'porcMontoGloDesc'=>'0.00',
            'totalDescBonRev'=>'0.00',
            'nombreTributo'=> '20',
            'ivaRetenido'=> $ivaRetenido,
            'retencionRenta'=>$rentaMenos,
            'montoTotalOp'=> $totalGravado,
            'totalCargoBasImpon'=>'0.00',
            'totalAPagar'=> $totalAPagar,
            'valorLetras'=> $valorletras['leyenda'],
            'iva13'=>$ivaResumen,
            'saldoAFavor'=>'0.00',
            'seguro'=>'0.00',
            'flete'=>'0.00',
            'condicionOpera'=>$condicionOpera,
            'codFormaPago'=>$codFormaPago,
            'montoPorFormaPag'=>$totalAPagar,
            'refModalidadPago'=>'',
            'plazo'=>$Plazo,
            'periodoPlazo'=>$periodoPlazo,
            'numPagoElecNPE'=>$numPagoElecNPE,
            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'incoterms'=>$consin,
            'descincoterms'=>$consinDesc,
            //'observaciones'=>$observaciones
        );

        //

        if ( $resumenConsulta == 'fin' ) {
            if ( $this->resumen_model->savetho( $data,$numeroControl,$codigoGeneracion ) ) {
                $data  = array(
                    'OK' => '1',
                );
                echo json_encode( $data );
            } else {

                $data  = array(
                    'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
                );
                echo json_encode( $data );
            }

        } else {
            echo json_encode( $data );

        }

    }

    public function llenarTablaExp() {

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );

        $tablaResumen = $this->cuerpodocumento_model->getParaResumenExp( $numeroControl, $codigoGeneracion );
        echo json_encode( $tablaResumen );

    }

    public function ingresoResumenSex() {

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
        $ClienteExcluido = $this->input->post( "excluido" );
        $condicionOpera = $this->input->post( "item153" );
        $codFormaPago = $this->input->post( "item154" );
        $Plazo = $this->input->post( "item157" );
        $periodoPlazo = $this->input->post( "item158" );
        $consin = $this->input->post( "consin" );
        $consinDesc = $this->input->post( "consinDes" );
        $numPagoElecNPE = '';

        $grancontribuyente = $this->input->post( "grancontribuyente" );
        $tipodocElec = $this->input->post( "tipodocElec" );
        $resumenConsulta = $this->input->post( "tipoConsulta" );

        $respuesta = $this->cuerpodocumento_model->getParaResumen( $numeroControl, $codigoGeneracion );
        $impuestos =  $this->cuerpodocumento_model->getImpuestos();
        $iva13 =    $impuestos[2]->valor;
        $Renta =    $impuestos[4]->valor;
        $iva1 =    $impuestos[5]->valor;
      
        $totalGravado = 0.00;
        $ivaResumen = 0.00;
        $sumadeprecioxcantidad = 0.00;
        $ivaRetenido=$rentaMenos = 0.0;

        for ( $i = 0; $i<count( $respuesta ); $i++ ) {
            $totalGravado += $respuesta[$i]->subtotal;
           // $ivaResumen += $respuesta[$i]->ivaItem;
            $sumadeprecioxcantidad += ( $respuesta[$i]->precioUnitario*$respuesta[$i]->cantidad );
            $rentaMenos+=floatval(trim($respuesta[$i]->retencionRenta,'"'));
            $ivaRetenido+=floatval(trim($respuesta[$i]->ivaRetenido,'"'));
              $ivaResumen +=$respuesta[$i]->ivaItem;
        }

                   
       

        $totalAPagar = $totalGravado-$rentaMenos;
     //  $totalGravado = number_format( $totalGravado, 2, '.', '' );
        $ivaResumen = number_format( $ivaResumen, 2, '.', '' );
        $this->load->helper('numeros');
        $valorletras = array(
            'leyenda' => num_to_letras(number_format($totalAPagar, 2, '.', '' ))
            , 'cantidad' => $totalAPagar-$rentaMenos
            );
       // echo json_encode($valorletras);
       

        // ingreso a resumen
        $data  = array(
            'totalNoSuj'=>'0.00',
            'totalExenta'=>'0.00',
            'totalGravada'=>number_format($totalGravado, 2, '.', '' ),
            'totalOperaciones'=>number_format($totalGravado, 2, '.', '' ),
            'subTotal'=>number_format(( $sumadeprecioxcantidad ), 2, '.', '' ),
			 'totalMonSujRet'=>number_format($totalGravado, 2, '.', '' ),
            'montoGloDescNS'=>'0.00',
            'montoGloDescVE'=>'0.00',
            'montoGloDescVG'=>'0.00',
            'porcMontoGloDesc'=>'0.00',
            'totalDescBonRev'=>'0.00',
            'nombreTributo'=> '20',
            'ivaRetenido'=> $ivaRetenido,
            'retencionRenta'=>$rentaMenos,
            'montoTotalOp'=> number_format($totalAPagar-$ivaResumen, 2, '.', '' ),
            'totalCargoBasImpon'=>'0.00',
            'totalAPagar'=> number_format($totalAPagar-$ivaResumen, 2, '.', '' ),
            'valorLetras'=>$valorletras['leyenda'],
            'iva13'=>$ivaResumen,
            'saldoAFavor'=>'0.00',
            'condicionOpera'=>$condicionOpera,
            'codFormaPago'=>$codFormaPago,
            'montoPorFormaPag'=>number_format($totalAPagar-$ivaResumen, 2, '.', '' ),
            'refModalidadPago'=>'',
            'plazo'=>$Plazo,
            'periodoPlazo'=>$periodoPlazo,
            'numPagoElecNPE'=>$numPagoElecNPE,
            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
           
            //'observaciones'=>$observaciones
        );

        //

        if ( $resumenConsulta == 'fin' ) {
            if ( $this->resumen_model->savetho( $data,$numeroControl,$codigoGeneracion ) ) {
                $data  = array(
                    'OK' => '1',
                );
                echo json_encode( $data );
            } else {

                $data  = array(
                    'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
                );
                echo json_encode( $data );
            }

        } else {
            echo json_encode( $data );

        }

    }

    public function comprorete(){
        
        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
       
        //$verificar = $this->identificacion_model->verificarComReteCD( $numeroControl, $codigoGeneracion );
        
        /*if($verificar){
            
             $data  = array(
                    'Ocu' => json_encode($verificar),
                );
                echo json_encode( $data );
            */
     //   }else{
               $tablaResumen = $this->serviciosgenerales_model->getParaResumen( $numeroControl, $codigoGeneracion );
             $data  = array(
                    'Lib' => json_encode($tablaResumen),
                );
                echo json_encode( $data );
          
           
       // }
        
       
       
    }
    
    public function creacomprorete(){
         $codTdoc="07";
         $version="1";
        $montoretencion=0;$ivaretenido=0;
       
          $numeroControl2 = $this->input->post( "numeroControl" );
        $codigoGeneracion2 = $this->input->post( "codigoGeneracion" );
         $getreceptor = $this->receptor_model->getreceptor( $numeroControl2,$codigoGeneracion2 );
         // echo json_encode( $this->session->userdata( "areafact"));
         
           $codigoGeneracion = strtoupper( $this->uuid->v4() );
                
        $anio = date( "Y" );
        $numeroControl = $this->identificacion_model->corelativo( $anio );
       

                    $data = array(
                        'numeroControl' => $numeroControl->numeroControl+1,
                    );
                    $this->identificacion_model->corelativoUpdate( $anio, $data );
       
 // IDENTIFICACION DOCUMENTO
         $secuencia=str_pad( ( $numeroControl->numeroControl+1 ), 15, "0", STR_PAD_LEFT );
        $numeroControlFin='DTE-'.$codTdoc.'-CMPV0202-'.$secuencia;
        
         
         $item11 = $this->input->post( "horacomple" );
         $item10 = $this->input->post( "fechacomple" );
         $txt1 = $this->input->post( "txt1" );
        $horaactual= date("h:i:s");
         $data  = array(

            'version'=>$version,
            'ambDestino'=>'00',
            'tipoDoc'=>$codTdoc,
            'numeroControl' =>$numeroControlFin  ,
            'codigoGeneracion' => $codigoGeneracion,
            'modFacturacion' => 1,
            'tipTransmicion' => 1,
            'fecha' => $item10,
            'hora' => $horaactual,
          
            'tipMoneda' => 'USD'
              );
   $data2  = array(
             'fecha' => $item10,
            'idReceptor'=>$getreceptor[0]->idReceptor,
            'numeroControl' =>$numeroControlFin  ,
            'codigoGeneracion' => $codigoGeneracion,
         
              );
        
          $traedetalleRete = $this->resumen_model->traedetalleRete( $numeroControl2, $codigoGeneracion2 );
        //echo json_encode($traedetalleRete);
         
         $dicVin=array
             (
            'numeroControl' =>$numeroControlFin ,
            'codigoGeneracion' => $codigoGeneracion,
            'tipoDoc'=>'0'.$traedetalleRete[0]->tipoDoc,
            'tipoGenera'=>'2',
            'numDocRelacion'=>$codigoGeneracion2,
            'fechaGeneracion'=>$traedetalleRete[0]->fecha,
             );
       
         
         
         /* insertando cuerpo documento*/
         //S$traedetalleRete
         if($this->input->post( "tipocomp" )=="C4"){
            $montoretencion=$traedetalleRete[0]->montoTotalOp-$traedetalleRete[0]->iva13;
            $ivaretenido=$traedetalleRete[0]->iva13;
        }else{
            $montoretencion=$traedetalleRete[0]->ventasGravadas;
            $ivaretenido=$traedetalleRete[0]->ivaRetenido;
        }
         
       
            $data3  = array(
                
            'numeroControl'=>$numeroControlFin,
            'codigoGeneracion'=>$codigoGeneracion,
            'item'=>1,
            'tipDTRelacionado'=>str_pad($traedetalleRete[0]->tipoDoc,'2', "0", STR_PAD_LEFT ),
            'tipGenDoc'=>'2',
            'numDocRelacionado'=>$codigoGeneracion2,
            'fechaGendoc'=>$traedetalleRete[0]->fecha,
            'montoretencion'=>$montoretencion,
            'codRetencion'=>$this->input->post( "tipocomp" ),
            'ivaRetenido'=>$ivaretenido,
            'descripcion'=>$traedetalleRete[0]->descripcion." ".$traedetalleRete[0]->observacionesItem,
            
            );  
              
         /* ingresando resumen*/
         # procedemos a covertir la cantidad en letras
        $this->load->helper('numeros');
        $valorletras = array(
            'leyenda' => num_to_letras($traedetalleRete[0]->ivaRetenido)
            , 'cantidad' => $traedetalleRete[0]->ivaRetenido
            );
       // echo json_encode($valorletras);
       //$valorletras['leyenda']
         
         
     $data4  = array(
                
            'numeroControl'=>$numeroControlFin,
            'codigoGeneracion'=>$codigoGeneracion,
            'totalMonSujRet'=>$montoretencion,
            'totalIvaRetenido'=>$ivaretenido,
            'valorLetrasIvaRet'=> $valorletras['leyenda'],
            
            );  
              
         
          if ( $this->docrelacionados_model->save( $dicVin ) && $this->identificacion_model->save( $data ) && $this->identificacion_model->save2( $data2 ) && $this->cuerpodocumento_model->save( $data3 ) &&  $this->resumen_model->savetho( $data4,$numeroControlFin,$codigoGeneracion )) {
            $datasave  = array(
                'identificacion' =>1,
                'receptordocumen' => 1,
                'cuerpo' => 1,
                'resumen' => 1,
                'docVinculados' => 1,
            );
            echo json_encode( $data2 );
        } else {

            $datasave  = array(
                'error' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }
   
         
     }
    
    public function creaNotCred(){
         $codTdoc="05";
         $version="3";
        $numeroControl2 = $this->input->post( "numeroControl" );
        $codigoGeneracion2 = $this->input->post( "codigoGeneracion" );
         $getreceptor = $this->receptor_model->getreceptor( $numeroControl2,$codigoGeneracion2 );
        //  echo json_encode($getreceptor);
         
           $codigoGeneracion = strtoupper( $this->uuid->v4() );
                
        $anio = date( "Y" );
        $numeroControl = $this->identificacion_model->corelativo( $anio );
       

                    $data = array(
                        'numeroControl' => $numeroControl->numeroControl+1,
                    );
                    $this->identificacion_model->corelativoUpdate( $anio, $data );
       
 // IDENTIFICACION DOCUMENTO
         $secuencia=str_pad( ( $numeroControl->numeroControl+1 ), 15, "0", STR_PAD_LEFT );
        $numeroControlFin='DTE-'.$codTdoc.'-CMPV0202-'.$secuencia;
        
         //fecha y hora 
        
         $horaactual= date("h:i:s");
         $fechaactual= date("Y-m-d");
        
        
        // termina fecha y hora
         $item11 = $horaactual;
         $item10 = $fechaactual;
         $txt1 = $this->input->post( "txt1" );
        
         $data  = array(

            'version'=>$version,
            'ambDestino'=>'00',
            'tipoDoc'=>$codTdoc,
            'numeroControl' =>$numeroControlFin  ,
            'codigoGeneracion' => $codigoGeneracion,
            'modFacturacion' => 1,
            'tipTransmicion' => 1,
            'fecha' => $item10,
            'hora' => $item11,
          
            'tipMoneda' => 'USD'
              );
   $data2  = array(
             'fecha' => $item10,
            'idReceptor'=>$getreceptor[0]->idReceptor,
            'numeroControl' =>$numeroControlFin  ,
            'codigoGeneracion' => $codigoGeneracion,
         
              );
        
          $traedetalleRete = $this->resumen_model->traedetalleRete( $numeroControl2, $codigoGeneracion2 );
        
         
         $dicVin=array
             (
            'numeroControl' =>$numeroControlFin ,
            'codigoGeneracion' => $codigoGeneracion,
            //'tipoDoc'=>$traedetalleRete[0]->tipoDoc,
            'tipoDoc'=>str_pad($traedetalleRete[0]->tipoDoc,'2', "0", STR_PAD_LEFT ),
            'tipoGenera'=>'2',
            'numDocRelacion'=>$codigoGeneracion2,
            'fechaGeneracion'=>$traedetalleRete[0]->fecha,
             );
       
         
         
         /* insertando cuerpo documento*/
         //S$traedetalleRete
        
         
       
           
              
         
          if ( $this->docrelacionados_model->save( $dicVin ) && $this->identificacion_model->save( $data ) && $this->identificacion_model->save2( $data2 )) {
            $datasave  = array(
                'identificacion' =>1,
                'receptordocumen' => 1,
                'cuerpo' => 1,
                'resumen' => 1,
                'docVinculados' => 1,
            );
            echo json_encode( $data );
        } else {

            $datasave  = array(
                'error' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }
   
         
     }
   
    public function comNotCred(){
        
        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );

        
          $verificar = $this->identificacion_model->verificarComRete( $numeroControl, $codigoGeneracion );
        
        if($verificar){
            
             $data  = array(
                    'Ocu' => json_encode($verificar),
                );
                echo json_encode( $data );
            
        }else{
                $tablaResumen = $this->resumen_model->traedetalleRete( $numeroControl, $codigoGeneracion );
             $data  = array(
                    'Lib' => json_encode($tablaResumen),
                );
              //$this->session->set_userdata( "areafact",$tablaResumen[0]->areafact);
                echo json_encode( $data );
          
           
        }
       
    }
    
    public function CreaComRemi(){
        
        
        
        
        
        
        
    }
    
    
    
    
}
