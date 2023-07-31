
        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
      
        <div class="right_col" role="main">
          <!-- top tiles -->
         
          <!-- /top tiles -->

        
     <!-- form input mask -->
             <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Comprobante de Retención</h2>
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
											<input type="text" class="form-control " id="num" placeholder="Numero Control" >
										</div>

										

										<div class="col-md-6 col-sm-6  form-group ">
											<input type="text" class="form-control " id="cod" placeholder="Cod Generacion" >
										</div>

                        <div class="col-md-6 col-sm-6  form-group ">
                                            <select id="tipoIva" class="form-control">
                                            <option value="C4">Comprobante 13%   </option>
                                            <option value="22">Comprobante 1%   </option>
                                            </select>
										</div>
                        
										<div class="col-md-6 col-sm-6  form-group ">
												<input type="hidden" class="form-control" id="fecha" data-inputmask="'mask': '99/99/9999'">
                                            <div class="col-md-9 col-sm-9 ">
												
												<button type="button" onclick=" llenarTabla()" class="btn btn-success">Buscar documento</button>
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
   
            
            <div class="row">
         
                <div class="x_content">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            
                                            <th>Num. control</th>

                                            <th>Cod. DTE</th>
                                           
                                            <th>Total</th>
                                            <th>Retenido</th>
                                            <th>Percivido</th>
                                            <th>Renta</th>
                                            <th>Codigo Comp. Retencion </th>
                                            <th>
                                            </th>
                                        </tr>
                                    </thead>


                                    <tbody>



                                    </tbody>
                                   
                                </table>
                               


                            </div>
            </div>
            
            

        </div>

<script>
    
    var fechacomple;
    var horacomple;
    var numeroControl;// = 'DTE-07-123456789-000000000000517';
    var codigoGeneracion;//='347656AD-FF9E-49E1-A948-66D7D2A2998B';
//8F7E2C14-C558-435D-9D3E-ECB0F832BD59
//DTE-14-123456789-000000000000472
    

    
    //473
    //6B9CDE9A-7605-4EEC-B176-3CE597091AC7
    
     $(document).ready(function() {
        tomarhoras();
      tableDetalle = $('#example').DataTable({
            paging: false,
            searching: false,
            info: false,
        });
    
    });
    
  
function llenarTabla() {
    //$('#num').val(),$('#cod').val(),
var Datos = {
        "numeroControl": $('#num').val(),
        "codigoGeneracion":$('#cod').val(),
        "fechatxt":$('#fecha').val(),
        "tipocomp":$('#tipoIva').val()
            
        };
 
     if ( ($('#num').val() != '' || $('#cod').val() != '') && ($("#num").val().length==31 && $("#cod").val().length==36)) {
      
        var url = "<?php echo base_url("mhdte/serviciosgenerales/comprorete");?>";
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
                }
              
                tableDetalle = $('#example').DataTable({
                    "processing": true,
                    "destroy": true,
                    paging: false,
                    scrollY: '30vh',
                    scrollCollapse: true,

                    searching: true,
                    "data": datos_tabla_new,
                    "columns": [
                        {
                            data: "numeroControl"
                        },
                        {
                            data: "codigoGeneracion",
                           
                        },
                        {
                            data: "montoPorFormaPag",
                            
                        },
                        {
                            data: "ivaRetenido",
                            
                        },{
                            data: "ivaPercibido",
                            
                        },{
                            data: "retencionRenta",
                            
                        },
                        
                        {
                            "data": null,

                            "mRender": function(data, type, value) {
                                return '<p id="Vnumcontrol"></p><p id="Vcodcontrol"></p>'
                            },
                           

                        },{
                            "data": null,

                            "mRender": function(data, type, value) {
                                var un="'"+value["numeroControl"] +"'";
                                var dos="'"+value["codigoGeneracion"] +"'";
                                return '<a class="btn btn-success btn-sm" href="#" onclick="enviardte(' + un + ',' + dos + ')"><i class="fa fa-save"></i></a><a class="btn btn-success btn-sm" href="#" onclick="imprimir()"><i class="fa fa-print"></i></a>'
                            },
                           

                        }

                    ],

                   

                });


            }
        });
     }else{
           mensaje('Campos Requeridos', 'Verifique ingresar Numero Numero de Control y Codigo Generacion', 'info');
     }

    }


function enviardte(un,dos){
    
    tomarhoras();
    var Datos = {
        "numeroControl": un,
        "codigoGeneracion":dos,
        "fechacomple":fechacomple,
        "horacomple":horacomple,
         "tipocomp":$('#tipoIva').val()
                    
        };
		console.log(Datos);
      var url = "<?php echo base_url("mhdte/serviciosgenerales/creacomprorete");?>";
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
                
                 
                    enviarDte(codigoGeneracion,numeroControl);
                
                
            }
        });
    
    
}    
    
    
function tomarhoras(){
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
        fechacomple=(ano + '-' + mes + '-' + dia);
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

        horacomple=(hora + ':' + minutos);
    }
    
function imprimir(){
       

                 url='<?=base_url()?>reportes/compRet/compRet';
            
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
    

     function mensaje(t, txt, stilo) {

        new PNotify({
            title: t,
            text: txt,
            type: stilo,
            styling: 'bootstrap3'
        });
    }
</script>
