
        <!-- =============================================== -->
    
        <!-- Content Wrapper. Contains page content -->
      
<div class="right_col" role="main">
          <!-- top tiles -->
         
          <!-- /top tiles -->

<div class="">
<div class="x_content">

<!-- modals -->
<!-- Large modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Large modal</button>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Cuenta Nueva</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="x_content">
                  <br>
                  <form class="form-label-left input_mask" id="nuevacuenta">

                  <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 ">Tipo de Cuenta </label>
                          <div class="col-md-9 col-sm-9 ">
                              <select class="form-control " id="tipocuenta">
                                  <option value="Seleccione"></option>

                              </select>
                              
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 ">Nombre:</label>
                          <div class="col-md-9 col-sm-9 ">
                              <input type="text" class="form-control" id="nombrecuenta" placeholder="Nombre de la cuenta">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 ">Numero:</label>
                          <div class="col-md-9 col-sm-9 ">
                              <input type="text" class="form-control" id="numcuenta" placeholder="Nombre de la cuenta">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 ">Nivel de Cuenta </label>
                          <div class="col-md-9 col-sm-9 ">
                              <select class="form-control " id="nivelcuenta">

                              </select>
                              
                          </div>
                      </div>
                      
                      <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 ">Clasificación de Cuenta </label>
                          <div class="col-md-9 col-sm-9 ">
                              <select class="form-control " id="clascuenta">

                              </select>
                              
                          </div>
                      </div>
                      <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 ">Cargo o Abono</label>
                          <div class="col-md-9 col-sm-9 ">
                              <select class="form-control " id="sumaresta">
                                  <option value="cargo">Cargo</option>
                                  <option value="abono">Abono</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 ">Estado</label>
                          <div class="col-md-9 col-sm-9 ">
                              <select class="form-control " id="estado">
                                  <option value="1">Activo</option>
                                  <option value="0">Inactiva</option>

                              </select>
                          </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group row">
                          <div class="col-md-9 col-sm-9  offset-md-3">
                          
                              <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                      </div>

                  </form>
              </div>
  
  
      </div>
    </div>
  </div>
</div>
<!-- Large modal Edit-->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true" id="modelEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Editar Cuenta</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="x_content">
                  <br>
                  <form class="form-label-left input_mask" id="editadocuenta">

                  <input id="ecodigo" type="hidden">
                      <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 ">Nombre:</label>
                          <div class="col-md-9 col-sm-9 ">
                              <input type="text" class="form-control" id="enombrecuenta" placeholder="Nombre de la cuenta">
                          </div>
                     </div>
                     <div class="form-group row">
                      <label class="col-form-label col-md-3 col-sm-3 ">Estado</label>
                          <div class="col-md-9 col-sm-9 ">
                              <select class="form-control " id="eestado">
                                  <option value="1">Activo</option>
                                  <option value="0">Inactiva</option>

                              </select>
                          </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group row">
                          <div class="col-md-9 col-sm-9  offset-md-3">
                          
                              <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                      </div>

                  </form>
              </div>
  
  
      </div>
    </div>
  </div>
</div>
</div>
<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Lista de Catalogo de Cuenta <span class="badge badge-success"><a class="" href="#" onclick ="cargareventos(2)">Cargar Cuentas Inactivas</a></span></h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-md-12">
                            <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                     
                    </p>
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                    cellspacing="0" aria-describedby="datatable-responsive_info" style="width:100%">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Num. Cuenta</th>
                          <th>Nombre</th>
                          <th>Nivel</th>
                          <th>Tipo </th>
                          <th>Clasificación</th>
                          <th>Cuenta Padre</th>
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

 <!-- /.content-wrapper -->
        </div>
         
        <br />
</div>
      
</div>
<script>
   $(document).ready(function() {
    $('#datatable').dataTable();
      cargareventos(1);
     
} ); 

function cargareventos(estado) {
     
     var Datos= {
                  "estado":estado,
                  "fechaou":''
                };

    $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("mantenimiento/Categorias/listacuenta");?>",
                    data:Datos,
                    success: function(response)
                    {
                 datos_tabla_new=JSON.parse(response);   
  
   $('#datatable').DataTable({
      "processing": true,
     "destroy": true,
     
      "data": datos_tabla_new,
      
      "info": false,
      
       "columns": [
          { data: "codigocuenta"},
          { data: "numcuenta"},
          { data: "nombre" },
          { data: "nivel" },
          { data: "tipo" },    
          { data: "clasificacion" },   
          { data: "cuentapadre" },      
          { data: "link" }
           ],
 
       
        
  } );
  }
});
}

function editar(editado){
  $('#modelEdit').modal('show');
  var Datos= {
                  "editado":editado,
                  
                };

                var url = "<?php echo base_url("mantenimiento/Categorias/obteberEditado");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          $('#ecodigo').val(editado);
          $('#enombrecuenta').val(respuesta["cNombreCuenta"]);
          $('#eestado').val(respuesta["cEstado"]);


          }
      });

}

$('#nuevacuenta').submit(function(){
    alert();
     
     var Datos = {
               "tipocuenta" : $('#tipocuenta').val(),
               "nombrecuenta" : $('#nombrecuenta').val(),
               "numcuenta" : $('#numcuenta').val(),
               "cNivelcuenta" : $('#nivelcuenta').val(),
               "clascuenta" : $('#clascuenta').val(),
               "sumaresta" : $('#sumaresta').val(),
               "estado" : $('#estado').val(),
              
       };
    
       var url = "<?php echo base_url("mantenimiento/Categorias/store");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          alert(respuesta[0]);


          }
      });
  
    return false;
    
   });  

   //editadocuenta
    
   $('#editadocuenta').submit(function(){
   
     
     var Datos = {
               "ecodigo" : $('#ecodigo').val(),
               "enombrecuenta" : $('#enombrecuenta').val(),
               "eestado" : $('#eestado').val(),
              
       };
    
       var url = "<?php echo base_url("mantenimiento/Categorias/update");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          alert(respuesta[0]);


          }
      });
  
    return false;
    
   });  

</script>