
		
		<!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->

      
        <div class="right_col" role="main">
          <!-- top tiles -->
          <!-- /top tiles -->

		<div class="container">
            <div class="col-md-4 col-sm-4  profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h2 class="brief"><i>Autenticacion con MH</i></h4>
                            <div class="left col-sm-12">
                              <h2>Duracion:</h2>
                              <p>Hasta las 11:59 pm del dia </p>
                              
                            </div>
                            <div class="right col-sm-5 text-center">
                              <input type="text" id="user" class="form-control" value="02033110660019"
                                <br>
                                <input type="password" id="senia" class="form-control" value="coopcuzcaDet2023*">
                            </div>
                          </div>
                          <div class=" bottom text-center">
                            <div class=" col-sm-12 emphasis">
                             
                            <div class=" col-sm-8 emphasis">
                             
                              <button type="button" class="btn btn-info btn-lg" id="btnApi">Auntenticar API MH</button>
                            </div>
                          </div>
                        </div>
                      </div>
  <!-- Trigger the modal with a button -->

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

	





	$('#btnApi').on('click', function(){
		console.log('click');
				const url = 'https://apitest.dtes.mh.gob.sv/seguridad/auth';
				const user = $('#user').val();
				const pwd =$('#senia').val();

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
  });
		
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
                            respuesta = JSON.parse(data);
                             new PNotify({
            title: 'Autenticar',
            text: respuesta.message,
            type: 'info',
            styling: 'bootstrap3'
        });
                           
						},
						error: function(data) {
								console.log(data);
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


// *********************************************************************************************** ******************

    </script>
      
        <!-- /.content-wrapper -->
