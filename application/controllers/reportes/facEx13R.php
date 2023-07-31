<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class facEx13R extends CI_Controller {
    
    public function __construct(){
		parent::__construct();
		if (!$this->session->userdata("login")) {
			redirect(base_url());
		}
        $this->load->model( "mhdte/cuerpodocumento_model" );
         $this->load->model( "mhdte/emisor_model" );
        $this->load->model( "mhdte/receptor_model" );
	}

    public function index() {

    }

    public function facEx13R() {

        $this->load->library( 'pdf/pdfCI' );
        
       // $numeroControl='DTE-14-123456789-000000000000464';
       // $codigoGeneracion='5140CD1D-7409-48A5-AD0B-DFF72C7842AC';
        $numeroControl = $this->input->post( "numeroControl" );
        $codigoGeneracion = $this->input->post( "codigoGeneracion" );
        
         $respuesta = $this->cuerpodocumento_model->getParaResumen( $numeroControl, $codigoGeneracion );
           $emisor = $this->emisor_model->getEmisor();
        $receptor = $this->receptor_model->getreceptor($numeroControl ,$codigoGeneracion);
         $impuestos =  $this->cuerpodocumento_model->getImpuestos();
        $respuestaMH= $this->receptor_model->getMH($numeroControl ,$codigoGeneracion);
        $iva13 =    $impuestos[2]->valor;
        $renta =    $impuestos[4]->valor;
         $ivaResumen = 0.00;
        $totalGravado = 0.00; 
        $ivaRetenido = 0.0;
        $fovialRet = 0.0;
        $cotransRet = 0.0;
        $rentaTotal=0.00;
        

        // $pdf = new PDF_Code128( 'P', 'mm', array( 140, 210 ) );
        $pdf = new PDF_Code128( 'P', 'mm', 'letter' );
        $pdf->SetMargins( 15, 15, 15 );
        $pdf->AddPage();

        $nameFile=$codigoGeneracion;
        # Logo de la empresa formato png #
        //$pdf->Image( './img/logo.png', 165, 12, 35, 35, 'PNG' );
        $fecha= date('Y-m-d',strtotime($respuestaMH[0]->fhProcesamiento));
        $pdf->Image( index_page()."?code=https://webapp.dtes.mh.gob.sv/consultaPublica?ambiente=01&codGen=".$codigoGeneracion."&fechaEmi=".$fecha, 170, 17.5, 27, 27, "png" );
        $pdf->Image( base_url()."/assets/build/images/cuzlogo.png", 20, 8, 14, 14, "png" );

        # Encabezado y datos de la empresa #
        $pdf->SetFont( 'Arial', 'B', 8 );
        $pdf->SetTextColor( 32, 100, 210 );
       
        $pdf->Cell( 25 );
        $pdf->Cell( 59, 2, utf8_decode( strtoupper( "COOPERATIVA CUZCACHAPA DE R.L" ) ), 0, 0, 'L' );
        $pdf->SetFont( 'Arial', 'B', 6 );
        $pdf->Cell( 97,4, utf8_decode( strtoupper( "DOCUMENTO TRIBUTARIO ELECTRÓNICO - FACTURA DE SUJETO EXCLUIDO" ) ), 1, 0, 'C' );
        $pdf->SetTextColor( 39, 39, 51);
        $pdf->Ln( 4 );$pdf->Cell( 10);
        $pdf->Cell( 63, 9, utf8_decode( "NIT: ".$emisor[0]->nit ), 0, 0, 'L' );
        $pdf->Cell( 11 );
        $pdf->Cell( 97, 9, utf8_decode( "Cód. Generación: ".$codigoGeneracion ), 'LR', 0, 'L' );
        $pdf->Ln( 3 );
        $pdf->Cell( 10 );
        $pdf->Cell( 63, 9, utf8_decode( "NCR: ".$emisor[0]->ncr ), 0, 0, 'L' );
        $pdf->Cell( 11 );
        $pdf->Cell( 97, 9, utf8_decode( "Núm. Control: ".$numeroControl ), 'LR', 0, 'L' );
        $pdf->Ln( 3 );
        $pdf->Cell( 10 );
        $pdf->Cell( 63, 9, utf8_decode( "Actividad económica: ".$emisor[0]->desactEco ), 0, 0, 'L' );
        $pdf->Cell( 11 );
        $pdf->Cell( 97, 9, utf8_decode( "Sello de Recepción:".$respuestaMH[0]->selloRecibido ), 'LR', 0, 'L' );
        $pdf->Ln( 3 );
        $pdf->Cell( 10 );$pdf->SetFont( 'Arial', 'B', 5.5 );
        $pdf->Cell( 63, 9, utf8_decode( "Dirección: ".$emisor[0]->Direccion ), 0, 0, 'L' );
        $pdf->Cell( 11 );$pdf->SetFont( 'Arial', 'B', 6 );
        $pdf->Cell( 97, 9, utf8_decode( "Módelo de Facturación: Mod. facturación Previo" ), 'LR', 0, 'L' );
        $pdf->Ln( 3 );
        $pdf->Cell( 10 );
        $pdf->Cell( 63, 9, utf8_decode( "Teléfono: ".$emisor[0]->telefono ), 0, 0, 'L' );
        $pdf->Cell( 11 );
        $pdf->Cell( 97, 9, utf8_decode( "Tipo de Transmisión: Normal" ), 'LR', 0, 'L' );
        $pdf->Ln( 3 );
        $pdf->Cell( 10 );
        $pdf->Cell( 63, 9, utf8_decode( "Email: ".$emisor[0]->correo ), 0, 0, 'L' );
        $pdf->Cell( 11 );
        $pdf->Cell( 97, 9, utf8_decode( "Fecha y Hora de Generación:".$respuestaMH[0]->fhProcesamiento ), 'LRB', 0, 'L' );
        $pdf->Ln( 3 );
        $pdf->Cell( 10 );
        $pdf->Cell( 63, 9, utf8_decode( "Establecimiento: Casa Matriz" ), 0, 0, 'L' );
       
        $pdf->Cell( 11 );
        $pdf->Cell( 97 );
        $pdf->SetFont( 'Arial', 'B', 5.5 );
        $pdf->Ln( 3 );
        $pdf->Cell( 10 );
        $pdf->Cell( 63, 9, utf8_decode( "Nombre Comercial: ".$emisor[0]->nomComercial ), 0, 0, 'L' );
        $pdf->Cell( 11 );
        $pdf->Cell( 97, 9, utf8_decode( '' ), 0, 0, 'L' );
        $pdf->Cell( 15 );

        $pdf->SetFont( 'Arial', '', 8 );
        $pdf->SetTextColor( 39, 39, 51 );
        $pdf->Cell( 10 );
        $pdf->Cell( 150, 2, utf8_decode( "" ), 0, 0, 'L' );

        // espacio de identificacion cliente
        $pdf->Ln( 10 );

        $pdf->SetFont( 'Arial', '', 8 );
        $pdf->SetTextColor( 39, 39, 51 );
        $pdf->Cell( 13, 7, utf8_decode( "Cliente:" ), 'LRT', 0 );
        $pdf->SetTextColor( 97, 97, 97 );
         if (strlen( $receptor[0]->NomDenominacion  )>30){
             $pdf->SetFont( 'Arial', '', 7 );
         }
        $pdf->Cell( 60, 7, utf8_decode( $receptor[0]->NomDenominacion  ), 'LRT', 0, 'L' );
        $pdf->SetFont( 'Arial', '', 8 );
        $pdf->SetTextColor( 39, 39, 51 );
       if( $receptor[0]->tipDoc==36){
            $txtDoc="NIT";
            $docVisto=$receptor[0]->nit;
        }else if ($receptor[0]->tipDoc==13){
            $txtDoc="DUI";
            $docVisto=$receptor[0]->numDoc;
        }else{
            $txtDoc="OTRO";
             $docVisto=$receptor[0]->numDoc;
            
        }
        $pdf->Cell( 28, 7, utf8_decode( "Tipo Doc: ".$txtDoc ), 'LRT', 0, 'L' );
        $pdf->SetTextColor( 97, 97, 97 );
        $pdf->Cell( 40, 7, utf8_decode( "N°: ".$docVisto ), 'LRT', 0, 'L' );
        $pdf->SetTextColor( 39, 39, 51 );
        $pdf->Cell( 7, 7, utf8_decode( "Tel:" ), 'LRT', 0, 'L' );
        $pdf->SetTextColor( 97, 97, 97 );
        $pdf->Cell( 33, 7, utf8_decode( $receptor[0]->telReceptor ), 'LRT', 0 );
        $pdf->SetTextColor( 39, 39, 51 );

        $pdf->Ln( 7 );

        $pdf->SetTextColor( 39, 39, 51 );
        $pdf->Cell( 13, 7, utf8_decode( "email:" ), 'LRTB', 0 );
        $pdf->SetTextColor( 97, 97, 97 );
        $pdf->Cell( 60, 7, utf8_decode( $receptor[0]->correoReceptor ), 'LRTB', 0 );
        $pdf->Cell( 108, 7, utf8_decode( "Direccion: ".$receptor[0]->dirComplemento ), 'LRTB', 0 );
         

        $pdf->Ln( 7 );

         # Tabla de productos #
        $pdf->SetFont( 'Arial', '', 8 );
        $pdf->SetFillColor( 23, 83, 201 );
        $pdf->SetDrawColor( 23, 83, 201 );
        $pdf->SetTextColor( 255, 255, 255 );
        $pdf->Cell( 7, 8, utf8_decode( "item" ), 1, 0, 'C', true );
        $pdf->Cell( 12, 8, utf8_decode( "Cant." ), 1, 0, 'C', true );
        $pdf->Cell( 86, 8, utf8_decode( "Descripción" ), 1, 0, 'C', true );
        $pdf->Cell( 25, 8, utf8_decode( "Precio" ), 1, 0, 'C', true );
        $pdf->Cell( 19, 8, utf8_decode( "Renta" ), 1, 0, 'C', true );
        $pdf->Cell( 32, 8, utf8_decode( "Subtotal" ), 1, 0, 'C', true );

        $pdf->Ln( 8 );

        $pdf->SetTextColor( 39, 39, 51 );
        $pdf->SetFont( 'Arial', '', 7 );
        /*----------  Detalles de la tabla  ----------*/
        for ( $i = 0; $i<count( $respuesta ); $i++ ) {
        $pdf->Cell( 7, 6, $respuesta[$i]->item, 'L', 0, 'C' );
        $pdf->Cell( 12, 6, $respuesta[$i]->cantidad, 'L', 0, 'C' );
        $pdf->Cell( 86, 6, utf8_decode( $respuesta[$i]->descripcion ), 'L', 0, 'C' );
        $pdf->Cell( 25, 6, utf8_decode( $respuesta[$i]->precioUnitario ), 'L', 0, 'C' );
        $pdf->Cell( 19, 6, utf8_decode( trim($respuesta[$i]->retencionRenta,'"') ), 'L', 0, 'C' );
        $pdf->Cell( 32, 6, utf8_decode( $respuesta[$i]->subtotal ), 'LR', 0, 'C' );
        $pdf->Ln( 6 );
        $ivaResumen += $respuesta[$i]->ivaItem;
       
        $totalGravado += $respuesta[$i]->subtotal;
        $rentaTotal+=floatval(trim($respuesta[$i]->retencionRenta,'"'));
        }
        /*----------  Fin Detalles de la tabla  ----------*/

         $pdf->SetFont( 'Arial', 'B', 7 );

        # Impuestos & totales #
        $pdf->Cell( 100, 7, utf8_decode( '' ), 'T', 0, 'C' );
        $pdf->Cell( 25, 7, utf8_decode( '' ), 'T', 0, 'C' );
        $pdf->Cell( 22, 7, utf8_decode( "SUBTOTAL" ), 'T', 0, 'C' );
        $pdf->Cell( 34, 7, utf8_decode( $totalGravado ), 'T', 0, 'C' );

        $pdf->Ln( 5 );

        $pdf->Cell( 100, 7, utf8_decode( '' ), '', 0, 'C' );
        $pdf->Cell( 25, 7, utf8_decode( '' ), '', 0, 'C' );
        $pdf->Cell( 22, 7, utf8_decode( "-IVA (".($iva13*100)."%)" ), '', 0, 'C' );
        $pdf->Cell( 34, 7, utf8_decode( $ivaResumen ), '', 0, 'C' );
        $pdf->Ln( 5 );
        $pdf->Cell( 100, 7, utf8_decode( '' ), '', 0, 'C' );
        $pdf->Cell( 25, 7, utf8_decode( '' ), '', 0, 'C' );
        $pdf->Cell( 22, 7, utf8_decode( "Total " ), '', 0, 'C' );
        $pdf->Cell( 34, 7, utf8_decode( $totalGravado - $ivaResumen), '', 0, 'C' );
        $pdf->Ln( 5 );
        $pdf->Cell( 100, 7, utf8_decode( '' ), '', 0, 'C' );
        $pdf->Cell( 25, 7, utf8_decode( '' ), '', 0, 'C' );
        $pdf->Cell( 22, 7, utf8_decode( "- Renta (".($renta*100)."%)" ), '', 0, 'C' );
        $pdf->Cell( 34, 7, utf8_decode( $rentaTotal ), '', 0, 'C' );
        
        $pdf->Ln( 5 );
        $pdf->Cell( 100, 7, utf8_decode( '' ), '', 0, 'C' );
        $pdf->Cell( 25, 7, utf8_decode( '' ), '', 0, 'C' );
        $pdf->Cell( 22, 7, utf8_decode( "TOTAL A PAGAR" ), 'T', 0, 'C' );
        $pdf->Cell( 34, 7, utf8_decode( $totalGravado-$rentaTotal -$ivaResumen), 'T', 0, 'C' );

       
        

        # Codigo de barras #
        //$pdf->SetFillColor( 39, 39, 51 );
        //$pdf->SetDrawColor( 23, 83, 201 );
        //$pdf->Code128( 72, $pdf->GetY(), "COD000001V0001", 70, 20 );
        //$pdf->SetXY( 12, $pdf->GetY()+21 );
        //$pdf->SetFont( 'Arial', '', 12 );
        //$pdf->MultiCell( 0, 5, utf8_decode( "COD000001V0001" ), 0, 'C', false );

        # Nombre del archivo PDF #
        $pdf->Output( "I", substr($codigoGeneracion, -8).".pdf", true );
    }

}

/* End of file PruebaPdf.php */
/* Location: ./application/controllers/PruebaPdf.php */