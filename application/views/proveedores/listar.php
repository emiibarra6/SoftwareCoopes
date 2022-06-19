<div class="col-xs-12">
    <h1>Proveedores</h1>
    <?php if(!empty($this->session->flashdata())): ?>
		<div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
			<?php echo $this->session->flashdata('mensaje') ?>
		</div>
	<?php endif; ?>
    <div>
        <a class="btn btn-success" href="<?php echo base_url() ?>Proveedores/agregar">Nuevo <i class="fa fa-plus"></i></a>
    </div>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>CUIT</th>
                <th>Nombre</th>
                <th>Celular</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($proveedores as $p){ ?>
            <tr>
                <td><?php echo $p->id ?></td>
                <td><?php echo $p->cuit ?></td>
                <td><?php echo $p->nombre ?></td>
                <td><?php echo $p->celular ?></td>
                <td><a class="btn btn-warning" href="<?php echo base_url() ."Proveedores/editar/" . $p->id ?>"><i class="fa fa-edit"></i></a></td>
                <td><a class="btn btn-danger" href="<?php echo base_url() ."Proveedores/eliminar/" . $p->id ?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>