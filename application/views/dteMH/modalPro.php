<script>
 $(document).ready(function() {
        llenacombos();
		 modalPro();
     modalPartida();
    limpiar();

        $('#item81').on("input", function() {
            var dInput = this.value;
           

           BucarCodigo(dInput,areafact);

        });
     function BucarCodigo(dInput,areafact){
          var Datos = {
                "codigo": dInput,
                "area": areafact,

            };
          var url = "<?php echo base_url("mhdte/generales/listaProducto");?>";
            $.ajax({
                type: "POST",
                url: url,
                data: Datos,
                success: function(data) {

                    arregleProducto = JSON.parse(data);
                    $("#item84").empty();
                    $('#item85').val('');
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
     }   
     
        $('#item84').on('click', function() {

            llenartext($(this).val());

        });
      
        function llenartext(num) {

            fila = num;

            $('#item81').val(arregleProducto[fila].codigo);

            if ($('#tipodocSelect').val() == "store") {
                $('#item85').val(arregleProducto[fila].precio);

            } else {

                $('#item85').val(arregleProducto[fila].precioPub);
            }

            $('#item83').val(arregleProducto[fila].UnidadMedida);
        }


        $('#txt1').on("input", function() {

            if ($('#txt1').val().length > 1) {

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
                                text:  arregleclientes[i]['codigo'] + ' -- ' +arregleclientes[i]['NomDenominacion']
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

    function limpiar2(){
        tableDetalle.clear().draw();
        tableDetalle2.clear().draw();
        tableDetalle3.clear().draw();
    }
        
    function limpiar(){
            
      tableDetalle = $('#example').DataTable({

            scrollY: '30vh',
            scrollCollapse: true,
            paging: false,
            searching: false,
          destroy:true

        });
      tableDetalle2 = $('#example2').DataTable({

            scrollY: '30vh',
            scrollCollapse: true,
            paging: false,
            searching: false,
          destroy:true


        });
 tableDetalle3 = $('#examplePro').DataTable({

           scrollY: '30vh',
            scrollCollapse: true,
            paging: false,
            searching: false,
          destroy:true


        }); 
        
        tableDetalle4 = $('#tablaPartida').DataTable({

           scrollY: '30vh',
            scrollCollapse: true,
            paging: false,
            searching: false,
          destroy:true


        });
        
    }
    function modalPro(){
        
        var Datos = {
                "codigo": "",
                "area": areafact,

            };
       
          var url = "<?php echo base_url("mhdte/serviciosgenerales/buscarProductos");?>";
        $.ajax({
            type: "POST",
            url: url,
            data: Datos,
            success: function(data) {

                datos_tabla_new = JSON.parse(data);

                tableDetalle3 = $('#examplePro').DataTable({
                    "processing": true,
                    "destroy": true,
                    paging: true,
                    scrollY: '30vh',
                    scrollCollapse: true,

                    searching: true,
                    "data": datos_tabla_new,
                    "columns": [{
                            data: "codigo"
                        },

                        {
                            data: "descripcion"
                        },
                        {
                            data: "null",
                             "mRender": function(data, type, value) {
                               cod=   "'"+value["codigo"]+"'";
                               item="'"+value["precio"]+"'";
                               num="'"+value["descripcion"]+"'";
                               um="'"+value["UnidadMedida"]+"'";
                                
                                return '<span>'+item+'</span> <a class="btn" href="#" onclick="AgregoPro(' +  cod+ ',' +  num+ ',' +  item+ ',' +  um+ ')"><i class="glyphicon glyphicon-saved"></i></a>'
                            },
                            width: "170px",

                           
                        }

                    ],

                   

                });


            }
        });

        
        
    }
    
    function AgregoPro(cod,num,item,um){
        $('#item81').val(cod);
        $('#item85').val(item);
        $('#item83').val(um);
         $("#item84").append($("<option>", {
                            value: cod,
                            text: num
                        }));
        $('#Bpro').modal('hide');
    }
    
    function modalPartida(){
        $('#modalPartida').show();
        
    }

</script>