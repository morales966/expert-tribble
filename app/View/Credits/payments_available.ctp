<div class="content-wrapper">
	<div class="container-fluid cuadro_panding">
		<div class="bg-white-content mb-2">
			<div class="row ">
				<div class="col-md-7">
					<h2 class="tittle">Créditos por pagar</h2>
				</div>
				<div class="col-md-5 text-right">
					<div class="input-group">
						<?php if (isset($this->request->query['q'])){ ?>
							<input type="text" class="form-control" value="<?php echo $this->request->query['q']; ?>" placeholder="Buscador por cédula"  disabled="disabled">
							<div class="input-group-append">
								<button class="btn btn-secondary" type="button" id="texto_busqueda" data-toggle="tooltip" data-placement="top" title="Borrar">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						<?php } else { ?>
							<input type="text" class="form-control" placeholder="Buscador por cedula" id="txt_buscador">
							<div class="input-group-append">
								<button class="btn btn-secondary btn_buscar" type="button" data-toggle="tooltip" data-placement="top" title="Buscador">
									<i class="fa fa-search"></i>
								</button>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="table-responsive mt-3">
				<table class="table table-hover">
					<thead class="thead-light ">
						<tr>
							<th>Identificación</th>
							<th>Cupo aprobado</th>
							<th>Valor deducido</th>
							<th>Valor a retirar</th>
							<th>Estado de pago</th>
							<th>Fecha de pago</th>
							<th>Comprobante</th>
							<th>Factura</th>
							<th>Nota</th>
							<th class="actions">Acción</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($credits as $credit): ?>
							<tr>
								<td>
									<?php echo h($credit['Credit']['cedula_persona']); ?>
									<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del cliente" class="ver_datos_cliente" data-uid="<?php echo $credit['Credit']['id']; ?>">
										<i class="fa fa-user"></i>
									</a>
									&nbsp;
								</td>
								<td>
									<?php echo number_format($this->Utilities->find_cupo_aprobado_credito($credit['Credit']['id'],0,",","."));?>&nbsp;
								</td>
								<td></td>
								<td></td>
								<td><?php echo $this->Utilities->estados_pago($credit['Credit']['state']); ?>&nbsp;</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td class="actions">
									<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Ver datos del crédito" class="ver_credito" data-uid="<?php echo $credit['Credit']['id']; ?>">
										<i class="fa fa-eye"></i>
									</a>
									<?php if ($credit['Credit']['state'] == Configure::read('variables.nombres_estados_creditos.Aprobado_retirado')): ?>
										<a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Desenbolsar" class="solicitud_desenbolsar" data-uid="<?php echo $credit['Credit']['id']; ?>">
											<i class="fa fa-money"></i>
										</a>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<p>
					<?php
					echo $this->Paginator->counter(array(
						'format' => __('Página {:page} de {:pages}, mostrando {:current} resultados en {:count} total')));
						?>
				</p>
				<div class="row numberpages">
					<?php
					echo $this->Paginator->first('<< ', array('class' => 'prev'), null);
					echo $this->Paginator->prev('< ', array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->counter(array('format' => '{:page} de {:pages}'));
					echo $this->Paginator->next(' >', array(), null, array('class' => 'next disabled'));
					echo $this->Paginator->last(' >>', array('class' => 'next'), null);
					?>
					<b><?php echo $this->Paginator->counter(array('format' => '{:count} registros en total')); ?></b>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	echo $this->Html->script("controller/credits/payments_avaliable.js?".rand(),						array('block' => 'AppScript'));
?>