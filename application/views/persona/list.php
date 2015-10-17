
	<?php foreach ($personas as $item) { ?>
		<?php $item = (Object) $item; ?>
		<tr>		   				
			<td><?= $item->id ?></td>
			<td class="persona_nombre"><?= $item->nombre ?></td>
			<td><?= $item->genero ?></td>
			<td><?= $item->fecha_nacimiento ?></td>
			<td><?= $item->edad ?></td>
			<td> 
				<button oref="<?= $item->id ?>" type="button" class="persona_edit btn btn-info">Editar</button>
				<button oref="<?= $item->id ?>" type="button" class="persona_delete btn btn-danger">Eliminar</button>
			</td>
		</tr>
	<?php } ?>
