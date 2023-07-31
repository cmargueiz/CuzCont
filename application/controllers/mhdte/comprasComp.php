<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class comprasComp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "mhdte/get_cat_model" );
        $this->load->model( "mhdte/cuerpodocumento_model" );
        $this->load->model( "mhdte/resumen_model" );
        $this->load->model( "mhdte/identificacion_model" );
        $this->load->model( "mhdte/serviciosgenerales_model" );
        $this->load->model( "mhdte/receptor_model" );
        $this->load->model( "mhdte/docrelacionados_model" );
        $this->load->model( "mhdte/integracion_model" );
        $this->load->library( 'Uuid' );
        $this->load->library( 'Lrenta' );

    }

    public function index() {
        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "dteMH/ComprasComp" );
        $this->load->view( "dteMH/modalPro" );
        $this->load->view( "dteMH/envioDte" );
        $this->load->view( "layouts/footer" );
    }

    public function agregar() {

        $codTdoc = "07";
        $version = "1";

        $txt1 = $this->input->post( "txt1" );
        $select1 = $this->input->post( "select1" );
        $txt2 = $this->input->post( "txt2" );
        $txt3 = $this->input->post( "txt3" );
        $txt4 = $this->input->post( "txt4" );
        $ctrlInterno = $this->input->post( "ctrlInterno" );
        $txt5 = $this->input->post( "txt5" );
        $numeroControl2 = $this->input->post( "numControl" );
        $SelloValida = $this->input->post( "SelloValida" );
        $codigoGeneracion2 = $this->input->post( "codGeneracion" );
        $select2 = $this->input->post( "select2" );

        //$getreceptor = $this->receptor_model->getreceptor( $numeroControl2, $codigoGeneracion2 );
        //  echo json_encode( $getreceptor );

        $codigoGeneracion = strtoupper( $this->uuid->v4() );

        $anio = date( "Y" );
        $numeroControl = $this->identificacion_model->corelativo( $anio );

        $data = array(
            'numeroControl' => $numeroControl->numeroControl+1,
        );
        $this->identificacion_model->corelativoUpdate( $anio, $data );

        // IDENTIFICACION DOCUMENTO
        $secuencia = str_pad( ( $numeroControl->numeroControl+1 ), 15, "0", STR_PAD_LEFT );
        $numeroControlFin = 'DTE-'.$codTdoc.'-CMPV0202-'.$secuencia;

        //fecha y hora

        $horaactual = date( "h:i:s" );
        $fechaactual = date( "Y-m-d" );

        // termina fecha y hora
        $item11 = $horaactual;
        $item10 = $fechaactual;

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
            'idReceptor'=>$txt3,
            'numeroControl' =>$numeroControlFin  ,
            'codigoGeneracion' => $codigoGeneracion,

        );

        //$traedetalleRete = $this->resumen_model->traedetalleRete( $numeroControl2, $codigoGeneracion2 );
        $tipoGenera="";


        if(is_numeric($select1)){
            $tipoGenera=2;
            $codigoGeneracion2=$codigoGeneracion2;
        }else{
            $tipoGenera=1;
            $codigoGeneracion2=$txt5;
        }


        $dicVin = array
            (
            'numeroControl' =>$numeroControlFin ,
            'codigoGeneracion' => $codigoGeneracion,
            //'tipoDoc'=>$traedetalleRete[0]->tipoDoc,
            'tipoDoc'=>str_pad( $select1, '2', "0", STR_PAD_LEFT ),
            'tipoGenera'=>$tipoGenera,
            'numDocRelacion'=>$codigoGeneracion2,
            'fechaGeneracion'=>$txt2,
        );

        /* insertando encabezado de compra*/
        $dataCompras = array
            (
            'codCompra'=> $txt1,
            'tipDocumento '=> $select1,
            'fecha'=> $txt2,
            'emisor'=> $txt3,
            'mes'=> $txt4,
            'dteInterno'=> $ctrlInterno,
            'serie'=> $txt5,
            'numeroControl'=> $numeroControl2,
            'codGeneracion'=> $codigoGeneracion2,
            'sellovalidacion'=> $SelloValida,
            'tipcompra'=>$select2,
            'tipPago'=> '',
        );      

        // ingresoEcompras


        if ( $this->docrelacionados_model->save( $dicVin ) && $this->identificacion_model->save( $data ) && $this->integracion_model->ingresoEcompras( $dataCompras ) && $this->identificacion_model->save2( $data2 ) ) {
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

    public function store(){
        $numeroControl2 = $this->input->post( "numControl" );
        $codigoGeneracion2 = $this->input->post( "codGeneracion" );
        $cantidad = $this->input->post( "item80" );
        $precio = $this->input->post( "item85" );
        $tipodocSelect = $this->input->post( "tipodocSelect" );
        $observacionesItem = $this->input->post( "observacionesItem" );
        $unidadMedida=$this->input->post( "item83" );
        $item =$this->input->post( "item72" );

        $dataCompras = array
            (         
            'numControl'=> $numeroControl2,
            'codGeneracion'=> $codigoGeneracion2,
            'cantidad'=> $cantidad,
            'descripcion'=> $observacionesItem,
            'precio'=> $precio,
            'item'=> $item
        );  




        if ( $this->integracion_model->ingresoDcompras( $dataCompras )) {

            $data = array(
                'OK' => 1,
            );
            echo json_encode( $data );
        } else {

            $datasave  = array(
                'error' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }


    }
    
    public function llenarTabla(){
        
        $numeroControl2 = $this->input->post( "numControl" );
        $codigoGeneracion2 = $this->input->post( "codGeneracion" );
        
        $impuestos =  $this->cuerpodocumento_model->getImpuestos();
        $fovial =    $impuestos[0]->valor;
        $cotrans =   $impuestos[1]->valor;
        $iva13 =    $impuestos[2]->valor;
        $iva1 =    $impuestos[5]->valor;
        $ivaPercibido=0;
        $totalGravado=0;
        $ivaResumen=0;
        
        $respuesta=$this->integracion_model->Rcompras( $numeroControl2,$codigoGeneracion2 );

            for ( $i = 0; $i<count( $respuesta ); $i++ ) {
                $totalGravado += ($respuesta[$i]->cantidad*$respuesta[$i]->precio);
                $ivaResumen +=$this->lrenta->caliva13( $respuesta[$i]->precio, $respuesta[$i]->cantidad, $iva13 );;


            }
            if ( $totalGravado >= 100 ) {
                $ivaPercibido =  $this->lrenta->IvaPercibido( $totalGravado ,$iva1);


            }

            $dataCompras = array
            (         
            'iva13'=> number_format($ivaResumen, 2, '.', '' ),
            'ivaPercibido'=> number_format($ivaPercibido, 2, '.', '' ),
            'montoPorFormaPag'=> number_format($totalGravado+$ivaResumen-$ivaPercibido, 2, '.', '' )
        );
            $data = array
            ( 
            'OK'=>'1',
            'data'=> $respuesta,
            'totales'=> $dataCompras
        );  
        echo json_encode( $data );
    }

    public function creacomprorete(){
         $codTdoc="07";
         $version="1";
        $montoretencion=0;$ivaretenido=0;
       
        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
       
          $txt1 = $this->input->post( "txt1" );
        $select1 = $this->input->post( "select1" );
        $txt2 = $this->input->post( "txt2" );
        $txt3 = $this->input->post( "txt3" );
        $txt4 = $this->input->post( "txt4" );
        $ctrlInterno = $this->input->post( "ctrlInterno" );
        $txt5 = $this->input->post( "txt5" );
      
        $SelloValida = $this->input->post( "SelloValida" );
       
        $select2 = $this->input->post( "select2" );

         
         
        $numeroControl2 = $this->input->post( "numControl" );
        $codigoGeneracion2 = $this->input->post( "codGeneracion" );
        
        $impuestos =  $this->cuerpodocumento_model->getImpuestos();
        $fovial =    $impuestos[0]->valor;
        $cotrans =   $impuestos[1]->valor;
        $iva13 =    $impuestos[2]->valor;
        $iva1 =    $impuestos[5]->valor;
        $ivaPercibido=0;
        $totalGravado=0;
        $ivaResumen=0;
        
        $respuesta=$this->integracion_model->Rcompras( $numeroControl2,$codigoGeneracion2 );

            for ( $i = 0; $i<count( $respuesta ); $i++ ) {
                $totalGravado += ($respuesta[$i]->cantidad*$respuesta[$i]->precio);
                $ivaResumen +=$this->lrenta->caliva13( $respuesta[$i]->precio, $respuesta[$i]->cantidad, $iva13 );;


            }
            if ( $totalGravado >= 100 ) {
                $ivaPercibido =  $this->lrenta->IvaPercibido( $totalGravado ,$iva1);


            }
         
         
         /* insertando cuerpo documento*/
         //S$traedetalleRete
       
            $montoretencion=$totalGravado;
            $ivaretenido=$ivaPercibido;
         if(is_numeric($select1)){
            $tipoGenera=2;
            $codigoGeneracion2=$codigoGeneracion2;
        }else{
            $tipoGenera=1;
            $codigoGeneracion2=$txt5;
        }

         
       
            $data3  = array(
                
            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'item'=>1,
            'tipDTRelacionado'=>str_pad("03",'2', "0", STR_PAD_LEFT ),
            'tipGenDoc'=>$tipoGenera,
            'numDocRelacionado'=>$codigoGeneracion2,
            'fechaGendoc'=>$txt2,
            'montoretencion'=>$montoretencion,
            'codRetencion'=>'22',
            'ivaRetenido'=>$ivaretenido,
            'descripcion'=>$respuesta[0]->descripcion,
            
            );  
              
         /* ingresando resumen*/
         # procedemos a covertir la cantidad en letras
        $this->load->helper('numeros');
        $valorletras = array(
            'leyenda' => num_to_letras($ivaretenido)
            , 'cantidad' => $ivaretenido
            );
       // echo json_encode($valorletras);
       //$valorletras['leyenda']
         
         
     $data4  = array(
                
            'numeroControl'=>$numeroControl,
            'codigoGeneracion'=>$codigoGeneracion,
            'totalMonSujRet'=>$montoretencion,
            'totalIvaRetenido'=>$ivaretenido,
            'valorLetrasIvaRet'=> $valorletras['leyenda'],
            
            );  
              
         $dataCompras = array
            (         
            'iva13'=> number_format($ivaResumen, 2, '.', '' ),
            'ivaPercibido'=> number_format($ivaPercibido, 2, '.', '' ),
            'montoPorFormaPag'=> number_format($totalGravado+$ivaResumen-$ivaPercibido, 2, '.', '' )
        );
            $data = array
            ( 
            'OK'=>'1',
            'data'=> '',
            'totales'=> $dataCompras
        );  
        
         
          if (  $this->cuerpodocumento_model->save( $data3 ) &&  $this->resumen_model->savetho( $data4,$numeroControl,$codigoGeneracion )) {
            $datasave  = array(
               
                'cuerpo' => 1,
                'resumen' => 1,
               
            );
            echo json_encode( $data );
        } else {

            $datasave  = array(
                'error' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $datasave );
        }
   
         
     }
   

}
