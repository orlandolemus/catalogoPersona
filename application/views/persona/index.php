<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Catalogo Personas</title>
	
	<link href="<?php echo base_url() ?>resources/css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>resources/vendor/datepicker/css/datepicker.css" >

	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="<?php echo base_url() ?>resources/js/main.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>resources/vendor/datepicker/js/bootstrap-datepicker.js"></script>
	<script src="<?php echo base_url() ?>resources/vendor/validate/jquery.validate.min.js"></script>
	<script src="<?php echo base_url() ?>resources/vendor/validate/additional-methods.min.js"></script>

</head>
<body>

<div>

		
	<div class="row"></div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Administraci&oacute;n de personas
					<button id="persona_new" type="button" class="edit btn btn-primary pull-right" style="margin: -7px;">Nuevo</button>
				</div>

				<div class="panel-body">

					<div class="col-sm-8">

						<div class="table-responsive">
						  	<table class="table table-bordered">
						  		<thead>
						  			<tr>
						  				<th>ID</th>
						  				<th>NOMBRE COMPLETO</th>
						  				<th>GENERO</th>
						  				<th>FECHA NACIMIENTO</th>
						  				<th>EDAD</th>
						  				<th>OPCIONES</th>
						  			</tr>
						  		</thead>
						   		<tbody id="personas-list">
						  			<?php $this->load->view('persona/list') ?>
						  		</tbody>
						  	</table>
						</div>

					</div>

					<div class="col-sm-4">

						<!-- ALERT -->	
						<div id="main-alert" style="margin-top:5px;"></div>
						
						<div id="form-box">

						</div>
					</div>	
					
				</div>
			</div>
		</div>


		
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {

	$(document).on("click", "#persona_new", function(){
		$("#form-box").load("<?php echo site_url('persona/buildForm');?>");
		$("#form-box").show();
	});

	$(document).on("click", ".persona_edit", function(){
		id = $(this).attr('oref');
		$("#form-box").load("<?php echo site_url('persona/buildForm');?>",{id: id});
		$("#form-box").show();
	});

	$(document).on("click", ".persona_delete", function(){
		id = $(this).attr('oref');
		if(confirm("¿Realmente desa eliminar a " + $(this).parents('tr').find('.persona_nombre').html() + "?")){

			$.post("<?php echo site_url('persona/deleteAction');?>", { id: id}, showResult, "text");
		}
	});

	$(document).on("click","#form-submit", function(){
		
		form = $('#form_persona');

        jsonData = {};

        data = form.serializeFormJSON(); //Crea un arreglo serializado de los campos y valores del form			
		jsonData.persona = data; //Agrega el arreglo serializado con formato json al arreglo vacio del objeto jdonData	
		error = false;

		$.each(jsonData.persona, function(i, v){
			if(v == "" && i != "id"){
				error = true;
			}
		});

		if(!error){
			sendJsonData(jsonData);
		}else{
			showMessage("Debe completar todos los campos", "danger");
		}
    });

	function sendJsonData(jSon){
		form = $('#form_persona');
		dataString = JSON.stringify(jSon); //Da formato json a todo el objeto jsonData
		url = form.attr("action");
		$.post(url, { data: dataString}, showResult, "text");		
	}
	
	function showResult(res) {
	
		obj = JSON.parse(res); //Convierte los datos recibidos en formato texto plano a formato json
		
		if(obj.status == "ok"){
			showMessage(obj.msj, "success");
			$("#form-box").hide();
			$("#personas-list").load("<?php echo site_url('persona/buildGrid');?>");
		}
		else{
			showMessage(obj.msj, "danger");
		} 
	}	

	$(document).on('submit', '#form_persona', function(event) {
		event.preventDefault();
	});

});
</script>

</body>
</html>