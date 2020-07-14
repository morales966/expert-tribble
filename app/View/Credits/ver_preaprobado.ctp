<h2 class="titleView">Registro de retiros</h2>
<div class="table-responsive">
	<table class="table">
			<thead class="thead-dark">
			<tr>
				<th>Asesor</th>
				<th>Valor retiro</th>
				<th>Fecha registro</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($all_registros_cupo as $stage): ?>
			<tr>
				<td><?php echo $this->Utilities->name_user($stage['Stage']['user_id']); ?></td>
				<td><?php echo h(number_format($stage['Stage']['cupo_aprobado'],0,",","."));?>&nbsp;</td>
				<td><?php echo h($stage['Stage']['created']); ?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>
<br>
<span>Valor retirado: <?php echo number_format($valor_retiro[0]['total'],0,",","."); ?></span>
<br>
<span>Cupo aprobado: <?php echo number_format($cupo_aprobado['Credit']['cupo_aprobado'],0,",",".") ?></span>
<br>
<span>Valor restante: <?php echo number_format($cupo_aprobado['Credit']['cupo_aprobado']-$valor_retiro[0]['total'],0,",",".") ?></span>