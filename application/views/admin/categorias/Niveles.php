
        <!-- =============================================== -->
    
        <!-- Content Wrapper. Contains page content -->
      
<div class="right_col" role="main">
          <!-- top tiles -->
         
          <!-- /top tiles -->

<div class="">
<div class="x_content">

<div class="title_left">
                <h3>Lista de Generales de Cuentas<small></small></h3>
</div>

<!-- modals -->

<!-- small modal -->

<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" id="myModal">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Nuevo Nivel</h4>
                          
                        </div>
                        <div class="modal-body">
                          <h4>El numero de Nivel se Agregara Automático, solamente tiene que dar clic en el boton</h4>
                          <button type="button" onclick="AgregaNivel()" class="btn btn-secondary" data-toggle="tooltip" data-placement="left" title="" data-original-title="Tooltip left">Agregar un Nuevo Nivel</button>
                        </div>
                        </div>
                    </div>
                  </div>

<!-- small modal -->

</div>
<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Nivel de Cuentas <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Agregar nuevo Nivel</button></h2>


                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-md-12">
                            <div class="card-box table-responsive">
                   
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>

 <!-- /.content-wrapper -->
        </div>
         
        <br />

<div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Clasificación de Cuentas <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example2-modal-sm">Agregar clasificación</button></h2>
                    <div class="modal fade bs-example2-modal-sm" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;" id="myModal">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">Nueva Clasificación</h4>
                          

                        </div>
                        <div class="modal-body">
                        <form id="nuevaclasifica" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">

<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nombre: <span class="required"></span>
  </label>
  <div class="col-md-6 col-sm-6 ">
    <input type="text" id="nombre" required="required" class="form-control ">
  </div>
</div>
<div class="item form-group">
  <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Orden <span class="required">*</span>
  </label>
  <div class="col-md-6 col-sm-6 ">
    <input type="text" id="orden" required="required" class="form-control">
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
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                      </li>
                      
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: none;">
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
                          <th>Nombre</th>
                          <th>Orden</th>
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

function AgregaNivel(){
  var Datos = {
               "agregar" : 1,
       };
    
       var url = "<?php echo base_url("mantenimiento/Categorias/agreganivel");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          alert(respuesta[0]);
          $('#myModal').modal('hide');

          }
      });

}

function cargarclasificacion() {
    
     var Datos= {
                  "estado":"estado",
                  "fechaou":''
                };

    $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("mantenimiento/Categorias/listaclasificacion");?>",
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
          { data: "codigo"},
          { data: "nombre"},
          { data: "orden"},
          { data: "link" }
           ],
 
       
        
  } );
  }
});
}

$('#nuevaclasifica').submit(function(){

     
     var Datos = {
               "nombre" : $('#nombre').val(),
               "orden" : $('#orden').val(),
               };
    
       var url = "<?php echo base_url("mantenimiento/Categorias/guardarClasificacion");?>";
       $.ajax({                        
          type: "POST",                 
          url: url,                     
          data: Datos, 
          success: function(data)   {          
          
          respuesta=JSON.parse(data);  
          alert(respuesta[0]);
          $('#myModal2').modal('hide');
          cargarclasificacion();
          $("#nuevaclasifica")[0].reset();

          }
      });
  
    return false;
    
   });  
    


</script>