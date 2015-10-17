
<?php if (isset($error)){ ?>

	<div class="alert alert-danger" role="alert"><?php echo $error; ?></div>

<?php }
else {
?>

	<div class="center-block" style="float:none;">
		<div class="panel panel-info">

			<div class="panel-heading"><?= $titulo ?></div>

			<div class="panel-body">
				<?php echo form_open("persona/".$action, array("class"=>"form-fluid", "id"=>"form_persona")); ?>
					
			    	<input type="hidden" id="id" name="id" value="<?php if(isset($id)){ echo $id; } ?>">
					
					<div class="form-group">
						<label for="nombres">Nombres</label>
			    		<input type="text" class="form-control" id="nombres" name="nombres" required="required" value="<?php if(isset($nombres)){ echo $nombres; } ?>">
					</div>
					<div class="form-group">
						<label for="apellidos">Apellidos</label>
			    		<input type="text" class="form-control" id="apellidos" name="apellidos" required="required" value="<?php if(isset($apellidos)){ echo $apellidos; } ?>">
					</div>
					<div class="form-group">
						<label for="genero">Genero</label>
			    		<select class="form-control" id="genero" name="genero" required="required">
			    			<option value="Hombre" <?php if(isset($genero) && $genero == 'Hombre'){ echo "selected='selected'"; } ?> >Hombre</option>
			    			<option value="Mujer" <?php if(isset($genero) && $genero == 'Mujer'){ echo "selected='selected'"; } ?> >Mujer</option>
			    		</select>
					</div>
					<div class="form-group">
						<label for="fecha_nacimiento">Fecha de nacimiento</label>
			    		<input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required="required" value="<?php if(isset($fecha_nacimiento)){ echo $fecha_nacimiento; } ?>">
					</div>

					<button id="form-submit" type="submit" class="btn btn-default"><?php $showAction = $titulo == "Nueva persona" ? "Guardar datos" : "Actualizar datos"; echo $showAction ?></button>

				<?php echo form_close() ?>

				
			

			</div>
		</div>
	</div>

<?php } ?>

<script type="text/javascript">
$(document).ready(function() {
	$('input[name="fecha_nacimiento"]').datepicker({
		format: 'dd/mm/yyyy'
	}).attr("readonly","readonly");

});
</script>