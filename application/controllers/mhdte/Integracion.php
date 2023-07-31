<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class integracion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model( "mhdte/resumen_model" );
        $this->load->model( "mhdte/integracion_model" );
         $this->load->model( "mhdte/cuerpodocumento_model" );
        $this->load->model( "mhdte/identificacion_model" );
        

        $this->load->library( 'Uuid' );
        $this->load->library( 'Lrenta' );

    }

    public function index() {

        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "dteMH/AutenticaMH" );
        $this->load->view( "layouts/footer" );

    }   
    public function IntegraCobol() {

        $this->load->view( "layouts/header" );
        $this->load->view( "layouts/aside" );
        $this->load->view( "dteMH/enviaCobol_ing" );
        $this->load->view( "layouts/footer" );

    }

    
    public function llenarTabla() {

        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
        $fecha='2023-05-04';
        
        $tablaResumen = $this->resumen_model->traedetallelee( $numeroControl,$fecha );
      
        echo json_encode( $tablaResumen );

    }

    
    public function archivotxt(){
        
        $fechatxt ="Integracion";
       
        $estado = 0;
$arch="";

// variable $arc está vacia

//$arch = fopen("//192.120.55.195/sys2000/ACCESORIOS/FAUSTO/Facturacion Electronica/Integracion/".$fechatxt.".txt", "w+");
$arch = fopen("F:/Integracion/".$fechatxt.".txt", "w+");

fwrite($arch, "");

fclose($arch);
        $respuesta = $this->resumen_model->consultaArchivo( $estado, $fechatxt );
//echo json_encode($respuesta);
 //$ar = fopen("//192.120.55.195/sys2000/ACCESORIOS/FAUSTO/Facturacion Electronica/Integracion/".$fechatxt.".txt", "a") or       
 $ar = fopen("F:/Integracion/".$fechatxt.".txt", "a") or   
fputs($ar,str_pad(substr ("topodoc", 0, 2),'2', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("tipodoc", 0, 2),'2', " ", STR_PAD_LEFT ));
        fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("numeroControl", 0, 31),'32', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("codigoGeneracion", 0, 36),'37', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("numrecepcionMH", 0, 40),'41', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("Numerocontrolint", 0, 20),'21', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("fecha", 0, 10),'11', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("hora", 0, 8),'9', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("cliente", 0, 8),'9', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("nit", 0, 17),'18', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("numDoc", 0, 10),'11', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("ncr", 0, 9),'10', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("dirComplemento", 0, 40),'41', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("Departamento", 0, 2),'3', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("Municipio", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("condicionOpera", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("codFormaPago", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("montoPorFormaPag", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("refModalidadPago", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("plazo", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("periodoPlazo", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("numPagoElecNPE", 0, 20),'21', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("incoterms", 0, 2),'3', " ", STR_PAD_LEFT ));
        fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("descincoterms", 0, 20),'21', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("ConsumoInterno", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("item", 0, 4),'5', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("tipDTRelacionado", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("numDocRelacionado", 0, 36),'37', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("fechaGendoc", 0, 10),'11', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("cantidad", 0, 14),'15', " ", STR_PAD_LEFT ));
        fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("codigo", 0, 20),'21', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("areafact", 0, 3),'4', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("descripcion", 0, 40),'41', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("precioUnitario", 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("ventasGravadas", 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("ivaItem", 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("montoretencion", 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("codRetencion", 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("ivaRetenido", 0, 14),'15', " ", STR_PAD_LEFT ));
        fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("observacionesItem", 0, 100),'101', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("observacionesItems", 0, 100),'101', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("ivaPercibido", 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("sacos", 0, 4),'4', " ", STR_PAD_LEFT ));
        fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("fexDestino", 0, 100),'101', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("Contrato", 0, 15),'16', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ("fovial", 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ("cotrans", 0, 14),'15', " ", STR_PAD_LEFT ));              
fputs($ar, "\n");
fclose($ar);            
        for ( $i = 0; $i<count( $respuesta ); $i++ ) {

            $response = $this->resumen_model->traedetalle( $respuesta[$i]->numeroControl, $respuesta[$i]->codigoGeneracion );
            if($response){
                
                  for ( $j = 0; $j<count( $response ); $j++ ) {
                      $area='';
            //$ar = fopen("//192.120.55.195/sys2000/ACCESORIOS/FAUSTO/Facturacion Electronica/Integracion/".$fechatxt.".txt", "a") or
            $ar = fopen("F:/Integracion/".$fechatxt.".txt", "a") or
          //  $ar = fopen("C:/Users/LENOVO/Documents".$fechatxt.".txt", "a") or
    die("Problemas en la creacion");

fputs($ar,str_pad(substr ($response[$j]->tipodoc, 0, 2),'2', " ", STR_PAD_LEFT ));
                      fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->numeroControl, 0, 31),'32', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->codigoGeneracion, 0, 36),'37', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->numrecepcionMH, 0, 40),'41', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->Numerocontrolint, 0, 20),'21', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->fecha, 0, 10),'11', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->hora, 0, 8),'9', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->cliente, 0, 8),'9', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->nit, 0, 17),'18', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->numDoc, 0, 10),'11', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->ncr, 0, 9),'10', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->dirComplemento, 0, 40),'41', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->Departamento, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->Municipio, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->condicionOpera, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->codFormaPago, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->montoPorFormaPag, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->refModalidadPago, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->plazo, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->periodoPlazo, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->numPagoElecNPE, 0, 20),'21', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->incoterms, 0, 2),'3', " ", STR_PAD_LEFT ));
                       fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->descincoterms, 0, 20),'21', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->ConsumoInterno, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->item, 0, 4),'5', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->tipDTRelacionado, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->numDocRelacionado, 0, 36),'37', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->fechaGendoc, 0, 10),'11', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr (number_format( $response[$j]->cantidad, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
                       fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->codigo, 0, 20),'21', " ", STR_PAD_RIGHT ));
                      switch ($response[$j]->areafact){
                              CASE 'CC': $area='03'; break;
                              CASE 'CF': $area='04'; break;
                              CASE 'CG': $area='02'; break;
                              CASE 'CO': $area='05'; break;
                              CASE 'EX': $area='07'; break;
                              CASE 'OF': $area='01'; break;
                              CASE 'SE': $area='08'; break;
                              CASE 'SG': $area='00'; break;
                               default: $area='09'; break;
                      }
fputs($ar,str_pad(substr ($area, 0, 3),'4', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->descripcion, 0, 40),'41', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr (number_format($response[$j]->precioUnitario, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr (number_format($response[$j]->ventasGravadas, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr (number_format($response[$j]->ivaItem, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr (number_format($response[$j]->montoretencion, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->codRetencion, 0, 2),'3', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr (number_format($response[$j]->ivaRetenido, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
                       fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->observacionesItem, 0, 100),'101', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->observacionesItems, 0, 100),'101', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr (number_format($response[$j]->ivaPercibido, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->sacos, 0, 4),'4', " ", STR_PAD_LEFT ));
                      fputs($ar,str_pad('','1', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr ($response[$j]->fexDestino, 0, 100),'101', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr ($response[$j]->Contrato, 0, 15),'16', " ", STR_PAD_RIGHT ));
fputs($ar,str_pad(substr (number_format($response[$j]->fovial, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
fputs($ar,str_pad(substr (number_format($response[$j]->cotrans, 2, '.', '' ), 0, 14),'15', " ", STR_PAD_LEFT ));
//fputs($ar,str_pad($response[$j]->nombreTributo,'301', " ", STR_PAD_LEFT ));
//fputs($ar,str_pad($response[$j]->fovial,'41', " ", STR_PAD_LEFT ));
//fputs($ar,str_pad($response[$j]->cotrans,'41', " ", STR_PAD_LEFT ));
            
            
            

  fputs($ar, "\n");
  fclose($ar);
 
            
                         }
                
            }
                  }


        
        
        
    }
    
    
    public function leerArchivo(){
        
         $fechatxt = $this->input->post( "fechatxt" );
        
        //$fp = fopen("F:/CobolEnvio/".$fechatxt.".txt", "r");
        $fp = fopen("F:/CobolEnvio/IVAFACX.txt", "r");
        fseek($fp, 28);
$data  = array();
        $row = array();
        
        
        $this->integracion_model->BorrarTabla(  );
        
        while(!feof($fp)){
            $linea = fgets($fp);
            $linea = preg_replace("/[\r\n|\n|\r]+/", " ", $linea);;
           // echo $linea;
            $porciones = explode("*", $linea);
           
          $row  = array(
            'c1'=>$porciones[1],
            'c2'=>$porciones[2],
            'c3'=>$porciones[3],
            'c4'=>'DTE'.$porciones[4],
            'c5'=>$porciones[5],
            'c6'=>json_encode($porciones),
            'c7'=>$porciones[0],
            );
         //  array_push($data,$row);
         //   $rows = array();
          //InArchivo
             echo json_encode( $row );
          
            if ( $this->integracion_model->InArchivo( $row ) ) {
            $data  = array(
                'OK' => '1',
            );
           
        }
        }
        fclose($fp);

          $this->integracion_model->BorrarTabla2();
        
        
        
        
        
    }
    
    public function agrupainsertar(){
      $agrupado=  $this->integracion_model->agrupa();
        
        
        
       
      
       
        
        $anio = date( "Y" );
        $fecha=date("Y-m-d");
        $hora = date("h:i:s");
        
       
       
         for ( $i = 0; $i<count( $agrupado ); $i++ ) {
              echo ("Inicio: ".count( $agrupado )."<br>");
              $c4 =json_encode( $agrupado[$i]->c4 );
        $c6 = json_decode($agrupado[$i]->c6 );
         $codigoGeneracion = strtoupper( $this->uuid->v4() );
                     
             
              $numeroControl = $this->identificacion_model->corelativo( $anio );

                    $data = array(
                        'numeroControl' => $numeroControl->numeroControl+1,
                    );
                    $this->identificacion_model->corelativoUpdate( $anio, $data );
        
        $tipodocSelect = $this->input->post( "tipodocSelect" );
        $item11 = $hora;
        $item10 = $fecha;
        $txt1 = str_replace(' ', '', $c6[10]);
        $codTdoc=str_replace(' ', '', $c6[0]);
        $version="";
        if($codTdoc=='01'){
             
            $version=1;
        }else{
             
             $version=3;
        }
            
             
             // IDENTIFICACION DOCUMENTO
         $secuencia=str_pad( ( $numeroControl->numeroControl+1 ), 41, "0", STR_PAD_LEFT );
        $numeroControlFin='DTE-'.$codTdoc.'-123456789-'.$secuencia;
      
                 
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
            'idReceptor'=>$txt1,
            'numeroControl' =>$numeroControlFin  ,
            'codigoGeneracion' => $codigoGeneracion,
         
              );
             
             
        if ( $this->identificacion_model->save( $data ) && $this->identificacion_model->save2( $data2 ) ) {
            $datasave  = array(
                'identificacion' => 'ok',
                'receptordocumen' => 'ok',
            );
            echo json_encode( $data );
        } else {

            $datasave  = array(
                'error' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }
        
              echo ("Ingreso la facturaabuscar: ".$c4);
                       echo ("<br>");
        
     /**********************************    Ingreso CuerpoDocumento          ***************************************/         
             
             
              if(($codTdoc=='01' || $codTdoc=='03') & ($c6[17]!="CG")){ //factura
                  
                $tablaResumen = $this->integracion_model->selectTodo( $c4 );  
                  echo ("<br> contando fila: ". count( $tablaResumen ));
                  
                   for ( $j = 0; $j<count( $tablaResumen ); $j++ ) { 
                       $cc6 = json_decode($tablaResumen[$j]->c6 );
                       echo ("<br> Esta son ls filas ".count( $tablaResumen ));
                       echo ("<br>");
                       echo ("<br>");
        $data  = array(

            'numeroControl'=>$numeroControlFin,
            'codigoGeneracion'=>$codigoGeneracion,
            'item'=>$i , //$c6[14]
            'tipoItem'=>3,
            'tipoDonacion'=>'',
            'depreciacion'=>'',
            'cantidad'=>$cc6[41],
            'codigo'=>$cc6[16],
            'codTributo'=>'',
            'unidadMedida'=>'59', //hacerel join
            'descripcion'=>$cc6[18],
            'precioUnitario'=>$cc6[19],
            'valorUnitario'=>'',
            'descuentos'=>'0.00',
            'ventasNSujetas'=>'0.00',
            'ventasExentas'=>'0.00',
            'ventasGravadas'=>$cc6[20],
            'exportaciones'=>'0.00',
            'valorDonado'=>'0.00',
            'ventas'=>$cc6[20],
            'codigoTributo'=>'["20"]',
            'precSugVenta'=>$cc6[19],
            'CargosAbono'=>'0.00',
            'ivaItem'=>$cc6[21],
            'montoretencion'=>'0.00',
            'areafact'=>$cc6[17],

        );
      
        if ( $this->cuerpodocumento_model->save( $data ) ) {
            
            echo json_encode( $data );
        } else {

            $data  = array(
                'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }

              }
             
        }
                      
            /* if($codTdoc=='03'){ //credito
                  
                $tablaResumen = $this->integracion_model->selectTodo( $c4 );  
                  echo ("<br> contando fila Credito: ". count( $tablaResumen ));
                  
                   for ( $j = 0; $j<count( $tablaResumen ); $j++ ) { 
                       $cc6 = json_decode($tablaResumen[$j]->c6 );
                       echo ("<br> Esta son ls filas ".count( $tablaResumen ));
                       echo ("<br>");
                       echo ("<br>");
       $data  = array(

            'numeroControl'=>$numeroControlFin,
            'codigoGeneracion'=>$codigoGeneracion,
            'item'=>$i , //$c6[14]
            'tipoItem'=>3,
            'tipoDonacion'=>'',
            'depreciacion'=>'',
            'cantidad'=>$cc6[41],
            'codigo'=>$cc6[16],
            'codTributo'=>'',
            'unidadMedida'=>'59', //hacerel join
            'descripcion'=>$cc6[18],
            'precioUnitario'=>$cc6[19],
            'valorUnitario'=>'',
            'descuentos'=>'0.00',
            'ventasNSujetas'=>'0.00',
            'ventasExentas'=>'0.00',
            'ventasGravadas'=>$cc6[20],
            'exportaciones'=>'0.00',
            'valorDonado'=>'0.00',
            'ventas'=>$cc6[20],
            'codigoTributo'=>'["20"]',
            'precSugVenta'=>$cc6[19],
            'CargosAbono'=>'0.00',
            'ivaItem'=>$cc6[21],
            'montoretencion'=>'0.00',
            'areafact'=>$cc6[17],

        );
      
        if ( $this->cuerpodocumento_model->save( $data ) ) {
            
            echo json_encode( $data );
        } else {

            $data  = array(
                'OK' => $this->session->set_flashdata( "error", "No se pudo guardar la informacion" ),
            );
            echo json_encode( $data );
        }

              }
             
        }
             */
        } //fin for
        
        
       }
        
       
    public function ingresomasivo(){
        
       
         $fecha=date("Y-m-d");
       
        
        for($i=0;$i<51;$i++){
             $hora = date("h:i:s");
        $codTdoc='14';
        
         $codigoGeneracion = strtoupper( $this->uuid->v4() );
                
        $anio = date( "Y" );
        $numeroControl = $this->identificacion_model->corelativo( $anio );

                    $data = array(
                        'numeroControl' => $numeroControl->numeroControl+1,
                    );
                    $this->identificacion_model->corelativoUpdate( $anio, $data );
     
         // IDENTIFICACION DOCUMENTO
         $secuencia=str_pad( ( $numeroControl->numeroControl+1 ), 41, "0", STR_PAD_LEFT );
        //$numeroControlFin='DTE-'.$codTdoc.'-123456789-'.$secuencia;
        $numeroControlFin='DTE-'.$codTdoc.'-CMPV0202-'.$secuencia;
      $horaactual= date("h:i:s");
            
            
            /********* otro documento*******/
            
             $codTdoc='07';
        
         $codigoGeneracion2 = strtoupper( $this->uuid->v4() );
                
        $anio = date( "Y" );
        $numeroControl2 = $this->identificacion_model->corelativo( $anio );

                    $data = array(
                        'numeroControl' => $numeroControl2->numeroControl+1,
                    );
                    $this->identificacion_model->corelativoUpdate( $anio, $data );
     
         // IDENTIFICACION DOCUMENTO
         $secuencia2=str_pad( ( $numeroControl2->numeroControl+1 ), 41, "0", STR_PAD_LEFT );
        //$numeroControlFin='DTE-'.$codTdoc.'-123456789-'.$secuencia;
        $numeroControlFin2='DTE-'.$codTdoc.'-CMPV0202-'.$secuencia2;
      $horaactual= date("h:i:s");
            
            
             $data  = array(
                'OK' => $numeroControlFin,
            );
            echo json_encode( $data );
        
         echo json_encode($this->integracion_model->ingresocuerpo( $numeroControlFin, $codigoGeneracion ,$numeroControlFin2,$codigoGeneracion2));
         echo json_encode($this->integracion_model->ingresoresumen( $numeroControlFin, $codigoGeneracion ,$numeroControlFin2,$codigoGeneracion2));
         echo json_encode($this->integracion_model->ingresoidentificador( $numeroControlFin, $codigoGeneracion,$numeroControlFin2,$codigoGeneracion2,$fecha, $hora));
         echo json_encode($this->integracion_model->ingresoreceptordoc( $numeroControlFin, $codigoGeneracion ,$numeroControlFin2,$codigoGeneracion2,$fecha));
        // falta docurelacionado    
            
            
        sleep(1);
        }
    }
    
}