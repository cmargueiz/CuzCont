
		
		<!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->

      
        <div class="right_col" role="main">
          <!-- top tiles -->
          <!-- /top tiles -->

		<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-default btn-lg" id="btnApi">Auntenticar API MH</button>
</div>            
            <div class="row">
         
                <div class="x_content">
                                <table id="example" class="table table-bordered table-hover" style="width:100%">
                                    <thead>
                                        <tr>
																						<th>Tipo DTE</th>
                                            <th>Receptor</th>
                                            <th>Num. control</th>

                                            <th>Cod. DTE</th>
                                           
                                            <th>Total</th>
                                            <th>Fecha Doc</th>
                                            <th> <input type="date" class="form-control" id="fecha" data-inputmask="'mask': '99/99/9999'">
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                    </tbody>
                                    <tfoot align="right">
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                               


                            </div>
            </div>
            
            
         
            
           


        </div>

<style>
  .modal-header, h4, .close {
    background-color: #5cb85c;
    color:white !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-footer {
    background-color: #f9f9f9;
  }

</style>

<script>

 $(document).ready(function() {

	tableDetalle = $('#example').DataTable({
    scrollY: '30vh',
    scrollCollapse: true,
    paging: false,
    searching: false,
  });

	llenarTabla();





	$('#btnApi').on('click', function(){
		console.log('click');
				const url = 'https://apitest.dtes.mh.gob.sv/seguridad/auth';
				const user = '02033110660019';
				const pwd = 'coopcuzcaDet2023*';

				const credenciales = {
					user,
					pwd
				}

				$.ajax({
					type: "POST",
            url: url,
						data: credenciales,
            headers: {          
                Accept: "application/json",
								"Content-Type": "application/x-www-form-urlencoded",
                },
            success: function(data) {
							console.log(data);
							guardarToken(data);
              
            },
            error: function(data) {
                console.log(data);
            }
				})

    });

		//reception dte
    $('#example tbody').on('click', 'tr', async function() {
      
        const url = 'https://apitest.dtes.mh.gob.sv/fesv/recepciondte';

        const data = tableDetalle.row( this ).data() 

				const infoToken =  await  obtenerToken()

				const version = Number(data.identificacion.version);

				const tipoDte = data.identificacion.tipoDte;

				statusToken =JSON.parse(infoToken);

					if(!statusToken.status) {
						alert('No se puede enviar el documento. No se ha autenticado');
						return;
					}

				const documento = (await firmarDocumento(data)).body;

				const token = '<?php echo $this->session->userdata('token');?>'

				const dataToSend ={
					ambiente: "00",
					idEnvio: 1,
					version ,
					tipoDte,
					documento
				}

        $.ajax({
            type: "POST",
            url: url,
            headers: {
                Accept: "application/json",         
                "Content-Type": "application/json",
                "Authorization" : token
                },            
            data: JSON.stringify(dataToSend),
            success: function(data) {
                // console.log(data); mensaje 
								guardarBitacoraFactura(data);
                //mensajito
                //  setTimeout(imprimir(), 2000);
            },
            error: function(data) {
							// console.log(data.responseJSON);
							guardarBitacoraFactura(data.responseJSON);
            }
        });

	});

});

  function obtenerToken() {
    const url = "<?php echo base_url("mhdte/bitacora/obtenerToken");?>";
		statusToken = $.ajax({
						type: "POST",
						headers: {          
								Accept: "application/json",
								"Content-Type": "application/json",
								},
						url: url,
						success: function(data) {
								const { status, token, message } = data;

								statusToken =  status;
						},

						error: function(data) {
								console.log(data);
						}
				}).done(function(statusToken) {
					return statusToken;
				});

		return statusToken;

  }


	function guardarToken(response) {

		const { body, status, mensaje} = response;

		console.log(response);

		const url = "<?php echo base_url("mhdte/bitacora/store");?>";

		let fecha = new Date()

		fecha.toISOString().split('T')[0]

		const data = {
			usuario: body.user,
			comentario: status == 'OK' ? 'Token de autenticacion' : 'Error al autenticar',
			fecha: fecha.toISOString().split('T')[0],
			token: body.token,
			mensaje: status!='error' ?  null : message
		}

		$.ajax({
						type: "POST",
						headers: {          
                Accept: "application/json",
								"Content-Type": "application/x-www-form-urlencoded",
                },
						url: url,
						data: data,
						success: function(data) {
								console.log(data);
						},
						error: function(data) {
								console.log(data);
						}
				});
	}


	function validoParaTipoDte(tipoDte, documentosAplicado){


		const FE = '01';
		const CCFE = '03';
		const NRE = '04';
		const NCE = '05';
		const NDE = '06';
		const FEXE = '11';
		const FSEE = '14';

		if(Array.isArray(documentosAplicado)){
			return documentosAplicado.includes(tipoDte);
		}
	
		return documentosAplicado == tipoDte;
	}

	function validarDocumento(documento, tipoDte){

		const FE = '01';
		const CCFE = '03';
		const NRE = '04';
		const NCE = '05';
		const NDE = '06';
		const FEXE = '11';
		const FSEE = '14';
		const CRE = '07';


		documento.identificacion.version = Number(documento.identificacion.version);
		documento.identificacion.tipoModelo =Number(documento.identificacion.tipoModelo);
		documento.identificacion.tipoOperacion = Number(documento.identificacion.tipoOperacion);
		documento.identificacion.tipoContingencia = documento.identificacion.tipoContingencia == "" || documento.identificacion.tipoContingencia == null ? null : Number(documento.identificacion.tipoContingencia);


		if(!validoParaTipoDte(tipoDte,[FEXE])) documento.identificacion.motivoContin = documento.identificacion.motivoContin == "" || documento.identificacion.motivoContin == 'null' || documento.identificacion.motivoContin == 0 || documento.identificacion.motivoContin == null ? null : Number(documento.identificacion.motivoContin);
		
		if(validoParaTipoDte(tipoDte,[FEXE])) documento.identificacion.motivoContigencia = documento.identificacion.motivoContigencia == "" || documento.identificacion.motivoContigencia == null ? null : Number(documento.identificacion.motivoContigencia);

		if(validoParaTipoDte(tipoDte,[FEXE])) documento.emisor.tipoItemExpor = Number(documento.emisor.tipoItemExpor);

		if(validoParaTipoDte(tipoDte,[FEXE])) documento.receptor.tipoPersona = Number(documento.receptor.tipoPersona);

		const numDoc = documento.cuerpoDocumento.length;

		documento.cuerpoDocumento.forEach((cuerpo) => {
			if(!validoParaTipoDte(tipoDte,[FEXE, CRE])) cuerpo.tipoItem = Number(cuerpo.tipoItem);
			 cuerpo.numItem = Number(cuerpo.numItem);
			cuerpo.codTributo = cuerpo.codTributo == "" ? null : cuerpo.codTributo;
			if(!validoParaTipoDte(tipoDte, CRE))cuerpo.cantidad = Number(cuerpo.cantidad);
			if(!validoParaTipoDte(tipoDte, CRE))cuerpo.precioUni = Number(cuerpo.precioUni);

			if(cuerpo.tributos != null) cuerpo.tributos = cuerpo.tributos.length > 2 ? String(cuerpo.tributos).split(',') : [cuerpo.tributos];

			if(validoParaTipoDte(tipoDte,[FE])) cuerpo.tributos = null;
			
			cuerpo.numeroDocumento = cuerpo.numeroDocumento == "" ? null : cuerpo.numeroDocumento;
			if(!validoParaTipoDte(tipoDte, CRE)) cuerpo.uniMedida = Number(cuerpo.uniMedida);
			if(!validoParaTipoDte(tipoDte, CRE)) cuerpo.montoDescu = Number(cuerpo.montoDescu);

			if(!validoParaTipoDte(tipoDte,[FSEE,CRE])) cuerpo.ventaGravada = Number(cuerpo.ventaGravada);
			if(!validoParaTipoDte(tipoDte,[FEXE, FSEE, CRE])) cuerpo.ventaExenta = Number(cuerpo.ventaExenta);
			
			if(tipoDte == FE) cuerpo.ivaItem = Number(cuerpo.ivaItem);

			if(!validoParaTipoDte(tipoDte,[FEXE, FSEE, CRE]))  cuerpo.ventaNoSuj = Number(cuerpo.ventaNoSuj);
			if(!validoParaTipoDte(tipoDte,[FSEE, CRE, NDE, NCE])) cuerpo.noGravado = Number(cuerpo.noGravado);
			if(!validoParaTipoDte(tipoDte,[FEXE, FSEE, CRE, NDE, NCE])) cuerpo.psv = Number(cuerpo.psv);

			if(validoParaTipoDte(tipoDte,[FSEE])) cuerpo.compra = Number(cuerpo.compra);

			if(validoParaTipoDte(tipoDte,[CRE])) cuerpo.ivaRetenido = Number(cuerpo.ivaRetenido);
			if(validoParaTipoDte(tipoDte,[CRE])) cuerpo.tipoDoc = Number(cuerpo.tipoDoc);
			if(validoParaTipoDte(tipoDte,[CRE])) cuerpo.montoSujetoGrav = Number(cuerpo.montoSujetoGrav);
			

			
		})

		//validacion de resumen
		if(!validoParaTipoDte(tipoDte, [FSEE, CRE, NDE, NCE])) documento.otrosDocumentos = documento.otrosDocumentos==null || documento.otrosDocumentos.length == 0 ? null : documento.otrosDocumentos;

		if(!validoParaTipoDte(tipoDte, [FEXE, FSEE, CRE])) documento.resumen.totalNoSuj = Number(documento.resumen.totalNoSuj);
		if(!validoParaTipoDte(tipoDte, [FEXE, FSEE, CRE])) documento.resumen.descuNoSuj = Number(documento.resumen.descuNoSuj);

		if(tipoDte == FE) documento.resumen.totalIva = Number(documento.resumen.totalIva);

		if(!validoParaTipoDte(tipoDte, [FEXE, CRE])) documento.resumen.ivaRete1 = Number(documento.resumen.ivaRete1);
		if(!validoParaTipoDte(tipoDte, [FEXE, FSEE, CRE])) documento.resumen.subTotalVentas = Number(documento.resumen.subTotalVentas);
		if(!validoParaTipoDte(tipoDte, [FEXE, CRE])) documento.resumen.subTotal = Number(documento.resumen.subTotal);
		if(!validoParaTipoDte(tipoDte, [FEXE, CRE])) documento.resumen.reteRenta = Number(documento.resumen.reteRenta);

		if(validoParaTipoDte(tipoDte, [FEXE])) documento.resumen.flete = Number(documento.resumen.flete);
		if(validoParaTipoDte(tipoDte, [FEXE])) documento.resumen.seguro = Number(documento.resumen.seguro);

		if(!validoParaTipoDte(tipoDte, [CRE])){
			const pagos = documento.resumen.pagos;
		if(pagos!=null && pagos.length > 0) {
			documento.resumen.pagos.forEach(pago => {
				pago.montoPago = Number(pago.montoPago);
				pago.periodo = Number(pago.periodo);

			});
		}
		}

		if(validoParaTipoDte(tipoDte,[FEXE])) documento.resumen.descuento = Number(documento.resumen.descuento); 

		if(!validoParaTipoDte(tipoDte, [FEXE, FSEE, CRE])) documento.resumen.descuExenta = Number(documento.resumen.descuExenta);
		
		if(!validoParaTipoDte(tipoDte, [CRE])) documento.resumen.totalDescu = Number(documento.resumen.totalDescu);

		if(!validoParaTipoDte(tipoDte, [FEXE, FSEE, CRE])) documento.resumen.descuGravada = Number(documento.resumen.descuGravada);

		if(!validoParaTipoDte(tipoDte,[FSEE, CRE, NCE, NDE])) documento.resumen.porcentajeDescuento = Number(documento.resumen.porcentajeDescuento);
		
		if(!validoParaTipoDte(tipoDte,[FSEE, CRE])) documento.resumen.montoTotalOperacion = Number(documento.resumen.montoTotalOperacion);
		// if(validoParaTipoDte(tipoDte,[FE])) documento.resumen.totalVenta = Number(documento.resumen.totalVenta);
		if(!validoParaTipoDte(tipoDte,[FSEE, CRE ,NDE , NCE])) documento.resumen.totalNoGravado = Number(documento.resumen.totalNoGravado);
		if(!validoParaTipoDte(tipoDte, [FEXE, FSEE, CRE, NDE, NCE])) documento.resumen.saldoFavor = Number(documento.resumen.saldoFavor);
		if(!validoParaTipoDte(tipoDte, [FEXE, FSEE, CRE])) documento.resumen.totalExenta = Number(documento.resumen.totalExenta);

		if(validoParaTipoDte(tipoDte,[FSEE])) documento.resumen.totalCompra = Number(documento.resumen.totalCompra);
		if(validoParaTipoDte(tipoDte,[FSEE])) documento.resumen.descu = Number(documento.resumen.descu);

		if(!validoParaTipoDte(tipoDte,[CRE, NDE, NCE])) documento.resumen.totalPagar = Number(documento.resumen.totalPagar);
		if(!validoParaTipoDte(tipoDte,[FSEE, CRE])) documento.resumen.totalGravada = Number(documento.resumen.totalGravada);

		if(!validoParaTipoDte(tipoDte,[NRE, CRE])) documento.resumen.condicionOperacion = Number(documento.resumen.condicionOperacion);
		if(!validoParaTipoDte(tipoDte, [NCE])) documento.resumen.condicionOperacion = Number(documento.resumen.condicionOperacion);
		if(validoParaTipoDte(tipoDte,[CCFE, NDE, NCE])) documento.resumen.ivaPerci1 = Number(documento.resumen.ivaPerci1);


		if(validoParaTipoDte(tipoDte,[CRE])) documento.resumen.totalSujetoRetencion = Number(documento.resumen.totalSujetoRetencion);
		if(validoParaTipoDte(tipoDte,[CRE])) documento.resumen.totalIVAretenido = Number(documento.resumen.totalIVAretenido);
		//if(validoParaTipoDte(tipoDte,[CRE])) documento.resumen.totalIVAretenidoLetras = Number(documento.resumen.totalIVAretenidoLetras);

		
		console.log(documento);

		return documento;
	}

	async function firmarDocumento(documento) {

		//const url = 'http://localhost:8113/firmardocumento/';
		 const url = 'http://192.120.55.207:8113/firmardocumento/';

		const tipoDte = documento.identificacion.tipoDte;

		const docAFirmar = {
  	  nit:"02033110660019",
	    activo:1,
    	passwordPri:"contacuzcaDet23*",
    	dteJson: validarDocumento(documento,tipoDte),
		}

		 var docFirmado = null;
		 
		return $.ajax({
					type: "POST",
            url: url,
						data: JSON.stringify(docAFirmar),
            headers: {          
                Accept: "application/json",
								"Content-Type": "application/json",
                },
            success: function(data) {
              docFirmado = data;
            },
            error: function(data) {
                console.log(data);
            }
				}).done(function(docFirmado) {
					return docFirmado;
				});

	}


	function guardarBitacoraFactura(data) {

		const url = "<?php echo base_url("mhdte/bitacora/guardarBitacoraFactura");?>";
		const usuario = '<?php echo $this->session->userdata('uname');?>';

		const dataToSend = {...data, usuario}

		$.ajax({
						type: "POST",
						headers: {          
								Accept: "application/json",
								"Content-Type": "application/x-www-form-urlencoded",
								},
						url: url,
						data: dataToSend,
						success: function(data) {
								console.log(data);
						},
						error: function(data) {
								console.log(data);
						}
				});
	}


// *********************************************************************************************** ******************
function llenarTabla() {

        var url = "<?php echo base_url("mhdte/documentosdte/cargarDocumento");?>";
	
        $.ajax({
            type: "POST",
            url: url,
            // data: Datos,
            success: function(data) {

                datos_tabla_new = JSON.parse(data);

                // console.log(datos_tabla_new);
                tableDetalle = $('#example').DataTable({
                    "processing": true,
                    "destroy": true,
                    paging: false,
                    scrollY: '30vh',
                    scrollCollapse: true,

                    searching: false,
                    "data": datos_tabla_new,
                    "columns": [
						{
							data : "identificacion.tipoDte",
						},										
						{
                            data: "identificacion.tipoDte"
                        },

                        {
                            data: "identificacion.numeroControl"
                        },
                        {
                            data: "identificacion.codigoGeneracion",
                           
                        },
                        {
                            data: "identificacion.fecEmi",
                            
                        },
                        {
                            data: "identificacion.fecEmi",
                            
                        },

                        {
														data: "identificacion.fecEmi",
														
												},

                    ],

                   

                });


            }
        });


    }
    

      
    $('#consulta').submit(function() {
    
    var Datos = {
            "fechatxt":$('#fecha').val(),
          
        };
        
     var url = "<?php echo base_url("mhdte/Integracion/leerArchivo");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            
            success: function(data) {
                agrupaInserta();
                

            },
         
        });
    
    
       

});
    
 
    
function agrupaInserta(){
    var Datos = {
            "fechatxt":$('#fecha').val(),
          
        };
        
     var url = "<?php echo base_url("mhdte/Integracion/agrupainsertar");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            
            success: function(data) {
                respuesta = JSON.parse(data);
                

                console.log(respuesta);
                
              

            },
         
        });
    
}    
    
    
  
   $('#consultalsto').submit(function() {
       
         var Datos = {
            "fechatxt":$('#fecha').val(),
          
        };
        
        //var url = "<?php echo base_url("mhdte/Integracion/archivotxt");?>";
        var url = "<?php echo base_url("mhdte/Integracion/leerArchivo");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            timeout:8000,
            success: function(data) {
                respuesta = JSON.parse(data);

                console.log(respuesta);

            },        // var Datos = {
        //     "numeroControl": 'DTE-03-123456789-000000000000215',//numeroControl,
        //     "codigoGeneracion": 'EB5568A0-BDE6-43B6-AD4A-07A72836E71C',//codigoGeneracion,
            
        // };
            error: function(jqXHR, textStatus, errorThrown) {
        if(textStatus==="timeout") {
           alert('se acabo el tiempo');
            num='4567'; corr='987654';
            consulta(num,corr);
        } 
        }
        });

        return false;
       

});
    
    
   function consulta(num,corr){2023-06-30
       
         var Datos = {
            "fechatxt":$('#fecha').val(),
          
        };
          var url = "<?php echo base_url("mhdte/Integracion/archivotxt");?>";
  
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {
                respuesta = JSON.parse(data);

                console.log(respuesta);

            }
        });
    }
    </script>
      
        <!-- /.content-wrapper -->
