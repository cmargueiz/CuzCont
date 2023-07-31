
        <!-- =============================================== -->
        
        <!-- Content Wrapper. Contains page content -->
      
<div class="right_col" role="main">
          <!-- top tiles -->
         
          <!-- /top tiles -->

<div class="">
<div class="x_content">

<div class="title_left">
                <h3>Lista de Periodos Contables<small></small></h3>
</div>

</div>
<br />

<div class="row">
              <div class="col-md-8">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Periodos contables recientes<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"> Nuevo Periodo Contable</button></h2>
    <!-- modal -->                  
                    <div class="modal fade bs-example-modal-lg"  tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" id="myModal">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Nuevo Periodo Contable</h4>
                          </div>
                            <div class="modal-body">
                            <form id="nuevaclasifica" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha Inicio: <span class="required"></span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                              <input class="form-control" type="date" id="date" required="required">
                              </div>
                            </div>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha Inicio: <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                              <input class="form-control" type="date" id="date2" required="required">
                              </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                              <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Guardar</button>
                              </div>
                            </div>
                            </form>
                      </div>
                    </div>
                    </div>
                  </div>

                  <div class="modal fade bs-example-modal-lg"  tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" id="myModaledit">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Edicion Periodo Contable</h4>
                          </div>
                            <div class="modal-body">
                            <form id="editaPeriodo" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                            <input type="hidden" id="editado">
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Fecha Inicio: <span class="required"></span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                              <input class="form-control" type="date" id="Edate" required="required">
                              </div>
                            </div>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha Inicio: <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                              <input class="form-control" type="date" id="Edate2" required="required">
                              </div>
                            </div>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Estado: <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                             <select class="form-control" id="estado">
                              <option value="1">Activo</option>
                              <option value="0">Inactivo</option>
                             </select>
                              </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                              <div class="col-md-6 col-sm-6 offset-md-3">
                                <button type="submit" class="btn btn-success">Guardar</button>
                              </div>
                            </div>
                            </form>
                      </div>
                    </div>
                    </div>
                  </div>

      <!-- fin modal -->
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" >
                      <div class="row">
                          <div class="col-md-12">
                            <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                     
                    </p>
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                    cellspacing="0" aria-describedby="datatable-responsive_info" style="width:100%">
                      <thead>
                        <tr>
                          
                          <th>Año</th>
                          <th>Fecha In</th>
                          <th>Fecha Fin</th>
                          <th>Estado</th>
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


 <!-- /.content-wrapper -->
        </div>
        <br />
</div>
      
</div>
<script>
   $(document).ready(function() {
    $('#datatable').dataTable();
    cargarclasificacion();
     
} ); 


function cargarclasificacion() {
    
     var Datos= {
                  "estado":"estado",
                  "fechaou":''
                };

    $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("mantenimiento/Categorias/listaPeriodos");?>",
                    data:Datos,
                    success: function(response)
                    {
                 datos_tabla_new=JSON.parse(response);   
  
   $('#datatable').DataTable({
      "processing": true,
     "destroy": true,
     
      "data": datos_tabla_new,
      
      "info": false,
      "order": [[0, 'desc']],
       "columns": [
          
          { data: "anio"},
          { data: "fechaini"},
          { data: "fechafin"},
          { data: "estado",  "render": function (data, type, row) {
                  if (row.estado==1) {
                      return 'Activo'}
                      else {
                      return 'Inactivo';
                  }
          }},
          { data: "link" }
           ],
 
       
        
  } );
  }
});
}

function eliminar(este){
  if (confirm("Desea Eliminar el Periodo") == true) {
    
var Datos = {
               "borrar" : este,
               };
    
       var url = "<?php echo base_url("mantenimiento/Categorias/borrarPeriodo");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          alert(respuesta[0]);
      
          cargarclasificacion();
         

          }
      });
   
  }
}

function editar(este){
$('#myModaledit').modal('show');
    
var Datos = {
              "editar" : este,
              
               };
               var url = "<?php echo base_url("mantenimiento/Categorias/traePeriodo");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          $('#editado').val(respuesta[0]["cPeriodo"]);
         $('#Edate').val(respuesta[0]["cFechaIni"]);
         $('#Edate2').val(respuesta[0]["cFechaFin"]);
         $('#estado').val(respuesta[0]["cEstado"]);
          cargarclasificacion();
         

          }
      });
   /*

   
  */
}

$('#nuevaclasifica').submit(function(){

     
     var Datos = {
               "fecha1" : $('#date').val(),
               "fecha2" : $('#date2').val(),
               };
    
       var url = "<?php echo base_url("mantenimiento/Categorias/guardarPeriodo");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          if(respuesta){
            alert("Guardado Correctamente");
          }else{alert($respuesta)}
          
          $('#myModal').modal('hide');
          cargarclasificacion();
          $("#nuevaclasifica")[0].reset();

          }
      });
  
    return false;
    
   });  
    

   $('#editaPeriodo').submit(function(){

     
    var Datos = {
              "editar" : $('#editado').val(),
               "fecha1" : $('#Edate').val(),
               "fecha2" : $('#Edate2').val(),
               "estado" : $('#estado').val(),
               };
    
       var url = "<?php echo base_url("mantenimiento/Categorias/editarPeriodo");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          if(respuesta){
            alert("Editado Correctamente");
          }else{alert($respuesta)}
          $('#myModaledit').modal('hide');
          cargarclasificacion();
         

          }
      });

return false;

});  


</script>