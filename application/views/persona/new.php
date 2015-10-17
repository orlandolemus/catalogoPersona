
<script type="text/javascript">
$(document).ready(function(e){

/**********************************************************/  
/******************CONFIGUARACION INICIAL******************/
	
	//Objeto de datos con formato jSon a enviar al server
	var jsonData = { 
		tipo: "04",
		dat_noVenta: new Array()
	};
	
/*****************************************************************/	
/************** CREAR NUEVO USUARIO *****************/

	// Boton inscripcion click.
	$( "#insertar_button" ).click(function(){
		submit = false;
		$("#form_dat_pers").submit(); //Ejecutar Formulario. Validacion de campos
		
	});
    

/*****************************************************/
/*****************PROCESAR INSCRIPCION****************/
	
	// NO ---- Funcion para envio de datos y presentacion de resultado
	function sendJsonData(){
		submit = true;
		var dataString = JSON.stringify(jsonData); //Da formato json a todo el objeto jsonData
		
		$.post("<?php echo site_url('usuario/new_usuario');?>", { data: dataString}, showResult, "text");		
	}
	
	function showResult(res) {
	
		obj = JSON.parse(res); //Convierte los datos recibidos en formato texto plano a formato json
		
		if(obj.result == "ok"){
			
			// Mostrar dialogo de mensaje ok
			$("#dialog_ok .text_msj").html(obj.mensaje);
			$("#dialog_ok").dialog({
				title:"Registro completado.",
				buttons: {
					Ok: function() {
						$( this ).dialog( "close" );
					}
				},
				close: function(){
					//location.reload();
					$('.flex_usuarios').flexOptions({}).flexReload({});		
					$("#form_dat_pers").reset();
				}
			});
			$("#usuario_form" ).dialog( "close" );
			$("#dialog_ok").dialog( 'open' );

		}
		else{
			// Mostrar dialogo de mensaje error
			$("#dialog_error .text_msj").html( obj.mensaje );
            $("#dialog_error").dialog( 'open' );
		} 
	}
		
	/* ------------------------------------- */
	
	jQuery.validator.messages.required = "campo requerido";
	
	//Validacion datos personales:
	$("#form_dat_pers").validate({	
		invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = 'Tiene campos incorrectos.<br />Debe corregirlos para continuar.';
				$('html, body').animate({ scrollTop: '0px' }, 500); //Ir al inicio de la pagina, para ver el mensaje de error
				$("div.error").html(message);
				$("div.error").show('slow');
				setTimeout(function() { $("div.error").html(""); $("div.error").hide('slow'); }, 4200 );

			} else {
				$("div.error").hide('slow');
			}
		},
		onkeyup: false,
		submitHandler: function(e) {
			$("div.error").hide();
					
			$form = $("#form_dat_pers"); //Variable direccionada al formulario			
			data = $form.serializeFormJSON(); //Crea un arreglo serializado de los campos y valores del form			
			jsonData.dat_persona = data; //Agrega el arreglo serializado con formato json al arreglo vacio del objeto jdonData			
			console.log( "Form Personal: "+JSON.stringify(data) );
		
			//REALIZAR ACCION
			if(submit == false)
				sendJsonData(); //Procesar y enviar datos
		
		},
		rules: {
			txt_Usuario: { 
				required: true, rangelength: [5, 15],
				remote: {
					url: "<?php echo site_url('usuario/check_usuario/ins'); ?>",
					type: "post"
				}
			},
			txt_Password: { required: true, password: true, rangelength: [6, 18] },
			txt_Password2: { required: true, password: true, rangelength: [6, 18], equalTo: "#txt_Password" },
			txt_Nombres: { required: true },
			txt_Apellidos: { required: true },
			cbb_Genero: { required: true },
			cbb_Tipo: { required: true },
			txt_Direccion: { required: false},
			cbb_Departamento: { required: true },
			cbb_Municipio: { required: true },
			txt_Email: { required: true, email: true},
			txt_Celular: { required: false },
			txt_TelFijo: { required: false }
		},
		messages: {
			txt_Usuario: { 
				required: " ", 
				remote: "Usuario ya registrado, ingrese un nombre de usuario diferente." 
			},
			txt_Email: { 
				required: " ",
				email: "Ingrese una direcci\u00F3n Email v\u00E1lida, ejemplo: you@yourdomain.com",
				remote: "Email ya registrado, ingrese una direcci\u00F3n Email diferente."
			},
			txt_Password2: { 
				required: " ", 
				equalTo: "Los campos de password no coinciden" 
			}
		},
		debug:true
	});
	
	// EFECTOS AYUDA ---------------------------------------------------------
	
	$("#dialog_info .text_msj").append( $('div#help_fecha') );
	$("#dialog_info").dialog({
		title:"Ayuda para ingresar fecha.",
		height: 'auto',
		width: 'auto',
		buttons: {
			cerrar: function() {
				$( this ).dialog( "close" );
			}
		}
	});
		
	$('label[for="txt_FechaNac"]').click(function(e){
		// Mostrar dialogo de informacion
		$("#dialog_info").dialog( 'open' );
	});		
});
</script>