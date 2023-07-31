<?php

defined('BASEPATH') or exit('No direct script access allowed');

class json_model extends CI_Model
{
    public string $numeroControl;
    public string $codigoGeneracion;

    public const FE = '01';//-factura electronica
    public const CCFE = '03';//-comprobante de credito fiscal
    public const NRE = '04';//-nota de remision
    public const NCE = '05';//-nota de credito electronica
    public const NDE = '06';//-nota de debito electronica
    public const CRE = '07';//-
    public const FEXE = '11';//-factura de exportacion electronica
    public const FSEE = '14';//-factura de sujeto excluido electronica

    public string $tipoDTE;

    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
    }

    public function getIdentificacion(int $estado, string $numeroControl, string $codigoGeneracion)
    {
        $this->db->select('i.*');
        $this->db->from("identificacion i");
        $this->db->where("i.estado", $estado);
        $this->db->where("i.numeroControl", $numeroControl);
		$this->db->where("i.codigoGeneracion",$codigoGeneracion);
        $resultados = $this->db->get();
        return $resultados->row();
    }

    public function getDocumentoRelacionado()
    {
        $this->db->select(
            "
							dr.tipoDoc as tipoDocumento,
							dr.tipoGenera as tipoGeneracion,
							dr.numDocRelacion as numeroDocumento,
							dr.fechaGeneracion as fechaEmision"
        );
        $this->db->from("docrelacionados dr");
        $this->db->where("dr.numeroControl", $this->numeroControl);
        $this->db->where("dr.codigoGeneracion", $this->codigoGeneracion);
        $resultados = $this->db->get();
        return $resultados->result();
    }

	public function getCamposEmisor(){
		$campos = "
			replace(e.nit, '-','') as nit,
			replace(e.ncr,'-','') as nrc ,
			e.nombre,
			e.codactEco as codActividad,
			e.desactEco as descActividad,
			e.nomComercial as nombreComercial,
			e.tipEstablecimiento as tipoEstablecimiento,
			e.telefono,
			e.correo,
			e.codEstable,
			e.codEstableMH,
			e.codPuntoVentaMH,
			e.codPuntoVenta,
			e.Direccion as direccion,
			e.Municipio as municipio,
			e.Departamento as departamento
		";

		return match($this->tipoDTE){
			self::FEXE => "
				replace(e.nit, '-','') as nit,
				replace(e.ncr,'-','') as nrc ,
				e.nombre,
				e.codactEco as codActividad,
				e.desactEco as descActividad,
				e.nomComercial as nombreComercial,
				e.tipEstablecimiento as tipoEstablecimiento,
				e.telefono,
				e.correo,
				e.codEstable,
				e.codEstableMH,
				e.codPuntoVentaMH,
				e.codPuntoVenta,
				e.Direccion as direccion,
				e.Municipio as municipio,
				e.Departamento as departamento,
				e.tipoItem as tipoItemExpor,
				e.recintoFiscal,
				e.regExportacion as regimen
			",
			self::FSEE=>"
				replace(e.nit, '-','') as nit,
				replace(e.ncr,'-','') as nrc ,
				e.nombre,
				e.codactEco as codActividad,
				e.desactEco as descActividad,
				e.telefono,
				e.correo,
				e.codEstable,
				e.codEstableMH,
				e.codPuntoVentaMH,
				e.codPuntoVenta,
				e.Direccion as direccion,
				e.Municipio as municipio,
				e.Departamento as departamento,
			",
			self::CRE =>"
				replace(e.nit, '-','') as nit,
				replace(e.ncr,'-','') as nrc ,
				e.nombre,
				e.codactEco as codActividad,
				e.desactEco as descActividad,
				e.nomComercial as nombreComercial,
				e.tipEstablecimiento as tipoEstablecimiento,
				e.codEstable as codigo,
				e.telefono,
				e.correo,
				e.codEstableMH as codigoMH,
				e.codPuntoVentaMH as puntoVentaMH,, 
				e.codPuntoVenta as puntoVenta,
				e.Direccion as direccion,
				e.Municipio as municipio,
				e.Departamento as departamento
			",
			self::NCE, self::NDE=>"
				replace(e.nit, '-','') as nit,
				replace(e.ncr,'-','') as nrc ,
				e.nombre,
				e.codactEco as codActividad,
				e.desactEco as descActividad,
				e.nomComercial as nombreComercial,
				e.tipEstablecimiento as tipoEstablecimiento,
				e.telefono,
				e.correo,
				e.Direccion as direccion,
				e.Municipio as municipio,
				e.Departamento as departamento
			",

			default => $campos
		};
	}

    public function getEmisor()
    {
		$campos = $this->getCamposEmisor();

        $this->db->select($campos);
        $this->db->from("emisor e");
        // $this->db->where("e.numeroControl", $this->numeroControl);
        // $this->db->where("e.codigoGeneracion", $this->codigoGeneracion);
        $resultados = $this->db->get();
        return $resultados->row();
    }

    public function getMunicipio($codigoMunicipio)
    {
        $this->db->select("m.valor as municipio");
        $this->db->from("cat013 m");
        $this->db->where("m.codigo", $codigoMunicipio);
        $resultados = $this->db->get();
        return $resultados->row();
    }

    public function getDepartamento($codigoDepartamento)
    {
        $this->db->select("d.valores as departamento");
        $this->db->from("cat012 d");
        $this->db->where("d.codigo", $codigoDepartamento);
        $resultados = $this->db->get();
        return $resultados->row();
    }

    public function getReceptorDocumento()
    {

		$campos = $this->getCamposRecetor();
        $this->db->select($campos);
        $this->db->from("receptordocumen rd");
        $this->db->join("receptor r", "rd.idReceptor = r.codigo");
        $this->db->where("rd.numeroControl", $this->numeroControl);
        $this->db->where("rd.codigoGeneracion", $this->codigoGeneracion);
		if($this->tipoDTE == self::FEXE ) $this->db->where('r.area', 'EX');
        $resultados = $this->db->get();
        return $resultados->row();
    }

	public function getCamposRecetor(){
		$campos= "
			replace(r.nit, '-','') as nit,
			replace(r.ncr,'-','') as nrc ,
			r.NomDenominacion as nombre,
			r.codActEco as codActividad,
			r.actEco as descActividad,
			r.nomComercial as nombreComercial,
			r.dirComplemento as direccion,
			r.Municipio as municipio,
			r.Departamento as departamento,
			r.telReceptor as telefono,
			r.correoReceptor as correo
			";

		return match($this->tipoDTE){
			self::FSEE => "
						r.tipDoc as tipoDocumento,
						replace(r.numDoc,'-','') as numDocumento,
						r.NomDenominacion as nombre,
						r.codActEco as codActividad,
						r.actEco as descActividad,
						r.dirComplemento as direccion,
						r.Municipio as municipio,
						r.Departamento as departamento,
						r.telReceptor as telefono,
						r.correoReceptor as correo"
						,
			self::FE =>"
						r.tipDoc as tipoDocumento,
						replace(r.numDoc,'-','') as numDocumento,
						replace(r.ncr,'-','') as nrc ,
						r.NomDenominacion as nombre,
						r.codActEco as codActividad,
						r.actEco as descActividad,
						r.dirComplemento as direccion,
						r.Municipio as municipio,
						r.Departamento as departamento,
						r.telReceptor as telefono,
						r.correoReceptor as correo",
			self::FEXE => "
						r.NomDenominacion as nombre,
						r.tipDoc as tipoDocumento,
						replace(r.numDoc,'-','') as numDocumento,
						r.nomComercial as nombreComercial,
						r.codPais,
						r.paisDestino as nombrePais,
						r.dirComplemento as complemento,
						r.tipoReceptor as tipoPersona,
						r.actEco as descActividad,
						r.telReceptor as telefono,
						r.correoReceptor as correo
					",
			self::CRE =>"
						r.tipDoc as tipoDocumento,
						replace(r.numDoc,'-','') as numDocumento,
						replace(r.ncr,'-','') as nrc ,
						r.NomDenominacion as nombre,
						r.codActEco as codActividad,
						r.actEco as descActividad,
						r.nomComercial as nombreComercial,
						r.dirComplemento as direccion,
						r.Municipio as municipio,
						r.Departamento as departamento,
						r.telReceptor as telefono,
						r.correoReceptor as correo
					",
			default => $campos
		};
	}


	// public function getCamposOtrosDocumentos(){

	// 	$campos = "
	// 		od.docAsociado as codDocAsociado,
	// 		od.numIdentificacion as descDocumento,
	// 		od.desDocumento as detalleDocumento,
	// 		od.nomMedico as nombre,
	// 		od.nitMedico as nit,
	// 		od.identificacionDoc as docIdentificacion,
	// 		od.codServicio as tipoServicio,
	// 	";

	// 	return match($this->tipoDTE){
	// 		self::FEXE => "
	// 			od.docAsociado as codDocAsociado,
	// 			od.numIdentificacion as descDocumento,
	// 			od.desDocumento as detalleDocumento,
	// 			od.nomMedico as nombre,
	// 			od.nitMedico as nit,
	// 			od.identificacionDoc as docIdentificacion,
	// 			od.codServicio as tipoServicio,
	// 			od.
	// 		",
	// 		default => $campos
	// 	};
	// }

    public function getOtrosDocumentos()
    {

        $this->db->select("
							od.docAsociado as codDocAsociado,
							od.numIdentificacion as descDocumento,
							od.desDocumento as detalleDocumento,
							od.nomMedico as nombre,
							od.nitMedico as nit,
							od.identificacionDoc as docIdentificacion,
							od.codServicio as tipoServicio,
							");
        $this->db->from("otrosdocumentos od");
        $this->db->where("od.numeroControl", $this->numeroControl);
        $this->db->where("od.codigoGeneracion", $this->codigoGeneracion);
        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function getVentaTercero()
    {
        $this->db->select("
							vt.nitPorCuenta as nit,
							vt.nomDenominacion as nombre,
						");
        $this->db->from("ventatercero vt");
        $this->db->where("vt.numeroControl", $this->numeroControl);
        $this->db->where("vt.codigoGeneracion", $this->codigoGeneracion);
        $resultados = $this->db->get();
        return $resultados->row();
    }

    public function getCuerpoDocumento()
    {
        $campos = $this->camposCuerpoDocumento();
        $this->db->select($campos);
        $this->db->from("cuerpodocumento cd");
        $this->db->where("cd.numeroControl", $this->numeroControl);
        $this->db->where("cd.codigoGeneracion", $this->codigoGeneracion);
        $resultados = $this->db->get();
        return $resultados->result();
    }

    public function camposCuerpoDocumento()
    {

        $campos = "
		cd.item as numItem,
		cd.tipoItem,
		cd.tipoDonacion,
		cd.depreciacion as tipoDepreciacion,
		cd.tipDTRelacionado as tipoDte,
		cd.tipGenDoc as tipoDoc,
		cd.numDocRelacionado as numeroDocumento,
		cd.fechaGendoc as fechaEmision,
		cd.cantidad,
		cd.codigo,
		cd.codTributo,
		cd.unidadMedida as uniMedida,
		cd.descripcion,
		cd.precioUnitario as precioUni,
		cd.descripcion,
		cd.valorUnitario,,
		cd.descuentos as montoDescu,
		cd.ventasNSujetas as ventaNoSuj,
		cd.ventasExentas as ventaExenta,
		cd.ventasGravadas as ventaGravada,
		cd.exportaciones ,
		cd.valorDonado as valor,
		cd.ventas as compra,
		cd.codigoTributo as tributos,
		cd.precSugVenta as psv,
		cd.CargosAbono as noGravado,
		cd.ivaItem,
		cd.montoretencion as montoSujetoGrav,
		cd.codRetencion as codigoRetencionMH,
		cd.ivaRetenido,
		cd.fechaIni as periodoLiquidacionFechaIni,
		cd.fechaFin as periodoLiquidacionFechaFin,
		cd.codLiquidacion,
		cd.canDocumentos as cantidadDoc,
		cd.valorOpLiq as valorOperaciones,
		cd.valNoPercepcion as montoSinPercepcion,
		cd.descNoPercepcion as desCREipSinPercepcion,
		cd.observacionesItem as obsItem,
		cd.observacionesItems as observaciones,
		cd.subtotal,
		cd.ivaOpLiq as IVA,
		cd.montoSinIva as montoSujetoPercepcion,
		cd.ivaPercibido as IVApercibido,
		cd.comision,
		cd.porcComision as porcentajeComision,
		cd.IvaComision as IVAcomision,
		cd.ValorLiqPagar as liquidoApagar,
		cd.valorLetras as totalLetras
		";

        return match($this->tipoDTE) {
            self::CCFE => "
				cd.item as numItem,
				cd.tipoItem,
				cd.numDocRelacionado as numeroDocumento,
				cd.cantidad,
				cd.codigo,
				cd.codTributo,
				cd.precioUnitario as precioUni,
				cd.descuentos as montoDescu,
				cd.unidadMedida as uniMedida,
				cd.ventasNSujetas as ventaNoSuj,
				cd.ventasExentas as ventaExenta,
				cd.ventasGravadas as ventaGravada,
				cd.codigoTributo as tributos,
				cd.precSugVenta as psv,
				cd.CargosAbono as noGravado,
				cd.descripcion",
            self::FE => "
				cd.item as numItem,
				cd.tipoItem,
				cd.numDocRelacionado as numeroDocumento,
				cd.cantidad,
				cd.codigo,
				cd.codTributo,
				cd.descripcion,
				cd.unidadMedida as uniMedida,
				cd.precioUnitario as precioUni,
				cd.descuentos as montoDescu,
				cd.ventasNSujetas as ventaNoSuj,
				cd.ventasExentas as ventaExenta,
				cd.ventasGravadas as ventaGravada,
				cd.codigoTributo as tributos,
				cd.precSugVenta as psv,
				cd.CargosAbono as noGravado,
				cd.ivaItem",
            self::CRE => "
				cd.item as numItem,
				cd.tipDTRelacionado as tipoDte,
				cd.tipGenDoc as tipoDoc,
				cd.numDocRelacionado as numDocumento,
				cd.fechaGendoc as fechaEmision,
				cd.montoretencion as montoSujetoGrav,
				cd.codRetencion as codigoRetencionMH,
				cd.ivaRetenido,
				cd.descripcion",
            self::FEXE => "
				cd.item as numItem,
				cd.cantidad,
				cd.codigo,
				cd.unidadMedida as uniMedida,
				cd.descripcion,
				cd.precioUnitario as precioUni,
				cd.descuentos as montoDescu,
				cd.ventasGravadas as ventaGravada,
				cd.codigoTributo as tributos,
				cd.CargosAbono as noGravado",
            self::FSEE => "
					cd.item as numItem,
					cd.tipoItem,
					cd.cantidad,
					cd.codigo,
					cd.unidadMedida as uniMedida,
					cd.descripcion,
					cd.precioUnitario as precioUni,
					cd.descuentos as montoDescu,
					cd.ventas as compra",
            self::NCE => "
				cd.item as numItem,
				cd.tipoItem,
				cd.numDocRelacionado as numeroDocumento,
				cd.cantidad,
				cd.codigo,
				cd.codTributo,
				cd.unidadMedida as uniMedida,
				cd.descripcion,
				cd.precioUnitario as precioUni,
				cd.descuentos as montoDescu,
				cd.ventasNSujetas as ventaNoSuj,
				cd.ventasExentas as ventaExenta,
				cd.codigoTributo as tributos,
				cd.ventasGravadas as ventaGravada,",
            self::NDE, self::NRE => "
				cd.item as numItem,
				cd.tipoItem,
				cd.numDocRelacionado as numeroDocumento,
				cd.cantidad,
				cd.codigo,
				cd.codTributo,
				cd.unidadMedida as uniMedida,
				cd.descripcion,36
				cd.precioUnitario as precioUni,
				cd.descuentos as montoDescu,
				cd.ventasNSujetas as ventaNoSuj,
				cd.ventasExentas as ventaExenta,
				cd.ventasGravadas as ventaGravada,
				cd.codigoTributo as tributos",
            default => $campos
        };
    }

    public function camposResumen()
    {
		$campos = "
			r.totalNosuj as totalNoSuj,
			r.totalExenta,
			r.totalGravada,
			r.totalOpeExpo as totalExportacion,
			r.totalOperaciones as totalCompra,
			r.totalDonacion as valorTotal,
			r.sumOpSinImpu as subTotalVentas,
			r.montoGloDescNS as descuNoSuj,
			r.montoGloDescVE as descuExenta,
			r.montoGloDescVG as descuGravada,
			r.montoGloDescVA as descuento,
			r.montoGloDescOP as descu,
			r.porcMontoGloDesc as porcentajeDescuento,
			r.totalDescBonRev  as totalDescu,
			r.resCodTributo as tributosCodigo,
			r.nombreTributo as descricion,
			r.valorTributo as tributos,
			cast(r.subTotal as Decimal(9,2)) as subTotal,
			r.totalMonSujRet as totalSujetoRetencion,
			r.ivaPercibido as ivaPerci1,
			r.ivaPercibidoLiq as ivaPerci,
			r.ivaRetenido as ivaRete1,
			r.retencionRenta as reteRenta,
			r.seguro,
			r.flete,
			r.montoTotalOp as montoTotalOperacion,
			r.totalCargoBasImpon as totalNoGravado,
			r.totalAPagar as totalPagar,
			r.total as total,
			r.totalIvaRetenido as totalIVAretenido,
			r.valorLetrasIvaRet as totalIVAretenidoLetras,
			r.valorLetras as totalLetras,
			r.iva13 as totalIva,
			r.saldoAFavor as saldoFavor,
			r.condicionOpera as condicionOperacion,
			r.codFormaPago as codigoPago,
			r.montoPorFormaPag as montoPago,
			r.refModalidadPago as referenciaPago,
			r.plazo as plazoPago,
			r.periodoPlazo as periodoPago,
			r.numPagoElecNPE as numPagoElectronico,
			r.incoterms as codInterms,
			r.descincoterms as desIncoterms,
			r.observaciones,
			r.tributos
		";

        return match($this->tipoDTE) {
            //comprobante de credito fiscal y factura electronica
            self::CCFE => "
					r.totalNoSuj,
					r.totalExenta,
					r.totalGravada,
					r.sumOpSinImpu as subTotalVentas,
					r.montoGloDescNS as descuNoSuj,
					r.montoGloDescVE as descuExenta,
					r.montoGloDescVG as descuGravada,
					r.porcMontoGloDesc as porcentajeDescuento,
					r.montoGloDescVA as totalDescu,
					r.resCodTributo as codigoTributo,
					r.nombreTributo as descripcion,
					r.subTotal,
					r.ivaRetenido as ivaRete1,
					r.retencionRenta as reteRenta,
					r.montoTotalOp as montoTotalOperacion,
					r.totalCargoBasImpon as totalNoGravado,
					r.totalAPagar as totalPagar,
					r.valorLetras as totalLetras,
					r.saldoAFavor as saldoFavor,
					r.condicionOpera as condicionOperacion,
					r.codFormaPago as codigoFormaPago,
					r.ivaPercibido as ivaPerci1,
					r.montoPorFormaPag as montoPago,
					r.refModalidadPago as referencia,
					r.plazo,
					r.periodoPlazo as periodo,
					r.numPagoElecNPE as numPagoElectronico",
			self::FE => "
					r.totalNoSuj,
					r.totalExenta,
					r.totalGravada,
					r.sumOpSinImpu as subTotalVentas,
					r.montoGloDescNS as descuNoSuj,
					r.montoGloDescVE as descuExenta,
					r.montoGloDescVG as descuGravada,
					r.porcMontoGloDesc as porcentajeDescuento,
					r.montoGloDescVA as totalDescu,
					r.resCodTributo as codigoTributo,
					r.nombreTributo as descripcion,
					r.subTotal,
					r.ivaRetenido as ivaRete1,
					r.retencionRenta as reteRenta,
					r.montoTotalOp as montoTotalOperacion,
					r.totalCargoBasImpon as totalNoGravado,
					r.totalAPagar as totalPagar,
					r.valorLetras as totalLetras,
					r.iva13 as totalIva,
					r.saldoAFavor as saldoFavor,
					r.condicionOpera as condicionOperacion,
					r.codFormaPago as codigoFormaPago,
					r.montoPorFormaPag as montoPago,
					r.refModalidadPago as referencia,
					r.plazo,
					r.periodoPlazo as periodo,
					r.numPagoElecNPE as numPagoElectronico",
            self::CRE => "
					r.totalMonSujRet as totalSujetoRetencion,
					r.totalIvaRetenido as totalIVAretenido,
					r.valorLetrasIvaRet as totalIVAretenidoLetras",
            // factura de exportacion electronica
            self::FEXE => "r.totalGravada,
					r.montoGloDescNS as descuento,
					r.porcMontoGloDesc as porcentajeDescuento,
					r.montoGloDescVA as totalDescu,
					r.seguro,
					r.flete,
					r.montoTotalOp as montoTotalOperacion,
					r.totalCargoBasImpon as totalNoGravado,
					r.totalAPagar as totalPagar,
					r.valorLetras as totalLetras,
					r.condicionOpera as condicionOperacion,
					r.codFormaPago as codigoFormaPago,
					r.montoPorFormaPag as montoPago,
					r.refModalidadPago as referencia,
					r.plazo,
					r.periodoPlazo as periodo,
					r.incoterms as codIncoterms,
					r.descincoterms as descIncoterms,
					r.numPagoElecNPE as numPagoElectronico,
					r.observaciones
				",
            //factura de sujeto excluido electronica
            self::FSEE => "
					r.totalOperaciones as totalCompra,
					r.montoGloDescOp as descu,
					r.totalDescBonRev as totalDescu,
					r.subTotal,
					r.ivaRetenido as ivaRete1,
					r.retencionRenta as reteRenta,
					r.totalAPagar as totalPagar,
					r.valorLetras as totalLetras,
					r.condicionOpera as condicionOperacion,
					r.codFormaPago as codigoFormaPago,
					r.montoPorFormaPag as montoPago,
					r.refModalidadPago as referencia,
					r.nombreTributo as descripcion,
					r.plazo,
					r.periodoPlazo as periodo,
					observaciones",
			self::NCE, self::NDE => "
					r.totalNoSuj,
					r.totalExenta,
					r.totalGravada,
					r.sumOpSinImpu as subTotalVentas,
					r.montoGloDescNS as descuNoSuj,
					r.montoGloDescVE as descuExenta,
					r.montoGloDescVG as descuGravada,
					r.totalDescBonRev  as totalDescu,
					r.nombreTributo as descripcion,
					r.valorTributo as tributos,
					r.subTotal,
					r.ivaPercibido as ivaPerci1,
					r.ivaRetenido as ivaRete1,
					r.retencionRenta as reteRenta,
					r.montoTotalOp as montoTotalOperacion,
					r.valorLetras as totalLetras,
					r.condicionOpera as condicionOperacion",
			self::NRE => "
					r.totalNosuj,
					r.totalExenta,
					r.totalGravada,
					r.sumOpSinImpu as subTotalVentas,
					r.montoGloDescNS as descuNoSuj,
					r.montoGloDescVE as descuExenta,
					r.montoGloDescVG as descuGravada,
					r.porcMontoGloDesc as porcentajeDescuento,
					r.montoGloDescVA as totalDescu,
					r.valorTributo as tributos,
					r.subTotal as subTotal,
					r.montoTotalOp as montoTotalOperacion,
					r.valorLetras as totalLetras",
			default =>$campos
        };
    }

    public function getResumen()
    {
        $campos = $this->camposResumen();

        $this->db->select($campos);
        $this->db->from("resumen r");
        $this->db->where("r.numeroControl", $this->numeroControl);
        $this->db->where("r.codigoGeneracion", $this->codigoGeneracion);
        $resultados = $this->db->get();
        return $resultados->row();
    }

	public function modificarEstadoDte($estado, $numeroControl, $codigoGeneracion){
		$this->db->where('numeroControl', $numeroControl);
		$this->db->where('codigoGeneracion', $codigoGeneracion);
		$this->db->update('identificacion', ['estado'=>$estado]);

		return $this->db->affected_rows();
	}

}
