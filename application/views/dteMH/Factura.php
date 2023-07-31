<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="container body">
    <div class="main_container">



        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <div class="col-md-5 col-sm-5">
                            <select class="form-control" id="tipodocSelect">
                                <option value="store">FACTURA</option>
                                <option value="storeCCF">CRED. FISCAL</option>

                            </select>

                        </div>
                        <div class="col-md-6 col-sm-6">
                            <h2><?php echo strtoupper($titulo);?></h2>
                        </div>

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
                    <!-- form input mask -->
                    <div class="col-md-12 col-sm-12  ">
                        <div class="x_panel">
                            <div class="x_title">
                                <label>Datos del Cliente </label>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <form class="form-horizontal" id="receptor">

                                    <table class="table-bordered text-center" style="width:100%">
                                        <tr>
                                            <th style="width:38%">Cliente</th>

                                            <th style="width:48%"> <span>Modo de pago</span> </th>

                                            <th style="width:12%" colspan="2"> <span>Periodos</span> </th>
                                            <th> </th>

                                        </tr>

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" id="txt1" required="required" class="form-control-sm col-md-3 col-sm-3" placeholder="Codigo Cliente">
                                                    <select class="form-control-sm  col-sm-9" id="select1">

                                                    </select>

                                                </td>

                                                <td>
                                                    <div class="col-md-12 col-sm-12 ">
                                                        <select class="form-control-sm" id="item153">
                                                            <option value="1">Contado</option>
                                                            <option value="2">Crédito</option>
                                                            <option value="3">Otro</option>
                                                            <option value="Ci">Consumo Interno</option>
                                                        </select>
                                                        <select class="form-control-sm" id="item154">
                                                            <option value="01">Billetes y monedas</option>
                                                            <option value="02">Tarjeta Debito</option>
                                                            <option value="03">Tarjeta Credito</option>
                                                        </select>
                                                        <input class="form-control-sm" id="numPagoElecNPE" placeholder="NPE de Pago" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <select class="form-control-sm" id="item157">
                                                            <option value="01">Dias</option>
                                                            <option value="02">Mes</option>
                                                            <option value="03">anio</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" id="item158" class="form-control-sm col-md-12" placeholder="dias/mes/anios">
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-secondary btn-sm">Guardar</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /form input mask -->
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <label>Detalle de Factura <i class="fa fa-arrow-right"> &nbsp;&nbsp;&nbsp;</i></label>
                                <label>Correlativo: <small id="Vnumcontrol"></small> &nbsp;&nbsp;&nbsp;</label>
                                <label>Codigo: <small id="Vcodcontrol"></small> </label>

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
                                            <th>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Productos</button>
                                                <button id="partidaBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lgPart">Partida Contabla</button>
                                            </th>
                                            <th>cantidad y precio</th>
                                            <th></th>


                                        </tr>
                                        <tr>
                                            <td><input type="text" class="form-control-sm col-md-8" id="item80" placeholder="cantidad"></td>
                                            <td><input type="text" id="item81" required="required" class="form-control-sm col-md-4 col-sm-4" placeholder="Codigo producto">
                                                <select class="form-control-sm col-md-8 col-sm-8" id="item84" col-md-8 col-sm-8>

                                                </select>

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
                                                <input type="hidden" id="observacionesItem" placeholder="VentasGrabadas" />
                                                <input type="hidden" id="item78" />
                                                <input type="hidden" id="destino" />
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


        <!-- /page content -->
        <div id="modalpartida" class="modal fade bs-example-modal-lgPart" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Ingreso Partida Contable Facturacion Oficina</h4>
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
                                            <form id="PartContable" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Num. cuenta <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="cuentaContable" required="required" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Descripción <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input type="text" id="descripcion" required="required" class="form-control ">
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Cargo / Abono <span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <select id="debehaber" class="form-control">
                                                            <option value="1">CARGO</option>
                                                            <option value="2">ABONO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Monto $</label>
                                                    <div class="col-md-6 col-sm-6 ">
                                                        <input id="monto" class="form-control" type="number" step="0.00">
                                                    </div>
                                                </div>

                                                <div class="ln_solid"></div>
                                                <div class="item form-group">
                                                    <div class="col-md-6 col-sm-6 offset-md-3">

                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>

                                            </form>

                                            <div class="row">
                                                <table id="tablaPartida" class="table table-striped table-bordered" style="width:100%">

                                                    <thead>
                                                        <tr>
                                                            <th>cuenta</th>
                                                            <th>Desc.</th>
                                                            <th>Cargo / Abono</th>
                                                            <th>Monto</th>
                                                            <th></th>

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
    var arregleclientes;
    var tableDetalle;
    var tableDetalle2;
    var tableDetalle3;
    var tableDetalle4;
    var numeroControl = '';
    var codigoGeneracion = '';
    var grancontribuyente = '';
    var areafact = '<?php echo $this->session->userdata("areafact")?>';


    $('#item154').on('change', function() {

    })
    $('#tipodocSelect').on('change', function() {
        var arregleProducto = '';

        var numeroControl = '';
        var codigoGeneracion = '';
        var grancontribuyente = '';
         $('#Vnumcontrol').html('');
         $('#Vcodcontrol').html('');

        $('#cuerpoDocumento')[0].reset();
        $('#receptor')[0].reset();
         $("#select1").empty();
        $('#item84').val('');
        limpiar2();
    })


    $('#select1').on('change', function() {

        separar = $(this).val().split(',');

        $('#txt1').val(separar[0]);
        grancontribuyente = (separar[1]);

    })
    
    $('#select1').on('click', function() {

        separar = $(this).val().split(',');

        $('#txt1').val(separar[0]);
        grancontribuyente = (separar[1]);

    })

    function llenacombos() {
        // alert();
        
        if(areafact!="OF"){
           
            $("#partidaBtn").prop( "disabled", true );
        }
        
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
        if (fecha.getHours() <= 9) {
            hora = '0' + fecha.getHours();
        } else {
            hora = fecha.getHours();
        }

        $('#item11').val(hora + ':' + minutos);
    }

    $('#receptor').submit(function() {


        var Datos = {
            "tipodocSelect": $('#tipodocSelect').val(),
            "item11": $('#item11').val(),
            "item10": $('#item10').val(),
            "txt1": $('#txt1').val(),
            "destino": $('#destino').val(),
            "version": ""
        };

        var url = "<?php echo base_url("mhdte/cuerpodocumento/add");?>";
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

        return false;
    });

    $('#PartContable').submit(function() {


        var Datos = {
            "numeroControl": numeroControl,
            "codigoGeneracion": codigoGeneracion,
            "cuentaContable": $('#cuentaContable').val(),
            "debehaber": $('#debehaber').val(),
            "monto": $('#monto').val(),
            "descripcion": $('#descripcion').val()

        };

        var url = "<?php echo base_url("mhdte/generales/partConta");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {
                respuesta = JSON.parse(data);
                $('#PartContable')[0].reset();

                consultaPartida();

            }
        });

        return false;
    });


    $('#cuerpoDocumento').submit(function() {

        var tipodocSelect = $('#tipodocSelect').val();

        var filas = tableDetalle.rows().count() + 1;


        var Datos = {
            "numeroControl": numeroControl,
            "codigoGeneracion": codigoGeneracion,
            "tipodocSelect": tipodocSelect,
            "item80": $('#item80').val(),
            "item84": $('#item84 option:selected').html(),
            "item81": $('#item81').val(),
            "item85": $('#item85').val(),
            "item83": $('#item83').val(),
            "item78": $('#item78').val(),
            "item153": $('#item153').val(),
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
                        llenarTabla(numeroControl, codigoGeneracion)
                       // setTimeout(llenarTabla(numeroControl, codigoGeneracion), 2000);
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
        filas = 0;
        return false;


    });

    $("#Resumen").click(function() {


        resumenConsulta("fin");
        
     
       
        //setTimeout(imprimir(), 2000);

    });

    $("#ResumenCon").click(function() {

        resumenConsulta("con");



    });

    function imprimir() {
        if ($('#tipodocSelect').val() == "store") {
            url = '<?=base_url()?>reportes/facCons/facCons';

        } else {

            url = '<?=base_url()?>reportes/CcFe/CcFe';
        }
        $.ajax({
            type: 'POST',
            url: url,
            xhrFields: {
                responseType: 'blob'
            },
            data: {
                ajax: true,
                numeroControl: numeroControl,
                codigoGeneracion: codigoGeneracion,
            },
            success: function(json) {
                var blob = new Blob([json], {
                    type: 'application/pdf'
                });
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
            "item153": $('#item153').val(),
            "item154": $('#item154').val(),
            "item157": $('#item157').val(),
            "item158": $('#item158').val(),
            "item158": $('#item158').val(),

        };

        if ($('#tipodocSelect').val() == 'store') {
            var url = '<?=base_url()?>mhdte/cuerpodocumento/ingresoResumen';
        } else {
            var url = '<?=base_url()?>mhdte/cuerpodocumento/ingresoResumenCCF';
        }
borrarTotales();

        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            async:false,
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

    function borrarTotales(){
        
                $('#riva').val('');
                $('#riva1').val('');
                $('#totalon').val('');
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
    
    function consultaPartida() {

        var Datos = {
            "numeroControl": numeroControl,
            "codigoGeneracion": codigoGeneracion
        };

        var url = "<?php echo base_url("mhdte/generales/consultaPartida");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {

                datos_tabla_new = JSON.parse(data);

                tableDetalle4 = $('#tablaPartida').DataTable({
                    "processing": true,
                    "destroy": true,
                    paging: false,
                    scrollY: '30vh',
                    scrollCollapse: true,

                    searching: false,
                    "data": datos_tabla_new,
                    "columns": [{
                            data: "cuentaContable"
                        },

                        {
                            data: "descripcion"
                        },{
                            data: "debeHaber"
                        },
                        {
                            data: "monto",
                            width: "20px",
                        },
                        {
                            "data": null,

                            "mRender": function(data, type, value) {
                                  doc="'"+value["numControl"] +"'";
                                  doc2="'"+value["codigoGeneracion"] +"'";
                                return '<a class="btn" href="#" onclick="EliminarPC(' + doc + ',' + doc2+ ',' + doc2+ ')"><i class="fa fa-trash"></i></a>'
                            },
                            width: "170px",

                        }

                    ]

                   
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
    function EliminarPC(a,b,c){
        
        
        var Datos = {
            "numeroControl": a,
            "codigoGeneracion": b,
            "item": c,
           
        };

        var url = "<?php echo base_url("mhdte/otrosdocumentos/EliminarPC");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {
                respuesta = JSON.parse(data);
               if (respuesta.OK == 1) {

                       mensaje('info','Eliminacion Correcta', 'Partida Contable');
                  consultaPartida();
                     resumenConsulta("con");
                    } else {
                        mensaje('error', respuesta.OK, 'error');
                    }

            }
        });

    }
</script>
