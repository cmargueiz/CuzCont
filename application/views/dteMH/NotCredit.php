<!-- =============================================== -->
<!-- Content Wrapper. Contains page content -->
<div class="container body">
    <div class="main_container">
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                    </div>

                    <div class="title_right">

                        <div class="col-md-5 col-sm-4  form-group pull-right top_search">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <input type="time" class="form-control-sm" id="item11">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-4  form-group pull-right top_search">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <input type="date" class="form-control-sm" id="item10">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
               <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Nota de Credito // Buscar documento a relacionar</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                    
                    <div class="x_content">
									<br>
                        <div class="col-md-5 col-sm-5  form-group ">
											<input type="text" class="form-control " id="num" placeholder="Numero Control" >
										</div>
                        <div class="col-md-5 col-sm-5  form-group ">
											<input type="text" class="form-control " id="cod" placeholder="Cod Generacion" >
										</div>
											<div class="col-md-2 col-sm-2 form-group">
												
												<button type="button" onclick=" BuscarCC()" class="btn btn-success">Buscar documento</button>
											
										</div>

									
								</div>
                    
                 </div>
              </div>
</div>
                
                 <!-- /form input mask -->
   
            
            <div class="row">
         
                <div class="x_content">
                                <table id="example2" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>fecha</th>
                                            <th>Item</th>
                                            <th>Descripcion</th>
                                            <th>Total</th>
                                            <th>Retenido 1%</th>
                                            <th>Iva</th>
                                            <th>Renta</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                </div>
                        </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <label>Detalle de Nota de Credito Nuevo <i class="fa fa-arrow-right"> &nbsp;&nbsp;&nbsp;</i></label>
                                <label>Correlativo: <small id="Vnumcontrol"></small> &nbsp;&nbsp;&nbsp;</label>
                                <label>Codigo: <small id="Vcodcontrol"></small> </label>
								<input type="hidden" class="form-control-sm col-md-3 col-sm-3" id="item78" />

                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">


                                <form class="form-horizontal" id="cuerpoDocumento">


                                    <table class=" table-bordered" style="width:100%">
                                        <tr>
                                            <th style="width:12%">cantidad</th>
                                            <th> <button type="button" class="btn btn-primary col-md-6 col-sm-6" data-toggle="modal" data-target=".bs-example-modal-lg">Buscar Productos</button></th>
                                            <th>cantidad y precio</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control-sm col-md-8" id="item80" placeholder="cantidad"></td>
                                            <td><input type="text" id="item81" required="required" class="form-control-sm col-md-4 col-sm-4" placeholder="Codigo producto">
                                                <select class="form-control-sm col-md-8 col-sm-8" id="item84" col-md-8 col-sm-8>
                                                </select><br>
                                                <input type="text" id="observacionesItem" required="required" class="form-control-sm col-md-12 col-sm-12" placeholder="Descripcion">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control-sm col-md-3 col-sm-3" id="item85" placeholder="precio">
                                                <select class="form-control-sm  col-md-4 col-sm-4" id="item83" disabled>
                                                    <option value="59">Unidad</option>
                                                    <option value="58">Kilogramos</option>
                                                    <option value="57">Libras</option>
                                                    <option value="39">Gramos</option>
                                                    <option value="22">Gramos</option>
                                                    <option value="23">Gramos</option>
                                                    <option value="24">Gramos</option>
                                                    <option value="99">OTROS</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" id="item90" placeholder="VentasGrabadas" />
                                                <button type="submit" class="btn-sm btn-secondary">Agregar</button>
                                            </td>

                                        </tr>
                                    </table>
                                </form>
                            </div>
                            <div class="x_content">
                                <table id="example" class="display table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Descripcion</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th> <button type="button" id="Resumen" class="btn btn-success btn-sm">Guardar</button>
                                                <button type="button" id="ResumenCon" class="btn btn-info btn-sm">consulta</button>
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
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-4">
                                        <div class="col-md-4">
                                            iva(13%):
                                            <div class="form-group">
                                                <div class="input-group date" id="myDatepicker">
                                                    <input type="text" id="riva" class="form-control-sm col-sm-12" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            iva(1%):
                                            <div class="form-group">
                                                <div class="input-group date" id="myDatepicker2">
                                                    <input type="text" id="riva1" class="form-control-sm col-sm-12" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            Total:
                                            <div class="form-group">
                                                <div class="input-group date" id="myDatepicker3">
                                                    <input type="text" id="totalon" class="form-control-sm col-sm-12" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->
         <!-- /page content -->
         <div id="Bpro" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Buscar Producto</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                   
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                  
                    <table id="examplePro" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Codigo</th>
                          <th>Nombre del Producto</th>
                          <th>Precio</th>
                         
                        </tr>
                      </thead>
                   <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>                            
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         
                        </div>

                      </div>
                    </div>
                  </div>
        
         <!-- /page content -->
        
    </div>
</div>

<script>
    var arregleProducto;
    var tableDetalle2;
    var tableDetalle;
    var numeroControl = '';
    var codigoGeneracion = '';
    var grancontribuyente = '';
    var areafact = '<?php echo $this->session->userdata("areafact")?>';
    var condicionOpera='01';
    var codFormaPago='';
    var Plazo='';
    var periodoPlazo='';
   

    
    $('#item154').on('change', function() {

    })
    
    $('#tipodocSelect').on('change', function() {
        // $('#item85').removeAttr('disabled');
    })

    $('#select1').on('change', function() {

        separar = $(this).val().split(',');

        $('#txt1').val(separar[0]);
        grancontribuyente = (separar[1]);

    })

    function llenacombos(){
       // alert();
         var Datos = {};

            var url = "<?php echo base_url("mhdte/generales/item153");?>";
            $.ajax({
                type: "POST",
                url: url,
                data: Datos,
                success: function(data) {

                    cat016 = JSON.parse(data);
                   
                    $("#item153").empty();
                    for (i = 0; i < cat016.length; i++) {
                        $("#item153").append($("<option>", {
                            value: cat016[i]['codigo'],
                            text: cat016[i]['valor']
                        }));

                    }
                   
                }
            });
         var url = "<?php echo base_url("mhdte/generales/item154");?>";
            $.ajax({
                type: "POST",
                url: url,
                data: Datos,
                success: function(data) {

                    cat017 = JSON.parse(data);
                   
                    $("#item154").empty();
                    for (i = 0; i < cat017.length; i++) {
                        $("#item154").append($("<option>", {
                            value: cat017[i]['codigo'],
                            text: cat017[i]['valor']
                        }));

                    }
                   
                }
            });
        var url = "<?php echo base_url("mhdte/generales/item83");?>";
            $.ajax({
                type: "POST",
                url: url,
                data: Datos,
                success: function(data) {

                    cat014 = JSON.parse(data);
                   
                    $("#item83").empty();
                    for (i = 0; i < cat014.length; i++) {
                        $("#item83").append($("<option>", {
                            value: cat014[i]['codigo'],
                            text: cat014[i]['valor']
                        }));

                    }
                   
                }
            });
    }
    
    window.onload = function() {
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth() + 1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        var minutos;
		var hora;
        if (dia < 10)
            dia = '0' + dia; //agrega cero si el menor de 10
        if (mes < 10)
            mes = '0' + mes //agrega cero si el menor de 10
        $('#item10').val(ano + '-' + mes + '-' + dia);
        if (fecha.getMinutes() < 9) {
            minutos = '0' + fecha.getMinutes();
        } else {
            minutos = fecha.getMinutes();
        }
          if (fecha.getHours() <=9) {
            hora = '0' + fecha.getHours();
        } else {
            hora = fecha.getHours();
        }

        $('#item11').val(hora + ':' + minutos);
    }

    $('#cuerpoDocumento').submit(function() {
        var filas = tableDetalle.rows().count() + 1;
        var tipodocSelect = "storeCCF";


        var Datos = {
            "numeroControl": numeroControl,
            "codigoGeneracion": codigoGeneracion,
            "tipodocSelect": tipodocSelect,
            "item80": $('#item80').val(),
            "item84": $('#item84 option:selected').html(),
            "item81": $('#item81').val(),
            "item85": $('#item85').val(),
            "item83": $('#item83').val(),
            "item74": $('#item74').val(),
            "item78": $('#item78').val(),
            "observacionesItem": $('#observacionesItem').val(),
            "item72": filas,
            "item73": tableDetalle.rows().count()
                    };

        if (numeroControl != '' || codigoGeneracion != '') {

            var url = '<?=base_url()?>mhdte/cuerpodocumento/store'
            $.ajax({
                type: "POST",
                url: url,
                data: Datos,
                async:false,
                success: function(data) {
                    respuesta = JSON.parse(data);
                    if (respuesta.OK == 1) {

                        setTimeout(llenarTabla(numeroControl, codigoGeneracion), 2000);
                    } else {
                        mensaje('error', respuesta.OK, 'error');
                    }

                }
            });

        } else {

            mensaje('Campos Requeridos', 'Verifique ingresar un Cliente a la factura', 'info');

        }

        $('#cuerpoDocumento')[0].reset();
        resumenConsulta("con");
        return false;


    });

    $("#Resumen").click(function() {


        resumenConsulta("fin");
        
            // setTimeout(imprimir(), 2000);

    });

    $("#ResumenCon").click(function() {

    resumenConsulta("con");
  
   

    });

    function imprimir(){
        if ($('#tipodocSelect').val() == "store") {
               url='<?=base_url()?>reportes/notCred/notCred';

            } else {

                 url='<?=base_url()?>reportes/notCred/notCred';
            }
 $.ajax({
    type: 'POST',
    url:url ,
    xhrFields: {
         responseType: 'blob'
     },
     data: {
         ajax: true,
         numeroControl: numeroControl,
         codigoGeneracion: codigoGeneracion,
     },
     success: function (json) {
         var blob = new Blob([json], { type: 'application/pdf' });
            var URL = window.URL || window.webkitURL;
            //Creamos objeto URL
            var downloadUrl = URL.createObjectURL(blob);
            //Abrir en una nueva pestaña
            window.open(downloadUrl);
     },
     error: function() {
        console.log("Error");
     }
 });
        
    }
    
    function resumenConsulta(tipoConsulta) {
        var Datos = {
            "numeroControl": numeroControl,
            "codigoGeneracion": codigoGeneracion,
            // "excluido": $('#excluido').val(),
            "grancontribuyente": grancontribuyente,
            "tipodocElec": $('#tipodocSelect').val(),
            "areafact": areafact,
            "tipoConsulta": tipoConsulta,
            "item153": condicionOpera,
            "item154": codFormaPago,
            "item157": Plazo,
            "item158": periodoPlazo,
            };

        if ($('#tipodocSelect').val() == 'store') {
            var url = '<?=base_url()?>mhdte/cuerpodocumento/ingresoResumen';
        } else {
            var url = '<?=base_url()?>mhdte/cuerpodocumento/ingresoResumenCCF';
        }


        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {
                respuesta = JSON.parse(data);
                
                $('#riva').val(respuesta.iva13);
                $('#riva1').val(respuesta.ivaPercibido);
                $('#totalon').val(respuesta.montoPorFormaPag);
                if(tipoConsulta=="fin"){
                    enviarDte(codigoGeneracion,numeroControl);
                }
            }
        });

    }
    
    function BuscarCC() {
 
                var Datos = {
                    "numeroControl": $('#num').val(),
                    "codigoGeneracion":$('#cod').val(),
                    "fechatxt":$('#fecha').val(),
                    "tipocomp":$('#tipoIva').val()
                };
        

        var url = "<?php echo base_url("mhdte/serviciosgenerales/comNotCred");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {

            datos_tabla_new = JSON.parse(data);
           
               
                 if(datos_tabla_new["Ocu"]){
                    este=JSON.parse(datos_tabla_new["Ocu"]);
                    
                     mensaje('Informacion','DTE Ya esta Asociado a una Retencion '+este[0].numeroControl, 'info');
                }
                 if(datos_tabla_new["Lib"]){
                    datos_tabla_new =JSON.parse(datos_tabla_new["Lib"]);
                    numeroControl=datos_tabla_new[0].numeroControl;
                    codigoGeneracion=datos_tabla_new[0].codigoGeneracion;
                    grancontribuyente=datos_tabla_new[0].grancontribuyente;
                    areafact=datos_tabla_new[0].areafact;
                     
                }
                
                
                
            modalPro();
                $('#item78').val(codigoGeneracion);
                tableDetalle2 = $('#example2').DataTable({
                    "processing": true,
                    "destroy": true,
                    paging: false,
                    scrollY: '30vh',
                    scrollCollapse: true,
                    "bPaginate": false, 
                    searching: false,
                    info:false,
                    "data": datos_tabla_new,
                    "columns": [
                        {
                            data: "Nomdenominacion",
                        },{
                            data: "fecha",
                        },
                        {
                            data: "item"
                        },
                        {
                            data: "descripcion",
                        },
                        {
                            data: "montoPorFormaPag",
                        },
                        {
                            data: "ivaPercibido",                        
                        },
                        {
                            data: "iva13",                            
                        },
                        {
                            data: "retencionRenta",                            
                        },
                        {
                            "data": null,
                            "mRender": function(data, type, value) {
                                
                                doc="'"+value["codigoGeneracion"] +"'";
                              
                              
                                return '<a class="btn" href="#" onclick="NuevocompCredi(' +doc+ ')"><i class="fa fa-save"></i></a>'
                            },
                            width: "170px",

                        }
                    ],
                });
            }
        });
    }
    
    function NuevocompCredi(cod){
                  var Datos = {
                    "numeroControl": numeroControl,
                    "codigoGeneracion":codigoGeneracion,
                    "fechatxt":$('#fecha').val(),
                    "tipocomp":$('#tipoIva').val()
                };
        

        var url = "<?php echo base_url("mhdte/serviciosgenerales/creaNotCred");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) { 
             respuesta = JSON.parse(data);

                numeroControl = respuesta.numeroControl;
                codigoGeneracion = respuesta.codigoGeneracion;
                 $('#Vnumcontrol').html(numeroControl);
                $('#Vcodcontrol').html(codigoGeneracion);
                
            }
        });
        
        
    }

    function llenarTabla(numeroControl, codigoGeneracion) {

        var Datos = {
            "numeroControl": numeroControl,
            "codigoGeneracion": codigoGeneracion
        };

        var url = "<?php echo base_url("mhdte/cuerpodocumento/llenarTabla");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {

                datos_tabla_new = JSON.parse(data);

                tableDetalle = $('#example').DataTable({
                    "processing": true,
                    "destroy": true,
                    paging: false,
                    scrollY: '30vh',
                    scrollCollapse: true,

                    searching: false,
                    "data": datos_tabla_new,
                    "columns": [{
                            data: "item"
                        },

                        {
                            data: "descripcion"
                        },
                        {
                            data: "cantidad",
                            width: "20px",
                        },
                        {
                            data: "precioUnitario",
                            width: "20px",
                        },
                        {
                            data: "subtotal",
                            width: "20px",
                        },
                        {
                            "data": null,

                            "mRender": function(data, type, value) {
                               cod=   "'"+codigoGeneracion+"'";
                                num=   "'"+numeroControl+"'";
                                item="'"+value["identificador"]+"'";
                                return '<a class="btn" href="#" onclick="EliminarCD(' +  cod+ ',' +  num+ ',' +  item+ ')"><i class="fa fa-trash"></i></a>'
                            },
                            width: "170px",

                        }

                    ],

                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api(),
                            data;

                        // converting to interger to find total
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };



                        var friTotal = api
                            .column(4)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);


                        // Update footer by showing the total with the reference of the column index 
                        $(api.column(3).footer()).html('SubTotal');

                        $(api.column(4).footer()).html(friTotal.toFixed(3));
                    },

                });


            }
        });


    }

    function mensaje(t, txt, stilo) {

        new PNotify({
            title: t,
            text: txt,
            type: stilo,
            styling: 'bootstrap3'
        });
    }
function EliminarCD(a,b,c){
        
        
        var Datos = {
            "numeroControl": a,
            "codigoGeneracion": b,
            "item": c,
           
        };

        var url = "<?php echo base_url("mhdte/otrosdocumentos/EliminarCD");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {
                respuesta = JSON.parse(data);
               if (respuesta.OK == 1) {

                       mensaje('info','Eliminacion Correcta', 'Detalle de Documento');
                   llenarTabla(numeroControl, codigoGeneracion);
                     resumenConsulta("con");
                    } else {
                        mensaje('error', respuesta.OK, 'error');
                    }

            }
        });

    } 
    
</script>
