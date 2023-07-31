
        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
      
        <div class="right_col" role="main">
          <!-- top tiles -->
         
          <!-- /top tiles -->

        
     <!-- form input mask -->
            <div class="row">
              <div class="col-md-6 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Verifique la Fecha de envio</h2>
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
                    <form class="form-horizontal form-label-left" id="consultalsto">

                      <div class="form-group row">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Confirmar Fecha:</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="date" class="form-control" id="fecha" data-inputmask="'mask': '99/99/9999'">
                        
                        </div>
                      </div>
                        
                   <div class="ln_solid"></div>

                      <div class="form-group row">
                        <div class="col-md-9 offset-md-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
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
                                             <th>Cobol</th>
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


<script>
    
 $(document).ready(function() {
       
      tableDetalle = $('#example').DataTable({

            scrollY: '30vh',
            scrollCollapse: true,
            paging: false,
            searching: false,


        });
     llenarTabla();
    
    });
    
    
function llenarTabla() {

        var Datos = {
            "numeroControl": 'DTE-03-123456789-000000000000215',//numeroControl,
            "codigoGeneracion": 'EB5568A0-BDE6-43B6-AD4A-07A72836E71C',//codigoGeneracion,
            
        };

        var url = "<?php echo base_url("mhdte/integracion/llenarTabla");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {

                datos_tabla_new = JSON.parse(data);
                console.log(datos_tabla_new);
                tableDetalle = $('#example').DataTable({
                    "processing": true,
                    "destroy": true,
                    paging: false,
                    scrollY: '30vh',
                    scrollCollapse: true,

                    searching: false,
                    "data": datos_tabla_new,
                    "columns": [{
                            data: "cliente"
                        },

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
                            data: "fecha",
                            
                        },
                        {
                            "data": null,

                            "mRender": function(data, type, value) {
                                return '<a class="btn btn-success btn-sm" href="#" onclick="enviardte(' + value["item"] + ')"><i class="fa fa-send"></i></a>'
                            },
                           

                        }

                    ],

                   

                });


            }
        });


    }
    
 
$('#consulta').submit(function() {
    
    var Datos = {
            "fechatxt":$('#fecha').val(),
          
        };
        
     var url = "<?php echo base_url("mhdte/Integracion/ingresomasivo");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            
            success: function(data) {
               // respuesta = JSON.parse(data);
                

                //console.log(respuesta);
                
                agrupaInserta();
                

            },
         
        });
    
    return false;
       

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
        
        var url = "<?php echo base_url("mhdte/Integracion/archivotxt");?>";
        //var url = "<?php echo base_url("mhdte/Integracion/leerArchivo");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
           
            success: function(data) {
                respuesta = JSON.parse(data);

                console.log(respuesta);

            },
            error: function(jqXHR, textStatus, errorThrown) {
       
        }
        });

        return false;
       

});
    
    
   function consulta(num,corr){
       
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
