<?php
$granTotal = 0;
?>
<div class="col-12">
	<div class="container m-0">
		<h1><label id="tipofactura">Consumidor Final</label></h1> <br>
		<H3>(alt + A) factura A</H3>
		<H3>(alt + C) Cuenta Corriente</H3>
		<H3>(alt + B) Consumidor Final</H3>
	</div>
	<?php if (!empty($this->session->flashdata())) : ?>
		<div id="flashdata" class="alert alert-<?php echo $this->session->flashdata('clase') ?>">
			<?php echo $this->session->flashdata('mensaje') ?>
		</div>
	<?php endif; ?>
	<br>

	<!--Ahora para que nunca se salga de esos elementos (INPUTS DE FORM )mediante tab, 
	HAY que usar el método focus() y usar la táctica de valor centinela.
	Un valor centinela o bandera, es un valor que te permite saber si ya se
	cumplió alguna condición, en nuestro caso, que ya estemos seleccionando
	un elemento que no es de los que queremos que tengan foco.
	Usando tabindex a nuestro favor, haremos que el primer y último elemento
	nos manden el foco a otro, en el caso del primero que nos mande al último,
	 y en el caso del último al primero, esto debido a que para navegar entre 
	 campos mediante teclado se usa Tab para avanzar en una dirección, 
	 y Shift + Tab para avanzar en dirección contraria en el órden.
	-->
	
	<form method="post" action="<?php echo base_url() ?>Vender/agregar">
	<div id="centinela1" tabindex="1" onfocus="document.getElementById('cantidad').focus()"></div>
		<div class="col-12 col-md-6">
			<label for="codigo">Código de barras:</label>
			<input autocomplete="off" autofocus class="form-control" name="codigo" required type="text" id="codigo" placeholder="Escribe el código" tabindex="2">
		</div>
		<div class="col-12 col-md-6">
			<label for="cantidad">Cantidad por defecto:</label>
			<input autocomplete="off" autofocus class="form-control" name="cantidad" required type="text" id="cantidad" value="1" tabindex="3">
	    </div>
		<input type="submit" hidden />
	<div id="centinela2" tabindex="4" onfocus="document.getElementById('codigo').focus()"></div>
	</form>
	<br><br>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>ID</th>
				<th>Código</th>
				<th>Descripción</th>
				<th>Precio de venta</th>
				<th>Cantidad</th>
				<th>Total</th>
				<th>Quitar</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($carrito as $indice => $producto) {
				$granTotal += $producto->total;
			?>
				<tr>
					<td><?php echo $producto->id ?></td>
					<td><?php echo $producto->codigo ?></td>
					<td><?php echo $producto->descripcion ?></td>
					<td><?php echo $producto->precioVenta ?></td>
					<td><?php echo $producto->cantidad ?></td>
					<td><?php echo $producto->total ?></td>
					<td><a class="btn btn-danger" href="<?php echo base_url() . "Vender/quitarDelCarrito/" . $indice ?>"><i class="fa fa-trash"></i></a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<h3>Total: <?php echo $granTotal; ?></h3>
	<input name="total" type="hidden" value="<?php echo $granTotal; ?>">
	<a href="<?php echo base_url() ?>Vender/terminarVenta" class="btn btn-success">Terminar venta</a>
	<a href="<?php echo base_url() ?>Vender/cancelarVenta" class="btn btn-danger">Cancelar venta</a>

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
</div>