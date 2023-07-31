<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class integracion_model extends CI_Model {

    public function save( $data ) {
        return $this->db->insert( "resumen", $data );
    }

    public function InArchivo(  $data ) {
       
        return $this->db->insert("integracion",$data);
       
    } 
    public function BorrarTabla() {
       
         $this->db->empty_table("integracion");
       
    } 
    public function BorrarTabla2() {
       $this->db->where("c1","CodigoGeneracion ");
         $this->db->empty_table("integracion");
        
       
    }

 
public function agrupa() {
     $this->db->select("c4,c6");
    $this->db->from("integracion");
         
    $this->db->group_by("c4");
    $resultados=$this->db->get();
      return $resultados->result();  
       
    }

public function selectTodo($numeroControl){
    /*$this->db->select("c4,c6");
    $this->db->where("c4",$numeroControl);
		
    $this->db->from("integracion");
    
    $resultados=$this->db->get();*/
     $query = 'SELECT c4,c6 FROM integracion WHERE c4 ='.$numeroControl.'';
    
     $resultados = $this->db->query( $query );
        return $resultados->result();

}
public function savePartida( $data ) {
        return $this->db->insert( "tblpartidacontable", $data );
    }
public function consultaPartida( $numeroControl,$codigoGeneracion ) {
        
        $this->db->where("numControlFact",$numeroControl);
		$this->db->where("codigoGeneracion",$codigoGeneracion);
		$resultados = $this->db->get("tblpartidacontable");
		return $resultados->result();
    }
    
    
public function ingresocuerpo($numeroControl,$codigoGeneracion,$numeroControl2,$codigoGeneracion2){
    $ve='{"rentaMenos":"1.88","ivaRetenido":"16.25"}';
    
    
$query = "INSERT INTO cuerpodocumento ( numeroControl, codigoGeneracion, item, tipoItem, tipoDonacion, depreciacion, tipDTRelacionado, tipGenDoc, numDocRelacionado, fechaGendoc, cantidad, codigo, areafact, codTributo, unidadMedida, descripcion, precioUnitario, valorUnitario, descuentos, ventasNSujetas, ventasExentas, ventasGravadas, exportaciones, valorDonado, ventas, codigoTributo, precSugVenta, CargosAbono, ivaItem, montoretencion, codRetencion, ivaRetenido, fechaIni, fechaFin, codLiquidacion, canDocumentos, valorOpLiq, valNoPercepcion, descNoPercepcion, observacionesItem, observacionesItems, subtotal, ivaOpLiq, montoSinIva, ivaPercibido, comision, porcComision, IvaComision, ValorLiqPagar, valorLetras, sacosEsp) VALUES
('".$numeroControl."', '".$codigoGeneracion."',  '1', '3', NULL, NULL, NULL, NULL, NULL, NULL, '1', '5', NULL, NULL, '01', 'UVA S.H.G.', '125', NULL, NULL, NULL, NULL, '125', NULL, NULL, '125', NULL, NULL, NULL, '16.25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LIQUIDACION 057301 COS.2223', '".$ve."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
";
    
        $resultados = $this->db->query( $query );
        return $resultados;
    
    $query = "INSERT INTO cuerpodocumento ( numeroControl, codigoGeneracion, item, tipoItem, tipoDonacion, depreciacion, tipDTRelacionado, tipGenDoc, numDocRelacionado, fechaGendoc, cantidad, codigo, areafact, codTributo, unidadMedida, descripcion, precioUnitario, valorUnitario, descuentos, ventasNSujetas, ventasExentas, ventasGravadas, exportaciones, valorDonado, ventas, codigoTributo, precSugVenta, CargosAbono, ivaItem, montoretencion, codRetencion, ivaRetenido, fechaIni, fechaFin, codLiquidacion, canDocumentos, valorOpLiq, valNoPercepcion, descNoPercepcion, observacionesItem, observacionesItems, subtotal, ivaOpLiq, montoSinIva, ivaPercibido, comision, porcComision, IvaComision, ValorLiqPagar, valorLetras, sacosEsp) VALUES
    
    ( '".$numeroControl2."', '".$codigoGeneracion2."', '1', NULL, NULL, NULL, '14', '2', '".$codigoGeneracion."', '2023-06-29', NULL, NULL, NULL, NULL, NULL, 'UVA S.H.G. LIQUIDACION 057301 COS.2223', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'C4', '16.25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)";
    
        $resultados = $this->db->query( $query );
        return $resultados;
    
    
}  
    public function ingresoresumen($numeroControl,$codigoGeneracion,$numeroControl2,$codigoGeneracion2){
    $ve='[{"codigo":"20","descripcion":"Impuesto al Valor Agregado 13%","valor":16.25}]';
        
$query = "INSERT INTO resumen (numeroControl, codigoGeneracion, totalNoSuj, totalExenta, totalGravada, totalOpeExpo, totalOperaciones, totalDonacion, sumOpSinImpu, montoGloDescNS, montoGloDescVE, montoGloDescVG, montoGloDescVA, montoGloDescOP, porcMontoGloDesc, totalDescBonRev, resCodTributo, nombreTributo, valorTributo, subTotal, totalMonSujRet, ivaPercibido, ivaPercibidoLiq, ivaRetenido, retencionRenta, seguro, flete, montoTotalOp, totalCargoBasImpon, totalAPagar, total, totalIvaRetenido, valorLetrasIvaRet, valorLetras, iva13, saldoAFavor, condicionOpera, codFormaPago, montoPorFormaPag, refModalidadPago, plazo, periodoPlazo, numPagoElecNPE, incoterms, descincoterms, observaciones) VALUES
('".$numeroControl."', '".$codigoGeneracion."', '0.00', '0.00', '125', NULL, '125', NULL, NULL, '0.00', '0.00', '0.00', NULL, NULL, '0.00', '0.00', NULL, '".$ve."', NULL, '141.25', NULL, NULL, NULL, '16.25', '1.88', NULL, NULL, '125', '0.00', '123.12', NULL, NULL, NULL, '123.12', '16.25', '0.00', '1', '01', '123.12', '', '01', '', '', NULL, NULL, NULL)
";
      

        $resultados = $this->db->query( $query );
        return $resultados;
        
    $query = "INSERT INTO resumen (numeroControl, codigoGeneracion, totalNoSuj, totalExenta, totalGravada, totalOpeExpo, totalOperaciones, totalDonacion, sumOpSinImpu, montoGloDescNS, montoGloDescVE, montoGloDescVG, montoGloDescVA, montoGloDescOP, porcMontoGloDesc, totalDescBonRev, resCodTributo, nombreTributo, valorTributo, subTotal, totalMonSujRet, ivaPercibido, ivaPercibidoLiq, ivaRetenido, retencionRenta, seguro, flete, montoTotalOp, totalCargoBasImpon, totalAPagar, total, totalIvaRetenido, valorLetrasIvaRet, valorLetras, iva13, saldoAFavor, condicionOpera, codFormaPago, montoPorFormaPag, refModalidadPago, plazo, periodoPlazo, numPagoElecNPE, incoterms, descincoterms, observaciones) VALUES
    ('".$numeroControl2."', '".$codigoGeneracion2."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '125', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '16.25', 'DIECISEIS DOLARESS 25/100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)
";
      

        $resultados = $this->db->query( $query );
        return $resultados;
    
    
}    
  public function ingresoidentificador($numeroControl,$codigoGeneracion,$numeroControl2,$codigoGeneracion2,$fecha,$hora){
   
$query = "
INSERT INTO identificacion (version, ambDestino, tipoDoc, numeroControl, codigoGeneracion, modFacturacion, tipTransmicion, fecha, hora, tipMoneda, estado) VALUES
(1, '00', 14,'".$numeroControl."', '".$codigoGeneracion."', 1, 1, '".$fecha."', '".$hora."', 'USD', 0)";
   
        $resultados = $this->db->query( $query );
      
      $query = "
INSERT INTO identificacion (version, ambDestino, tipoDoc, numeroControl, codigoGeneracion, modFacturacion, tipTransmicion, fecha, hora, tipMoneda, estado) VALUES
(1, '00', 7, '".$numeroControl2."', '".$codigoGeneracion2."', 1, 1,  '".$fecha."', '".$hora."', 'USD', 0);";
   
        $resultados = $this->db->query( $query );
        return $resultados;
    
    
}    
   public function ingresoreceptordoc($numeroControl,$codigoGeneracion,$numeroControl2,$codigoGeneracion2,$fecha){
    
$query = "INSERT INTO receptordocumen (numeroControl, codigoGeneracion, idReceptor, fecha, estado, destino) VALUES
('".$numeroControl."', '".$codigoGeneracion."', '10-00573', '".$fecha."', NULL, NULL)";

        $resultados = $this->db->query( $query );
       
$query = "INSERT INTO receptordocumen (numeroControl, codigoGeneracion, idReceptor, fecha, estado, destino) VALUES
('".$numeroControl2."', '".$codigoGeneracion2."', '10-00573', '".$fecha."', NULL, NULL);";

        $resultados = $this->db->query( $query );
        return $resultados;
    
    
}    
    
  
    public function ingresoEcompras($data){
           return $this->db->insert( "compras", $data );
        
    } 
    public function ingresoDcompras($data){
           return $this->db->insert( "det_compras", $data );
        
    }
    public function Rcompras($numeroControl2,$codigoGeneracion2){
        $this->db->select("numControl,codGeneracion,cantidad,descripcion,precio,item,(precio*cantidad) subtotal");
         $this->db->where("numControl",$numeroControl2);
		$this->db->where("codGeneracion",$codigoGeneracion2);
		$resultados = $this->db->get("det_compras");
		return $resultados->result();
          
        
    }
    
    
}