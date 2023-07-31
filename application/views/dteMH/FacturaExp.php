<!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="container body">
    <div class="main_container">



        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <div class="col-md-12 col-sm-12">
                            <h4><?php echo strtoupper($titulo);?></h4>
                            <input type="hidden" value="11" class="form-control-sm" id="tipodocSelect">
                        </div>

                    </div>

                    <div class="title_right">

                        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <input type="time" class="form-control-sm" id="item11">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-5  form-group pull-right top_search">
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

                                    <table class="table-bordered" style="width:100%">
                                        <tr>
                                            <th>Cliente</th>
                                            <th> <span>Modo envio</span> </th>
                                            <th> <span>Modo de pago</span> </th>


                                            <th colspan="2"> <span>Periodos</span> </th>


                                        </tr>


                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="col-md-12 col-sm-12  form-group ">
                                                        <input type="text" id="txt1" required="required" class="form-control-sm col-md-4" placeholder="Codigo Cliente">
                                                        <select class="form-control-sm col-md-12" id="select1">

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6  form-group ">

                                                        <input type="text" class="form-control " id="contrato" placeholder="Contrato N°">

                                                    </div>

                                                </td>
                                                <td>
                                                    <select class="form-control-sm col-md-10" id="consin">
                                                        <option value="01">EXW- En fabrica</option>
                                                        <option value="02">FCA-Libre transportista</option>
                                                        <option value="09">FOB-Libre a bordo</option>

                                                    </select>
                                                    <br>
                                                    <br>
                                                    <select class="form-control-sm col-md-12" id="resfiscal">


                                                    </select>
                                                </td>


                                                <td>


                                                    <select class="form-control-sm col-md-12" id="item153">
                                                        <option value="1">Contado</option>
                                                        <option value="2">Crédito</option>
                                                        <option value="3">Otro</option>
                                                    </select>
                                                    <select class="form-control-sm col-md-12" id="item154">
                                                        <option value="01">Billetes y monedas</option>
                                                        <option value="02">Tarjeta Debito</option>
                                                        <option value="03">Tarjeta Credito</option>
                                                    </select>

                                                </td>
                                                <td>

                                                    <div class="form-group">

                                                        <div class="col-md-12 col-sm-12 ">
                                                            <select class="form-control-sm col-md-10" id="item157">

                                                                <option value="01">Dias</option>
                                                                <option value="02">Mes</option>
                                                                <option value="03">anio</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group"> <br><br>
                                                        <input type="text" id="item158" class="form-control-sm col-md-6" placeholder="dias/mes/anios">
                                                    </div>
                                                </td>

                                                <td>

                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-secondary btn-sm">Guardar</button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="7">
                                                    <div class="col-md-12 col-sm-12  form-group ">
                                                        <input type="text" id="destino" required="required" class="form-control-sm col-md-8" placeholder="Destino">
                                                    </div>
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
                                            <td>
                                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                    <textarea id="marcas" rows="5" required="required" class="form-control" placeholder="Marcas"></textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-6  form-group has-feedback">

                                                    <input type="text" class="form-control " id="sacos" placeholder="Sacos">

                                                </div>
                                                <div class="col-md-6 col-sm-6  form-group has-feedback">
                                                    <label for="fullname">Q. Espanioles</label>
                                                    <input type="text" class="form-control" id="Qesp" placeholder="Quintales Espanioles">

                                                </div>





                                            </td>
                                            <td>


                                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                                    <input type="text" class="form-control-sm col-md-4" id="item80" placeholder="cantidad">

                                                    <select class="form-control-sm col-md-4" id="item83">
                                                        <option value="59">Unidad</option>
                                                        <option value="58">Kilogramos</option>
                                                        <option value="57">Libras</option>
                                                        <option value="39">Gramos</option>
                                                        <option value="32">Quintal</option>
                                                        <option value="22">Gramos</option>
                                                        <option value="23">Gramos</option>
                                                        <option value="24">Gramos</option>
                                                        <option value="99">OTROS</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                                    <input type="text" id="item81" required="required" class="form-control-sm col-md-4" placeholder="Codigo producto">
                                                    <select class="form-control-sm col-md-8" id="item84">
                                                    </select>
                                                </div>

                                                <br>
                                                <textarea id="observacionesItem" rows="5" required="required" class="form-control" placeholder="Descripcion"></textarea>
                                            </td>
                                            <td>
                                                <div class="col-md-12 col-sm-12  form-group has-feedback">
                                                    <input type="number" step="any" class="form-control-sm " id="item85" placeholder="precio" required>

                                                </div>
                                                <div class="col-md-12 col-sm-12  form-group has-feedback">

                                                    <button type="submit" class="btn-sm btn-secondary">Agregar</button>
                                                </div>
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
                                            <th>Marca</th>
                                            <th>Sacos</th>
                                            <th>Q. Esp</th>
                                            <th>Cantidad</th>
                                            <th style="width:40%">Descripcion</th>

                                            <th>Precio</th>

                                            <th>Subtotal</th>
                                            <th>
                                                <button type="button" id="Resumen" class="btn btn-success btn-sm">Guardar</button>
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
                                            <th></th>
                                            <th></th>
                                            <th></th>

                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">


                                        <div class="col-md-3">
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
                <!-- form input mask -->
                <div class="row">
                    <div class="col-md-12 col-sm-12  ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Comprobante de Remición</h2>
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


                                <div class="col-md-6 col-sm-6  form-group ">
                                    <input type="text" class="form-control " id="Reminumcontrol" placeholder="Numero Control" disabled >
                                </div>



                                <div class="col-md-6 col-sm-6  form-group ">
                                    <input type="text" class="form-control " id="Remicodcontrol" placeholder="Cod Generacion" disabled >
                                </div>
                                <div class="col-md-6 col-sm-6  form-group ">
                                    <input type="text" class="form-control " id="Motorista" placeholder="Motorista" >
                                </div>



                                <div class="col-md-6 col-sm-6  form-group ">
                                    <input type="text" class="form-control " id="Licencia" placeholder="Licencia" >
                                </div>
                                <div class="col-md-6 col-sm-6  form-group ">
                                    <input type="text" class="form-control " id="Placa" placeholder="Placa" >
                                </div>



                                <div class="col-md-6 col-sm-6  form-group ">
                                    <input type="text" class="form-control " id="Marcavehi" placeholder="Marca Vehiculo" >
                                </div>



                                <div class="col-md-6 col-sm-6  form-group ">
                                    <input type="hidden" class="form-control" id="fecha" data-inputmask="'mask': '99/99/9999'">
                                    <div class="col-md-9 col-sm-9 ">

                                        <button type="button" onclick=" CreaComRemi()" class="btn btn-success">CREAR COMPROBANTE</button>
                                    </div>
                                </div>



                                <div class="form-group row">

                                </div>


                                <div class="ln_solid"></div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /form input mask -->



            </div>
        </div>
        <!-- /page content -->

    </div>
</div>

<script>
    var arregleProducto;
    var arregleclientes;
    var tableDetalle;
    var numeroControl = '';
    var codigoGeneracion = '';
    var grancontribuyente = '';
    var areafact = '';

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


    $(document).ready(function() {
        llenacombos();
        tableDetalle = $('#example').DataTable({

            scrollY: '30vh',
            scrollCollapse: true,
            paging: false,
            searching: false,


        });


        $('#item81').on("input", function() {
            var dInput = this.value;
            var Datos = {
                "codigo": dInput,
                "area": areafact,

            };
            console.log(Datos);
            var url = "<?php echo base_url("mhdte/generales/listaServicioGen");?>";
            $.ajax({
                type: "POST",
                url: url,
                data: Datos,
                success: function(data) {

                    arregleProducto = JSON.parse(data);
                    $("#item84").empty();
                    $('#item85').val('');


                    for (i = 0; i < arregleProducto.length; i++) {
                        $("#item84").append($("<option>", {
                            value: i,
                            text: arregleProducto[i]['descripcion']
                        }));

                    }
                    if (arregleProducto.length == 1) {
                        llenartext(0);
                    }



                }
            });

        });



        $('#item84').on('click', function() {

            llenartext($(this).val());

        });


        function llenartext(num) {

            fila = num;

            $('#item81').val(arregleProducto[fila].codigo);
            $('#item83').val(arregleProducto[fila].UnidadMedida);
        }


        $('#txt1').on("input", function() {

            if ($('#txt1').val().length > 0) {

                var Datos = {
                    "codigo": $('#txt1').val(),

                };

                var url = "<?php echo base_url("mhdte/receptor/listaBuscarCliente");?>";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: Datos,
                    success: function(data) {

                        arregleclientes = JSON.parse(data);
                        $("#select1").empty();

                        grancontribuyente = '';

                        for (i = 0; i < arregleclientes.length; i++) {
                            $("#select1").append($("<option>", {
                                value: arregleclientes[i]['codigo'] + ',' + arregleclientes[i]['granContribuyente'],
                                text: arregleclientes[i]['codigo'] + ' -- ' + arregleclientes[i]['NomDenominacion']
                            }));

                        }
                        if (arregleclientes.length == 1) {
                            grancontribuyente = arregleclientes[0]['granContribuyente'];
                        }

                    }
                });

            }


        });

        // document

    });

    window.onload = function() {
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth() + 1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        var minutos;
        var horas;
        if (dia < 10)
            dia = '0' + dia; //agrega cero si el menor de 10
        if (mes < 10)
            mes = '0' + mes //agrega cero si el menor de 10
        $('#item10').val(ano + '-' + mes + '-' + dia);
        if (fecha.getMinutes() < 10) {
            minutos = '0' + fecha.getMinutes();
        } else {
            minutos = fecha.getMinutes();
        }
        if (fecha.getHours() < 10) {
            horas = '0' + fecha.getHours();
        } else {
            horas = fecha.getHours();
        }
        console.log(horas + ':' + minutos);
        $('#item11').val(horas + ':' + minutos);
    }

    $('#receptor').submit(function() {


        var Datos = {
            "tipodocSelect": $('#tipodocSelect').val(),

            "item11": $('#item11').val(),
            "item10": $('#item10').val(),
            "txt1": $('#txt1').val(),
            "destino": $('#destino').val(),
            "version": "1"
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
                $('#consin').prop("disabled", true);


            }
        });

        return false;
    });


    $('#cuerpoDocumento').submit(function() {
        var filas = tableDetalle.rows().count() + 1;
        var tipodocSelect = $('#tipodocSelect').val();

        var Datos = {
            "numeroControl": numeroControl,
            "codigoGeneracion": codigoGeneracion,
            "tipodocSelect": tipodocSelect,
            "grancontribuyente": grancontribuyente,
            "item80": $('#item80').val(),
            "item84": $('#item84 option:selected').html(),
            "item81": $('#item81').val(),
            "item85": $('#item85').val(),
            "item83": $('#item83').val(),
            "observacionesItem": $('#observacionesItem').val(),
            "item72": filas,
            "item73": tableDetalle.rows().count(),
            "Marcas": $('#marcas').val(),
            "Sacos": $('#sacos').val(),
            "Qesp": $('#Qesp').val(),
            "resfiscal": $('#resfiscal').val(),
            "contrato": $('#contrato').val()

        };

        console.log(Datos);

        if (numeroControl != '' || codigoGeneracion != '') {

            var url = '<?=base_url()?>mhdte/cuerpodocumento/cFacturaExp'
            $.ajax({
                type: "POST",
                url: url,
                data: Datos,
                async: false,
                success: function(data) {
                    respuesta = JSON.parse(data);
                    if (respuesta.OK == 1) {

                        setTimeout(llenarTabla(numeroControl, codigoGeneracion), 1000);

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
        $('#item80').focus();

    });

    $("#Resumen").click(function() {


        resumenConsulta("fin");


    });

    $("#ResumenCon").click(function() {


        resumenConsulta("con");


    });

    function imprimir() {


        url = '<?=base_url()?>reportes/facEx/facEx';



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
            "consin": $('#consin').val(),
            "consinDes": $('#consin option:selected').html()

        };


        var url = '<?=base_url()?>mhdte/serviciosgenerales/ingresoResumenEx';


        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            async: false,
            success: function(data) {
                respuesta = JSON.parse(data);


                $('#totalon').val(respuesta.montoPorFormaPag);
                if (tipoConsulta == "fin") {
                    enviarDte(codigoGeneracion, numeroControl);
                }
            }
        });

    }

    function llenarTabla(numeroControl, codigoGeneracion) {

        var Datos = {
            "numeroControl": numeroControl,
            "codigoGeneracion": codigoGeneracion
        };

        var url = "<?php echo base_url("mhdte/serviciosgenerales/llenarTablaExp");?>";
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
                    "language": {
                        "decimal": ".", //separador decimales
                        "thousands": "," //Separador miles
                    },
                    searching: false,
                    "data": datos_tabla_new,
                    "columns": [{
                        data: "item"
                    },
                                {
                                    data: "observacionesItems"
                                },
                                {
                                    data: "sacos"
                                },
                                {
                                    data: "Qesp"
                                },
                                {
                                    data: "cantidad",
                                    width: "20px",
                                },

                                {
                                    "render": function(data, type, row) {
                                        return (row['descripcion'] + ' ' + row['observacionesItem']);


                                    },
                                    // data: "descripcion" + " " +"observacionesItem" 
                                },

                                {
                                    data: "precioUnitario",
                                    width: "20px",
                                },

                                {
                                    data: "subtotal",
                                    width: "20px",
                                    render: $.fn.dataTable.render.number(',', '.', 2)
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
                        .column(7)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                        // Update footer by showing the total with the reference of the column index 
                        $(api.column(4).footer()).html('SubTotal');

                        $(api.column(5).footer()).html(friTotal.toFixed(3));
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

    function llenacombos() {
        // alert();

        if (areafact != "OF") {

            $("#partidaBtn").prop("disabled", true);
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

        var url = "<?php echo base_url("mhdte/generales/regFiscal");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {

                cat014 = JSON.parse(data);

                $("#resfiscal").empty();
                for (i = 0; i < cat014.length; i++) {
                    $("#resfiscal").append($("<option>", {
                        value: cat014[i]['codigo'],
                        text: cat014[i]['valor']
                    }));

                }

            }
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
