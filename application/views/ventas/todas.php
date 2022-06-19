<div class="col-xs-12">
    <h1>Ventas</h1>
    <?php if(!empty($this->session->flashdata())): ?>
        <div class="alert alert-<?php echo $this->session->flashdata('clase')?>">
            <?php echo $this->session->flashdata('mensaje') ?>
        </div>
    <?php endif; ?>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Número</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Detalles</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ventas as $venta){ ?>
            <tr>
                <td><?php echo $venta->id ?></td>
                <td><?php echo $venta->fecha ?></td>
                <td><?php echo $venta->total ?></td>
                <td><a class="btn btn-info" href="<?php echo base_url() . "Ventas/detalle/" . $venta->id?>"><i class="fa fa-info"></i></a></td>
                <td><a class="btn btn-danger" href="<?php echo base_url() . "Ventas/eliminar/" . $venta->id?>"><i class="fa fa-trash"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>