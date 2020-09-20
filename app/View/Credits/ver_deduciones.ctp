 <table class="table table-hover">
    <thead class="thead-light ">
        <tr>
            <th>Monto</th>
            <th>Descripción</th>
            <th>Acción</th>
            <th>Fecha de registro</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($deducciones as $deduccion): ?>
            <tr>
                <td><?php echo number_format($deduccion['Deduct']['monto'],0,",",".");?>&nbsp;</td>
                <td><?php echo $deduccion['Deduct']['description_deducir']; ?></td>
                <td>
                	<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Borrar deducción" class="btn btn-sm btn-outline-primary eliminar_deduccion" data-uid="<?php echo $deduccion['Deduct']['id']; ?>">
						<i class="fa fa-ban"></i>
					</a>
				</td>
                <td><?php echo $deduccion['Deduct']['created']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>