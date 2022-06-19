<div class="col-xs-12">
	<h1>Editar proveedor</h1>
	<form method="post" action="<?php echo base_url() ?>Proveedores/guardarCambios">
		<input name="id" type="hidden" value="<?php echo $proveedor->id ?>">
		<div class="row mt-2 mb-2">
			<div class="col-12 col-md-6">
				<label for="cuit">CUIT:</label>
				<input value="<?php echo $proveedor->cuit ?>" class="form-control" name="cuit" required type="text" id="cuit">
			</div>
			<div class="col-12 col-md-6">
				<label for="nombre">Nombre:</label>
				<input value="<?php echo $proveedor->nombre ?>" class="form-control" name="nombre" required type="text" id="nombre">
			</div>
		</div>
		<div class="row mt-2 mb-2">
			<div class="col-12">
				<label for="celular">Celular:</label>
				<input value="<?php echo $proveedor->celular ?>" class="form-control" name="celular" required type="text" id="celular">
			</div>
		</div>
		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>