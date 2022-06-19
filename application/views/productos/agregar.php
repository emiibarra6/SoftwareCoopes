<div class="col-xs-12">
	<h1>Nuevo producto</h1>
	<?php if(!empty($this->session->flashdata())): ?>
		<div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
			<?php echo $this->session->flashdata('mensaje') ?>
		</div>
	<?php endif; ?>
	<form method="post" action="<?php echo base_url() ?>Productos/guardar">
	<div class="row mt-2 mb-2">
		<div class="col-12 col-md-6">
		<label for="codigo">Código de barras:</label>
		<input class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código">
		</div>
		<div class="col-12 col-md-6">
		<label for="descripcion">Descripción:</label>
		<input required id="descripcion"  type="text" name="descripcion" class="form-control" placeholder="Escribe la descripción">
		</div>
	</div>
	
	<div class="row mt-2 mb-2">
		<div class="col-12 col-md-6">
		<label for="precioVenta">Precio de venta:</label>
		<input class="form-control" name="precioVenta" required type="number" id="precioVenta" placeholder="Precio de venta">
		</div>
		<div class="col-12 col-md-6">
		<label for="precioCompra">Precio de compra:</label>
		<input class="form-control" name="precioCompra" required type="number" id="precioCompra" placeholder="Precio de compra">
		</div>
	</div>

	<div class="row mt-2 mb-2">
		<div class="col-12">
		<label for="existencia">Existencia:</label>
		<input class="form-control" name="existencia" required type="number" id="existencia" placeholder="Cantidad o existencia">
		</div>
	</div>

		<br><br><input class="btn btn-info" type="submit" value="Guardar">
	</form>
</div>